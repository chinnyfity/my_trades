<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Setting;
use Illuminate\Support\Facades\Route;
use Cookie;
use Auth;
use App\Models\User;
use App\Models\User_test;
use App\Models\Other_setting;
use File;
use DB;
use App\Classes\DownloadFile;
use App\Classes\Stacks;
//use PagaBusiness\PagaBusinessClient;
use Phalconvee\Paga\Facades\Paga;

class HomeController extends Controller
{

    public function __construct(){
        $this->middleware(function ($request, $next){

            $this->mem_id = Auth::guard('user')->id();
            $this->members = User::find($this->mem_id);

            return $next($request);
        });

        $this->folder = "/public/";
        /* if(url('/') == "https://microfinancetrades.com"){
            $this->folder = "/public/";
        } */
        \View::share('folder', $this->folder);

        Paga::setTest(true);
        
    }


    function paga(){

        /* $businessClient = PagaBusinessClient::builder()
        ->setApiKey("6515d771280f49f88d92ad41c42d6f0ea1cdb2c4a6e54266bd02e0da92dcc273e31bcec8b24d469ab0df8ad1d0f454517076f56d871548d1b492af5b51db9e3a")
        ->setPrincipal("100F27F6-64AB-49F2-8481-839F0D26F506")
        ->setCredential("zB8*%svYq6TJdH+")
        ->setTest(true)
        ->build(); */


        $response = Paga::getBanks();

        return response()->json(['message' => $response]);
    }

    
    
    
    function factorial( $n ) {
        if($n == 0){
            return 1;
        }
        $result = $n * $this->factorial($n-1);
        echo "Result of $n * factorial( ". ($n-1) .") is $result<br>";
        return $result;
    }    

    function recursion(){
        echo "The factorial of 5 is: " . $this->factorial( 5 );
    }


    function arrays(){
        $input = array(
            "The_Alchemist" => array (
            "author" => "Paulo Coelho",
            "type" => "Fiction",
            "published_year" => 1988
            ),
            "Managing_Oneself" => array (
            "author" => "Peter Drucker",
            "type" => "Non-fiction",
            "published_year" => 1999
            ),
            "Measuring_the_World" => array(
            "author" => "Daniel Kehlmann",
            "type" => "Fiction",
            "published_year" => 2005
            )
        );

        /* foreach($input as $books){
            foreach($books as $book => $key){
                echo "$book == $key<br>";
            }
            echo "<br>";
        } */


        $cars = array (
            array("Volvo",22,18),
            array("BMW",15,13),
            array("Saab",5,2),
            array("Land Rover",17,15)
        );

        //array_push($cars[0], "honda");

        /* foreach($cars as $mycars){
            foreach($mycars as $key => $mycar){
                echo "$mycar == $key<br>";
            }
            echo "<br>";
        } */

        $rowCount = count($cars);
        $colCount = count($cars[0]);

        for ($row=0; $row < $rowCount; $row++) { 
            echo "Row number $row <br>";
            for ($col=0; $col < $colCount; $col++) { 
                echo $cars[$row][$col]."<br>";
            }
            echo "<br>";
        }
    }


