@extends('layout')
@section('link')
    <link rel="stylesheet" href="{{asset('public/fontend/css/detail_dish.css')}}">
@endsection
@section('content')
    <?php
        $cart_id = Session::get('cart_id');
    ?>
    <section class="container">
        <!-- Dish information -->
        <div class="row">
                <div class="title">
                    <div class="line4">
                    <span class="line4-line"></span>
                    <h3>Detail dish</h3>
                    <span class="line4-line"></span>
                    </div>
                </div>
                <div class="row detail-dish">
                    <div class="col-sm-5 dish-img">
                        <img src="{{asset('public/upload/dishes/'.$detail_dish->dish_img)}}" alt="">
                    </div>
                    <div class="col-sm-7 dish-information">
                        <h3 class="dish-name">{{ $detail_dish->dish_name }}</h3>
                        <p class="field-dish"><b class="field-dish">Dish ID:</b>{{ $detail_dish->dish_id }}</p>
                        <p class="field-dish"><b class="field-dish">Category:</b>{{ $detail_dish->get_category->category_name }}</p>       
                        <p class="field-dish"><b class="field-dish">Description:</b>{{ $detail_dish->dish_desc }}</p>
                        <?php
                            $sum_rating = 0;
                            $count = 0;
                            foreach($detail_dish->hasOrderItem as $key => $item) {
                                if($item->getFeedback) {
                                    $sum_rating = $sum_rating + $item->getFeedback->rating;
                                    $count += 1;
                                }
                            }
                            if($count != 0) {
                                $avg_rating = number_format($sum_rating/$count,1);
                                if (4.7 <= $avg_rating ) {
                                    $rating_star  = '<i class="fa-solid fa-star rating-star"></i> <i class="fa-solid fa-star rating-star"></i> <i class="fa-solid fa-star rating-star"></i> <i class="fa-solid fa-sta rating-starr"></i> <i class="fa-solid fa-star rating-star"></i>';
                                }
                                elseif (4.3 <=  $avg_rating) {
                                    $rating_star  = '<i class="fa-solid fa-star rating-star"></i> <i class="fa-solid fa-star rating-star"></i> <i class="fa-solid fa-star rating-star"></i> <i class="fa-solid fa-star rating-star"></i> <i class="fa-regular fa-star-half-stroke rating-star"></i>';
                                }
                                elseif (3.7 <= $avg_rating) {
                                    $rating_star  = '<i class="fa-solid fa-star rating-star"></i> <i class="fa-solid fa-star rating-star"></i> <i class="fa-solid fa-star rating-star"></i> <i class="fa-solid fa-star rating-star"></i> <i class="fa-regular fa-star rating-star"></i>';
                                }
                                elseif (3.3 <= $avg_rating) {
                                    $rating_star  = '<i class="fa-solid fa-star rating-star"></i> <i class="fa-solid fa-star rating-star"></i> <i class="fa-solid fa-star rating-star"></i> <i class="fa-regular fa-star-half-stroke rating-star"></i> <i class="fa-regular fa-star rating-star"></i>';
                                }
                                elseif (2.7 <= $avg_rating) {
                                    $rating_star  = '<i class="fa-solid fa-star rating-star"></i> <i class="fa-solid fa-star rating-star"></i> <i class="fa-solid fa-star rating-star"></i> <i class="fa-regular fa-star rating-star"></i> <i class="fa-regular fa-star rating-star"></i>';
                                }
                                elseif (2.3 <= $avg_rating) {
                                    $rating_star  = '<i class="fa-solid fa-star rating-star"></i> <i class="fa-solid fa-star rating-star"></i><i class="fa-regular fa-star-half-stroke rating-star"></i> <i class="fa-regular fa-star rating-star"></i> <i class="fa-regular fa-star rating-star"></i>';
                                }
                                elseif (1.7 <= $avg_rating) {
                                    $rating_star  = '<i class="fa-solid fa-star rating-star"></i> <i class="fa-solid fa-star rating-star"></i> <i class="fa-regular fa-star rating-star"></i> <i class="fa-regular fa-star rating-star"></i> <i class="fa-regular fa-star rating-star"></i>';
                                }
                                elseif (1.3 <= $avg_rating) {
                                    $rating_star  = '<i class="fa-solid fa-star rating-star"></i> <i class="fa-regular fa-star-half-stroke rating-star"></i> <i class="fa-regular fa-star rating-star"></i> <i class="fa-regular fa-star rating-star"></i> <i class="fa-regular fa-star rating-star"></i>';
                                }
                                elseif (0.5 <= $avg_rating) {
                                    $rating_star  = '<i class="fa-solid fa-star rating-star"></i> <i class="fa-regular fa-star rating-star"></i> <i class="fa-regular fa-star rating-star"></i> <i class="fa-regular fa-star rating-star"></i> <i class="fa-regular fa-star rating-star"></i>';
                                }
                                else {
                                    $rating_star  = '<i class="fa-regular fa-star rating-star"></i> <i class="fa-regular fa-star rating-star"></i> <i class="fa-regular fa-star rating-star"></i> <i class="fa-regular fa-star rating-star"></i> <i class="fa-regular fa-star rating-star"></i>';
                                }
                            }
                            else {
                                $rating_star  = '';
                            }
                        ?>
                        <p class="field-dish"><b class="field-dish rate">Rating</b>/(<?php echo $count . ' feedbacks): ' .$rating_star ?></p>
                        @if($cart_id == null)
                            <form action="{{URL::to('/add-to-cart')}}" method="POST">
                                {{ csrf_field() }}
                                <p><span class="field-dish"><b>Price:</b></span><span class="price">{{ number_format($detail_dish->dish_price, 0, ',', '.') }}</span><span class="char">đ</span></p>
                                <div class="quantity">
                                    <p><span class="field-dish"><b>Quantity:</b></span></p>
                                    <div class="box-quantity">
                                        <input name="quantity" type="number" min="1" value="1" />
                                        <input name="dishid_hidden" type="hidden" value="{{$detail_dish->dish_id}}" />
                                    </div>
                                </div>
                                <div class="form-button">
                                        <button class="button" type="submit"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </form>
                        @else
                            <form action="{{URL::to('/add-to-cart-res-id/'.$cart_id)}}" method="POST">
                                {{ csrf_field() }}
                                <p><span class="field-dish"><b>Price:</b></span><span class="price">{{ number_format($detail_dish->dish_price, 0, ',', '.') }}</span><span class="char">đ</span></p>
                                <div class="quantity">
                                    <p><span class="field-dish"><b>Quantity:</b></span></p>
                                    <div class="box-quantity">
                                        <input name="quantity" type="number" min="1" value="1" />
                                        <input name="dishid_hidden" type="hidden" value="{{$detail_dish->dish_id}}" />
                                    </div>
                                </div>
                                <div class="form-button">
                                        <button class="button" type="submit"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </form>
                        @endif
                    </div>
            </div>
        </div>
        <!-- tab content -->
        <div class="row tab-container">
        <div class="title">
            <div class="line4">
                <span class="line4-line"></span>
                <h3>Reviews</h3>
                <span class="line4-line"></span>
                </div>
            </div>
            <div class="tab-content">
                <div class=" owl-carousel owl-theme reviews">
                    @if(!empty($detail_dish->hasOrderItem))
                        <?php
                            $hasFeedback = false;
                        ?>
                        @foreach($detail_dish->hasOrderItem as $key => $item)
                            @if($item->getFeedback)
                                    <?php
                                        $hasFeedback = true;
                                    ?>
                                    <div class="rev-content">
                                        <div class="row col-sm-6 judgement-title">
                                            <div class="row account">
                                                <div class="col-md-4 user">
                                                    <i class="fa-solid fa-user"></i>
                                                    <p>{{ $item->getOrder->getUser->account_name }}</p>
                                                </div>
                                                <div class="col-md-4 time-judgement">
                                                    <i class="fa-solid fa-clock"></i>
                                                    <p>{{ $item->getFeedback->fb_time}}</p>
                                                </div>
                                                <div class="col-md-4 date-judment">
                                                    <i class="fa-solid fa-calendar-days"></i>
                                                    <?php
                                                        $fb_date = $item->getFeedback->fb_date;
                                                        $fb_date = date('d-m-Y');
                                                    ?>
                                                    <p>{{ $fb_date }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row judgement-content">
                                            <?php
                                                $rating = $item->getFeedback->rating;
                                                switch($rating) {
                                                    case 1: 
                                                      $rating_star = '<i class="fa-solid fa-star rating-star-item"></i> <i class="fa-regular fa-star rating-star-item"> <i class="fa-regular fa-star rating-star-item"> <i class="fa-regular fa-star rating-star-item"> <i class="fa-regular fa-star rating-star-item"></i>';
                                                      break;
                                                    case 2:
                                                      $rating_star = '<i class="fa-solid fa-star rating-star-item"></i> <i class="fa-solid fa-star rating-star-item"></i> <i class="fa-regular fa-star rating-star-item"> <i class="fa-regular fa-star rating-star-item"> <i class="fa-regular fa-star rating-star-item"></i>';
                                                      break;
                                                    case 3:
                                                      $rating_star = '<i class="fa-solid fa-star rating-star-item"></i> <i class="fa-solid fa-star rating-star-item"></i> <i class="fa-solid fa-star rating-star-item"></i> <i class="fa-regular fa-star rating-star-item"> <i class="fa-regular fa-star rating-star-item"></i>';
                                                      break;
                                                    case 4: 
                                                      $rating_star = '<i class="fa-solid fa-star rating-star-item"></i> <i class="fa-solid fa-star rating-star-item"></i> <i class="fa-solid fa-star rating-star-item"></i> <i class="fa-solid fa-star rating-star-item"></i> <i class="fa-regular fa-star rating-star-item"></i>';
                                                      break;
                                                    case 5:
                                                      $rating_star = '<i class="fa-solid fa-star rating-star-item"></i> <i class="fa-solid fa-star rating-star-item"></i> <i class="fa-solid fa-star rating-star-item"></i> <i class="fa-solid fa-star rating-star-item"></i> <i class="fa-solid fa-star rating-star-item"></i>';
                                                      break;
                                                  }
                                            ?>
                                            <p><b>Rating: </b> <?php echo $rating_star; ?></p>
                                        </div>
                                        <div class="row judgement-content">
                                            <p>{{ $item->getFeedback->comment  }}</p>
                                        </div>
                                    </div>  
                            @endif
                        @endforeach
                    @endif
                    @if(!$hasFeedback)
                        <div class="content-message">
                            <p>There are no reviews for this dish yet</p>
                        </div> 
                    @endif
                </div>
                @if(isset($order_item))
                <div class="row form-review">
                    <div class="col-sm-12">
                        <p class="form-top"><b>Write your review</b></p>
                    </div>
                    <form action="{{URL::to('/send-feedback/'.$order_item->order_item_id .'?type_name='.$type_user)}}" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-12 form-box">
                                <textarea style="resize: none;"  rows="5" name="comment" placeholder="Your impressions of this dish" required=""></textarea>
                            </div>
                        </div>
                        <div class="judgement">
                                <p class="field-dish"><b>Rating: </b</p>
                                <div class="rating">
                                    <input value="5" name="rate" id="star5" type="radio" checked="">
                                    <label title="text" for="star5"></label>
                                    <input value="4" name="rate" id="star4" type="radio">
                                    <label title="text" for="star4"></label>
                                    <input value="3" name="rate" id="star3" type="radio" >
                                    <label title="text" for="star3"></label>
                                    <input value="2" name="rate" id="star2" type="radio">
                                    <label title="text" for="star2"></label>
                                    <input value="1" name="rate" id="star1" type="radio">
                                    <label title="text" for="star1"></label>
                                </div>
                        </div>
                        <div class="row form-button btn-send-fb">
                            <button class="button" name="submit">Submit <i class="fa-solid fa-paper-plane"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif
        <!-- related dishes -->
        <div class="related-dishes">
            <div class="title">
                <div class="line4">
                <span class="line4-line"></span>
                <h3>Related dishes</h3>
                <span class="line4-line"></span>
                </div>
            </div>
            <div class="row rel-dish">
                <div class="owl-carousel owl-theme best-seller-card">
                    @foreach($related_dish as $key => $related_value)
                        @if($cart_id == null)
                            <div class="card" onclick="location.href='{{URL::to('/detail_dish/'.$related_value->dish_id)}}'">
                                <form action="{{URL::to('/add-to-cart')}}" method="post">
                                {{ csrf_field() }}
                            <img class="card-img-top" src="{{asset('public/upload/dishes/'.$related_value->dish_img)}}" alt="Card image" style="width:100%">
                            <div class="card-body">
                                <div class="dish-price">
                                <p><span class="price">{{ number_format($related_value->dish_price, 0, ',', '.') }}</span><span class="char">đ</span></p>
                                </div>
                                <h4 class="dish-name">{{ $related_value->dish_name }}</h4>
                                <input type="hidden" name="dishid_hidden" value="{{$related_value->dish_id}}">
                                <input type="hidden" name="quantity" value="1">
                                <div class="row form-button">
                                    <button class="button rel-dish-btn"  type="submit" name="add-to-cart" ><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                            </form>
                            </div>
                        @else 
                            <div class="card" onclick="location.href='{{URL::to('/detail_dish_cart_id/'.$related_value->dish_id.'?cart_id='.$cart_id)}}'">
                                <form action="{{URL::to('/add-to-cart-res-id/'.$cart_id)}}" method="post">
                                {{ csrf_field() }}
                                    <img class="card-img-top" src="{{asset('public/upload/dishes/'.$related_value->dish_img)}}" alt="Card image" style="width:100%">
                                    <div class="card-body">
                                        <div class="dish-price">
                                        <p><span class="price">{{ number_format($related_value->dish_price, 0, ',', '.') }}</span><span class="char">đ</span></p>
                                        </div>
                                        <h4 class="dish-name">{{ $related_value->dish_name }}</h4>
                                        <input type="hidden" name="dishid_hidden" value="{{$related_value->dish_id}}">
                                        <input type="hidden" name="quantity" value="1">
                                        <div class="row form-button">
                                            <button class="button rel-dish-btn"  type="submit" name="add-to-cart" ><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <script>
        $('.reviews').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplaySpeed: 3000,
            dots:false,
            autoplayHoverPause: true,
            items:1,
    })
    </script>
@endsection

