@extends('admin.admin_layout')
@section('style')
  <style>
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
    th, .short-content {
      text-align: center;
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
    @if(!isset($find_orders))
        <div class="panel-heading">
        List of Orders
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
        <form action="{{URL::to('/search-order/'.$type_user)}}" method="post" class="search-form">
            {{ csrf_field() }}
            <input type="text" name="search_order" class="input-sm form-control" placeholder="Search">
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
            <th style="width:50px;">Account name</th>
            <th style="width:50px;">Name</th>
            <th style="width:80px;">Phone</th>
            <th style="width:100px;">Date</th>
            <th style="width:30px;">Time</th>
            <th style="width:100px;">Number of people</th>
            <th style="width:30px;">Order items</th>
            <th style="width:30px;">Total payment</th>
            <th style="width:10px;">Status</th>

          </tr>
        </thead>
          @if(!isset($find_orders))
          <tbody>
            @foreach($list_orders as $key => $order)
            <tr>
              <td class="short-content"><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
              <td class="short-content">{{ $order->getUser->account_name }}</td>
              <td class="short-content">{{$order->getReservation->name  }}</td>
              <td class="short-content">{{$order->getReservation->phone  }}</td>
              <td class="short-content">{{ $order->getReservation->res_date }}</td>
              <td class="short-content">{{ $order->getReservation->res_time }}</td>
              <td class="short-content">{{ $order->getReservation->number_of_people }}</td>
              <td class="short-content">
                <a href="{{URL::to('/order-items/'.$order->order_id . '?type_name='.$type_user)}}"><i class="fa-solid fa-cart-shopping"></i></a></td>
              <td>{{ number_format($order->total_payment, 0, ',', '.') }}<span>đ</span></td>
              <td class="short-content"><span class="text-ellipsis status_container">
                      @if($order->order_status == "unpaid" )
                          <a href="{{URL::to('/paid/'.$order->order_id)}} "><span><p class="res_status">{{ $order->order_status }}</p></span></a>
                      @else
                      <a href=  "{{URL::to('/unpaid/'.$order->order_id)}}"><span><p class="res_status">{{ $order->order_status }}</p></span>
                      @endif
                    </span>
              </td>
            </tr>
              @endforeach
          </tbody>
        @else
        <tbody>
            @foreach($find_orders as $key => $find_order)
            <tr>
              <td class="short-content"><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
              <td class="short-content">{{ $find_order->getUser->account_name }}</td>
              <td class="short-content">{{$find_order->getReservation->name  }}</td>
              <td class="short-content">{{$find_order->getReservation->phone  }}</td>
              <td class="short-content">{{ $find_order->getReservation->res_date }}</td>
              <td class="short-content">{{ $find_order->getReservation->res_time }}</td>
              <td class="short-content">{{ $find_order->getReservation->number_of_people }}</td>
              <td class="short-content">
                <a href="{{URL::to('/order-items/'.$find_order->order_id . '?type_name='.$type_user)}}"><i class="fa-solid fa-cart-shopping"></i></a></td>
              <td>{{ number_format($find_order->total_payment, 0, ',', '.') }}<span>đ</span></td>
              <td class="short-content"><span class="text-ellipsis status_container">
                      @if($find_order->order_status == "unpaid" )
                          <a href="{{URL::to('/paid/'.$find_order->order_id)}} "><span><p class="res_status">{{ $find_order->order_status }}</p></span></a>
                      @else
                      <a href=  "{{URL::to('/unpaid/'.$find_order->order_id)}}"><span><p class="res_status">{{ $find_order->order_status }}</p></span>
                      @endif
                    </span>
              </td>
            </tr>
              @endforeach
          </tbody>
        @endif
      </table>
    </div>
    @if(!isset($find_orders))
    {{$list_orders->links()}}
    @endif
  </div>
</div>
@endsection