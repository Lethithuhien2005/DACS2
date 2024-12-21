@extends('layout')
@section('link')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
@endsection
@section('content')
<div class="owl-carousel owl-theme header-container">
        <div class="item">
            <img src="{{asset('public/fontend/img/background4.jpg')}}" alt="">
            <div class="content-slide1">
              <div class="line1" data-aos="fade-right" data-aos-easing="ease-in-out" data-aos-duration="800">
                <span class="line"></span>
                <i class="fa-solid fa-bowl-rice"></i>
                <span class="line"></span>
              </div>
              <h1 data-aos="fade-right" data-aos-easing="ease-in-out" data-aos-duration="800">SAVORY RESTAURANT</h1>
              <div class="line2" data-aos="fade-left" data-aos-easing="ease-in-out" data-aos-duration="800">
                <span class="line2-line"></span>
                <h3>Zesty</h3>
                <span class="line2-line-dot"></span>
                <h3>Flavourful</h3>
                <span class="line2-line-dot"></span>
                <h3>Tasty</h3>
                <span class="line2-line"></span>
              </div>
            </div>
        </div>
        <div class="item">
            <img src="{{asset('public/fontend/img/background7.jpg')}}" alt="">
            <div class="content-slide2">
              <h2>Discover Flavors Today</h2>
              <p>Let the journey of flavor discovery begin today.<br>Every flavor is carefully crafted to offer a rich and <br> unforgettable experience. Join us in a captivating culinary world <br> where every meal is an exciting adventure</p>
            </div>
        </div>
        <div class="item">
            <img src="{{asset('public/fontend/img/background11.jpg')}}" alt="" id="background-header1">
            <div class="content-slide3">
              <h2>Where each dish tells a story</h2>
              <p>As you savor every bite, you'll discover the history<br> and passion behind the recipe, making, your dining experience <br> not just a meal, but a journey through flavors and memories</p>
            </div>
        </div>
        <div class="item">
            <img src="{{asset('public/fontend/img/background14.jpg')}}" alt="">
            <div class="content-slide4">
              <h2>Elevate Your Taste</h2>
              <p>Each dish is designed not just to satisfy hunger, <br>but to take you on a culinary journey that transforms <br> the ordinary into the extraordinary. Join us, <br> and discover how we can elevate your palate to new heights</p>
            </div>
        </div>
    </div>
    <main>
    <!-- About us -->
    <div class="about-us-container">
      <div class="row col-sm-7 img-container" data-aos="fade-up" data-aos-easing="ease-in-out">
          <div class="col-6 col-sm-6" data-aos="fade-up">
            <img class="row" src="{{asset('public/fontend/img/spaghetti bolognese.jpg')}}" alt="" id="about-us-img1">
            <img class="row" src="{{asset('public/fontend/img/service1.jpg')}}" alt="" id="about-us-img2">
          </div>
          <div class="col-6 col-sm-6" data-aos="fade-up" data-aos-easing="ease-in-out">
            <img src="https://media.istockphoto.com/id/1409921056/vi/anh/g%C3%A0-r%C3%A1n-tr%C3%AAn-n%C4%A9a.jpg?s=612x612&w=0&k=20&c=K6RIn17LdN83HlaV0ReVBgV2_JMssSzB_R8ttH6dYro=" alt="fried chicken.jpg" id="about-us-img3">
          </div>
      </div>
      <div class="col-sm-5 about-us-content" data-aos="fade-up" data-aos-easing="ease-in-out">
        <div class="line4">
          <span class="line4-line"></span>
          <h3>Discover</h3>
          <span class="line4-line"></span><br>
        </div>
        <h2>Our Story</h2>
        <h4>Proud of our start in the restaurant business</h4>
        <p>Welcome to Savory, where flavor takes center stage. Our menu features exquisite dishes made from fresh, local ingredients. Enjoy a cozy atmosphere and unforgettable dining experiences. Join us and savor the joy of great food!</p>
        <button class="see-more-btn" onclick="location.href='{{URL::to('/aboutus')}}'">About us</button>
      </div>
    </div>

    <!-- Open hours -->
    <div class="open-hours">
      <video autoplay muted loop playsinline src="{{asset('public/fontend/img/OpenHours.mp4')}}"></video>
      <div class="video-content">
        <div class="content1">
          <h1>Opening hours</h1>
          <h3>Call for reservation</h3>
        </div>
        <div class="row content2">
          <div class="col-6 col-sm-6 time-content1">
            <h3 class="day-content">Monday to Friday</h3>
            <h2 class="time-content">09:00</h2>
            <h2 class="time-content">20:00</h2>
          </div>
          <div class="col-6 col-sm-6 time-content2">
            <h3 class="day-content">Saturday to Sunday</h3>
            <h2 class="time-content">08:00</h2>
            <h2 class="time-content">23:00</h2>
          </div>
        </div>
        <button class="book-now-btn" onclick="location.href='{{URL::to('/reservation')}}'">Book now ></button>
      </div>
    </div>

    <!-- Service -->
      <div class="service-container" data-aos="fade-up" data-aos-easing="ease-in-out">
        <div class="title">
          <div class="line4">
            <span class="line4-line"></span>
            <h3>Our Service</h3>
            <span class="line4-line"></span>
          </div>
          <h2>What we focus on</h2>
        </div>
        <div class="row service-content">
          <div class="col-lg-3 col-sm-6 services" data-aos="fade-up" data-aos-easing="ease-in-out">
            <div class="service-icon">
              <i class="fa-solid fa-pizza-slice"></i>
              <h3 class="content-title">Quality food</h3>
              <p>Our restaurant offers a diverse menu prepared with fresh ingredients for unique flavors and elegant presentation</p>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 services" data-aos="fade-up" data-aos-easing="ease-in-out">
            <div class="service-icon">
              <i class="fa-solid fa-champagne-glasses"></i>
              <h3 class="content-title">Private Event</h3>
              <p>Our restaurant offers private event services with an elegant and cozy atmosphere, perfect for birthday parties, family gatherings, or corporate events</p>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 services" data-aos="fade-up" data-aos-easing="ease-in-out">
            <div class="service-icon">
              <i class="fa-regular fa-calendar-days"></i>
              <h3 class="content-title">Reservation</h3>
              <p>We offers a convenient online reservation service, allowing customers to easily select their preferred date, time, and seating with just a few clicks</p>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 services" data-aos="fade-up" data-aos-easing="ease-in-out">
            <div class="service-icon">
              <i class="fa-solid fa-user-tie"></i>
              <h3 class="content-title">Chef team</h3>
              <p>Our restaurant boasts a professional and passionate chef team dedicated to delivering delicious and innovative dishes</p>
            </div>
          </div>
        </div>
      </div>

    <!-- Best seller -->
     <div class="best-seller" data-aos="fade-up" >
        <div class="title">
          <div class="line4">
            <span class="line4-line"></span>
            <h3>Our Gallery</h3>
            <span class="line4-line"></span>
          </div>
          <h2>Best seller dishes</h2>
        </div>
        <div class="owl-carousel owl-theme best-seller-card">
          <div class="card" onclick="location.href='{{URL::to('/detail_food')}}'">
            <img class="card-img-top" src="{{asset('public/fontend/img/fried chicken.jpg')}}" alt="Card image" style="width:100%">
            <div class="card-body">
              <h4 class="card-title">fried chicken</h4>
              <div class="card-price">
                <p>150.000<span>đ</span></p>
                <button onclick="location.href='{{URL::to('/shopcart')}}'"><i class="fa-solid fa-cart-shopping"></i></button>
              </div>
            </div>
          </div>
          <div class="card" onclick="location.href='{{URL::to('/detail_food')}}'">
            <img class="card-img-top" src="{{asset('public/fontend/img/spaghetti bolognese.jpg')}}" alt="Card image" style="width:100%">
            <div class="card-body">
              <h4 class="card-title">spaghetti bolognese</h4>
              <div class="card-price">
                <p>89.000<span>đ</span></p>
                <button onclick="location.href='{{URL::to('/shopcart')}}'"><i class="fa-solid fa-cart-shopping"></i></button>
              </div>
            </div>
          </div>
          <div class="card" onclick="location.href='{{URL::to('/detail_food')}}'">
            <img class="card-img-top" src="{{asset('public/fontend/img/French steak.jpg')}}" alt="Card image" style="width:100%">
            <div class="card-body">
              <h4 class="card-title">French steak</h4>
              <div class="card-price">
                <p>239.000<span>đ</span></p>
                <button onclick="location.href='{{URL::to('/shopcart')}}'"><i class="fa-solid fa-cart-shopping"></i></button>
              </div>
            </div>
          </div>
          <div class="card" onclick="location.href='{{URL::to('/detail_food')}}'">
            <img class="card-img-top" src="{{asset('public/fontend/img/Pumpkin Shrimp Soup.jpg')}}" alt="Card image" style="width:100%">
            <div class="card-body">
              <h4 class="card-title">pumpkin soup</h4>
              <div class="card-price">
                <p>85.000<span>đ</span></p>
                <button onclick="location.href='{{URL::to('/shopcart')}}'"><i class="fa-solid fa-cart-shopping"></i></button>
              </div>
            </div>
          </div>
          <div class="card" onclick="location.href='{{URL::to('/detail_food')}}'">
            <img class="card-img-top" src="{{asset('public/fontend/img/shrimp.jpg')}}" alt="Card image" style="width:100%">
            <div class="card-body">
              <h4 class="card-title">golden sauce shrimp</h4>
              <div class="card-price">
                <p>179.000<span>đ</span></p>
                <button onclick="location.href='{{URL::to('/shopcart')}}'"><i class="fa-solid fa-cart-shopping"></i></button>
              </div>
            </div>
          </div>
          <div class="card" onclick="location.href='{{URL::to('/detail_food')}}'">
            <img class="card-img-top" src="{{asset('public/fontend/img/shushi 2.jpg')}}" alt="Card image" style="width:100%">
            <div class="card-body">
              <h4 class="card-title">kimpap</h4>
              <div class="card-price">
                <p>219.000<span>đ</span></p>
                <button onclick="location.href='{{URL::to('/shopcart')}}'"><i class="fa-solid fa-cart-shopping"></i></button>
              </div>
            </div>
          </div>
          <div class="card" onclick="location.href='{{URL::to('/detail_food')}}'">
            <img class="card-img-top" src="{{asset('public/fontend/img/pizza.jpg')}}" alt="Card image" style="width:100%">
            <div class="card-body">
              <h4 class="card-title">pizza</h4>
              <div class="card-price">
                <p>150.000<span>đ</span></p>
                <button onclick="location.href='{{URL::to('/shopcart')}}'"><i class="fa-solid fa-cart-shopping"></i></button>
              </div>
            </div>
          </div>
        </div>
     </div>
    <!-- Discount -->
     <div class="discount-container" data-aos="fade-right">
      <div class="discount-content-left">
          <p class="discount-content1">Today's special menu discount!</p>
          <h2 class="discount-content2">Up to <span class="percentage">25%</span> discount</h2>
          <p class="discount-content1">Book your table now!</p>
          <button class="see-more-btn" onclick="location.href='{{URL::to('/blog')}}'">See more</button>
      </div>
      <div class="discount-content-right"></div>
     </div>
    
    <!-- Blog -->
     <div class="blog-container" data-aos="fade-up">
        <div class="title">
          <div class="line4">
            <span class="line4-line"></span>
            <h3>Blog & News</h3>
            <span class="line4-line"></span>
          </div>
          <h2>Get update our food</h2>
        </div>
        <div class="row blogs">
          <div class="col-md-4 col-sm-6 card" data-aos="fade-up">
            <img class="card-img-top" src="{{asset('public/fontend/img/crispy shrimp.jpg')}}" alt="Card image" style="width: 100%;">
            <div class="card-body">
              <div class="time-blog">
                <i class="fa-solid fa-calendar-days"></i>
                <p>23/9/2024</p>
                <i class="fa-regular fa-comment"></i>
                <p>4 comments</p>
              </div>
              <div class="blog-content">
                <h3>Why You Should Try the New Dishes at Savory</h3>
                <p>At our restaurant, trying new dishes offers fresh and unique flavors, allowing you to explore tastes like never before.</p>
              </div>
              <button class="animated-button"  onclick="window.location.href='{{ URL::to('/blog') }}'">
                <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                  </path>
                </svg>
                <span class="text">Read more</span>
                <span class="circle"></span>
                <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">         </path>
                </svg>
              </button>
            </div>
          </div>
          <div class="col-md-4 col-sm-6 card" id="blog2" data-aos="fade-up">
            <img class="card-img-top" src="{{asset('public/fontend/img/Mixed Instant Noodles.jpg')}}" alt="Card image" style="width: 100%;">
            <div class="card-body">
              <div class="time-blog">
                <i class="fa-solid fa-calendar-days"></i>
                <p>30/9/2024</p>
                <i class="fa-regular fa-comment"></i>
                <p>2 comments</p>
              </div>
              <div class="blog-content">
                <h3>Unlocking the Secrets to Achieving Perfect Flavor</h3>
                <p>Perfect flavor comes from fresh ingredients, balanced spices, and careful cooking techniques.</p>
              </div>
              <button class="animated-button"  onclick="window.location.href='{{ URL::to('/blog') }}'">
                <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                  </path>
                </svg>
                <span class="text">Read more</span>
                <span class="circle"></span>
                <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">         </path>
                </svg>
              </button>
            </div>
          </div>
          <div class="col-md-4 card" id="blog3" data-aos="fade-up">
            <img class="card-img-top" src="{{asset('public/fontend/img/blog4.jpg')}}" alt="Card image" style="width: 100%;">
            <div class="card-body">
              <div class="time-blog">
                <i class="fa-solid fa-calendar-days"></i>
                <p>02/10/2024</p>
                <i class="fa-regular fa-comment"></i>
                <p>3 comments</p>
              </div>
              <div class="blog-content">
                <h3>Common Mistakes When Ordering Food</h3>
                <p>When ordering food at a restaurant, many people often not carefully reviewing the menu, leading to choosing the wrong dish.</p>
              </div>
              <button class="animated-button" >
                <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                  </path>
                </svg>
                <span class="text">Read more</span>
                <span class="circle"></span>
                <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">         </path>
                </svg>
              </button>
            </div>
          </div>
        </div>
     </div>
  </main>
  <script>
    AOS.init();
</script>
@endsection