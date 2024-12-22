@extends('user.account_layout')
@section('user_content')
    <div class="right-container">
        <div class="row right-header">
        <h4>My reservation</h4>
        <p>View and manage your reservations here</p>
        </div>
        <div class="right-user-content">
            <section class="container">
                @if($list_reservations->isEmpty())
                    <div class="notification">
                        <div class="notify-content">
                            <p>You don't have any reservations</p>
                            <p>You can choose dishes for your order or make a reservation immediately</p>
                        </div>
                        <div class="row button-choice">
                            <div class="col-sm-6">
                                <button class="book-now-btn" onclick="location.href='{{URL::to('/menu')}}'">Add dish <i class="fa-solid fa-cart-plus"></i></button>
                            </div>
                            <div class="col-sm-6">
                                <button class="book-now-btn" onclick="location.href='{{URL::to('/reservation')}}'">Book table <i class="fa-solid fa-paper-plane"></i></button>
                            </div>
                        </div>
                    </div>
                @else
                    <table class="table-container">
                        <thead>
                            <tr class="row1">
                                <th width="13%">Name</td>
                                <th width="15%">Email</th>
                                <th width="12%;">Phone</th>
                                <th width="11%;">Date</th>
                                <th width="7%;">Time</th>
                                <th width="19%">Number of people</th>
                                <th width="5%;">Cart</th>
                                <th width="10%;">Status</th>
                                <th width="8%;"></th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach($list_reservations as $key => $reservation)
                                    <tr class="content-row">
                                        <td>
                                            <div class="dish-name">
                                                <p>{{$reservation->name}}</p>
                                            </div>
                                        </td>
                                        <td class="dish-content">
                                            <div class="dish-category">
                                                <p>{{$reservation->email}}</p>
                                            </div>
                                        </td>
                                        <td class="dish-content">
                                            <div class="dish-category">
                                                <p>{{$reservation->phone}}</p>
                                            </div>
                                        </td>
                                        <td class="dish-content">
                                            <div class="dish-category">
                                                <p>{{$reservation->res_date}}</p>
                                            </div>
                                        </td>
                                        <td class="dish-content">
                                            <div class="dish-category">
                                                <p>{{$reservation->res_time}}</p>
                                            </div>
                                        </td>
                                        <td class="dish-content">
                                            <div class="dish-category">
                                                <p>{{$reservation->number_of_people}}</p>
                                            </div>
                                        </td>
                                        <td class="dish-content">
                                            <div class="dish-category">
                                                @if($reservation->res_status == 'meal completed')
                                            <a href="{{URL::to('/order-items/'.$reservation->hasOrder->order_id . '?type_name=customer')}}"><i class="fa-solid fa-cart-shopping"></i></a>
                                                @else
                                            <a href="{{URL::to('/cart-items/'.$reservation->hasCart->cart_id . '?type_name=customer')}}"><i class="fa-solid fa-cart-shopping"></i></a>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="dish-content">
                                            <div class="dish-category">
                                                <p>{{$reservation->res_status}}</p>
                                            </div>
                                        </td>
                                        @if($reservation->res_status == 'not yet arrived')
                                            <td><button class="btn-cancel" onclick="location.href='{{URL::to('/cancel-reservation/'.$reservation->res_id . '?type_name=customer')}}'">Cancel</button></td>
                                        @else
                                            <td></td>
                                        @endif
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                @endif
            </section>
        </div>
  </div>
@endsection