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
        <?php
        $content = Cart::content();
        $dishCount = $content->count();
        ?>
        @if($dishCount < 1)
            <div class="notification">
                <p>There are no items in your cart.</p>
                <button class="book-now-btn" onclick="location.href='{{URL::to('/menu')}}'">Add now <i class="fa-solid fa-cart-plus"></i></button>
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
                    @foreach($content as $key => $item_content)
                        <tr class="content-row" data-rowid="{{ $item_content->rowId }}">
                            <td width="10%">
                                <div class="dish-img">
                                    <img src="{{asset('public/upload/dishes/'.$item_content->options->image)}}" alt="">
                                </div>
                            </td>
                            <td width="20%">
                                <div class="dish-name">
                                    <p>{{$item_content->name}}</p>
                                </div>
                            </td>
                            <td class="dish-content">
                                <div class="dish-category">
                                    <p>{{$item_content->options->category}}</p>
                                </div>
                            </td>
                            <td class="dish-price">
                                    <span class="price">{{number_format($item_content->price, 0, ',', '.')}}</span><span>đ</span>
                            </td>
                            <td>
                                <div class="cart-quantity">
                                    <div class="subtract-quantity">
                                        <button class="button-subtract" onclick="updateQuantity(event,-1)">-</button>
                                    </div>
                                    <input class="input-quantity" type="text" name="quantity" value="{{$item_content->qty}}" size="2" autocomplete="off">
                                    <div class="add-quantity">
                                        <button class="button-add" onclick="updateQuantity(event,1)">+</button>
                                    </div>
                                </div>
                            </td>
                            <td class="dish-price">
                                <span class="total-price">
                                    <?php
                                        $total_price = number_format($item_content->price * $item_content->qty, 0, ',', '.');
                                        echo $total_price;
                                    ?>
                                </span><span>đ</span>
                            </td>
                            <td><button class="btn-delete" onclick="deleteCartItem(event)"><i class="fa-solid fa-trash-can btn-delete"></i></button></td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
        <div class="end-cart">
            <ul>
                    <li class="grand-price">
                    <p class="total-text">Total meal price</p>
                    <p class="total-money"><span class="money">{{ number_format((float) str_replace(',', '', Cart::subtotal()), 0, ',', '.') }}</span><span>đ</span></p>
                    </li>
                    <li class="grand-price">
                    <p class="total-text">Service Charge (5%)</p>
                        <span class="money serviceCharge">
                            <?php
                                $subtotal = (float) str_replace(',', '', Cart::subtotal());
                                $service_charge = $subtotal * 0.05;
                                echo number_format($service_charge, 0, ',', '.') . "đ";
                            ?>
                        </span>
                    </li>
                    <li class="grand-price">
                    <p class="total-text">Tax (10%)</p>
                        <span  class="money tax">
                            <?php
                                $tax = $subtotal * 0.1;
                                echo number_format($tax, 0, ',', '.') . "đ";
                            ?>
                        </span>
                    </li>
                    <li class="grand-price">
                        <p class="total-text">Total payment</p>
                        <span class="total-payment">
                           <?php
                                $total_payment = $subtotal + $service_charge + $tax;
                                echo number_format($total_payment, 0, ',', '.') . "đ";
                           ?>
                        </span>
                    </li>
                    <li class="grand-price">
                        <div class="form-button">
                                <button class="button" onclick="location.href='{{URL::to('/reservation')}}'">Book table <i class="fa-solid fa-paper-plane"></i></button>
                        </div>
                    </li>
                </ul>
            </div>   
        @endif
    </section>
    <script>
    function updateQuantity(event, change) {
        const row = event.target.closest('tr');
        const input = row.querySelector('.input-quantity');
        let currentQuantity = parseInt(input.value, 10);
        currentQuantity += change;
        if (currentQuantity < 1) {
            currentQuantity = 1;
        }

        input.value = currentQuantity;
        const rowId = row.getAttribute('data-rowid');
        const price = parseFloat(row.querySelector('.price').textContent.replace('.', '').replace('đ', ''));
        $.ajax({
        url: "{{ URL::to('/update-price-shoppingcart') }}", 
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            rowId: rowId,
            qty: currentQuantity
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
    function deleteCartItem(event) {
        const row = event.target.closest('tr');
        const rowId = row.getAttribute('data-rowid');
        $.ajax({
            url: "{{URL::to('/delete_item_shoppingcart')}}",
            method: "get",
            data: {
                _token: '{{ csrf_token() }}',
                rowId: rowId
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


  
  