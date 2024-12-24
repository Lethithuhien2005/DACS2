@extends('admin.admin_layout')
@section('style')
  <style>
    th, .short-content {
      text-align:center;
    }
    .res_status {
      text-transform: none;
      color: #928a8a;
      font-weight: none;
      font-family: sans-serif;
    }
    .status_container {
      display: flex;      /* Đặt các phần tử trên cùng một dòng */
      align-items: center;       /* Căn giữa dọc */
      gap: 5px;        
    }
    nav {
      text-align: right;
      margin: 10px 10px 0px 0px;
    }
    .page-link{
      font-size: 13px;
      padding: 4px 10px;
    }
    .search-form {
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .input-group {
      margin-right: 50px;
    }
  </style>
@endsection
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    @if(!isset($find_reservations))
        <div class="panel-heading">
        List of Reservations
        </div>
      @else
          <div class="panel-heading">
          Search results
          </div>
      @endif
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <form action="{{URL::to('/search-reservation/'.$type_user)}}" method="post" class="search-form">
            {{ csrf_field() }}
            <input type="text" name="search_reservation" class="input-sm form-control" placeholder="Search">
            <span class="input-group-btn">
              <button class="btn btn-sm btn-default" name="search" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </span>
          </form>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <?php
        $message = Session::get('message');
        if($message) {
          echo $message;
        } 
        Session::put('message', null);
      ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Account name</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Date</th>
            <th>Time</th>
            <th>Number of people</th>
            <th>Note</th>
            <th>Status</th>
            <th>Cart</th>          
            <th></th>
          </tr>
        </thead>
        @if(!isset($find_reservations))
          <tbody>
              @foreach($list_reservations as $key => $reservation)
            <tr>
              <td class="short-content"><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
              <td class="short-content">{{ $reservation->getUser->account_name }}</td>
              <td class="short-content">{{$reservation->name  }}</td>
              <td class="short-content">{{$reservation->email  }}</td>
              <td class="short-content">{{$reservation->phone  }}</td>
              <td class="short-content">{{ $reservation->res_date }}</td>
              <td class="short-content">{{ $reservation->res_time }}</td>
              <td class="short-content">{{ $reservation->number_of_people }}</td>
              <td>{{ $reservation->note }}</td>
              <td class="short-content"><span class="text-ellipsis status_container">
                      @if($reservation->res_status == "not yet arrived" )
                          <a href="{{URL::to('/eating/'.$reservation->res_id . '?type_name='.$type_user)}} "><span><p class="res_status">{{ $reservation->res_status }}</p></span></a>
                      @elseif($reservation->res_status == "currently eating" )
                      <a href=  "{{URL::to('/completed/'.$reservation->res_id . '?type_name='.$type_user)}}"><span><p class="res_status">{{ $reservation->res_status }}</p></span></a>
                      @else
                      <span><p class="res_status">{{ $reservation->res_status }}</p></span>
                      @endif
                    </span>
              </td>
              <td class="short-content">
                @if($reservation->res_status == 'meal completed')
                <a href="{{URL::to('/order-items/'.$reservation->hasOrder->order_id . '?type_name='.$type_user)}}"><i class="fa-solid fa-cart-shopping"></i></a></td>
                @else
                <a href="{{URL::to('/cart-items/'.$reservation->hasCart->cart_id . '?type_name='.$type_user)}}"><i class="fa-solid fa-cart-shopping"></i></a></td>
                @endif
                <td class="short-content">
                @if($reservation->res_status == "not yet arrived")
                  <a href="{{URL::to('/edit-reservation/' .$reservation->res_id . '?type_name='.$type_user)}}" class="active" ui-toggle-class="">
                  <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                @else 
                  <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                @endif
                  @if($reservation->res_status == 'not yet arrived')
                  <a onclick="return confirm('Are you sure to CANCEL this reservation?') " href="{{URL::to('/cancel-reservation/'.$reservation->res_id . '?type_name='.$type_user)}}" class="active" ui-toggle-class="">
                  <i class="fa fa-times text-danger text"></i>
                  @else
                  <i class="fa fa-times text-danger text"></i>
                  @endif
                </a>
              </td>
            </tr>
              @endforeach
          </tbody>
        @else
        <tbody>
            @foreach($find_reservations as $key => $find_reservation)
          <tr>
            <td class="short-content"><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td class="short-content">{{ $find_reservation->getUser->account_name }}</td>
            <td class="short-content">{{$find_reservation->name  }}</td>
            <td class="short-content">{{$find_reservation->email  }}</td>
            <td class="short-content">{{$find_reservation->phone  }}</td>
            <td class="short-content">{{ $find_reservation->res_date }}</td>
            <td class="short-content">{{ $find_reservation->res_time }}</td>
            <td class="short-content">{{ $find_reservation->number_of_people }}</td>
            <td>{{ $find_reservation->note }}</td>
            <td class="short-content"><span class="text-ellipsis status_container">
                    @if($find_reservation->res_status == "not yet arrived" )
                        <a href="{{URL::to('/eating/'.$find_reservation->res_id . '?type_name='.$type_user)}} "><span><p class="res_status">{{ $find_reservation->res_status }}</p></span></a>
                    @elseif($find_reservation->res_status == "currently eating" )
                    <a href=  "{{URL::to('/completed/'.$find_reservation->res_id . '?type_name='.$type_user)}}"><span><p class="res_status">{{ $find_reservation->res_status }}</p></span></a>
                    @else
                    <span><p class="res_status">{{ $find_reservation->res_status }}</p></span>
                    @endif
                  </span>
            </td>
            <td class="short-content">
              @if($find_reservation->res_status == 'meal completed')
              <a href="{{URL::to('/order-items/'.$find_reservation->hasOrder->order_id . '?type_name='.$type_user)}}"><i class="fa-solid fa-cart-shopping"></i></a></td>
              @else
              <a href="{{URL::to('/cart-items/'.$find_reservation->hasCart->cart_id . '?type_name='.$type_user)}}"><i class="fa-solid fa-cart-shopping"></i></a></td>
              @endif
              <td class="short-content">
              @if($find_reservation->res_status == "not yet arrived")
                <a href="{{URL::to('/edit-reservation/' .$find_reservation->res_id)}}" class="active" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              @else 
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              @endif
                @if($find_reservation->res_status == 'not yet arrived')
                <a onclick="return confirm('Are you sure to CANCEL this reservation?') " href="{{URL::to('/cancel-reservation/'.$find_reservation->res_id . '?type_name='.$type_user)}}" class="active" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
                @else
                <i class="fa fa-times text-danger text"></i>
                @endif
              </a>
            </td>
          </tr>
            @endforeach
        </tbody>
      @endif
      </table>
    </div>
    @if(!isset($find_reservations))
      {{$list_reservations->links()}}
    @endif
  </div>
</div>
@endsection