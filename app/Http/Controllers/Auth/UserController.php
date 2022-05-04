<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Setting;
use App\Models\Other_setting;
use App\Models\Notification;
use Illuminate\Support\Facades\Route;
use App\Models\Country;
use App\Models\State;
use App\Models\Transaction;
use DataTables;
use Cookie;



class UserController extends Controller
{

    public function __construct(){
        $this->middleware('auth:user')->except('logout');

        $this->middleware(function ($request, $next){
            $this->mem_id = Auth::guard('user')->id();
            $this->members = User::find($this->mem_id);
            $this->settings = Setting::find(1);

            $this->firstname = $this->members->fullname;
            $this->firstname1 = explode(" ", $this->firstname)[0];
            $this->lastname1 = @explode(" ", $this->firstname)[1];

            $this->disabled = "opacity:1!important";
            if($this->firstname == null || $this->members->phone == null || $this->members->kyc == null || $this->members->addr_file == null || $this->members->address == null || $this->members->kyc_approved == 0 || $this->members->mft_acct == null){
                $this->disabled = "opacity:0.5!important";
            }

            if(Route::currentRouteName() != "kyc"){
                if($this->firstname == null || $this->members->phone == null || $this->members->kyc == null || $this->members->addr_file == null || $this->members->address == null || $this->members->kyc_approved == 0 || $this->members->mft_acct == null){
                    return redirect('/dashboard/kyc');
                }
            }

            $this->notifications = Notification::whereUser($this->mem_id)->orderBy('id', 'desc')->take(5)->get();

            return $next($request);
        });

        \View::share('states2', State::whereCountry_id(160)->get());
        \View::share('countries', Country::all());
        //\View::share('notifications', $this->notifications);

        $this->folder = "/public/";
        /* if(url('/') == "https://microfinancetrades.com"){
            $this->folder = "/public/";
        } */
        \View::share('folder', $this->folder);
    }

    function rate($month, $payment, $amount){
        // make an initial guess
        $error = 0.0000001; $high = 1.00; $low = 0.00;
        $rate = (2.0 * ($month * $payment - $amount)) / ($amount * $month);

        while(true) {
            // check for error margin
            $calc = pow(1 + $rate, $month);
            $calc = ($rate * $calc) / ($calc - 1.0);
            $calc -= $payment / $amount;

            if ($calc > $error) {
                // guess too high, lower the guess
                $high = $rate;
                $rate = ($high + $low) / 2;
            } elseif ($calc < -$error) {
                // guess too low, higher the guess
                $low = $rate;
                $rate = ($high + $low) / 2;
            } else {
                // acceptable guess
                break;
            }
        }

        return $rate * 12;
    }


    public function fetch_tables(Request $request){
        $routeName = Route::currentRouteName();

        if($routeName == "transactions_"){
            if ($request->ajax()) {
                $data = Transaction::whereTransaction_status('completed')->orderBy('id', 'desc')->get();

                return Datatables::of($data)
                    //->addIndexColumn()
                    ->addIndexColumn('', function($row){
                        return "";
                    })

                    ->addColumn('status', function($row){
                        $colors="red";
                        if($row->status == "approved") $colors="green";
                        if($row->status == "pending") $colors="#ee4e4e";

                        $timeouts = "";
                        if($row->status == "failed"){
                            $timeouts = "<p style='line-height:15px;font-size:11px;color:#999'>Payment Timeout</p>";   
                        }
                        return "<span style='color:$colors'>".ucwords($row->status)."</span>$timeouts";
                    })

                    
                    ->addColumn('trans_type', function($row){
                        return ucwords($row->trans_type);
                    })

                    ->addColumn('receiver_addr', function($row){
                        return $row->receiver_addr ? $row->receiver_addr : "<label style='color:#777;font-weight:400'>No recepient</label>";
                    })

                    ->addColumn('amt_usd', function($row){
                        $colors="";
                        if($row->status == "approved") $colors="green";
                        if($row->status == "pending") $colors="#ee4e4e";
                        if($row->status == "failed") $colors="red";
                        $amount = @number_format($row->amt_usd, 2);
                        return "<span style='color:$colors'>$".$amount ." (". strtoupper($row->coins).")</span>";
                    })

                    ->addColumn('decline_reason', function($row){
                        return "<i style='color:#666'>".nl2br($row->decline_reason)."</i>";
                    })

                    ->addColumn('notes', function($row){
                        return ucfirst($row->notes);
                    })
                    
                    ->addColumn('date_created', function($row){
                        return date("D jS, M Y h:ia", strtotime($row->date_created));
                    })

                ->rawColumns(['status', 'trans_type', 'receiver_addr', 'amt_usd', 'decline_reason', 'notes', 'date_created', 'action'])->make(true);
            }
        }
        
    }


    public function contactUs(Request $request){
        $attributes = [
            'fname' => 'Firstname',
            'lname' => 'Lastname',
            'email' => 'Email',
            'phone' => 'Phone',
            'txtmsg' => 'Message',
        ];

        $rules = [
            'fname'     => 'required|string|max:20',
            'lname'     => 'required|string|max:20',
            'email'     => 'required|string|email',
            'phone'     => 'required|numeric|regex:/[0-9]{9}/',
            'txtmsg'    => 'required|string',
        ];

        $messages = [
            'required' => 'The :attribute field is required',
        ];
        $validator = Validator::make($request->all(), $rules, $messages)->setAttributeNames($attributes);

        if($validator->fails()){
            return response($validator->errors()->all(), 200);
        }

        ////////////////////////////////
        // send mail
        return response()->json(['success' => 'sent']);
        ////////////////////////////////


        /* if(Hash::check($request->pass, $userName['pass'])){
            
            $userData = User::find($userName['id']);
            Auth::guard("user")->login($userData, $request->remember); // this true is for remember me

            return response()->json(['success' => 'authenticated']);
        }
        return response()->json(['msg' => 'Invalid details entered!', 'inputs' => '']); */
    }


    public function dashboard() {
        Cookie::queue(Cookie::make('lastPage', "dashboard", 10000));
        $firstname = $this->members->fullname;
        $firstname1 = explode(" ", $firstname)[0];
        //return $this->mem_id;
        $data['page_name'] = "dashboard";
        $data['disabled'] = $this->disabled;
        $data['page_title'] = ucwords($firstname)."'s Dashboard";
        $data['users'] = $this->members;
        $data['firstname1'] = ucfirst($firstname1);
        $data['transactions'] = Transaction::whereUser($this->members->id)->orderBy('id', 'desc')->take(6)->get();
        $data['notifications'] = $this->notifications;
        return view('auth.dashboard.index', $data);
    }

    public function wallet() {
        Cookie::queue(Cookie::make('lastPage', "wallet", 10000));
        $data['page_name'] = "wallet";
        $data['page_title'] = "My Wallet";
        $data['users'] = $this->members;
        $data['notifications'] = $this->notifications;
        $data['settings'] = $this->settings;
        $data['disabled'] = $this->disabled;
        $data['firstname1'] = ucfirst($this->firstname1);
        return view('auth.dashboard.my-wallets', $data);
    }

    /* public function trading() {
        Cookie::queue(Cookie::make('lastPage', "trading", 10000));
        $data['page_name'] = "";
        $data['page_title'] = "Live Trading";
        $data['users'] = $this->members;
        
        $data['settings'] = $this->settings;
        $data['disabled'] = $this->disabled;
        $data['firstname1'] = ucfirst($this->firstname1);
        return view('auth.dashboard.trading', $data);
    } */

    public function kyc() {
        Cookie::queue(Cookie::make('lastPage', "kyc", 10000));
        $data['page_name'] = "kyc";
        $data['page_title'] = "KYC";
        $data['users'] = $this->members;
        $data['disabled'] = $this->disabled;
        $data['notifications'] = $this->notifications;
        $data['firstname1'] = ucfirst($this->firstname1);
        $data['lastname1'] = ucfirst($this->lastname1);
        return view('auth.dashboard.profile', $data);
    }

    
    public function investment_plans() {
        Cookie::queue(Cookie::make('lastPage', "investment_plans", 10000));
        $data['page_name'] = "investment_plans";
        $data['page_title'] = "Investment Plans";
        $data['users'] = $this->members;
        $data['disabled'] = $this->disabled;
        $data['notifications'] = $this->notifications;
        $data['firstname1'] = ucfirst($this->firstname1);
        $data['lastname1'] = ucfirst($this->lastname1);
        return view('auth.dashboard.plans', $data);
    }

    
    public function deposit() {
        Cookie::queue(Cookie::make('lastPage', "deposit", 10000));
        $data['settings'] = $this->settings;
        $data['page_name'] = "deposit";
        $data['page_title'] = "Deposit";
        $data['users'] = $this->members;
        $data['disabled'] = $this->disabled;
        $data['notifications'] = $this->notifications;
        $data['firstname1'] = ucfirst($this->firstname1);
        $data['lastname1'] = ucfirst($this->lastname1);
        return view('auth.dashboard.deposit', $data);
    }

    
    public function transactions() {
        Cookie::queue(Cookie::make('lastPage', "transactions", 10000));
        $data['page_name'] = "transactions";
        $data['page_title'] = "Transaction History";
        $data['users'] = $this->members;
        $data['disabled'] = $this->disabled;
        $data['notifications'] = $this->notifications;
        $data['firstname1'] = ucfirst($this->firstname1);
        $data['lastname1'] = ucfirst($this->lastname1);
        return view('auth.dashboard.tables', $data);
    }


}
