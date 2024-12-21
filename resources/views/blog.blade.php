@extends('layout')
@section('style')
  <style>
    .title-blog {
    font-family: "Rancho", sans-serif;
    font-size: 60px;
    padding-top: 50px;
}
  </style>
@endsection
@section('content')
<div class="header-content">
            <img src="{{asset('public/fontend/img/background11.jpg')}}" alt="background-header">
            <div class="title-header">
                <h1>Blog</h1>
                <p>The various dishes are waiting for your coming to enjoy its</p>
                <p class="header-link"><a href="{{URL::to('/homepage')}}">Home</a><span>></span><a href="{{URL::to('/blog')}}">Blog</a></p>
            </div>
        </div>
    <div class="container my-5">
        <!-- Promotions Section -->
        <h2 class="text-center my-5 title-blog">Promotions</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="https://i.pinimg.com/736x/a9/21/5b/a9215b390de0e381e134dbc54c7fb2f1.jpg" class="card-img-top" alt="Promotion">
                    <div class="card-body">
                        <h5 class="card-title">Special Discount</h5>
                        <p class="card-text">Get 20% off on all dishes this weekend!</p>
                        <button class="animated-button">
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
            <div class="col-md-4">
                <div class="card">
                    <img src="https://i.pinimg.com/564x/82/ff/70/82ff70603fbbefaa39d4f54d966bc216.jpg" class="card-img-top" alt="Promotion">
                    <div class="card-body">
                        <h5 class="card-title">Happy Hour</h5>
                        <p class="card-text">Join us for happy hour from 5 PM to 7 PM!</p>
                        <button class="animated-button">
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
            <div class="col-md-4">
                <div class="card">
                    <img src="{{asset('public/fontend/img/Wine Frost.jpg')}}" class="card-img-top" alt="Promotion">
                    <div class="card-body">
                        <h5 class="card-title">Free Drink</h5>
                        <p class="card-text">Get a free appetizer with any main course!</p>
                        <button class="animated-button">
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

        <!-- New Dishes Section -->
        <h2 class="text-center my-5 title-blog">New Dishes</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="{{asset('public/fontend/img/Melon Daiquiri.jpg')}}" class="card-img-top" alt="New Dish">
                    <div class="card-body">
                        <h5 class="card-title">Spicy Pasta</h5>
                        <p class="card-text">Try our delicious Spicy Pasta, made with fresh ingredients!</p>
                        <button class="animated-button">
                            <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                              </path>
                            </svg>
                            <span class="text">Oder now</span>
                            <span class="circle"></span>
                            <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">         </path>
                            </svg>
                          </button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="{{asset('public/fontend/img/seafood soup.jpg')}}" class="card-img-top" alt="New Dish">
                    <div class="card-body">
                        <h5 class="card-title">Grilled Salmon</h5>
                        <p class="card-text">Experience the taste of our grilled salmon, seasoned to perfection!</p>
                        <button class="animated-button">
                            <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                              </path>
                            </svg>
                            <span class="text">Order now</span>
                            <span class="circle"></span>
                            <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">         </path>
                            </svg>
                          </button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="{{asset('public/fontend/img/cheese cake.jpg')}}" class="card-img-top" alt="New Dish">
                    <div class="card-body">
                        <h5 class="card-title">Vegan Burger</h5>
                        <p class="card-text">Our vegan burger is hearty, satisfying, and absolutely delicious!</p>
                        <button class="animated-button">
                            <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                              </path>
                            </svg>
                            <span class="text">Order now</span>
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

        <!-- Bestsellers Section -->
        <h2 class="text-center my-5 title-blog">Best sellers</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="{{asset('public/fontend/img/fried chicken.jpg')}}" class="card-img-top" alt="Bestseller">
                    <div class="card-body">
                        <h5 class="card-title">Fried Chicken</h5>
                        <p class="card-text">Crispy fried chicken, tender inside, bursting with flavorful seasoning</p>
                        <button class="animated-button">
                            <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                              </path>
                            </svg>
                            <span class="text">View details</span>
                            <span class="circle"></span>
                            <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">         </path>
                            </svg>
                          </button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="{{asset('public/fontend/img/spaghetti bolognese.jpg')}}" class="card-img-top" alt="Bestseller">
                    <div class="card-body">
                        <h5 class="card-title">Spaghetty Bolognese</h5>
                        <p class="card-text">Rich, savory Spaghetti Bolognese with a hearty meat sauce and aromatic herbs</p>
                        <button class="animated-button">
                            <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                              </path>
                            </svg>
                            <span class="text">View details</span>
                            <span class="circle"></span>
                            <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">         </path>
                            </svg>
                          </button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="{{asset('public/fontend/img/French steak.jpg')}}" class="card-img-top" alt="Bestseller">
                    <div class="card-body">
                        <h5 class="card-title">Beef Steak</h5>
                        <p class="card-text">Succulent beef steak, cooked to perfection with a rich, tender texture and a mouthwatering char</p>
                        <button class="animated-button">
                            <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                              </path>
                            </svg>
                            <span class="text">View details</span>
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

    </div>
  @endsection