    function arrays2(){
        $marks = array(
            "Ankit" => array(
                "C" => 95,
                "DCO" => 85,
                "FOL" => 74,
            ),
            "Ram" => array(
                "C" => 78,
                "DCO" => 98,
                "FOL" => 46,
            ),
            "Anoop" => array(
                "C" => 88,
                "DCO" => 46,
                "FOL" => 99,
            ),
        );

        foreach($marks as $key => $mark){
            echo $key."<br>";
            foreach($mark as $key1 => $mark1){
                echo "$key1 == $mark1<br>";
            }
            echo "<br>";
        }
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


    // Binary Search is a searching technique used to search an element in a sorted array.
    function binary_search($search_item, $array_set){
        $start = 0;
        sort($array_set);
        $end = count($array_set) - 1;
        while($start <= $end){
            $mid = floor(($start + $end) / 2);
            if($search_item < $array_set[$mid]){
                $end = $mid - 1;
            }elseif($search_item > $array_set[$mid]){
                $start = $mid + 1;
            }elseif($search_item == $array_set[$mid]){
                return "index= $mid and value=$search_item";
            }
        }
        return "not found";
    }
    

    function testing1(){
        $array_set = [1,2,9,3,4,8,6,7,10,5,5,4,8,3,3,6];
        $search_item = 6;
        return $this->binary_search($search_item, $array_set);
    }


    function stacks(){
        /* stacks are sequential collection with a particular property, in that, the last item placed on the stack will be the last item to be removed, example the LIFO

        init = create the stack
        push = add an item on the stack
        pop = delete the last item on the stack
        top = the current item on the stack
        isEmpty = check if the stack is empty or not */

        //$stack = new Stacks(5, array(1,2,3,4,5,6,7));

        /* $stack = new Stacks();
        $stack->push(1);
        $stack->push(2);
        $stack->push(3);
        $stack->push(4);
        $stack->push(5);

        print_r($stack);
        echo "<br><br>";
        echo $stack->top(); */


        $queue = new Stacks();
        //$queue->enqueue("Element");
        $queue->enqueue(1);
        $queue->enqueue(2);
        $queue->enqueue(3);
        $queue->enqueue(4);
        $queue->enqueue(5);
        print_r($queue);

        echo "<br>";
        echo $queue->front();
        echo "<br>";
        echo $queue->back();

        echo "<br>";
        //$queue->dequeue();
        //echo $queue->front();

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


    function live_rates(Request $request){
        //return response()->json(['success' => 333]);
        if($this->is_connected()){
            $from_currency = urlencode($request->from_currency);
            $json = @file_get_contents("https://api.coinbase.com/v2/exchange-rates?currency=USD");
            $obj = json_decode($json, true);
            
            $i=1;
            if(isset($obj["data"])){
                foreach($obj["data"]["rates"] as $curName => $rate){
                    if($curName == "BTC" || $curName == "ETH" || $curName == "USDT" || $curName == "LTC" || $curName == "BCH" || $curName == "DOGE" || $curName == "ADA" || $curName == "USDC" || $curName == "SHIB" || $curName == "DOT"){

                        $conversionAmt = 1/$rate;
                        Cookie::queue(Cookie::make('rise_fall_'.$curName, $conversionAmt, 10000)); // 0.045

                        $rise_fall = Cookie::get('rise_fall_'.$curName);
                        $cur_old = Cookie::get('cur_old_'.$curName);

                        if($rise_fall == $cur_old){
                            $newRate = "<span style='color:#66dfa6'>+".round(($conversionAmt / 1000), 2)."</span>";

                        }else if($rise_fall > $cur_old){
                            $newRate = "<span style='color:green'>+".round(($rise_fall / 1000), 2)."</span>";

                        }else{
                            Cookie::queue(Cookie::make('cur_old_'.$curName, $conversionAmt, 10000)); // 0.045
                            $cur_old = Cookie::get('cur_old_'.$curName);
                            $newRate = "<span style='color:red'>-".round(($conversionAmt - $cur_old) / 1000, 2)."</span>";
                        }

                        $curImage = "bch.png";
                        $coinName = "BitCash";

                        if($curName == "BTC"){
                            $curImage = "earth-icon-3.png";
                            $coinName = "Bitcoin";
                        }
                        if($curName == "ETH"){
                            $curImage = "eth.png";
                            $coinName = "Ethereum";
                        }
                        if($curName == "LTC"){
                            $curImage = "lte.png";
                            $coinName = "Litecoin";
                        }
                        if($curName == "USDT"){
                            $curImage = "usdt.png";
                            $coinName = "Tether";
                        }
                        /////////////////////////////////
                        if($curName == "DOGE"){
                            $curImage = "doge.png";
                            $coinName = "Dogecoin";
                        }
                        if($curName == "ADA"){
                            $curImage = "ada.png";
                            $coinName = "Cardano";
                        }
                        if($curName == "USDC"){
                            $curImage = "usdt.png";
                            $coinName = "USD Coin";
                        }
                        if($curName == "SHIB"){
                            $curImage = "shib.png";
                            $coinName = "Shiba Inu";
                        }
                        if($curName == "DOT"){
                            $curImage = "dot.png";
                            $coinName = "Polkadot";
                        }

                        $folder = "";
                        if(url('/') == "https://microfinancetrades.com"){
                            $folder = "/public/";
                        }
                        ?>

                            <div class="col-lg-3 col-3 lines">
                                <a href="./deposit/<?=strtolower($curName)?>/">
                                    <div class="each_rate row align-items-center">
                                        <div class="col-lg-2 col-1 trade_img">
                                            <img src="<?=url('/')?>/<?=$folder?>images/<?=$curImage?>" alt="">
                                        </div>

                                        <div class="col-lg-4 col-4 pl-sm-30 pl-xs-20 pr-0 trade_coin pb-10">
                                            <p><?=$curName?></p>
                                            <p><?=$coinName?></p>
                                        </div>

                                        <div class="col-lg-5 col-5 trade_value pt-0 pl-0 mt-xs--5">
                                            <p>$<?=number_format($conversionAmt, 2)?></p>
                                            <p class="rise_fall"><?=$newRate?>%</p>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        <?php
                    }
                    $i++;
                }
            }
            Cookie::queue(Cookie::make('cur_old_'.$curName, $conversionAmt, 10000)); // 0.045
        }
    }


    function index(){
        Cookie::queue(Cookie::make('lastPage', "index", 10000));
        $data['users'] = $this->members;
        $data['page_name'] = "";
        $data['page_title'] = "";
        $data['settings'] = Setting::find(1);
        return view('index', $data);
    }

    function contact(){
        Cookie::queue(Cookie::make('lastPage', "contact", 10000));
        $data['users'] = $this->members;
        $data['page_name'] = "";
        $data['page_title'] = "Contact Us";
        return view('contact-us', $data);
    }

    function privacy(){
        Cookie::queue(Cookie::make('lastPage', "privacy", 10000));
        $data['users'] = $this->members;
        $data['page_name'] = "";
        $data['page_title'] = "Privacy & Policy";
        return view('privacy', $data);
    }

    function terms(){
        Cookie::queue(Cookie::make('lastPage', "terms", 10000));
        $data['users'] = $this->members;
        $data['page_name'] = "";
        $data['page_title'] = "Terms & Condition";
        return view('agreement', $data);
    }

    function forex_widgets(){
        Cookie::queue(Cookie::make('lastPage', "terms", 10000));
        $data['users'] = $this->members;
        $data['page_name'] = "forex_widgets";
        $data['page_title'] = "Trading - MFT Forex Widgets";
        return view('other_pages', $data);
    }

    
    function continuous_cfds(){
        Cookie::queue(Cookie::make('lastPage', "terms", 10000));
        $data['users'] = $this->members;
        $data['page_name'] = "continuous_cfds";
        $data['page_title'] = "Continuous CFDs on Stock Indices and Commodities";
        return view('other_pages', $data);
    }

    function economic_calendar(){
        Cookie::queue(Cookie::make('lastPage', "terms", 10000));
        $data['users'] = $this->members;
        $data['page_name'] = "economic_calendar";
        $data['page_title'] = "Economic Calendar";
        return view('other_pages', $data);
    }

    function bitcoin(){
        Cookie::queue(Cookie::make('lastPage', "terms", 10000));
        $data['users'] = $this->members;
        $data['page_name'] = "bitcoin";
        $data['page_title'] = "Bitcoin";
        return view('other_pages', $data);
    }

    function money_management(){
        Cookie::queue(Cookie::make('lastPage', "terms", 10000));
        $data['users'] = $this->members;
        $data['page_name'] = "money_management";
        $data['page_title'] = "Money Management Limits to Trade";
        return view('other_pages', $data);
    }

    function asset_equity(){
        Cookie::queue(Cookie::make('lastPage', "terms", 10000));
        $data['users'] = $this->members;
        $data['page_name'] = "asset_equity";
        $data['page_title'] = "Available Assets Equity";
        return view('other_pages', $data);
    }
    
    
    function redirect(){
        $data['page_name'] = "";
        $data['page_title'] = "Signing out...";
        return view('redirect', $data);
    }


    function btc_usd(Request $request){
        $amts = @number_format($this->convertCurrency($request->amts, $request->coinTypeFrom, $request->coinTypeTo), 7);
        //$amts = 0;
        return $amts ? $amts : "0.0000000";
    }




    function testing__(){ // copying log files to remote server
        $ftp_server = "www.embexdigital.com.ng"; //www.example.com
        $ftp_username   = "embexdig"; // username
        $ftp_password   =  '7HQ).HjOqT$9'; // password

        $conn_id = ftp_connect($ftp_server); 
        $ftp_user_name=$ftp_username;
        $ftp_user_pass=$ftp_password;

        $day=date("d", time());
        $month=date("m", time());
        $year=date("Y", time());
        $time=date("g:i:sa", time());
        $full_date = $day."_".$month."_".$year."_".$time;

        $file = "log_".$full_date.".txt";

        $login_result = @ftp_login($conn_id, $ftp_user_name, $ftp_user_pass); 
        $destination_file =  $destination_file = "public_html/backups/".$file;
        $source_file = storage_path()."/logs/laravel.log";
        //$dir = storage_path()."\logs\*.log";

        if ((!$conn_id) || (!$login_result)) { 
            return "FTP connection has failed!";
        } else {
            $upload = ftp_put($conn_id, $destination_file, $source_file, FTP_BINARY); 

            return (!$upload) ? "FTP upload has failed!" : "Uploaded $source_file to $ftp_server as $destination_file";
        }

        /* foreach(glob($dir) as $file) {
            $upload = ftp_put($conn_id, $destination_file, $file, FTP_BINARY); // this one
        } */

        ftp_close($conn_id); 
    }


    public function getAddresses(){
        $client = new \GuzzleHttp\Client();
        try{
            $response = $client->request('GET', "http://127.0.0.1:8001/api/v1/addresses", [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    //'next' => $next,
                    'platform' => 'grip',
                    'limit' => 50,
                ]
            ])->getBody();

            return json_decode($response);

        }catch(ClientExceptioncatch $e){
            return response()->json([
                'data' => [],
                'status' => 'failed',
                'message' => 'Unable to fetch data'
            ],400);
        }
    }


    function insert_testing(){
        $json_string = $this->getAddresses();
        $insert = false;

        foreach($json_string->data as $value){
            $user = $value->user;
            $address = $value->address;
            $address_id = $value->address_id;
            $address2 = $value->address;
            $address2_id = $value->address_id;
            
            $addrs1 = Address::where('user', $user)->where('address', '!=', $address)->first();
            if($addrs1){
                $addrs1->update(['address' => $address ]);
                $insert = true;
            }

            $addrs2 = Address::where('user', $user)->where('address_id', '!=', $address_id)->first();
            if($addrs2){
                $addrs2->update(['address_id' => $address_id ]);
                $insert = true;
            }

            $addrs3 = Address::where('user', $user)->where('address2', '!=', $address2)->first();
            if($addrs3){
                $addrs3->update(['address2' => $address2 ]);
                $insert = true;
            }

            $addrs4 = Address::where('user', $user)->where('address2_id', '!=', $address2_id)->first();
            if($addrs4){
                $addrs4->update(['address2_id' => $address2_id]);
                $insert = true;
            }
        }

        if(!$insert)
            return response()->json(['message' => 'no records to update']);

        return response()->json(['message' => 'success']);
    }





}
