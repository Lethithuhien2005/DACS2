@extends('admin.admin_layout')
@section('style')
  <style>
    img {
      width: 100%;
      object-fit: cover !important;
    }
    .dish_status {
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
      List of Dishes
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
            <th style="width:40px;">Name</th>
            <th style="width:30px;">Price</th>
            <th style="width:50px;">Image</th>
            <th style="width:250px;">Desciption</th>
            <th style="width:30px;">Catogory</th>
            <th style="width:100px;">Status</th>
            <th style="width:100px;">Date added</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
            @foreach($list_dishes as $key => $dish)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{ $dish->dish_name }}</td>
            <td>{{ number_format($dish->dish_price, 0, ',', '.') }}</td>
            <td><img src="{{asset('public/upload/dishes/'.$dish->dish_img)}}" alt=""></td>
            <td>{{ $dish->dish_desc }}</td>
            <td>{{ $dish->get_category->category_name }}</td>
            <td><span class="text-ellipsis status_container">
                <?php
                if($dish->dish_status == 1 ) { ?>
                    <a href="{{URL::to('/hidden-dish/'.$dish->dish_id)}} "><span> <i class="fa fa-thumbs-up"></i><p class="dish_status">Still available</p></span></a>
                <?php } else { ?>
                  <a href=  "{{URL::to('/display-dish/'.$dish->dish_id)}}"><span> <i class="fa fa-thumbs-down"></i><p class="dish_status">Sold out</p></span></a>
                <?php } ?>
            </span></td>
            <td>{{ $dish->dish_dateAdded }}</td>
            <td>
              <a href="{{URL::to('/edit_dish/' .$dish->dish_id)}}" class="active" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Are you sure to delete this dish?') " href="{{URL::to('/delete_dish/' .$dish->dish_id)}}" class="active" ui-toggle-class="">
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
            <!-- @foreach ($list_dishes->getUrlRange(1, $list_dishes->lastPage()) as $page => $url)
            <li class="page-item {{ ($page == $list_dishes->currentPage()) ? 'active' : '' }}">
              <a class="page-link" href="{{ $url }}">{{ $page }}</a>
            </li>
          @endforeach -->

          <!-- {{ $list_dishes->links() }} -->

          <!-- Mũi tên "Previous" -->
        @if ($list_dishes->onFirstPage())
          <li class="page-item disabled">
            <span class="page-link"><i class="fa fa-chevron-left"></i></span>
          </li>
        @else
          <li class="page-item">
            <a class="page-link" href="{{ $list_dishes->previousPageUrl() }}"><i class="fa fa-chevron-left"></i></a>
          </li>
        @endif

        <!-- Hiển thị các số trang -->
        @php
          $currentPage = $list_dishes->currentPage();
          $lastPage = $list_dishes->lastPage();
          $range = 5;
          $start = max(1, $currentPage - $range);
          $end = min($lastPage, $currentPage + $range);
        @endphp

        @if ($currentPage > 1 && $currentPage - $range > 1)
          <li class="page-item">
            <a class="page-link" href="{{ $list_dishes->url(1) }}">1</a>
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
              <a class="page-link" href="{{ $list_dishes->url($page) }}">{{ $page }}</a>
            </li>
          @endif
        @endfor

        @if ($currentPage < $lastPage && $currentPage + $range < $lastPage)
          <li class="page-item disabled"><span class="page-link">...</span></li>
          <li class="page-item">
            <a class="page-link" href="{{ $list_dishes->url($lastPage) }}">{{ $lastPage }}</a>
          </li>
        @endif

        <!-- Mũi tên "Next" -->
        @if ($list_dishes->hasMorePages())
          <li class="page-item">
            <a class="page-link" href="{{ $list_dishes->nextPageUrl() }}"><i class="fa fa-chevron-right"></i></a>
          </li>
        @else
          <li class="page-item disabled">
            <span class="page-link"><i class="fa fa-chevron-right"></i></span>
          </li>
        @endif
        
        <!-- @if ($list_dishes->onFirstPage())
          <li class="page-item disabled">
            <span class="page-link"><i class="fa fa-chevron-left"></i></span>
          </li>
        @else
          <li class="page-item">
            <a class="page-link" href="{{ $list_dishes->previousPageUrl() }}"><i class="fa fa-chevron-left"></i></a>
          </li>
        @endif -->

        <!-- Hiển thị trang 1 và 2 -->
        <!-- <li class="page-item @if($list_dishes->currentPage() == 1) active @endif">
          <a class="page-link" href="{{ $list_dishes->url(1) }}">1</a>
        </li>
        @if ($list_dishes->lastPage() > 2)
          <li class="page-item @if($list_dishes->currentPage() == 2) active @endif">
            <a class="page-link" href="{{ $list_dishes->url(2) }}">2</a>
          </li>
        @endif -->

        <!-- Nếu có nhiều hơn 2 trang, hiển thị dấu mũi tên "..." -->
        <!-- @if ($list_dishes->lastPage() > 2)
          <li class="page-item disabled"><span class="page-link">...</span></li>
        @endif -->

        <!-- Mũi tên "Next" -->
        <!-- @if ($list_dishes->hasMorePages())
          <li class="page-item">
            <a class="page-link" href="{{ $list_dishes->nextPageUrl() }}"><i class="fa fa-chevron-right"></i></a>
          </li>
        @else
          <li class="page-item disabled">
            <span class="page-link"><i class="fa fa-chevron-right"></i></span>
          </li>
        @endif -->
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection