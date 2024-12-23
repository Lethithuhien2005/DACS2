<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use App\Models\TypeUser;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\MailHandler;
session_start();

class UserHandle extends Controller
{
    public function show_login() {
        return view('login');
    }

    public function show_logup() {
        return view('logup');
    }
    public function save_user(Request $request) {
        $check_email = User::where('email', $request->email_user)->first();
        $account_name = User::where('account_name', $request->account_name)->first();
        if($check_email) {
            Session::put('message', "The email already exists!!!");
            return Redirect::to('/logup');
        } else {
            if($account_name) {
                Session::put('message', "The account name already exists!!!");
                return Redirect::to('/logup');
            } else {
                $user = User::create([
                    'name' => $request->name_user,
                    'account_name' => $request->account_name,
                    'date_of_birth' => $request->date_of_birth,
                    'gender' => $request->gender,
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'email' => $request->email_user,
                    'password' => $request->password_user,
                    'type_id' => $request->type_id,
                ]);
                $this->mailHandler->notifyRegister($user);
                return Redirect::to('/login');
            }
        }
    }
    public function login(Request $request) {
        $email = $request->email_user;
        $password = $request->password;
        $result = User::where('email', $email)->first();
        if($result) {
            $type_user = $result->get_type->type_name;
            $check_password = Hash::check($password, $result->password);
            if($check_password) {
                Session::put('account_name', $result->account_name);
                Session::put('user_id', $result->user_id);
                Session::put('type_user', $type_user);
                $remember_token = Str::random(60);
                $result->remember_token = $remember_token;
                $result->save();
                cookie()->queue('remember_token', $remember_token, 60*24*7);
                if($type_user == "customer") {
                    return redirect()->intended('/homepage');
                } else {
                    return Redirect::to('/dashboard/'.$type_user);
                }
            } else {
                Session::put('message', "Your password is invalid");
                return Redirect::to('/login');
            }
        } else {
            Session::put('message', "Your email is invalid");
            return Redirect::to('/login');
        }
    }
    //check cookie:
    public function __construct(MailHandler $mailHandler) {
        $this->mailHandler = $mailHandler;
        if(Cookie::get('remember_token')) {
            $remember_token = Cookie::get('remember_token');
            $user = User::where('remember_token', $remember_token)->first();
            if($user) {
                Session::put('account_name', $user->account_name);
                Session::put('user_id', $user->user_id);
            }
        }
    }
    public function logout() {
        Session::flush();
        Cookie::queue(Cookie::forget('remember_token')); // Use "::" instead of ":"
        return Redirect::to('/login');
    }    
    public function showProfile($user_id) {
       $user = User::find($user_id);
       $type_user = $user->type_id;
       if($type_user == 1) {
        return view('user.profile_user')->with('user_information', $user)->with('account_name', $user->account_name)->with('user_id', $user_id);
       }
       else {
        return view('admin.profile_admin')->with('user_information', $user)->with('account_name', $user->account_name)->with('user_id', $user_id);
       }
    }
    public function update_user($user_id, Request $request) {
        $check_email = User::where('email', $request->email)->where('user_id', '!=', $user_id)->exists();
        $check_account = User::where('account_name', $request->account_name)->where('user_id', '!=', $user_id)->exists();
        if($check_email) {
            Session::put('message', "The email already exists!!!");
            return Redirect::to('/update-user-information'.$user->user_id);
        }
        else {
            if($check_account) {
                Session::put('message', "The account name already exists!!!");
                return Redirect::to('/update-user-information'.$user->user_id);
            }
            else {
                $user = User::find($user_id);
                $user->name = $request->name;
                $user->account_name = $request->account_name;
                $user->date_of_birth = $request->daye_of_birth;
                $user->gender = $request->gender;
                $user->address = $request->address;
                $user->phone = $request->phone;
                $user->email = $request->email;
                $user->save();
                Session::put('message', "Updated your information successfully!");
                $this->mailHandler->sendUpdatingAccount($user);
                return Redirect::to("/profile/$user_id");
            }
        }
    }
}
