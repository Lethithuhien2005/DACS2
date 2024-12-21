@extends('admin.admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Update category
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
                                <form role="form" action="{{URL::to('/update_category/'.$category->category_id)}}"  method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">category's name</label>
                                    <input type="text" name="category_name" value="{{ $category->category_name }}" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Decription</label>
                                    <textarea style="resize: none" rows="5" name="category_describe" class="form-control" id="exampleInputPassword1">{{ $category->category_desc }}</textarea>
                                </div>
                                <button type="submit" name="update_category" class="btn btn-info">Update</button>
                                </form>
                            </div>
                        </div>
                    </section>

            </div>
        </div>
@endsection