@extends('layout_auth')
@section('link')
    <link rel="stylesheet" href="{{asset('public/fontend/css/logup.css')}}">
@endsection
@section('style')
    <style>
        .navbar {
            background-color: #000;
        }
        .message-invalid {
            color: red;
        }
    </style>
@endsection
@section('content')
    <main>
        <div class="container">
            <form class="form" action="{{URL::to('/log-up')}}" method="POST" name="logup">
                {{ csrf_field() }}
                <p class="title">Register</p>
                <?php
                    $message = Session::get('message');
                    if($message) {
                        echo '<p class="message-invalid">' . $message . '</p>';
                        Session::put('message', null);
                    }
                ?>
                <p class="message">Signup now and get full access to our app. </p>
                <div class="row type-user">
                    <label class="radio-user">
                        <span id="type_user">Who are you?</span>
                    </label> 
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="type-content">
                                <input required="" placeholder="" type="radio" value="1" class="input-radio" name="type_id">I'm a customer <br>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="type-content">
                                <input required="" placeholder="" type="radio" value="2" class="input-radio" name="type_id">I'm an manager <br>
                            </div>
                        </div>  
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="type-content">
                                <input required="" placeholder="" type="radio" value="2" class="input-radio" name="type_id">I'm an staff <br>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="type-content">
                            <input required="" placeholder="" type="radio" value="2" class="input-radio" name="type_id">I'm an administrator <br>
                            </div>
                        </div>  
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label>
                            <input required="" placeholder="" type="text" class="input" name="name_user">
                            <span>Name</span>
                        </label> 
                    </div>
                    <div class="col-sm-6">
                        <label>
                            <input required="" placeholder="" type="text" class="input" name="account_name">
                            <span>Account's name</span>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label class="input-container">
                            <input required="" placeholder="mm/dd/yyyy" type="date" class="input" name="date_of_birth">
                            <span id="date-of-birth">Date of birth</span>
                        </label> 
                    </div>
                    <div class="col-sm-6">
                        <label class="radio-gender">Gender
                            <div class="gender-content">
                                <input required="" placeholder="" type="radio" value="Male" class="input-radio" name="gender">Male
                                <input required="" placeholder="" type="radio" value="Female" class="input-radio" name="gender">Female
                                <input required="" placeholder="" type="radio" value="Other" class="input-radio" name="gender">Other
                            </div>
                        </label> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label>
                            <input required="" placeholder="" type="text" class="input" name="address">
                            <span>Address</span>
                        </label>
                    </div>
                    <div class="col-sm-6">
                        <label>
                            <input required="" placeholder="" type="text" class="input" name="phone">
                            <span>Phone number</span>
                        </label> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label>
                            <input required="" placeholder="" type="email" class="input" name="email_user">
                            <span>Email</span>
                        </label> 
                    </div>
                    <div class="col-sm-6">
                    <label>
                        <input required="" placeholder="" type="password" class="input" name="password_user">
                        <span>Password</span>
                    </label>
                    </div>
                </div>
                <button class="submit">Submit</button>
                <p class="signin">Already have an acount ? <a href="{{URL::to('/login')}}">Signin</a></p>
            </form>
        </div>
    </main>
</body>
</html>