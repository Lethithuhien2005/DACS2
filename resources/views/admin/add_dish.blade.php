@extends('admin.admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Dish
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
                                <form role="form" action="{{URL::to('/add_dish')}}"  method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Dish's name</label>
                                    <input type="text" name="dish_name"class="form-control" id="exampleInputEmail1" placeholder="dish's name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Dish's Price</label>
                                    <input type="text" name="dish_price"class="form-control" id="exampleInputEmail1" placeholder="dish's price">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Dish's Image</label>
                                    <input type="file" name="dish_img"class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Dish's Decription</label>
                                    <textarea style="resize: none" rows="5" name="dish_describe" class="form-control" id="exampleInputPassword1" placeholder="Descibing dish if needed"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Date added</label>
                                    <input type="date" name="dish_dateAdded"class="form-control" id="exampleInputEmail1" placeholder="dd/mm/yyyy">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Menu Category</label>
                                    <select name="category_dish" class="form-control input-sm m-bot15">
                                        @foreach($category_dish as $key => $category) 
                                            <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Dish's Status</label>
                                    <select name="dish_status" class="form-control input-sm m-bot15">
                                        <option value="still available">Still Available</option>
                                        <option value="sold out">Sold Out</option>
                                    </select>
                                </div>
                                <button type="submit" name="add_dish" class="btn btn-info">Add</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
        </div>
@endsection