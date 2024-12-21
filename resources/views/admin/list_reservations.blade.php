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
  </style>
@endsection
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      List of Reservations
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
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
              <!-- <a href="{{URL::to('/edit_reservation/' .$reservation->res_id)}}" class="active" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a> -->
                <a onclick="return confirm('Are you sure to CANCEL this reservation?') " href="{{URL::to('/cancel-reservation/'.$reservation->res_id . '?type_name='.$type_user)}}" class="active" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
          </tr>
            @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">       
        <div class="col-sm-5 text-center">
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
             <!-- Mũi tên "Previous" -->
        @if ($list_reservations->onFirstPage())
          <li class="page-item disabled">
            <span class="page-link"><i class="fa fa-chevron-left"></i></span>
          </li>
        @else
          <li class="page-item">
            <a class="page-link" href="{{ $list_reservations->previousPageUrl() }}"><i class="fa fa-chevron-left"></i></a>
          </li>
        @endif

        <!-- Hiển thị các số trang -->
        @php
          $currentPage = $list_reservations->currentPage();
          $lastPage = $list_reservations->lastPage();
          $range = 5;
          $start = max(1, $currentPage - $range);
          $end = min($lastPage, $currentPage + $range);
        @endphp

        @if ($currentPage > 1 && $currentPage - $range > 1)
          <li class="page-item">
            <a class="page-link" href="{{ $list_reservations->url(1) }}">1</a>
          </li>
          <li class="page-item disabled"><span class="page-link">...</span></li>
        @endif

        @for ($page = $start; $page <= $end; $page++)
          @if ($page == $currentPage)
            <li class="page-item active">
              <span class="page-link">{{ $page }}</span>
            </li>
          @else
            <li class="page-item">
              <a class="page-link" href="{{ $list_reservations->url($page) }}">{{ $page }}</a>
            </li>
          @endif
        @endfor

        @if ($currentPage < $lastPage && $currentPage + $range < $lastPage)
          <li class="page-item disabled"><span class="page-link">...</span></li>
          <li class="page-item">
            <a class="page-link" href="{{ $list_reservations->url($lastPage) }}">{{ $lastPage }}</a>
          </li>
        @endif

        <!-- Mũi tên "Next" -->
        @if ($list_reservations->hasMorePages())
          <li class="page-item">
            <a class="page-link" href="{{ $list_reservations->nextPageUrl() }}"><i class="fa fa-chevron-right"></i></a>
          </li>
        @else
          <li class="page-item disabled">
            <span class="page-link"><i class="fa fa-chevron-right"></i></span>
          </li>
        @endif
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection