@extends('admin.admin_layout')
@section('admin_content')
@section('style')
<style>
.search-form {
  display: flex;
  justify-content: center;
  align-items: center;
}
.input-group {
  margin-right: 50px;
}
</style>
@endsection
<div class="table-agile-info">
  <div class="panel panel-default">
    @if(!isset($find_categories))
      <div class="panel-heading">
        List of categories
      </div>
    @else
        <div class="panel-heading">
        Search results
        </div>
    @endif
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <form action="{{URL::to('/search-category')}}" method="post" class="search-form">
            {{ csrf_field() }}
            <input type="text" name="search_category" class="input-sm form-control" placeholder="Search">
            <span class="input-group-btn">
              <button class="btn btn-sm btn-default" name="search" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </span>
          </form>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <?php
        $message = Session::get('message');
        if($message) {
          echo $message;
        } 
        Session::put('message', null);
      ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th style="width:150px;">Category's name</th>
            <th>Description</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        @if(!isset($find_categories))
          <tbody>
              @foreach($list_category as $key => $category)
            <tr>
              <td><label class="i-checks m-b-none"><input type="checkbox" name=""><i></i></label></td>
              <td>{{ $category->category_name }}</td>
              <td>{{ $category->category_desc }}</td>
              <td>
                <a href="{{URL::to('/edit_category/'.$category->category_id)}}" class="active" ui-toggle-class="">
                  <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                <a onclick="return confirm('Are you sure to delete this category?') " href="{{URL::to('/delete_category/'.$category->category_id)}}" class="active" ui-toggle-class="">
                  <i class="fa fa-times text-danger text"></i>
                </a>
              </td>
            </tr>
              @endforeach
          </tbody>
        @else
          <tbody>
                @foreach($find_categories as $key => $find_category)
              <tr>
                <td><label class="i-checks m-b-none"><input type="checkbox" name=""><i></i></label></td>
                <td>{{ $find_category->category_name }}</td>
                <td>{{ $find_category->category_desc }}</td>
                <td>
                  <a href="{{URL::to('/edit_category/'.$find_category->category_id)}}" class="active" ui-toggle-class="">
                    <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                  <a onclick="return confirm('Are you sure to delete this category?') " href="{{URL::to('/delete_category/'.$find_category->category_id)}}" class="active" ui-toggle-class="">
                    <i class="fa fa-times text-danger text"></i>
                  </a>
                </td>
              </tr>
                @endforeach
            </tbody>
          @endif
      </table>
    </div>
  </div>
</div>
@endsection