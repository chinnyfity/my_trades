<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\UserController;

use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\AdminController;




use App\Models\User;
use App\Models\Other_setting;
use App\Models\Setting;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

// Route::get('getAddresses', [HomeController::class, 'getAddresses']);
// Route::get('insert_testing', [HomeController::class, 'insert_testing']);

//Route::get('cronjobs', [HomeController::class, 'cronjobs']);

Route::get('/', [HomeController::class, 'index'])->name('index');
// Route::get('/asset/{name}', [HomeController::class, 'index']);



// Route::get('/emails', function(){
//     return view('emails');
// });

/* Route::get('/email-queue', function(){
    $details['email'] = 'donchibobo@gmail.com';
    $ddd = dispatch(new App\Jobs\SendEmailJob($details));

    return $ddd ? "sent" : "error";
    //dd('done');
}); */



Route::get('testing1', [HomeController::class, 'testing1']);
Route::get('stacks', [HomeController::class, 'stacks']);

Route::get('paga', [HomeController::class, 'paga']);
Route::get('recursion', [HomeController::class, 'recursion']);
Route::get('arrays', [HomeController::class, 'arrays']);
Route::get('arrays2', [HomeController::class, 'arrays2']);


Route::get('contact', [HomeController::class, 'contact'])->name('contact');
Route::get('privacy', [HomeController::class, 'privacy'])->name('privacy');
Route::get('terms', [HomeController::class, 'terms'])->name('terms');
Route::get('redirect', [HomeController::class, 'redirect'])->name('redirect');
Route::get('trading/forex-widgets', [HomeController::class, 'forex_widgets'])->name('forex-widgets');
Route::get('trading/continuous-cfds', [HomeController::class, 'continuous_cfds']);
Route::get('trading/economic-calendar', [HomeController::class, 'economic_calendar']);

Route::get('trading/bitcoin', [HomeController::class, 'bitcoin']);
Route::get('trading/money-management', [HomeController::class, 'money_management']);
Route::get('trading/asset-equity', [HomeController::class, 'asset_equity']);


Route::get('auth/signin', [RegisterController::class, 'signin'])->name('signin');
Route::get('auth/signup', [RegisterController::class, 'register'])->name('signup');



Route::post('/auth/logMeIn', [LoginController::class, 'logMeIn']);
Route::post('/auth/enterCode', [LoginController::class, 'enterCode']);

Route::post('/auth/registerMe', [LoginController::class, 'registerMe']);
Route::post('/updateProfile', [LoginController::class, 'updateProfile']);

Route::post('/display_states', [LoginController::class, 'display_states']);
Route::post('/upload_kyc', [LoginController::class, 'upload_kyc']);
Route::post('/upload_others', [LoginController::class, 'upload_others']);
Route::post('/openMyAcct', [LoginController::class, 'openMyAcct']);
Route::post('/confirm_wallAddr', [LoginController::class, 'confirm_wallAddr']);
Route::post('/updateTransStatusFailed', [LoginController::class, 'updateTransStatusFailed']);
Route::post('/updateTransStatusPending', [LoginController::class, 'updateTransStatusPending']);
Route::post('/deleteTransID', [LoginController::class, 'deleteTransID']);
Route::post('/updateWithdrawalTrans', [LoginController::class, 'updateWithdrawalTrans']);
Route::post('/updatePlans', [LoginController::class, 'updatePlans']);
// Route::post('/approve_querys', [LoginController::class, 'approve_querys']);
Route::post('/update_my_pass', [LoginController::class, 'update_my_pass'])->name('update_my_pass');
Route::post('/doConversion', [LoginController::class, 'doConversion'])->name('doConversion');
Route::post('/contactUs', [UserController::class, 'contactUs'])->name('contactUs');
//Route::post('/live_rates', [UserController::class, 'live_rates'])->name('live_rates');

Route::post('/live_rates', [HomeController::class, 'live_rates'])->name('live_rates');


Route::post('btc_usd', [HomeController::class, 'btc_usd']);
Route::post('ngn_usd', [HomeController::class, 'btc_usd']);
Route::post('eth_usd', [HomeController::class, 'btc_usd']);
Route::post('usdt_usd', [HomeController::class, 'btc_usd']);




Route::get('/signout', function(){
    return Redirect::to('redirect');
})->name('signout');

Route::get('/redirect', [HomeController::class, 'redirect'])->name('redirect');

Route::get('/redirect1', function(){
    Auth::guard('user')->logout();
    return Redirect::to('auth/signin');
})->name('redirect1');


//Route::group(['middleware' => ['auth.timeout:user']],  function() {
    Route::prefix('dashboard')->group(function(){
        Route::get('/', [UserController::class, 'dashboard'])->name('dashboard');

        Route::get('/wallet', [UserController::class, 'wallet'])->name('wallet');
        // Route::get('/trading', [UserController::class, 'trading'])->name('trading');
        Route::get('/kyc', [UserController::class, 'kyc'])->name('kyc');
        Route::get('/investment-plans', [UserController::class, 'investment_plans'])->name('investment_plans');
        Route::get('/deposit', [UserController::class, 'deposit'])->name('deposit');
        Route::get('/deposit/{cur}', [UserController::class, 'deposit']);
        Route::get('/transactions', [UserController::class, 'transactions'])->name('transactions');
        
        Route::get('/transactions_', [UserController::class, 'fetch_tables'])->name('transactions_');
        
    });
//});


Route::prefix('shield')->group(function(){
    Route::get('/', [AdminController::class, 'index'])->name('indexs');
    Route::get('/login', [AdminLoginController::class, 'adminLoginForm'])->name('adminLoginForm');
    Route::get('/users', [AdminController::class, 'allUsers'])->name('users');
    Route::get('/wallets', [AdminController::class, 'wallets'])->name('shield.wallets');
    Route::get('/all-transactions', [AdminController::class, 'transactions'])->name('shield.transactions');
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::get('/transactions_adm_',[AdminController::class, 'fetch_tables'])->name('transactions_adm_');
    Route::get('/users_',[AdminController::class, 'fetch_tables'])->name('users_');
    Route::get('/wallets_',[AdminController::class, 'fetch_tables'])->name('wallets_');

    Route::post('/approve_querys', [AdminController::class, 'approve_querys']);
    Route::post('/delete_records', [AdminController::class, 'delete_records']);
    Route::post('logMeInAdmin', [LoginController::class, 'logMeInAdmin'])->name('logMeInAdmin');
    Route::post('/updateSettings1', [AdminController::class, 'updateSettings1']);
    Route::post('/updateSettings2', [AdminController::class, 'updateSettings2']);
    Route::post('/updateSettings3', [AdminController::class, 'updateSettings3']);
    Route::post('/update_my_pass_adm', [AdminController::class, 'update_my_pass_adm']);
    Route::post('/updateWallet', [AdminController::class, 'updateWallet']);
    

    Route::get('/signout', function(){
        Auth::guard('admin_tbl')->logout();
        //return Redirect::to('redirect1');
        return Redirect::to('shield/login');
    })->name('shield.signout');

});