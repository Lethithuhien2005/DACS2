<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\User;
use App\Models\OrderItem;
use App\Http\Controllers\MailHandler;
use Illuminate\Support\Facades\Redirect;

session_start();

class AdminHandle extends Controller
{
    public function showDashboard($type_user) {
        $best_sellers = OrderItem::select('dish_id', DB::raw('SUM(quantity) as total_quantity'))
        ->groupBy('dish_id')->orderBy('total_quantity', 'desc')->take(7)->get();
        return view('admin.dashboard')->with($type_user)->with('best_sellers', $best_sellers);
    }
    public function show_list_user() {
       $list_user = User::with('get_type')->paginate(5);
       return view('admin.list_users')->with('list_user', $list_user);
    }
    public function add_user(){
        return view('admin.add_user');
    }
    public function save_user(Request $request) {
        $check_email = User::where('email', $request->email_user)->first();
        $account_name = User::where('account_name', $request->account_name)->first();
        if($check_email) {
            Session::put('message', "The email already exists!!!");
            return Redirect::to('/add-user');
        } else {
            if($account_name) {
                Session::put('message', "The account name already exists!!!");
                return Redirect::to('/add-user');
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
                Session::put('message', 'Added a new account successfully!');
                return Redirect::to('/list-of-users');
            }
        }
    }
    public function edit_user($user_id) {
        $user = User::find($user_id);
        return view('admin.edit_user')->with('user', $user);
    }
    public function update_user($user_id, Request $request) {
        $check_email = User::where('email', $request->email)->where('user_id', '!=', $user_id)->exists();
        $check_account = User::where('account_name', $request->account_name)->where('user_id', '!=', $user_id)->exists();
        if($check_email) {
            Session::put('message', "The email already exists!!!");
            return Redirect::to('/edit-user/'.$user_id);
        } else {
            if($check_account) {
                Session::put('message', "The account name already exists!!!");
                return Redirect::to('/edit-user/'.$user_id);
            } else {
                $user = User::find($user_id);
                $user->name = $request->name;
                $user->account_name = $request->account_name;
                $user->date_of_birth = $request->date_of_birth;
                $user->gender = $request->gender;
                $user->address = $request->address;
                $user->phone = $request->phone;
                $user->email = $request->email;
                $user->save();
                Session::put('message', "Updated information successfully!");
                $this->mailHandler->sendUpdatingAccount($user);
                return Redirect::to('/edit-user/'.$user_id);
            }
        }
    }
    public function delete_user($user_id) {
        $user = User::find($user_id);
        $user->delete();
        Session::put('message', "Deleted a user successfully!");
        return Redirect::to('/list-of-users');
    }
    public function __construct(MailHandler $mailHandler) {
        $this->mailHandler = $mailHandler;
    }
}
