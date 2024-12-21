@extends('layout')
@section('link')
  <link rel="stylesheet" href="{{asset('public/fontend/css/account.css')}}">
  <link rel="stylesheet" href="{{asset('public/fontend/css/shopcart.css')}}">
@endsection
@section('content')
<?php
  $user_id = Session::get('user_id');
?>
<div class="user-container">
    <div class="left-sidebar">
      <div class="account-name-user">
        <h4>{{$account_name}}</h4>
        <div class="bonus">
          <i class="fa-solid fa-user-pen"></i>
          <p>Edit profile</p>
        </div>
      </div>
      <div class="link">
        <ul>
          <li>
            <a href="{{URL::to('/profile/'.$user_id)}}">
              <i class="fa-solid fa-address-card"></i>
              <span>My profile</span>
            </a>
          </li>
          <li>
            <a href="{{URL::to('/my-reservation/'.$user_id)}}">
              <i class="fa-solid fa-table"></i>
              <span>My reservation</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
    @yield('user_content')
</div>
@endsection