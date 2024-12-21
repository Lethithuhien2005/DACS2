@extends('layout')
@section('style')
 <style>
  .form_contact h2 {
    font-family: 'Rancho';
    margin-bottom: 20px;
  }
  .message {
    color: #3366cc;
  }
  </style>
@endsection
@section('content')
  <?php
    $user_id = Session::get('user_id');
    $message = Session::get('message');
  ?>
  <div class="header-content">
            <img src="{{asset('public/fontend/img/background11.jpg')}}" alt="background-header">
            <div class="title-header">
                <h1>Contact</h1>
                <p>We would love to hear from you! contact us anytime</p>
                <p class="header-link"><a href="{{URL::to('/homepage')}}">Home</a><span>></span><a href="{{('/contact')}}">Contact</a></p>
            </div>
        </div>
      
        <div class="infor mt-5 mb-5">
        <div class="container">
          <div class="form_contact">
            <h2><center>Contact</center></h2>
            <?php if($message) ?>
            <span class="message">
                <?php
                  echo $message;
                  Session::put('message', null);
                ?>
            </span>
            <form action="{{URL::to('/send-contact')}}" method="POST">
              {{ csrf_field() }}
              <div class="row">
                <div>
                  <input name="user_id" type="hidden" value="{{ $user_id }}"/>
                </div>
                <div class="col-lg-6 col-md-6">
                  <div class="form_group">
                    <label for="">Your Name</label>
                    <div class="txt">
                      <input name="name" type="text" required="" placeholder="Your name" value="{{ old('name', session('contact_data.name')) }}"/>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6">
                  <div class="form_group">
                    <label for="">Your Email</label>
                    <div class="txt">
                      <input name="email" type="text" required="" placeholder="Email" value="{{ old('email', session('contact_data.email')) }}" />
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form_group">
                    <label for="">Your Number</label>
                    <div class="txt">
                      <input name="phone" type="text" required="" placeholder="Number" value="{{ old('phone', session('contact_data.phone')) }}"/>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form_group">
                    <label for="">Your Message</label>
                    <div class="txt">
                      <textarea
                        name="message" id="" cols="30" rows="2" required="" placeholder="Message">{{ old('message', session('contact_data.message')) }}</textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="btn_contact text-center">
              <button name="submit" type="submit">Send</button>
            </div>
            </form>
            <?php
              if (session::has('contact_data')) {
                session::forget('contact_data');
              }
            ?>
          </div>
        </div>
      </div>
      <div class="col-12">
        <div id="contact_map" class="map">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3833.1821516426455!2d108.2506521!3d15.9752603!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142108997dc971f%3A0x1295cb3d313469c9!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2jhu4cgVGjDtG5nIHRpbiB2w6AgVHJ1eeG7gW4gdGjDtG5nIFZp4buHdCAtIEjDoG4sIMSQ4bqhaSBo4buNYyDEkMOgIE7hurVuZw!5e0!3m2!1svi!2s!4v1727932600330!5m2!1svi!2s"
            width="600"
            height="450"
            style="border: 0"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
          ></iframe>
        </div>
      </div>
@endsection