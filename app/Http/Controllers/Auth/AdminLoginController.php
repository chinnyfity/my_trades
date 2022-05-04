<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest:admin_tbl')->except('logout');
    }

    public function adminLoginForm(){
        $data['page_title'] = "Administrator";
        $data['user_type'] = "admin";
        $data['page_name'] = "";
        return view('auth.shield.login1', $data);
    }

    function redirect(){
        $data['page_name'] = "";
        $data['page_title'] = "Signing out...";
        return view('redirect1', $data);
    }
}
