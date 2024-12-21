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
  </style>
@endsection
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      List of Orders
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
              <a href="{{URL::to('/order-items/'.$order->order_id)}}"><i class="fa-solid fa-cart-shopping"></i></a></td>
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
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        <div class="col-sm-5 text-center">
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <!-- Mũi tên "Previous" -->
        @if ($list_orders->onFirstPage())
          <li class="page-item disabled">
            <span class="page-link"><i class="fa fa-chevron-left"></i></span>
          </li>
        @else
          <li class="page-item">
            <a class="page-link" href="{{ $list_orders->previousPageUrl() }}"><i class="fa fa-chevron-left"></i></a>
          </li>
        @endif

        <!-- Hiển thị các số trang -->
        @php
          $currentPage = $list_orders->currentPage();
          $lastPage = $list_orders->lastPage();
          $range = 5;
          $start = max(1, $currentPage - $range);
          $end = min($lastPage, $currentPage + $range);
        @endphp

        @if ($currentPage > 1 && $currentPage - $range > 1)
          <li class="page-item">
            <a class="page-link" href="{{ $list_orders->url(1) }}">1</a>
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
              <a class="page-link" href="{{ $list_orders->url($page) }}">{{ $page }}</a>
            </li>
          @endif
        @endfor

        @if ($currentPage < $lastPage && $currentPage + $range < $lastPage)
          <li class="page-item disabled"><span class="page-link">...</span></li>
          <li class="page-item">
            <a class="page-link" href="{{ $list_orders->url($lastPage) }}">{{ $lastPage }}</a>
          </li>
        @endif

        <!-- Mũi tên "Next" -->
        @if ($list_orders->hasMorePages())
          <li class="page-item">
            <a class="page-link" href="{{ $list_orders->nextPageUrl() }}"><i class="fa fa-chevron-right"></i></a>
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