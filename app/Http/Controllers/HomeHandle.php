<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class HomeHandle extends Controller
{
    public function index() {
        return view('homepage');
    }

    public function showAboutus() {
        return view('aboutus');
    }

    public function showContact() {
        return view('contact');
    }
}
