<?php

namespace App\Http\Controllers;
// use Illuminate\Http\Request;
use Request;
use Illuminate\Support\Facades\Hash;
use DB;
use App\Models\Feedback;
use App\Models\AccountInfo;

class AccountController extends Controller
{
    public function loginpage(){
        return view("Feedback.loginpage");
    }

    public function login(){
        $user_name = Request::get("user_name");
        $password = Request::get("password");
        DB::connection("mysql");
        $userData = DB::select("SELECT * FROM AccountInfo WHERE user_name=?", [$user_name]);

        if(!isset($userData[0]->user_name)){
            return \Redirect::back()->with("message","使用者不存在");
        }elseif($userData[0]->violate_count>=3){
            return \Redirect::back()->with("warning","使用者已遭停權");
        }elseif(password_verify($password, $userData[0]->password)){
            session(["user_name" => $userData[0]->user_name]);
            return redirect("/");
        }else{
            return \Redirect::back()->with("message","密碼錯誤");
        }


    }

    public function registerpage(){
        return view("Feedback.registerpage");
    }

    public function register(){
        $user_name = Request::get("user_name");
        $password = Request::get("password");
        DB::connection("mysql");
        $userData = DB::select("SELECT * FROM AccountInfo WHERE user_name=?", [$user_name]);
        if(isset($userData[0]->user_name)){
            return \Redirect::back()->with("message","已存在使用者");
        }
        else{
            $hashed_password = Hash::make($password);
            AccountInfo::create([
                "user_name" => $user_name,
                "password" => $hashed_password,
                "violate_count" => 0,
            ]);
            return \Redirect::back()->with("message","註冊成功");
        }
    }

    public function logout(){
        session()->forget("user_name");
        return redirect("/loginpage");
        // return view("Feedback.loginpage");
    }
}