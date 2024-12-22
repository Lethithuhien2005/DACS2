@extends('layout')
@section('link')
    <!-- Date -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/default.css">
@endsection
@section('content')
        <?php
            $message = Session::get('message_reservation');
            $user_id = Session::get('user_id');
        ?>
        @if($message)
              <script>
                alert("{{ $message }}");
              </script>
              <?php
                $message = Session::put('message_reservation', null);
              ?>
          @endif
        <div class="header-content">
            <img src="https://i.pinimg.com/564x/58/24/19/582419057d4c33f61ee59e084f46f047.jpg" alt="background-header">
            <div class="title-header">
                <h1>Reservation</h1>
                <p>Make your reservation and savor our culinary delights</p>
                <p class="header-link"><a href="../index.php?action=homepage">Home</a><span>></span><a href="../index.php?action=reservation">Reservation</a></p>
            </div>
        </div>
      <div class="reservation-container">
        <div class="title">
          <h3>Reservation form</h3>
        </div>
        <div class="reservation-form">
          <p>We willing to help you make the reservation online to save your time and money or if you want to reservate table for greater than 12 people, you can call us directly through the customer service hotline: <span class="hotline">0123456789</span></p>
          <form action="{{URL::to('/book-table')}}" method = "post">
            {{ csrf_field() }}
            <div class="row form-content">
              <input type="hidden" name="user_id" value="{{ $user_id }}">
              <div class="col-sm-6">
                <i class="fa-solid fa-user"></i>
                <input class="form-tag" type="text" placeholder="Your name" name="name" required="" value="{{ old('name', session('reservation_data.name')) }}">
              </div>
              <div class="col-sm-6">
                <i class="fa-solid fa-envelope"></i>
                <input class="form-tag" type="text" placeholder="Email" name="email" required="" value="{{ old('email', session('reservation_data.email')) }}">
              </div>
            </div>
            <div class="row form-content">
              <div class="col-sm-6">
                <i class="fa-solid fa-phone"></i>
                <input class="form-tag" type="text" placeholder="Phone" name="phone" required="" value="{{ old('phone', session('reservation_data.phone')) }}">
              </div>
              <div class="col-sm-6">
                <i class="fa-solid fa-user-group"></i>
                <select type="text" class="form-tag" name="number_of_people" value="{{ old('number_of_people', session('reservation_data.number_of_people')) }}">
                  <option>1 Person</option>
                  <option>2 People</option>
                  <option>3 People</option>
                  <option>4 People</option>
                  <option>5 People</option>
                  <option>6 People</option>
                  <option>7 People</option>
                  <option>8 People</option>
                  <option>9 People</option>
                  <option>10 People</option>
                  <option>11 People</option>
                  <option>12 People</option>
                </select>
              </div>
            </div>
            <div class="row form-content">
              <div class="col-sm-6">
                <i class="fa-solid fa-calendar-days"></i>
                <input id="date" class="form-tag" type="date" placeholder="Date" name="book_date" required="" value="{{ old('res_date', session('reservation_data.book_date')) }}">
              </div>
              <div class="col-sm-6">
                <i class="fa-solid fa-clock"></i>
                <select type="text" class="form-tag" name = "book_time" value="{{ old('res_time', session('reservation_data.book_time')) }}">
                  <option>7:00</option>
                  <option>8:00</option>
                  <option>9:00</option>
                  <option>10:00</option>
                  <option>11:00</option>
                  <option>12:00</option>
                  <option>13:00</option>
                  <option>14:00</option>
                  <option>15:00</option>
                  <option>16:00</option>
                  <option>17:00</option>
                  <option>18:00</option>
                  <option>19:00</option>
                  <option>20:00</option>
                  <option>21:00</option>
                  <option>22:00</option>
                  <option>23:00</option>
                </select>
              </div>
            </div>
            <div class="row form-content">
             <textarea name="" id="" placeholder="Your note" name="note" value="{{ old('note', session('reservation_data.note')) }}"></textarea>
            </div>
            <input type="hidden" name="reservation_status" value="not yet arrived">
            <div class="row form-button">
              <button class="button" name="book_table" type="submit">Book table <i class="fa-solid fa-paper-plane"></i></button>
            </div>
          </form>
        </div>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
      flatpickr("#date", {
        dateFormat: "Y-m-d",
      });
    </script>
@endsection

