@extends('layout')
@section('link')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
@endsection
@section('content')

        <?php
          $cart_id = Session::get('cart_id');
        ?>
        <div class="header-content">
            <img src="{{asset('public/fontend/img/background11.jpg')}}" alt="background-header">
            <div class="title-header">
                <h1>Menu</h1>
                <p>The various dishes are waiting for your coming to enjoy its</p>
                <p class="header-link"><a href="{{URL::to('/homepage')}}">Home</a><span>></span><a href="{{URL::to('/menu')}}">Menu</a></p>
            </div>
        </div>
    <main>
      <div class="menu-container">
        <div class="title" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="800">
          <div class="line4">
            <span class="line4-line"></span>
            <h3>Our Menu</h3>
            <span class="line4-line"></span>
          </div>
          <h2>Explore Our Dishes</h2>
        </div>
        <div class="menu-list" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="800">
          @foreach($list_categories as $key => $category)
          <button onclick="showMenu('{{ str_replace(' ', '_', $category->category_name) }}')">
            <div class="menu-icon" id="menu{{ $category->category_id }}">
              @if($category->category_id == 1)
              <i class="fa-solid fa-plate-wheat"></i>
              @elseif($category->category_id == 2)
              <i class="fa-solid fa-pizza-slice"></i>
              @elseif($category->category_id == 3)
              <i class="fa-solid fa-martini-glass-citrus"></i>
              @elseif($category->category_id == 4)
              <i class="fa-solid fa-mug-hot"></i>
              @endif
               <p>{{ $category->category_name }}</p>
             </div>
          </button>
          <span class="line4-line"></span>
          @endforeach
        </div>
        @foreach($list_categories as $key => $category)
        <div class="menu-section {{ str_replace(' ', '_', $category->category_name) }}">
          <div class="row dish-container">
            @foreach($list_dishes as $key => $dish)
            @if ($dish->category_id == $category->category_id)
              @if($cart_id == null)
              <div class="col-sm-4 card card-dish" onclick="location.href='{{URL::to('/detail_dish/'.$dish->dish_id)}}'"  data-aos="zoom-in" data-aos-easing="ease-in-out" data-aos-delay="{{ $key * 20 }}"   data-aos-duration="1000" >
                <form action="{{URL::to('/add-to-cart')}}" method="post">
                  {{ csrf_field() }}
                  <img class="card-img-top" src="{{asset('public/upload/dishes/'.$dish->dish_img)}}" alt="Card image" style="width:100%">
                    <div class="card-body">
                      <h4 class="card-title">{{$dish->dish_name}}</h4>
                      <?php
                       $sum_rating = 0;
                       $count = 0;
                        foreach($dish->hasOrderItem as $key => $dish_item) {
                            if($dish_item->getFeedback) {
                              $sum_rating = $sum_rating + $dish_item->getFeedback->rating;
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
                      <div class="judgement">
                          <p><?php echo $rating_star ?></p>
                        </div>
                      <input type="hidden" name="dishid_hidden" value="{{$dish->dish_id}}">
                      <input type="hidden" name="quantity" value="1">
                      <div class="card-price">
                        <p>{{ number_format($dish->dish_price, 0, ',', '.') }}<span>đ</span></p>
                        <button type="submit" name="add-to-cart"><i class="fa-solid fa-cart-shopping"></i></button>
                      </div>
                    </div>
                  </form>
                </div>
                @else
                  <div class="col-sm-4 card card-dish" onclick="location.href='{{ URL::to('/detail_dish_cart_id/'.$dish->dish_id.'?cart_id='.$cart_id . '&type_name=' . $type_user) }}'">
                    <form action="{{URL::to('/add-to-cart-res-id/'.$cart_id . '?type_name='.$type_user)}}" method="post">
                    {{ csrf_field() }}
                    <img class="card-img-top" src="{{asset('public/upload/dishes/'.$dish->dish_img)}}" alt="Card image" style="width:100%">
                      <div class="card-body">
                        <h4 class="card-title">{{$dish->dish_name}}</h4>
                          <?php
                            $sum_rating = 0;
                            $count = 0;
                              foreach($dish->hasOrderItem as $key => $dish_item) {
                                  if($dish_item->getFeedback) {
                                    $sum_rating = $sum_rating + $dish_item->getFeedback->rating;
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
                        <div class="judgement">
                            <p><?php echo $rating_star ?></p>
                          </div>
                        <input type="hidden" name="dishid_hidden" value="{{$dish->dish_id}}">
                        <input type="hidden" name="quantity" value="1">
                        <div class="card-price">
                          <p>{{ number_format($dish->dish_price, 0, ',', '.') }}<span>đ</span></p>
                          <button type="submit" name="add-to-cart"><i class="fa-solid fa-cart-shopping"></i></button>
                        </div>
                      </div>
                    </form>
                  </div>
                @endif
            @endif
            @endforeach
          </div>
      </div>
      @endforeach
    </main>
    <script>
      AOS.init();
    </script>
@endsection