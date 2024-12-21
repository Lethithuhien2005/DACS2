
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
     <!-- Font awesome -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />

     <!-- jQuery và Owl Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.green.min.css" integrity="sha512-C8Movfk6DU/H5PzarG0+Dv9MA9IZzvmQpO/3cIlGIflmtY3vIud07myMu4M/NTPJl8jmZtt/4mC9bAioMZBBdA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Font-family -->
    <link href="https://fonts.googleapis.com/css2?family=Rancho&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/fontend/css/index.css')}}">
    <link rel="stylesheet" href="{{asset('public/fontend/css/menu.css')}}">
    <link rel="stylesheet" href="{{asset('public/fontend/css/aboutus.css')}}">
    <link rel="stylesheet" href="{{asset('public/fontend/css/reservation.css')}}">
    <link rel="stylesheet" href="{{asset('public/fontend/css/contact.css')}}">
    @yield('link')
    <title>Home</title>
    @yield('style')
</head>
<body>
  <?php
    $user_id = Session::get('user_id');
  ?>
  <header>
    <nav class="navbar navbar-expand-md justify-content-end navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{URL::to('/homepage')}}">Savory<i class="fa-solid fa-seedling"></i></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ms-auto">
                  <li class="nav-item">
                    <a class="nav-link" href="{{URL::to('/homepage')}}">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{URL::to('/menu')}}">Menu</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{URL::to('/reservation')}}">Reservation</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Other</a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{URL::to('/aboutus')}}">About us</a></li>
                      <li><a class="dropdown-item" href="{{URL::to('/blog')}}">Blog</a></li>
                      <li><a class="dropdown-item" href="{{URL::to('/contact')}}">Contact</a></li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{URL::to('/show-cart')}}"><i class="fa-solid fa-cart-shopping"></i></a>
                  </li>
                  <form class="d-flex search-container">
                    <input class="form-control me-2" type="text" placeholder="Search">
                    <div class="btn">
                      <i class="fa fa-search"></i>
                    </div>
                </form>
                    <!-- Set up navbar for user -->
                <?php if(isset($_COOKIE['remember_token']) || Session::has('account_name')):  ?>
                  <li class="nav-item dropdown account">
                      <a data-toggle="dropdown" class="dropdown-toggle account-name" href="#">
                      <span>
                          <?php
                              $account = Session::get('account_name');
                              if($account) {
                                echo $account;
                              }
                            ?>
                      </span>
                      </a>
                      <ul class="dropdown-menu extended logout">
                          <li><a href="{{URL::to('/profile/'.$user_id)}}" class="option1"><i class=" fa fa-suitcase"></i> Profile</a></li>
                          <li><a href="{{URL::to('/logout')}}" class="option1"><i class="fa fa-key"></i> Log Out</a></li>
                      </ul>
                    </li>
                  <?php else: ?>
                    <form  action="login.php" method="POST">
                      <button class="button-login" type="button" onclick="window.location.href='{{URL::to('/login')}}'">
                        Log in
                      </button>
                  </form>
                <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
  </header>
      @yield('content')            
  <footer>
    <div class="container">
      <div class="row ">
        <div class="col-lg-3 content_col">
          <div class="footer_content">
            <h4>About Restaurant</h4>
            <p>A cozy restaurant serving delicious, homemade dishes with friendly service.
            </p>
            <ul class="social">
              <li>
                <a href="https://daotao.vku.udn.vn/sv">
                  <i class="fa-brands fa-facebook"></i>
                </a>
          
              </li>
              <li>
                <a href="https://daotao.vku.udn.vn/sv">
                  <i class="fa-brands fa-twitter"></i>
                </a>
          
              </li>
              <li>
                <a href="https://daotao.vku.udn.vn/sv">
                  <i class="fa-brands fa-linkedin"></i>
                </a>
          
              </li>
              <li>
                <a href="https://daotao.vku.udn.vn/sv">
                  <i class="fa-brands fa-instagram"></i>
                </a>
          
              </li>
            </ul>
          </div>
        </div>
        <div class="col-lg-3 content_col">
          <div class="footer_content">
            <h4>Our Menus</h4>
            <ul>
              <li>
                <a href="{{URL::to('/menu')}}">Appetizers</a>
              </li>
              <li>
                <a href="{{URL::to('/menu')}}">Main course</a>
              </li>
              <li>
                <a href="{{URL::to('/menu')}}">Dessert</a>
              </li>
              <li>
                <a href="{{URL::to('/menu')}}">Drink</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-lg-3 content_col">
          <div class="footer_content">
            <h4>Recent Posts</h4>
            <div class="footer_post">
              <div class="img">
                <a href="{{URL::to('/blog')}}">
                  <img src="{{asset('public/fontend/img/food-1.png')}}" alt="">
                </a>
              </div>
              <div class="footer_post_title">
                <a href="{{URL::to('/blog')}}">New Restaurant Town Our Ple Award</a>
                <div class="calendar" onclick="location.href='{{URL::to('/blog')}}'">
                  <i class="fa-regular fa-calendar-days"></i>
                  <p>13/10/2024</p>
                </div>
              </div>
            </div>
            <div class="footer_post">
              <div class="img">
                <a href="{{URL::to('/blog')}}">
                  <img src="{{asset('public/fontend/img/food-2.png')}}" alt="">
                </a>
              </div>
              <div class="footer_post_title">
                <a href="{{URL::to('/blog')}}">New Restaurant Town Our Ple Award</a>
                <div class="calendar" onclick="location.href='{{URL::to('/blog')}}'">
                  <i class="fa-regular fa-calendar-days"></i>
                  <p>20/10/2024</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 content_col">
          <div class="footer_content">
            <h4>Contact Now</h4>
            <ul class="footer_contact">
              <li>
                <div>
                <i class="fa-solid fa-location-dot"></i>
                </div>
                <p>470 VKU, Da Nang</p>
              </li>
              <li>
                <div>
                <i class="fa-solid fa-phone-volume"></i>
                </div>
                <p>0123456789</p>
              </li>
              <li>
                <div>
                <i class="fa-regular fa-envelope"></i>
                </div>
                <p>savory470@gmail.com</p>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
   </footer>
  <script src="{{asset('public/fontend/js/index.js')}}"></script>
  <script src="{{asset('public/fontend/js/menu.js')}}"></script>   
  <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script> -->
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
</body>
</html>
