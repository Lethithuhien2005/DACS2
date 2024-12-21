@extends('admin.admin_layout')
@section('style')
    <link rel="stylesheet" href="{{asset('public/fontend/css/reservation.css')}}">
    <style>
        .right-header {
            padding: 20px 0px 30px 50px;
        }
        h3 {
            font-size: 30px;
            padding-bottom: 10px;
        }
        .right-user-content {
            margin-left: 100px;
        }
        .form-information {
            margin-top: 20px;
        }
        .user-information {
            margin-bottom: 10px;
        }
        .user-information .input-text {
            margin-right: 20px;
            width: 80%;
        }
        ..gender-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        input[type=radio] {
            margin: 4px 10px 0px 15px;
        }
        .message {
            color: #3366cc;
        }
    </style>
@endsection
@section('admin_content')
<div class="right-container">
        <!-- <div class="row right-header">
            <h4>My profile</h4>
            <p>Account security information management</p>
        </div> -->
        <div class="right-user-content">
            <span class="message">
                <?php
                    $message = Session::get('message');
                    if($message) {
                        echo $message;
                    }
                    Session::put('message', null);
                ?>
            </span>
                <form class="form-information" action="{{URL::to('update-user/'.$user->user_id)}}" method="post">
                    {{ csrf_field() }}
                    <div class="row user-information">
                        <div class="col-sm-3">
                            <label>Account name</label>
                        </div>
                        <div class="col-sm-9">
                            <input class="input-text" type="text" name="account_name" value="{{$user->account_name}}"><i class="fa-solid fa-pen"></i>
                        </div>
                    </div>
                    <div class="row user-information">
                        <div class="col-sm-3">
                            <label>Name</label>
                        </div>
                        <div class="col-sm-9">
                            <input class="input-text" type="text" name="name" value="{{$user->name}}"><i class="fa-solid fa-pen"></i>
                        </div>
                    </div>
                    <div class="row user-information">
                        <div class="col-sm-3">
                            <label>Address</label>
                        </div>
                        <div class="col-sm-9">
                            <input class="input-text" type="text" name="address" value="{{$user->address}}"><i class="fa-solid fa-pen"></i>
                        </div>
                    </div>
                    <div class="row user-information">
                        <div class="col-sm-3">
                            <label>Email</label>
                        </div>
                        <div class="col-sm-9">
                            <input class="input-text" type="text" name="email" value="{{$user->email}}"><i class="fa-solid fa-pen"></i>
                        </div>
                    </div>
                    <div class="row user-information">
                        <div class="col-sm-3">
                            <label>Phone number</label>
                        </div>
                        <div class="col-sm-9">
                            <input class="input-text" type="text" name="phone" value="{{$user->phone}}"><i class="fa-solid fa-pen"></i>
                        </div>
                    </div>
                    <div class="row user-information">
                    <div class="col-sm-3">
                            <label>Date of birth</label>
                        </div>
                        <div class="col-sm-9">
                            <input class="input-text" type="date" name="date_of_birth" value="{{$user->date_of_birth}}">
                        </div>
                    </div>
                    <div class="row user-information">
                        <div class="col-sm-3">
                            <label class="radio-gender">Gender</label> 
                        </div>
                        <div class="col-sm-9 gender-content">
                            <input type="radio" value="Male" class="input-radio" name="gender" {{ $user->gender == 'Male' ? 'checked' : '' }}>Male
                            <input type="radio" value="Female" class="input-radio" name="gender" {{ $user->gender == 'Female' ? 'checked' : '' }}>Female
                            <input type="radio" value="Other" class="input-radio" name="gender" {{ $user->gender == 'Other' ? 'checked' : '' }}>Other
                        </div>
                    </div>
                    <div class="row form-button">
                        <button class="button" name="update" type="submit">Update<i class="fa-solid fa-paper-plane"></i></button>
                    </div>
                </form>
            </div>
  </div>
@endsection