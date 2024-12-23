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
    @if(!isset($find_dishes))
      <div class="panel-heading">
        List of Dishes
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
          <form action="{{URL::to('/search-dish')}}" method="post" class="search-form">
            {{ csrf_field() }}
            <input type="text" name="search_dish" class="input-sm form-control" placeholder="Search">
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
            <th style="width:40px;">Name</th>
            <th style="width:30px;">Price</th>
            <th style="width:50px;">Image</th>
            <th style="width:250px;">Desciption</th>
            <th style="width:30px;">Category</th>
            <th style="width:100px;">Status</th>
            <th style="width:100px;">Date added</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        @if(!isset($find_dishes))
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
                  if($dish->dish_status == "still available" ) { ?>
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
        @else
          <tbody>
              @foreach($find_dishes as $key => $find_dish)
            <tr>
              <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
              <td>{{ $find_dish->dish_name }}</td>
              <td>{{ number_format($find_dish->dish_price, 0, ',', '.') }}</td>
              <td><img src="{{asset('public/upload/dishes/'.$find_dish->dish_img)}}" alt=""></td>
              <td>{{ $find_dish->dish_desc }}</td>
              <td>{{ $find_dish->get_category->category_name }}</td>
              <td><span class="text-ellipsis status_container">
                  <?php
                  if($find_dish->dish_status == "still available" ) { ?>
                      <a href="{{URL::to('/hidden-dish/'.$find_dish->dish_id)}} "><span> <i class="fa fa-thumbs-up"></i><p class="dish_status">Still available</p></span></a>
                  <?php } else { ?>
                    <a href=  "{{URL::to('/display-dish/'.$find_dish->dish_id)}}"><span> <i class="fa fa-thumbs-down"></i><p class="dish_status">Sold out</p></span></a>
                  <?php } ?>
              </span></td>
              <td>{{ $find_dish->dish_dateAdded }}</td>
              <td>
                <a href="{{URL::to('/edit_dish/' .$find_dish->dish_id)}}" class="active" ui-toggle-class="">
                  <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                <a onclick="return confirm('Are you sure to delete this dish?') " href="{{URL::to('/delete_dish/' .$find_dish->dish_id)}}" class="active" ui-toggle-class="">
                  <i class="fa fa-times text-danger text"></i>
                </a>
              </td>
            </tr>
              @endforeach
          </tbody>
        @endif
      </table>
    </div>
    @if(!isset($find_dishes))
      {{$list_dishes->links()}}
    @endif
  </div>
</div>
@endsection