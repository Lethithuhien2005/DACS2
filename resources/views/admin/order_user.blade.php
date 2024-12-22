@extends('layout')
@section('link')
  <link rel="stylesheet" href="{{asset('public/fontend/css/shopcart.css')}}">
@endsection
@section('style')
    <style>
        .btn-cancel {
        background-color: #ffff00;
        border: #ffff00 1px solid;
        border-radius: 5px;
        padding: 5px;
        }
        .btn-cancel:hover {
            background-color: #000;
            border: #ffff00 1px solid;
            border-radius: 5px;
            color: #ffff00;
        }
 </style>
@endsection
@section('content')
<div class="header-shopcart">
        <i class="fa-solid fa-bag-shopping"></i>
        <h3>Savory</h3>
        <span class="line-cart"></span>
        <p>Dishes in the order</p>
    </div>
    <section class="container">
        <table class="table-container">
            <thead>
            @if($type_user == "customer")
                <tr class="row1">
                    <th colspan="2" width="40%">Dish</td>
                    <th width="20%">Price</th>
                    <th width="7%">Quantity</th>
                    <th width="25%">Total price</th>
                    <th width="8%"></th>
                </tr>
            @else
                <tr class="row1">
                    <th colspan="2" width="40%">Dish</td>
                    <th width="20%">Price</th>
                    <th width="15%">Quantity</th>
                    <th width="25%">Total price</th>
                </tr>
            @endif
            </thead>
            <tbody>
                    @foreach($order_items as $key => $order_item)
                        <tr class="content-row">
                            <td width="10%">
                                <div class="dish-img">
                                    <img src="{{asset('public/upload/dishes/'.$order_item->order_item_img)}}" alt="">
                                </div>
                            </td>
                            <td width="20%">
                                <div class="dish-name">
                                    <p>{{$order_item->order_item_name}}</p>
                                </div>
                            </td>
                            <td class="dish-price">
                                    <span class="price">{{number_format($order_item->price, 0, ',', '.')}}</span><span>đ</span>
                            </td>
                            <td>
                                <div class="cart-quantity">
                                    <input class="input-quantity" type="text" name="quantity" value="{{$order_item->quantity}}" size="2" autocomplete="off">
                                </div>
                            </td>
                            <td class="dish-price">
                                <span class="total-price">
                                    <?php
                                        $total_price = number_format($order_item->price * $order_item->quantity, 0, ',', '.');
                                        echo $total_price;
                                    ?>
                                </span><span>đ</span>
                            </td>
                            @if($type_user == "customer")
                                    @if(isset($order_item->getFeedback))
                                        <td><p>Evaluated <i class="fa-solid fa-check"></i></p></td>
                                    @else 
                                        <td>
                                            <button class="btn-cancel" onclick="location.href='{{ URL::to('/detail_dish/' .$order_item->dish_id . '?order_item_id=' . $order_item->order_item_id . '&type_name='.$type_user) }}'">
                                                Evaluate
                                            </button>
                                        </td>
                                    @endif
                            @endif
                            
                        </tr>
                    @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-sm-8"></div>
            <div class="col-sm-4 add-more" >
                @if($type_user == "customer")
                <button class="book-now-btn" onclick="location.href='{{URL::to('/my-reservation/'. $order->user_id)}}'"><i class="fa-solid fa-arrow-left"></i>Back</button>
                @elseif($type_user == "administrator" || $type_user == "manager" || $type_user == "staff")
                <button class="book-now-btn" onclick="location.href='{{URL::to('/list-of-orders/'. $type_user)}}'"><i class="fa-solid fa-arrow-left"></i>Back</button>
                @endif
            </div>
        </div>
        <div class="end-cart">
            <ul>
                    <li class="grand-price">
                    <p class="total-text">Total meal price</p>
                    <p class="total-money"><span class="money">{{ number_format($order->sub_total, 0, ',', '.') }}</span><span>đ</span></p>
                    </li>
                    <li class="grand-price">
                    <p class="total-text">Service Charge (5%)</p>
                        <span class="money">
                            <?php 
                                $total_meal = (float)$order->sub_total;
                                $service = $total_meal * 5 / 100;
                                echo number_format($service, 0, ',', '.') . 'đ';
                            ?>
                        </span>
                    </li>
                    <li class="grand-price">
                    <p class="total-text">Tax (10%)</p>
                        <span  class="money">
                            <?php
                                $total_meal = (float)$order->sub_total;
                                $tax = $total_meal * 10 / 100;
                                echo number_format($tax, 0, ',', '.') . 'đ';
                            ?>
                        </span>
                    </li>
                    <li class="grand-price">
                        <p class="total-text">Total payment</p>
                        <span class="total-payment">
                            <?php
                                $total_payment = (float)$order->sub_total + $service + $tax;
                                echo number_format($total_payment, 0, ',', '.') . 'đ';
                            ?>
                        </span>
                    </li>
                </ul>
            </div>   
    </section>
@endsection


  
  