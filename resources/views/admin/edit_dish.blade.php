@extends('admin.admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Update Dish
                        </header>
                        <?php
                            $message = Session::get('message');
                            if($message) {
                                echo $message;
                            }
                            Session::put('message', null);
                        ?>
                        
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update_dish/'.$edit_dish->dish_id)}}"  method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Dish's name</label>
                                    <input type="text" name="dish_name" value="{{ $edit_dish->dish_name }}" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Dish's price</label>
                                    <input type="text" name="dish_price" value="{{ $edit_dish->dish_price}}" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Dish's image</label>
                                    <input type="file" name="dish_img"class="form-control" id="exampleInputEmail1">
                                    <img src="{{asset('public/upload/dishes/'.$edit_dish->dish_img)}}" height="100" width="100" alt="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Decription</label>
                                    <textarea style="resize: none" rows="5" name="dish_desc" class="form-control" id="exampleInputPassword1">{{ $edit_dish->dish_desc }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Category</label>
                                    <select name="category_pr" class="form-control input-sm m-bot15">
                                    @foreach($category_dish as $key => $category_value)
                                        @if($category_value->category_id == $edit_dish->category_id)
                                            <option selected value="{{ $category_value->category_id}}">{{ $category_value->category_name }}</option>
                                        @else 
                                        <option value="{{ $category_value->category_id}}">{{ $category_value->category_name }}</option>
                                        @endif
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Dish's status</label>
                                    <select name="dish_status" class="form-control input-sm m-bot15">
                                        <option value="0">Sold out</option>
                                        <option value="1">Still available</option>
                                    </select>
                                </div>
                                <button type="submit" name="update_dish" class="btn btn-info">Update</button>
                                </form>
                            </div>
                        </div>
                    </section>

            </div>
        </div>
@endsection