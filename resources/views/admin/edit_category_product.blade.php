@extends('admin_layout')
@section('admin_content')
<?php
                $message = Session::get('message');
                if($message){
                    echo '<span style="color:red">' .$message. '</span>';
                    Session::put('message',null);
                }
                ?>
<h3 class="h3 text-primary mt-4 mb-4">Cập nhập danh mục sản phẩm</h3>
@foreach ($edit_category_product as $key => $edit_value)
<form role="form" action="{{URL::to('/update-category-product/'.$edit_value ->category_id)}}" method="POST">
    {{csrf_field()}}
    <div class="row">
        <div class="col-lg-9 col-md-8">
            <div class="card m-1 border border-primary">
                <div class="card-header p-2 text-primary border-botton border-primary">
                    Nhập thông tin danh mục
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên danh mục</label>
                        <input type="text" name="category_product_name" class="form-control" id="exampleInputEmail1"
                            value="{{$edit_value->category_name}}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mô tả danh mục</label>
                        <textarea style="resize: none" rows="4" name="category_product_desc" class="form-control"
                            id="exampleInputPassword1" required>{{$edit_value->category_desc}}</textarea>
                    </div>
                    {{-- Use Jquery to change the category status by click button, see at backend/demo/add-product.js --}}
                    <input type="number" value="0" name="category_product_status" id="category_status" readonly hidden />
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4">
            <div class="card m-1 border border-primary">
                <div class="card-header p-2 text-primary border-botton border-primary">
                    Hành động
                </div>
                <div class="card-body">
                    <div class="col-12">
                        <button type="submit" id="btn-public" class="btn btn-success col-12">Cập nhật</button>
                    </div>

                    <div class="col-12">
                        <a href="{{URL::to('/all-category-product')}}"><input type="button"
                                class="btn btn-danger col-12 mt-2" value="Hủy" /></a>
                    </div>
                </div>
            </div>
        </div>
</form>
@endforeach
</div>
<script src="{{asset('public/backend/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('public/backend/js/custom-js/category.js')}}"></script>
@endsection