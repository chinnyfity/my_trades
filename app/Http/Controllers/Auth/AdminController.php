<?php

namespace App\Http\Controllers\Auth;
use illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Setting;
use App\Models\Other_setting;
use App\Models\Country;
use App\Models\State;
use App\Models\Notification;
use App\Models\Admin_tbl;
use Validator;
use Illuminate\Support\Facades\Route;
use DataTables;
use Cookie;
use DB;


class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin_tbl')->except('logout');

        $this->folder = "";
        /* if(url('/') == "https://microfinancetrades.com"){
            $this->folder = "/public/";
        } */
        \View::share('folder', $this->folder);

    }


    public function index() {
        $data['page_name'] = "dashboard_index";
        $data['page_title'] = "Administrator";
        $data['transactions'] = Transaction::orderBy('id', 'desc')->take(10)->get();
        $data['user_count'] = User::count();
        $data['new_user_count'] = User::whereRaw('created_at > DATE_SUB(NOW(), INTERVAL 3 DAY)')->count();
        $data['pending_deposit'] = Transaction::whereRaw('date_created > DATE_SUB(NOW(), INTERVAL 3 DAY)')->whereStatus('pending')->whereTrans_type('deposit')->count();

        $data['pending_withdrawal'] = Transaction::whereRaw('date_created > DATE_SUB(NOW(), INTERVAL 3 DAY)')->whereStatus('pending')->whereTrans_type('withdrawal')->count();

        $data['total_btc'] = Transaction::whereCoins('btc')->whereStatus('approved')->sum('amt_usd');
        $data['total_eth'] = Transaction::whereCoins('eth')->whereStatus('approved')->sum('amt_usd');
        $data['total_usdt'] = Transaction::whereCoins('usdt')->whereStatus('approved')->sum('amt_usd');

        return view('auth.shield.index', $data);
    }

    public function transactions() {
        //$bonus_wallet = Setting::orderBy('id', 'desc')->get();
        $data['page_name'] = "transactions_adm";
        $data['page_title'] = "Customers Transactions";
        return view('auth.shield.tables', $data);
    }

    public function withdrawal() {
        $data['page_name'] = "withdrawal";
        $data['page_title'] = "Customers Withdrawals";
        return view('auth.shield.tables', $data);
    }

    public function members_wallet() {
        $data['page_name'] = "members_wallet";
        $data['page_title'] = "Customers Wallets";
        return view('auth.shield.tables', $data);
    }

    function settings(){
        $data['settings'] = Setting::find(1);
        //$data['other_settings'] = Other_setting::orderBy('id', 'asc')->pluck('names', 'percents');
        $data['other_settings'] = Other_setting::select('names', 'percents')->orderBy('id', 'asc')->get();
        $data['page_name'] = "settings";
        $data['page_title'] = "Settings";
        return view('auth.shield.forms', $data);
    }

    public function allUsers() {
        $data['page_name'] = "users";
        $data['page_title'] = "Users | Administrator";
        return view('auth.shield.tables', $data);
    }

    public function wallets() {
        $data['page_name'] = "wallets";
        $data['page_title'] = "Users Wallet | Administrator";
        return view('auth.shield.tables', $data);
    }

    public function edit_password() {
        $data['url_id'] = "";
        $data['page_name'] = "edit_password";
        $data['page_title'] = "Update Your Password";
        return view('auth.shield.index', $data);
    }


    public function updateSettings1(Request $request){
        $attributes = [
            'txtcharges'        => 'Withdrawal Charges',
            //'txtstop_earn'      => 'Pause Earning',
            'txtbtc_min'        => 'BTC Minimum',
            'txtbtc_max'        => 'BTC Maximum',
            'txteth_min'        => 'ETH Minimum',
            'txteth_max'        => 'ETH Maximum',
            'txtusdt_min'       => 'USDT Minimum',
            'txtusdt_max'       => 'USDT Maximum',
        ];

        $rules = [
            'txtcharges'     => 'required|numeric|min:1|max:10',
            'txtbtc_min'     => 'required|numeric|min:3|gt:49',
            'txtbtc_max'     => 'required|numeric|min:3|gt:txtbtc_min',
            'txteth_min'     => 'required|numeric|min:3|gt:49',
            'txteth_max'     => 'required|numeric|min:3|gt:txteth_min',
            'txtusdt_min'    => 'required|numeric|min:3|gt:49',
            'txtusdt_max'    => 'required|numeric|min:3|gt:txtusdt_min',
        ];

        $messages = [
            'required'      => ':attribute field is required',
            'alpha'         => ':attribute may only contain letters.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages)->setAttributeNames($attributes);

        if($validator->fails()){
            return response($validator->errors()->all(), 200);
        }

        $settings = Setting::find(1);
        $settings->update([
            'withdraw_charges'  => $request->txtcharges,
            'stop_earning'      => $request->txtstop_earn,
            'btc_min_max'       => $request->txtbtc_min.",".$request->txtbtc_max,
            'eth_min_max'       => $request->txteth_min.",".$request->txteth_max,
            'usdt_min_max'      => $request->txtusdt_min.",".$request->txtusdt_max,
        ]);

        if($settings){
            return response()->json(['success' => 'updated']);            
        }
        return response()->json(['success' => 'Error in updating settings']);
    }


    public function updateSettings2(Request $request){
        foreach ($request->plan as $key => $value) {
            $keys = str_replace('\'', "", $key);

            $settings = DB::table('other_settings')
            ->where('names', $keys)
            ->update([
                "percents" => $value,
            ]);
        }
        if($settings){
            return response()->json(['success' => 'updated']);            
        }
        return response()->json(['success' => 'Error in updating settings']);
    }


    public function updateSettings3(Request $request){
        $attributes = [
            'txtcurex'          => 'Withdrawal Charges',
            'txttraders'        => 'BTC Minimum',
            'txtcus'            => 'BTC Maximum',
            'txtccounts'        => 'ETH Minimum',
        ];

        $rules = [
            'txtcurex'       => 'required|numeric',
            'txttraders'     => 'required|numeric',
            'txtcus'         => 'required|numeric',
            'txtccounts'     => 'required|numeric',
        ];

        $messages = [
            'required'      => ':attribute field is required',
        ];
        $validator = Validator::make($request->all(), $rules, $messages)->setAttributeNames($attributes);

        if($validator->fails()){
            return response($validator->errors()->all(), 200);
        }

        $settings = Setting::find(1);
        $settings->update([
            'currency_exchange'     => $request->txtcurex,
            'active_traders'        => $request->txttraders,
            'customers'             => $request->txtcus,
            'countries_supported'   => $request->txtccounts,
        ]);

        if($settings){
            return response()->json(['success' => 'updated']);            
        }
        return response()->json(['success' => 'Error in updating settings']);
    }


    public function updateWallet(Request $request){
        $attributes = [
            'txtbtc'          => 'USD Amount for BTC',
            'txtbtc_bal'      => 'USD Balance for BTC',
            'txteth'          => 'USD Amount for ETH',
            'txteth_bal'      => 'USD Balance for BTC',
            'txtusdt'         => 'USD Amount for USDT',
            'txtusdt_bal'     => 'USD Balance for USDT',
        ];

        $rules = [
            'txtbtc'         => 'required|numeric',
            'txtbtc_bal'     => 'required|numeric',
            'txteth'         => 'required|numeric',
            'txteth_bal'     => 'required|numeric',
            'txtusdt'        => 'required|numeric',
            'txtusdt_bal'    => 'required|numeric',
        ];

        $messages = [
            'required'      => ':attribute field is required',
        ];
        $validator = Validator::make($request->all(), $rules, $messages)->setAttributeNames($attributes);

        if($validator->fails()){
            return response($validator->errors()->all(), 200);
        }

        $users = User::find($request->txtall_id_1);
        $users->update([
            'usd_btc'       => $request->txtbtc,
            'usd_btc_bal'   => $request->txtbtc_bal,
            'usd_eth'       => $request->txteth,
            'usd_eth_bal'   => $request->txteth_bal,
            'usd_usdt'      => $request->txtusdt,
            'usd_usdt_bal'  => $request->txtusdt_bal,
        ]);

        if($users){
            return response()->json(['success' => 'updated']);            
        }
        return response()->json(['success' => 'Error in updating wallet']);
    }


    public function update_my_pass_adm(Request $request){
        $attributes = [
            'txtpass1'      => 'Old Password',
            'txtpass2'      => 'New Password',
            'txtpass3'      => 'Confirm Password',
        ];
        $rules = [
            'txtpass1'      => 'required|string|min:5',
            'txtpass2'      => 'required|string|min:5|different:txtpass1',
            'txtpass3'      => 'required|string|same:txtpass2',
        ];
        $messages = [
            'required'      => 'The :attribute space is required',
            'german_url'    => 'The :attribute is not valid',
            'different'     => 'Your new password must be different with your old password',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->setAttributeNames($attributes);
        if($validator->fails()){
            return response($validator->errors()->all(), 200);
        }else{
            $newPass = sha1($request->txtpass1);
            $admin = Admin_tbl::wherePass1($newPass)->first();

            if(!$admin){
                return response()->json(['msg' => 'Your old password does not match with the one in the database.']);
            }

            $data2 = array(
                'pass1'   => sha1($request->txtpass2)
            );
            $updated = DB::table('admin_tbls')->wherePass1(sha1($request->txtpass1))->update($data2);

            if($updated){
                $userData = Admin_tbl::find(1);
                Auth::guard("admin_tbl")->login($userData, true);
                
                return response()->json(['type' => 'success', 'msg' => 'success']);
            }else{
                return response()->json(['msg' => 'Error in updating your details or no changes were made.']);
            }
        }
    }


    public function fetch_tables(Request $request){
        $routeName = Route::currentRouteName();
        //echo $routeName." kk"; exit;

        if($routeName == "users_"){
            if ($request->ajax()) {
                $data = User::orderBy('id', 'desc')->get();

                return Datatables::of($data)
                    ->addIndexColumn()

                    ->addColumn('fullname', function($row){
                        $fulls = "<font style='font-size:15px;'>".ucwords($row->fullname)."</font>";

                        if($row->plan == "")
                            $plan = "<font style='color:#777; font-size:14px;'>Not selected</font>";
                        else
                            $plan = "<font style='color:#b49327; font-size:14px;'>".strtoupper($row->plan)."</font>";
                        $user_plan = $plan;

                        return $fulls."<br>".$user_plan;
                    })

                    ->addColumn('approved', function($row){
                        $approved_1="";
                        $approved_2="";
                        if($row->approved == 1){
                            $approved_1 .= "<p id='approve_it' caps='Approved' table1='users' table='App\Models\User' colums='approved' class='approve_it$row->id' ids='".$row->id."' style='color:#090; font-size:14px; line-height:20px; cursor:pointer'>Approved</p>";
                        }else{
                            $approved_1 .= "<p id='approve_it' caps='Not Approved' table1='users' table='App\Models\User' colums='approved' class='approve_it$row->id' ids='".$row->id."' style='color:red; font-size:13.5px; line-height:20px; cursor:pointer'>Approve User</p>";
                        }

                        $approved_2 .= "<div class='border_bottom'></div>";

                        if($row->kyc == ""){
                            $approved_2 .= "<p style='color:red; font-size:13.5px; opacity:0.5; cursor:pointer; padding:8px 0px 7px 0px;' onclick='javascript:;alert(\"This user didn&prime;t unload KYC\")'>Approve KYC</p>";
                        }else{
                            if($row->kyc_approved == 1){
                                $approved_2 .= "<p id='approve_it' caps='Approved' table1='users' table='App\Models\User' colums='kyc_approved' class='approve_it$row->id' ids='".$row->id."' style='color:#090; font-size:13.5px; line-height:20px; cursor:pointer; padding:8px 0px 7px 0px;'>KYC Approved</p>";
                            }else{
                                $approved_2 .= "<p id='approve_it' caps='Not Approved' table1='users' table='App\Models\User' colums='kyc_approved' class='approve_it$row->id' ids='".$row->id."' style='color:red; font-size:13.5px; line-height:20px; cursor:pointer; padding:8px 0px 7px 0px;'>Approve KYC</p>";
                            }
                        }
                        return $approved_1.$approved_2;
                    })

                    ->addColumn('email', function($row){
                        $email = "<p><a style='color:#997a12' href='mailto:$row->email'>$row->email</a><br>";
                        $phone = "<a style='color:#997a12' href='tel:$row->phone'>$row->phone</a></p>";
                        return $email.$phone;
                    })

                    ->addColumn('rawp', function($row){
                        $pass1="";
                        if(strlen($row->rawp) <= 3) $pass1 = "<i style='color:#777;'>Not specified</i>";
                        if(strlen($row->rawp) > 3) $pass1 = substr($row->rawp, 0, 3)."******";

                        $pass1 = "<a href='#' class='passwd_caption$row->id'>$pass1</a> 
                        <a href='javascript:;' style='color:#997a12;font-weight:normal;font-size:13px;display:block' class='reveal_pass' rwpas='$row->rawp' rlpass='$pass1' ids='$row->id'>reveal</a>";

                        return $pass1;
                    })

                    ->addColumn('countrys', function($row){
                        $states = $row->states;
                        $citys = $row->citys;
                        $country = $row->countrys;
                        if(strlen($citys)>=2) $citys="$citys, ";

                        $locs = $citys.State::whereId($states)->value('name').", ".Country::whereId($country)->value('name');

                        if(strlen($locs) <= 2){
                            $locs = "Not specified";
                        }
                        return $locs;
                    })

                    ->addColumn('mft_acct', function($row){
                        $mft_acct = "MFT-".ucwords($row->mft_acct);
                        if($row->mft_acct == "") $mft_acct = "Not opened yet";
                        return "<p style='margin:0'>$mft_acct</p>";
                    })

                    ->addColumn('kyc', function ($row) { 
                        $pic_path1=""; $pic_path2="";
                        $path1=""; $path2="";

                        $myfiles="<div class='row'>";
                            if(strlen($row->kyc) >= 2){
                                $pic_path1 = asset('public/kyc_files/'.$row->kyc);
                                $ext1 = pathinfo($pic_path1, PATHINFO_EXTENSION);

                                $path1 = url("/documents/$row->kyc");
                                $path1 = "<a style='color:#b49327;font-size:14.5px;' href='$path1'>View KYC</a><br>";
                            }

                            if(strlen($row->addr_file) >= 2){
                                $pic_path2 = asset('public/kyc_files/'.$row->addr_file);
                                $ext2 = pathinfo($pic_path2, PATHINFO_EXTENSION);

                                $path2 = url("/documents/$row->addr_file");
                                $path2 = "<a style='color:#b49327;font-size:14.5px;' href='$path2'>View Address file</a><br>";
                            }
                            $myfiles .= $path1.$path2;
                        $myfiles .= "</div>";

                        if(strlen($row->kyc) <= 2 && strlen($row->addr_file) <= 2){
                            $myfiles = "Not specified";
                        }
    
                        return $myfiles;
                    })
                    
                    ->addColumn('address', function($row){
                        $myaddress = nl2br($row->address);
                        if(strlen($row->address) <= 2) $myaddress = "Not specified";
                        return $myaddress;
                    })

                    ->addColumn('created_at', function($row){
                        return date("D jS, M Y h:ia", strtotime($row->created_at));
                    })

                    ->addColumn('action', function($row){
                        //$actionBtn = '<button class="btn btn-primary btn-xs edit_me" mypage="edit-product" id="'.md5($row->id).'"><span class="fa fa-edit"></span> </button> &nbsp;';

                        $actionBtn = '<button class="btn btn-danger btn-xs btn_delete" table1="users" data-title="Delete" data-toggle="modal" data-target="#my-modal" for_id="'.$row->id.'"><span class="fa fa-trash"></span></button>';
                        return $actionBtn;
                    })
                ->rawColumns(['fullname', 'approved', 'email', 'rawp', 'country', 'mft_acct', 'kyc', 'address', 'date_created', 'action'])->make(true);
            }
        }


        if($routeName == "wallets_"){
            if ($request->ajax()) {
                $data = User::orderBy('id', 'desc')->get();

                return Datatables::of($data)
                    ->addIndexColumn()

                    ->addColumn('fullname', function($row){
                        $fulls = "<font style='font-size:15px;'>".ucwords($row->fullname)."</font>";

                        if($row->plan == "")
                            $plan = "<font style='color:#777; font-size:14px;'>Not selected</font>";
                        else
                            $plan = "<font style='color:#b49327; font-size:14px;'>".strtoupper($row->plan)."</font>";
                        $user_plan = $plan;

                        return $fulls."<br>".$user_plan;
                    })

                    ->addColumn('usd_btc', function($row){
                        $colors="color:#28961a;";
                        if($row->usd_btc <=0 ) $colors="";
                        return "<font style='$colors font-size:15px;'>$".@number_format($row->usd_btc, 2)."</font>";
                    })
                    ->addColumn('usd_btc_bal', function($row){
                        $colors="color:#28961a;";
                        if($row->usd_btc_bal <=0 ) $colors="";

                        $amts = "<font style='$colors font-size:15px;'>$".@number_format($row->usd_btc_bal, 2)."</font>";

                        $profit = $row->usd_btc_bal - $row->usd_btc;
                        $amts1="";
                        if($profit > 0 ) {
                            $colors="color:#b49327";
                            $amts1 = "<p style='font-size:12px;$colors'>Profit: ".$profit."USD</p>";
                        }else{
                            if($profit < 0 ) {
                                $colors="color:red;";
                                $amts1 = "<p style='font-size:12px;$colors'>Profit: ".$profit."USD</p>";
                            }
                        }
                        return $amts.$amts1;
                    })
                    ->addColumn('usd_eth', function($row){
                        $colors="color:#28961a;";
                        if($row->usd_eth <=0 ) $colors="";
                        return "<font style='$colors font-size:15px;'>$".@number_format($row->usd_eth, 2)."</font>";
                    })
                    ->addColumn('usd_eth_bal', function($row){
                        $colors="color:#28961a;";
                        if($row->usd_eth_bal <=0 ) $colors="";

                        $amts = "<font style='$colors font-size:15px;'>$".@number_format($row->usd_eth_bal, 2)."</font>";

                        $profit = $row->usd_eth_bal - $row->usd_eth;

                        $amts1="";
                        if($profit > 0 ) {
                            $colors="color:#b49327";
                            $amts1 = "<p style='font-size:12px;$colors'>Profit: ".$profit."USD</p>";
                        }else{
                            if($profit < 0 ) {
                                $colors="color:red;";
                                $amts1 = "<p style='font-size:12px;$colors'>Profit: ".$profit."USD</p>";
                            }
                        }

                        return $amts.$amts1;
                    })
                    ->addColumn('usd_usdt', function($row){
                        $colors="color:#28961a;";
                        if($row->usd_usdt <=0 ) $colors="";
                        return "<font style='$colors font-size:15px;'>$".@number_format($row->usd_usdt, 2)."</font>";
                    })
                    ->addColumn('usd_usdt_bal', function($row){
                        $colors="color:#28961a;";
                        if($row->usd_usdt_bal <=0 ) $colors="";

                        $amts = "<font style='$colors font-size:15px;'>$".@number_format($row->usd_usdt_bal, 2)."</font>";

                        $profit = $row->usd_usdt_bal - $row->usd_usdt;
                        $amts1="";
                        if($profit > 0 ) {
                            $colors="color:#b49327";
                            $amts1 = "<p style='font-size:12px;$colors'>Profit: ".$profit."USD</p>";
                        }else{
                            if($profit < 0 ) {
                                $colors="color:red;";
                                $amts1 = "<p style='font-size:12px;$colors'>Profit: ".$profit."USD</p>";
                            }
                        }
                        return $amts.$amts1;
                    })
                    ->addColumn('action', function($row){
                        $actionBtn = '<button class="btn btn-primary btn-xs edit_me" data-toggle="modal" data-target="#edit_modal" table1="users" for_id="'.$row->id.'" btc="'.$row->usd_btc.'" btc_bal="'.$row->usd_btc_bal.'" eth="'.$row->usd_eth.'" eth_bal="'.$row->usd_eth_bal.'" usdt="'.$row->usd_usdt.'" usdt_bal="'.$row->usd_usdt_bal.'"><span class="fa fa-edit"></span> </button> &nbsp;';


                        $btn_caption = "Stop Earn";
                        $btn_bg_color = "btn-danger";
                        $stop_actn = "stop_actn='Stop'";
                        if($row->stop_earn == 1){
                            $btn_caption = "Start Earn";
                            $btn_bg_color = "btn-success";
                            $stop_actn = "stop_actn='Start'";
                        }

                        $actionBtn = '<button class="btn '.$btn_bg_color.' btn-xs btn_stop_earn" table1="users" data-toggle="modal" data-target="#stop_earn" user_name="'.$row->fullname.'" for_id="'.$row->id.'" '.$stop_actn.'>'.$btn_caption.'</button>';

                        return $actionBtn;
                    })
                    
                ->rawColumns(['fullname', 'usd_btc', 'usd_btc_bal', 'usd_eth', 'usd_eth_bal', 'usd_usdt', 'usd_usdt_bal', 'action'])->make(true);
            }
        }


        if($routeName == "transactions_adm_"){
            if ($request->ajax()) {
                $data = Transaction::whereTransaction_status('completed')->orderBy('id', 'desc')->get();

                return Datatables::of($data)
                    ->addIndexColumn()

                    ->addColumn('user', function($row){
                        $cusName = User::find($row->user);
                        return ucwords($cusName->fullname);
                    })

                    ->addColumn('trans_type', function($row){
                        return ucwords($row->trans_type);
                    })

                    ->addColumn('status', function($row){
                        $status_1="";
                        if($row->status == "pending" || $row->status == "declined"){
                            if($row->status == "pending"){
                                $status1 = "Approve Deposit";
                            }else{
                                $status1 = "Declined";
                            }
                                
                            //$status_1 .= "<p id='approve_it' caps='Not Approved' table1='transactions' table='App\Models\Transaction' colums='status' colums2='".$row->amt_usd."' colums3='".$row->user."' class='approve_it$row->id' ids='".$row->id."' style='color:red; position:relative; top:6px; font-size:13.5px; line-height:20px; cursor:pointer'>$status1</p>";

                            $status_1 .= "<p class='approveUser' caps='Not Approved' data-toggle='modal' data-target='#approval_reason' table1='transactions' table='App\Models\Transaction' colums='status' colums2='".$row->amt_usd."' colums3='".$row->user."' status1='".$status1."' ids='".$row->id."' style='color:red; position:relative; top:6px; font-size:13.5px; line-height:20px; cursor:pointer'>$status1</p>";

                        }else if($row->status == "failed"){
                            $timeouts = "<p style='line-height:15px;font-size:11px;color:#999'>Payment Timeout</p>";
                            $status_1 .= "<span style='color:red; font-size:14px; opacity:0.4'>Failed</span>$timeouts";

                        }else{
                            // $status_1 .= "<p class='approveUser' caps='Approved' data-toggle='modal' data-target='#approval_reason' table1='transactions' table='App\Models\Transaction' colums='status' colums2='".$row->amt_usd."' colums3='".$row->user."' status1='Approved' ids='".$row->id."' style='color:#090; position:relative; top:6px; font-size:13.5px; line-height:20px; cursor:pointer'>Deposit Approved</p>";

                            $status_1 .= "<p style='color:#090; position:relative; top:6px; font-size:13.5px; line-height:20px; cursor:default'>Deposit Approved</p>";
                        }
                        return $status_1;
                    })

                    
                    ->addColumn('amt_usd', function($row){
                        $colors="";
                        if($row->status == "approved") $colors="green";
                        if($row->status == "pending") $colors="#ee4e4e";
                        if($row->status == "failed") $colors="#ee4e4e";
                        $amount = @number_format($row->amt_usd, 2);
                        return "<span style='color:$colors'>$".$amount ." (". strtoupper($row->coins).")</span>";
                    })

                    ->addColumn('decline_reason', function($row){
                        return "<i style='color:#666'>".nl2br($row->decline_reason)."</i>";
                    })
                    
                    ->addColumn('notes', function($row){
                        return "<span style='color:#555;font-weight:normal'>".nl2br($row->notes)."</span>";
                    })

                    ->addColumn('date_created', function($row){
                        return date("D jS, M Y h:ia", strtotime($row->date_created));
                    })

                    ->addColumn('action', function($row){
                        $actionBtn = '<button class="btn btn-danger btn-sm btn_delete" table1="transactions" status="'.$row->status.'" data-title="Delete" data-toggle="modal" data-target="#my-modal" for_id="'.$row->id.'"><span class="fa fa-trash"></span></button>';
                        return $actionBtn;
                    })

                ->rawColumns(['mem_id', 'amt', 'amt_usd', 'status', 'decline_reason', 'notes', 'date_created', 'action'])->make(true);
                
                //->rawColumns(['mem_id', 'amt'])->make(true);
            }
        }
        
    }


    function approve_querys(Request $request){
        $ids = $request->ids;
        $colums = $request->colums;
        $colums2 = $request->colums2; // amt 100
        $colums3 = $request->colums3; // user 20
        $tbls = $request->tbls;
        $table1 = $request->table1;
        $reason = $request->reason;
        $status3 = $request->status3;

        if($table1 == "transactions"){
            $users = User::find($colums3);
            $coins = strtolower(Transaction::whereId($ids)->first()['coins']);

            if($coins == "btc"){
                $coinType1 = "usd_btc";
                $coinType2 = "usd_btc_bal";
            }
            if($coins == "eth"){
                $coinType1 = "usd_eth";
                $coinType2 = "usd_eth_bal";
            }
            if($coins == "usdt"){
                $coinType1 = "usd_usdt";
                $coinType2 = "usd_usdt_bal";
            }

            //$approved = $tbls::whereId($ids)->first()['status'];
            
            if($status3 == "approve"){
                $approved = Transaction::whereId($ids)->first()['status'];
                if($approved == "approved"){
                    $query = DB::table($table1)->whereId($ids)->update(['status' => 'pending']);

                    if($query){
                        $users1 = DB::table('users')->whereId($colums3)->first();
                        $datas = array(
                            $coinType1 => $users1->$coinType1 - $colums2,
                            $coinType2 => $users1->$coinType2 - $colums2,
                        );
                        $updated = DB::table('users')->whereId($colums3)->update($datas);
                    }

                }else{

                    $query = DB::table($table1)->whereId($ids)->update(['status' => 'approved']);

                    // delete all pending from this user
                    DB::table('transactions')->where('user', $colums3)->where('status', 'pending')->where('trans_type', 'deposit')->delete();

                    if($query){
                        $datas = array(
                            $coinType1 => $users->$coinType1 + $colums2,
                            $coinType2 => $users->$coinType2 + $colums2,
                        );
                        $updated = DB::table('users')->whereId($colums3)->update($datas);

                        $notification = Notification::create([
                            'user'          => $colums3,
                            'message'       => "your transaction has been approved and $colums2 USD has been added to your wallet.",
                            'created_at'  => date("Y-m-d g:i a", time())
                        ]);
                    }
                }
            }

            if($status3 == "decline"){
                $query = DB::table($table1)->whereId($ids)->update(['status' => 'declined', 'decline_reason' => $reason]);
                if($query){
                    /* $users1 = DB::table('users')->whereId($colums3)->first();
                    $datas = array(
                        $coinType1 => $users1->$coinType1 - $colums2,
                        $coinType2 => $users1->$coinType2 - $colums2,
                    );
                   $updated = DB::table('users')->whereId($colums3)
                        ->where($coinType1, '>=', $users->$coinType1 + $colums2)
                        ->where($coinType2, '>=', $users->$coinType2 + $colums2)
                        ->update($datas); */
                    
                    $notification = Notification::create([
                        'user'          => $colums3,
                        'message'       => "your transaction of $colums2 USD was declined",
                        'created_at'  => date("Y-m-d g:i a", time())
                    ]);
                }
            }

            if($status3 != "decline" && $status3 != "approve"){
                $query = DB::table($table1)->whereId($ids)->update(['status' => 'pending']);
                if($query){
                    $users1 = DB::table('users')->whereId($colums3)->first();
                    $datas = array(
                        $coinType1 => $users1->$coinType1 - $colums2,
                        $coinType2 => $users1->$coinType2 - $colums2,
                    );
                    $updated = DB::table('users')->whereId($colums3)->update($datas);
                }
            }
        }else{
            $approved = $tbls::whereId($ids)->value($colums);
            if($approved == 1){
                $query = DB::table($table1)->whereId($ids)->update([$colums => 0]);
            }else{
                $query = DB::table($table1)->whereId($ids)->update([$colums => 1]);
            }
        }
        
        return ($query ? "updated" : "error");

    }

    function delete_records(Request $request){
        $txtall_id = $request->txtall_id;
        $table1 = $request->table1;

        if($table1 == "transactions"){
            $trans_details = Transaction::whereId($txtall_id)->first();
            if($trans_details['status'] == "pending" && $trans_details['trans_type'] == "withdrawal"){ 
                // update back the user's wallet on pending only
                $user_id = $trans_details['user'];
                $coins = $trans_details['coins'];
                $amt_usd = $trans_details['amt_usd'];
                $trans_type = $trans_details['trans_type'];

                if($coins == "btc"){
                    $coinType2 = "usd_btc_bal";
                }
                if($coins == "eth"){
                    $coinType2 = "usd_eth_bal";
                }
                if($coins == "usdt"){
                    $coinType2 = "usd_usdt_bal";
                }

                if($user_id){
                    $users1 = DB::table('users')->whereId($user_id)->first();
                    $datas = array(
                        $coinType2 => $users1->$coinType2 + $amt_usd,
                    );
                    $updated = DB::table('users')->whereId($user_id)->update($datas);
                    
                    $notification = Notification::create([
                        'user'          => $user_id,
                        'message'       => "the $trans_type amount of $amt_usd USD you placed was deleted and has been reverted back to your wallet",
                        'created_at'  => date("Y-m-d g:i a", time())
                    ]);
                }
            }
        }
        //exit;

        if($table1 == "users"){ // do for delete member
            $files = User::whereid($txtall_id)->get();
            if($files){
                foreach ($files as $row) {
                    $files1 = $row['kyc'];
                    $files2 = $row['addr_file'];
                    $in_folder1 = public_path()."\kyc_files\\$files1";
                    $in_folder2 = public_path()."\kyc_files\\$files2";

                    if(is_readable($in_folder1)) @unlink($in_folder1);
                    if(is_readable($in_folder2)) @unlink($in_folder2);
                }
                DB::table('notifications')->where('user', $txtall_id)->delete();
                DB::table('transactions')->where('user', $txtall_id)->delete();
            }
        }

        $is_deleted = DB::table($table1)->where('id', $txtall_id)->delete();
        echo ($is_deleted ? 1 : 0);
    }


}
