@extends('layout')
@section('link')
  <link rel="stylesheet" href="{{asset('public/fontend/css/shopcart.css')}}">
@endsection
@section('content')
<div class="header-shopcart">
        <i class="fa-solid fa-bag-shopping"></i>
        <h3>Savory</h3>
        <span class="line-cart"></span>
        <p>Shopping Cart</p>
    </div>
    <section class="container">
        @php 
            $cart_id = Session::get('cart_id');
            $user_id = Session::get('user_id');
        @endphp
        @if($reservation_status == "canceled")
            @if($type_user == "customer")
                <div class="notification">
                    <p>There are no items in this reservation because you canceled it.</p>
                    <button class="book-now-btn" onclick="location.href='{{URL::to('/my-reservation/'.$user_id)}}'">Back</button>
                </div>
            @else
                <div class="notification">
                    <p>There are no items in this reservation because the customer canceled it.</p>
                    <button class="book-now-btn" onclick="location.href='{{URL::to('/dashboard/'.$type_user)}}'">Back</button>
                </div>
            @endif
        @else
            @if($cart_items->isEmpty())
                <div class="notification">
                    <p>There are no items in this cart.</p>
                    <button class="book-now-btn" onclick="location.href='{{URL::to('/menu/'.$cart_id . '?type_name='.$type_user)}}'">Add now <i class="fa-solid fa-cart-plus"></i></button>
                </div>
            @else
            <table class="table-container">
                <thead>
                    <tr class="row1">
                        <th colspan="2" width="30%">Dish</td>
                        <th width="10%" >Category</th>
                        <th width="15%">Price</th>
                        <th width="15%">Quantity</th>
                        <th width="25%">Total price</th>
                        <th width="5%"></th>
                    </tr>
                </thead>
                <tbody>
                        @foreach($cart_items as $key => $cart_item)
                            <tr class="content-row" data-id="{{ $cart_item->cart_item_id }}">
                                <td width="10%">
                                    <div class="dish-img">
                                        <img src="{{asset('public/upload/dishes/'.$cart_item->cart_item_img)}}" alt="">
                                    </div>
                                </td>
                                <td width="20%">
                                    <div class="dish-name">
                                        <p>{{$cart_item->cart_item_name}}</p>
                                    </div>
                                </td>
                                <td class="dish-content">
                                    <div class="dish-category">
                                        <p>{{$cart_item->cart_item_category}}</p>
                                    </div>
                                </td>
                                <td class="dish-price">
                                        <span class="price">{{number_format($cart_item->price, 0, ',', '.')}}</span><span>đ</span>
                                </td>
                                <td>
                                    <div class="cart-quantity">
                                        <div class="subtract-quantity">
                                            <button class="button-subtract" onclick="updateQuantity(event, {{$cart_item->cart_item_id}},-1)">-</button>
                                        </div>
                                        <input class="input-quantity" type="text" name="quantity" value="{{$cart_item->quantity}}" size="2" autocomplete="off">
                                        <div class="add-quantity">
                                            <button class="button-add" onclick="updateQuantity(event, {{$cart_item->cart_item_id}},1)">+</button>
                                        </div>
                                    </div>
                                </td>
                                <td class="dish-price">
                                    <span class="total-price">
                                        <?php
                                            $total_price = number_format($cart_item->price * $cart_item->quantity, 0, ',', '.');
                                            echo $total_price;
                                        ?>
                                    </span><span>đ</span>
                                </td>
                                <td><button class="btn-delete" onclick="deleteCartItem(event, {{$cart_item->cart_item_id}})"><i class="fa-solid fa-trash-can btn-delete"></i></button></td>
                            </tr>
                        @endforeach
                </tbody>
            </table>
            <div class="row button-group">
                <div class="col-sm-4 add-more" >
                    <button class="book-now-btn " onclick="location.href='{{URL::to('/menu/'.$cart_id . '?type_name='.$type_user)}}'">Add more</button>
                </div>
                <div class="col-sm-4"></div>
                <div class="col-sm-4 text-end">
                    @if($type_user == "administrator" || $type_user == "manager" || $type_user == "staff")
                    <button class="book-now-btn " onclick="location.href='{{URL::to('/list-of-reservations/'.$type_user)}}'"><i class="fa-solid fa-arrow-left"></i>Back</button>
                    @else
                    <button class="book-now-btn back-btn " onclick="location.href='{{URL::to('/my-reservation/'.$user_id)}}'"><i class="fa-solid fa-arrow-left"></i> Back</button>
                    @endif
                </div>
            </div>
            <div class="end-cart">
                <ul>
                        <li class="grand-price">
                        <p class="total-text">Total meal price</p>
                        <p class="total-money"><span class="money">
                        <span>{{number_format($cart->total_price, 0, ',', '.')}}đ</span></p>
                        </li>
                        <li class="grand-price">
                        <p class="total-text">Service Charge (5%)</p>
                            <span class="money serviceCharge">
                                <?php
                                    $service_charge = $cart->total_price * 0.05;
                                    echo number_format($service_charge, 0, ',', '.') . "đ";
                                ?>
                            </span>
                        </li>
                        <li class="grand-price">
                        <p class="total-text">Tax (10%)</p>
                            <span  class="money tax">
                                <?php
                                    $tax = $cart->total_price * 0.1;
                                    echo number_format($tax, 0, ',', '.') . "đ";
                                ?>
                            </span>
                        </li>
                        <li class="grand-price">
                            <p class="total-text">Total payment</p>
                            <span class="total-payment">{{number_format($cart->sub_total, 0, ',', '.')}}đ</span>
                        </li>
                    </ul>
                </div>   
            @endif
        @endif
    </section>
    <script>
    function updateQuantity(event, cartItemId, change) {
        const row = event.target.closest('tr');
        const input = row.querySelector('.input-quantity');
        let currentQuantity = parseInt(input.value, 10);
        currentQuantity += change;
        if (currentQuantity < 1) {
            currentQuantity = 1;
        }

        input.value = currentQuantity;
        const rowId = row.getAttribute('data-id');
        const price = parseFloat(row.querySelector('.price').textContent.replace('.', '').replace('đ', ''));
        $.ajax({
        url: "{{ URL::to('/update-price-cartmodel') }}",
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            cart_item_id: cartItemId,
            quantity: currentQuantity
        },
        success: function(response) {
            // Cập nhật giá trị tổng tiền sau khi thay đổi số lượng
            row.querySelector('.total-price').textContent = response.totalPrice;
            document.querySelector('.total-money .money').textContent = response.subtotal;
            document.querySelector('.serviceCharge').textContent = response.serviceCharge + "đ";
            document.querySelector('.tax').textContent = response.tax + "đ";
            document.querySelector('.total-payment').textContent = response.totalPayment + "đ";
        },
        error: function(error) {
            console.log("Error!", error);
        }
    });
    }
    function deleteCartItem(event, cartItemId) {
        const row = event.target.closest('tr');
        const button = row.querySelector('.btn-delete');
        $.ajax({
            url: "{{URL::to('/delete_item_cart_res_id')}}",
            method: "get",
            data: {
                _token: '{{ csrf_token() }}',
                cart_item_id: cartItemId,
            },
            success: function(response) {
                row.remove();
                document.querySelector('.total-money .money').textContent = response.subtotal;
                if(response.dishCount < 1) {
                   location.reload();
                } 
            },
            error: function(error) {
                console.log("Error", error);
            }
        });
    }
    </script>
@endsection


  
  