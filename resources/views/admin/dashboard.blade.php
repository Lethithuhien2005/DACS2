@extends('admin.admin_layout')
@section('style')
<style>
    th, td {
        text-align: center;
    }
    img {
      width: 40%;
      object-fit: cover !important;
    }
  </style>
@endsection
@section('admin_content')  
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Best Sellers
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">          
      </div>
      <div class="col-sm-4">
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20%;">Image</th>
            <th style="width:20%;">Name</th>
            <th style="width:20%;">Price</th>
            <th style="width:20%;">Category</th>
            <th style="width:20%;">Quantity</th>
          </tr>
        </thead>
        <tbody>
            @foreach($best_sellers as $key => $best_dish)
          <tr>
            <td><img src="{{asset('public/upload/dishes/'.$best_dish->getDish->dish_img)}}" alt=""></td>
            <td>{{ $best_dish->getDish->dish_name }}</td>
            <td>{{ number_format($best_dish->getDish->dish_price, 0, ',', '.') }}</td>
            <td>{{ $best_dish->getDish->get_category->category_name }}</td>
            <td>{{ $best_dish->total_quantity }}</td>
          </tr>
            @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection