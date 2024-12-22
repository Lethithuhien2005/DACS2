<?php

namespace App\Http\Controllers;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactHandle extends Controller
{   
    public function save_contact(Request $request) {
        //check login
        $user_id = $request->user_id;
        if(!Session::has('user_id')) {
            // save inputed content before redirecting to login page
            session(['contact_data' => $request->only(['name', 'email', 'phone', 'message'])]);
            //save current url
            session(['url.intended' => url()->previous()]);
            return Redirect::to('/login');
        }
        else {
            $data = Contact::create([
                'user_id' => $user_id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'message' => $request->message,
            ]);
            Session::put('message', 'Sent your contact successfully!');
            return redirect()->intended('/contact');
        }
    }
    public function show_list_contact() {
        $list_contacts = Contact::paginate(7);
        return view('admin.list_contacts')->with('list_contacts', $list_contacts);
    }
}
