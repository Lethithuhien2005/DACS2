@extends('admin.admin_layout')
@section('style')
  <style>
    th, td {
      text-align:center;
    }
    .message {
      color: #3366cc;
    }
    nav {
      text-align: right;
      margin: 10px 10px 0px 0px;
    }
    .page-link{
      font-size: 13px;
      padding: 4px 10px;
    }
  </style>
@endsection
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      List of Users
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
    <span class="message">
                <?php
                    $message = Session::get('message');
                    if($message) {
                        echo $message;
                    }
                    Session::put('message', null);
                ?>
            </span>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:5%;">Name</th>
            <th style="width:10%;">Account name</th>
            <th style="width:15%;">Date of birth</th>
            <th style="width:5%;">Gender</th>
            <th style="width:45%;">Address</th>
            <th style="width:5%;">Email</th>
            <th style="width:10%;">Phone</th>        
            <th style="width:5%;">Type user</th>  
            <th></th>      
          </tr>
        </thead>
        <tbody>
            @foreach($list_user as $key => $user)
          <tr>
            <td>{{$user->name  }}</td>
            <td>{{ $user->account_name }}</td>
            <td>{{ $user->date_of_birth }}</td>
            <td>{{ $user->gender }}</td>
            <td>{{ $user->address }}</td>
            <td>{{$user->email  }}</td>
            <td>{{$user->phone  }}</td>
            <td>{{ $user->get_type->type_name }}</td>
            <td>
              <a href="{{URL::to('/edit-user/' .$user->user_id)}}" class="active" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                <a onclick="return confirm('Are you sure to DELETE this user?') " href="{{URL::to('/delete-user/'.$user->user_id)}}" class="active" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
          </tr>
            @endforeach
        </tbody>
      </table>
    </div>
    {{$list_user->links()}}
  </div>
</div>
@endsection