@extends('admin.admin_layout')
@section('style')
  <style>
    img {
      width: 100%;
      object-fit: cover !important;
    }
    th, .short-content {
      text-align:center;
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
    @if(!isset($find_feedbacks))
        <div class="panel-heading">
        List of Feedbacks
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
          <form action="{{URL::to('/search-feedback')}}" method="post" class="search-form">
            {{ csrf_field() }}
            <input type="text" name="search_feedback" class="input-sm form-control" placeholder="Search">
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
            <th style="width:15%;">Account name</th>
            <th style="width:15%;">Dish</th>
            <th style="width:15%;">Rating</th>
            <th style="width:35%;">Comment</th>
            <th style="width:15%;">Date</th>
            <th style="width:5%;">Time</th>
          </tr>
        </thead>
        @if(!isset($find_feedbacks))
          <tbody>
            @foreach($list_feedbacks as $key => $feedback)
              <tr>
                <td class="short-content">{{ $feedback->getOrderItem->getOrder->getUser->account_name }}</td>
                <td class="short-content">
                  <div class="dish-name">
                    <p>{{ $feedback->getOrderItem->order_item_name}}</p>
                  </div>
                  <div class="dish-img">
                    <img src="{{asset('public/upload/dishes/'. $feedback->getOrderItem->order_item_img)}}" alt="">
                  </div>
                </td>
                <td>
                  <?php
                    $rating = $feedback->rating;
                    switch($rating) {
                      case 1: 
                        $rating_star = '<i class="fa-solid fa-star"></i>';
                        break;
                      case 2:
                        $rating_star = '<i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i>';
                        break;
                      case 3:
                        $rating_star = '<i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i>';
                        break;
                      case 4: 
                        $rating_star = '<i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i>';
                        break;
                      case 5:
                        $rating_star = '<i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i>';
                        break;
                    }
                    echo $rating_star;
                  ?>
                </td>
                <td>{{ $feedback->comment}}</td>
                <td class="short-content">{{ $feedback->fb_date}}</td>
                <td class="short-content">{{ $feedback->fb_time}}</td>
              </tr>
            @endforeach
          </tbody>
        @else
          <tbody>
            @foreach($find_feedbacks as $key => $find_feedback)
              <tr>
                <td class="short-content">{{ $find_feedback->getOrderItem->getOrder->getUser->account_name }}</td>
                <td class="short-content">
                  <div class="dish-name">
                    <p>{{ $find_feedback->getOrderItem->order_item_name}}</p>
                  </div>
                  <div class="dish-img">
                    <img src="{{asset('public/upload/dishes/'. $find_feedback->getOrderItem->order_item_img)}}" alt="">
                  </div>
                </td>
                <td>
                  <?php
                    $rating = $find_feedback->rating;
                    switch($rating) {
                      case 1: 
                        $rating_star = '<i class="fa-solid fa-star"></i>';
                        break;
                      case 2:
                        $rating_star = '<i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i>';
                        break;
                      case 3:
                        $rating_star = '<i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i>';
                        break;
                      case 4: 
                        $rating_star = '<i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i>';
                        break;
                      case 5:
                        $rating_star = '<i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i>';
                        break;
                    }
                    echo $rating_star;
                  ?>
                </td>
                <td>{{ $find_feedback->comment}}</td>
                <td class="short-content">{{ $find_feedback->fb_date}}</td>
                <td class="short-content">{{ $find_feedback->fb_time}}</td>
              </tr>
            @endforeach
          </tbody>
        @endif
      </table>
    </div>
    @if(!isset($find_feedbacks))
      {{$list_feedbacks->links()}}
    @endif
  </div>
</div>
@endsection