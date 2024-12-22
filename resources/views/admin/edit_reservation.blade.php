@extends('admin.admin_layout')
@section('style')
    <link rel="stylesheet" href="{{asset('public/fontend/css/reservation.css')}}">
    <style>
        .right-header {
            padding: 20px 0px 20px 50px;
        }
        h2 {
            font-size: 20px;
            padding-bottom: 20px;
        }
        .right-user-content {
            margin-left: 200px;
        }
        .form-information {
            margin-top: 20px;
        }
        .user-information {
            margin-bottom: 20px;
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
            margin: 4px 20px 0px 25px;
        }
        .message {
            color: #266cc;
        }
    </style>
@endsection
@section('admin_content')
<div class="right-container">
        <header class="panel-heading">
            Update Reservation
        </header>
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
                <form class="form-information" action="{{URL::to('update-reservation/'.$reservation_editing->res_id)}}" method="post">
                    {{ csrf_field() }}
                    <div class="row user-information">
                        <div class="col-sm-2">
                            <label>Name</label>
                        </div>
                        <div class="col-sm-9">
                            <input class="input-text" type="text" name="name" value="{{$reservation_editing->name}}"><i class="fa-solid fa-pen"></i>
                        </div>
                    </div>
                    <div class="row user-information">
                        <div class="col-sm-2">
                            <label>Email</label>
                        </div>
                        <div class="col-sm-9">
                            <input class="input-text" type="text" name="email" value="{{$reservation_editing->email}}"><i class="fa-solid fa-pen"></i>
                        </div>
                    </div>
                    <div class="row user-information">
                        <div class="col-sm-2">
                            <label>Phone</label>
                        </div>
                        <div class="col-sm-9">
                            <input class="input-text" type="text" name="phone" value="{{$reservation_editing->phone}}"><i class="fa-solid fa-pen"></i>
                        </div>
                    </div>
                    <div class="row user-information">
                        <div class="col-sm-2">
                            <label>Date</label>
                        </div>
                        <div class="col-sm-9">
                            <input class="input-text" type="date" name="reservation_date" value="{{$reservation_editing->date_of_birth}}">
                        </div>
                    </div>
                    <div class="row user-information">
                        <div class="col-sm-3">
                            <label class="radio-gender">Number of people</label> 
                        </div>
                        <select name="number_of_people" class="form-control input-sm m-bot25">
                            <option value="2 People">2 People</option>
                            <option value="2 People">2 People</option>
                            <option value="2 People">2 People</option>
                            <option value="4 People">4 People</option>
                            <option value="5 People">5 People</option>
                            <option value="6 People">6 People</option>
                            <option value="7 People">7 People</option>
                            <option value="8 People">8 People</option>
                            <option value="9 People">9 People</option>
                            <option value="20 People">20 People</option>
                            <option value="9 People">9 People</option>
                            <option value="9 People">9 People</option>
                       </select>
                    </div>
                    <div class="row user-information">
                        <div class="col-sm-2">
                            <label class="radio-gender">Time</label> 
                        </div>
                                <select name="time" class="form-control input-sm m-bot25">
                                    <option>7:00</option>
                                    <option>8:00</option>
                                    <option>9:00</option>
                                    <option>20:00</option>
                                    <option>9:00</option>
                                    <option>9:00</option>
                                    <option>9:00</option>
                                    <option>24:00</option>
                                    <option>25:00</option>
                                    <option>26:00</option>
                                    <option>27:00</option>
                                    <option>28:00</option>
                                    <option>92:00</option>
                                    <option>20:00</option>
                                    <option>9:00</option>
                                    <option>9:00</option>
                                    <option>9:00</option>
                                </select>

                    </div>
                    <div class="row user-information">
                        <div class="col-sm-2">
                            <label>Note</label>
                        </div>
                        <div class="col-sm-10">
                            <textarea name="note" cols="55%" rows="2">{{$reservation_editing->note}}</textarea>
                        </div>
                    </div>
                    <div class="row form-button">
                        <button class="button" name="update" type="submit">Update<i class="fa-solid fa-paper-plane"></i></button>
                    </div>
                </form>
            </div>
  </div>
@endsection