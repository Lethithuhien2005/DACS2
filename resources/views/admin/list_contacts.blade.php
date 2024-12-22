@extends('admin.admin_layout')
@section('style')
  <style>
    img {
      width: 100%;
      object-fit: cover !important;
    }
    th, .short-content {
      text-align:center;
    }
    nav {
      text-align: right;
      margin: 10px 10px 0px 0px;
    }
    .page-link{
      font-size: 10px;
      padding: 4px 10px;
    }
  </style>
@endsection
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      List of Contacts
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
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:15%;">Account name</th>
            <th style="width:20%;">Name</th>
            <th style="width:20%;">Email</th>
            <th style="width:10%;">Phone</th>
            <th style="width:35%;">Message</th>
          </tr>
        </thead>
        <tbody>
          @foreach($list_contacts as $key => $contact)
            <tr>
              <td class="short-content">{{ $contact->getUser->account_name }}</td>
              <td class="short-content">{{ $contact->name }}</td>
              <td class="short-content">{{ $contact->email }}</td>
              <td class="short-content">{{ $contact->phone }}</td>
              <td>{{ $contact->message }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    {{$list_contacts->links()}}
  </div>
</div>
@endsection