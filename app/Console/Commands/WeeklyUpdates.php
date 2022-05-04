<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Other_setting;
use App\Models\Setting;

use DB;

class WeeklyUpdates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Weekly updates trading increment';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $isStopped = Setting::where('id', 1)->first();
        if($isStopped->stop_earning == 0){
            $transactions = DB::table('transactions')
                ->select('user')
                ->whereRaw("transactions.status = 'approved' AND transactions.trans_type = 'deposit' AND transactions.amt_usd >= 20")
                ->groupBy('user');
    
            $users = DB::table('users')                
                ->whereRaw("users.approved = 1 AND users.stop_earn = 0 AND users.plan != 'null' AND users.kyc_approved = 1 AND (users.usd_btc >= 10 OR users.usd_eth >= 10 OR users.usd_usdt >= 10)")
                ->joinSub($transactions, 'transactions', function ($join) {
                    $join->on('users.id', '=', 'transactions.user');
                })->get();

            $myData1 = array(); $myData2 = array(); $myData3 = array();

            if($users){
                foreach ($users as $user) {
                    $user = User::where('id', $user->id)->first();
                    $setting1 = Other_setting::where('names', $user->plan)->value('percents');

                    $usd_btc1 = $user->usd_btc;
                    $usd_eth1 = $user->usd_eth;
                    $usd_usdt1 = $user->usd_usdt;

                    if($usd_btc1 >= 20){ // if i invested in btc, add me profit
                        $earnings = ($usd_btc1 * ($setting1 / 100)) / 7; // 7 days
                        $former_btc_amt = $user->usd_btc_bal + $earnings;
                        $myData1 = array('usd_btc_bal' => round($former_btc_amt, 2));
                    }

                    if($usd_eth1 >= 20){
                        $earnings = ($usd_eth1 * ($setting1 / 100)) / 7;
                        $former_eth_amt = $user->usd_eth_bal + $earnings;
                        $myData2 = array('usd_eth_bal' => round($former_eth_amt, 2));
                    }

                    if($usd_usdt1 >= 20){
                        $earnings = ($usd_usdt1 * ($setting1 / 100)) / 7;
                        $former_usdt_amt = $user->usd_usdt_bal + $earnings;
                        $myData3 = array('usd_usdt_bal' => round($former_usdt_amt, 2));
                    }
                    $newdata = array_merge($myData1, $myData2, $myData3);
                    $user->update($newdata);
                }
            }

            $this->info('Weekly trading executing...');
            //run php artisan schedule:work
        }
    }
}
