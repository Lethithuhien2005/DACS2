<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class BlogHandle extends Controller
{
   public function showBlog() {
    return view('blog');
   }
}
