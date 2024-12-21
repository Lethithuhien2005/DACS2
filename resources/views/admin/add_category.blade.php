@extends('admin.admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Category
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
                                <form role="form" action="{{URL::to('/add_category_pr')}}"  method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Category's name</label>
                                    <input type="text" name="category_name"class="form-control" id="exampleInputEmail1" placeholder="Category's name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Decription</label>
                                    <textarea style="resize: none" rows="5" name="category_describe" class="form-control" id="exampleInputPassword1" placeholder="Descibing category"></textarea>
                                </div>
                                <button type="submit" name="add_category" class="btn btn-info">Add</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
        </div>
@endsection