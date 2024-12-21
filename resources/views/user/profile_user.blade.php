@extends('user.account_layout')
@section('user_content')
<?php
    $message = Session::get('message');
    if ($message) {
        echo $message;
    }
    Session::put('message', null);
?>
    <div class="right-container">
        <div class="row right-header">
            <h4>My profile</h4>
            <p>Account security information management</p>
        </div>
        <div class="right-user-content">
            <div class="row profile-container">
                <form class="col-sm-9 form-information" action="{{URL::to('update-user-information/'.$user_id)}}" method="post">
                    {{ csrf_field() }}
                    <div class="row user-information">
                        <div class="col-sm-4">
                            <label>Account name</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" name="account_name" value="{{$user_information->account_name}}"><i class="fa-solid fa-pen"></i>
                        </div>
                    </div>
                    <div class="row user-information">
                        <div class="col-sm-4">
                            <label>Name</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" name="name" value="{{$user_information->name}}"><i class="fa-solid fa-pen"></i>
                        </div>
                    </div>
                    <div class="row user-information">
                        <div class="col-sm-4">
                            <label>Address</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" name="address" value="{{$user_information->address}}"><i class="fa-solid fa-pen"></i>
                        </div>
                    </div>
                    <div class="row user-information">
                        <div class="col-sm-4">
                            <label>Email</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" name="email" value="{{$user_information->email}}"><i class="fa-solid fa-pen"></i>
                        </div>
                    </div>
                    <div class="row user-information">
                        <div class="col-sm-4">
                            <label>Phone number</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" name="phone" value="{{$user_information->phone}}"><i class="fa-solid fa-pen"></i>
                        </div>
                    </div>
                    <div class="row user-information">
                    <div class="col-sm-4">
                            <label>Date of birth</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="date" name="daye_of_birth" value="{{$user_information->date_of_birth}}">
                        </div>
                    </div>
                    <div class="row user-information">
                        <div class="col-sm-4">
                            <label class="radio-gender">Gender</label> 
                        </div>
                        <div class="col-sm-8 gender-content">
                            <input type="radio" value="Male" class="input-radio" name="gender" {{ $user_information->gender == 'Male' ? 'checked' : '' }}>Male
                            <input type="radio" value="Female" class="input-radio" name="gender" {{ $user_information->gender == 'Female' ? 'checked' : '' }}>Female
                            <input type="radio" value="Other" class="input-radio" name="gender" {{ $user_information->gender == 'Other' ? 'checked' : '' }}>Other
                        </div>
                    </div>
                    <div class="row form-button">
                        <button class="button" name="update" type="submit">Update<i class="fa-solid fa-paper-plane"></i></button>
                    </div>
                </form>
                <div class="col-sm-3 profile-background">
                    <img src="{{asset('public/fontend/img/background15.jpg')}}" alt="">
                </div>
            </div>
        </div>
  </div>
@endsection