@extends('layout')
@section('link')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
@endsection
@section('content')
    <div class="header-content">
            <img src="{{asset('public/fontend/img/background11.jpg')}}" alt="background-header">
            <div class="title-header">
                <h1>About us</h1>
                <p>We’re always ready to hear your thoughts and concerns</p>
                <p class="header-link"><a href="{{URL::to('/homepage')}}">Home</a><span>></span><a href="{{URL::to('/aboutus')}}">About us</a></p>
            </div>
    </div>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
      integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
      integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <div class="about">
      <div class="container">
        <div class="row">
          <div class="col-lg-7">
            <div class="about_img">
              <div class="img_1" data-aos="fade-right" data-aos-easing="ease-in-out" data-aos-duration="1000">
                <img
                  id="anh1"
                  src="{{asset('public/fontend/img/about-2.png')}}"
                  alt=""
                />
              </div>
              <script>
                const image = document.getElementById("anh1");
                let position = 0; // Vị trí hiện tại
                let direction = 0.3; // Hướng di chuyển (1 = sang phải, -1 = sang trái)
                const range = 100; // Phạm vi di chuyển (trong pixel)

                function moveImage() {
                  position += direction; // Thay đổi vị trí
                  image.style.transform = `translateX(${position}px)`; // Áp dụng vị trí mới

                  // Kiểm tra để thay đổi hướng khi đến giới hạn
                  if (position >= range || position <= -range) {
                    direction *= -1; // Đổi hướng
                  }

                  requestAnimationFrame(moveImage); // Gọi lại hàm để tiếp tục di chuyển
                }

                moveImage();
              </script>
              <div class="img_2" data-aos="fade-right" data-aos-easing="ease-in-out" data-aos-duration="1000">
                <img
                  src="{{asset('public/fontend/img/about-3.png')}}"
                  alt=""
                />
              </div>
            </div>
          </div>
          <div class="col-lg-5" data-aos="fade-left" data-aos-easing="ease-in-out" data-aos-duration="1000">
            <div class="destination">
              <div class="des_title">
                <span
                  style="
                    font-family: 'Rancho';
                    color: #efef26;
                    font-size: 50px;
                    font-weight: 500;
                  "
                  >About restaurant</span
                >
                <h3
                  style="
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                    font-size: 20px;
                    font-weight: 500;
                  "
                >
                  Health and safety, along with quality, are the cornerstones of
                  our brand
                </h3>
                <p
                  style="
                    text-align: justify;
                    font-size: 18px;
                  "
                >
                  Welcome to Savory, where culinary passion meets
                  exceptional service. Nestled in the heart of Da Nang, we
                  offer a diverse menu inspired by both local flavors and
                  international cuisine. Our talented chefs use only the
                  freshest ingredients to create dishes that delight the senses.
                </p>
                <table class="list">
                  <tr>
                    <td>
                      <li>
                      <i class="fa-solid fa-paper-plane icon-plane"></i>
                        Food Items management
                      </li>
                    </td>
                    <td>
                      <li>
                      <i class="fa-solid fa-paper-plane icon-plane"></i>
                      Table reservation
                      </li>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <li>
                      <i class="fa-solid fa-paper-plane icon-plane"></i>
                      Customer feedback portal
                      </li>
                    </td>
                    <td>
                      <li>
                      <i class="fa-solid fa-paper-plane icon-plane"></i>
                      Location-based services
                      </li>
                    </td>
                  </tr>
                </table>
                <div class="btn-detail">
                  <a href="">SEE DETAILS</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="choose-us">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 choose-content" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="800">
            <div class="choose_title mb-4">
              <span
                style="
                  font-family: 'Rancho';
                  color: #000;
                  font-size: 40px;
                  font-weight: 300;
                "
                >Why choose us</span
              >
              <h3
                style="
                  font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial,
                    sans-serif;
                  font-weight: 600;
                "
              >
                Let's discover food with us
              </h3>
            </div>
            <p>
              Our restaurant offers a unique dining experience with a cozy
              atmosphere, delicious dishes made from fresh ingredients, and
              friendly service. Join us for unforgettable meals!
            </p>
            <div class="btn-detail">
              <a href="{{URL::to('/menu')}}">SEE DETAILS</a>
            </div>
          </div>
          <div class="col-lg-8" >
            <div class="row">
              <div class="col-lg-4" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="800" data-aos-delay="100">
                <div class="box-content">
                  <img   src="{{asset('public/fontend/img/food.png')}}" alt="" />
                  <span><b>Presentation</b></span>
                  <p></p>
                  <p>
                    Food presentation enhances the dining experience, showcasing
                    colors and textures that excite the senses and elevate each
                    dish's appeal.
                  </p>
                </div>
              </div>
              <div class="col-lg-4" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="800" data-aos-delay="200">
                <div class="box-content">
                  <img  src="{{asset('public/fontend/img/flavoring.png')}}" alt="" />
                  <span><b>Flavor </b></span>
                  <p></p>
                  <p>
                    "Flavor pairing combines complementary tastes, creating
                    balanced dishes that delight the palate and enhance the
                    overall dining experience."
                  </p>
                </div>
              </div>
              <div class="col-lg-4" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="800" data-aos-delay="200">
                <div class="box-content">
                  <img   src="{{asset('public/fontend/img/kitchen.png')}}" alt="" />
                  <span><b>Technique</b></span>
                  <p></p>
                  <p>
                    Culinary techniques showcase a chef's skill, transforming
                    ingredients through methods like grilling, sautéing, and
                    sous-vide for exceptional flavors.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
    AOS.init();
</script>
@endsection