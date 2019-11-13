@extends('admin_layout')
@section('admin_content')
@foreach ($edit_brand_product as $key => $edit_value)
<form role="form" action="{{URL::to('/update-brand-product/'.$edit_value ->brand_id)}}" method="POST">
    {{csrf_field()}}
    <?php
                $message = Session::get('message');
                if($message){
                    echo '<span style="color:red">' .$message. '</span>';
                    Session::put('message',null);
                }
        ?>
        <h3 class="h3 text-primary mt-4 mb-4">Cập nhập thương hiệu sản phẩm</h3>
    <div class="row">
        <div class="col-lg-9 col-md-8">
            <div class="card m-1 border border-primary">
                <div class="card-header p-2 text-primary border-botton border-primary">
                    Nhập thông tin thương hiệu
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên thương hiệu</label>
                        <input type="text" name="brand_product_name" class="form-control" id="exampleInputEmail1"
                        value="{{$edit_value->brand_name}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                        <textarea style="resize: none" rows="4" name="brand_product_desc" class="form-control"
                            id="exampleInputPassword1" placeholder="Mô tả...">{{$edit_value->brand_desc}}</textarea>
                    </div>
                    {{-- Use Jquery to change the brand status by click button, see at backend/demo/add-product.js --}}
                    <input type="number" value="0" name="brand_product_status" id="brand_status" readonly hidden />
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
                        <button type="submit" id="btn-public" class="btn btn-success col-12">Hiển thị</button>
                    </div>
                    <div class="col-12">
                        <button type="submit" id="btn-draft" class="btn btn-secondary col-12 mt-2">Bản nháp</button>
                    </div>
                    <div class="col-12">
                        <a href="{{URL::to('/all-brand-product')}}"><input type="button" class="btn btn-danger col-12 mt-2" value="Hủy"/></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="{{asset('public/backend/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('public/backend/js/custom-js/brand.js')}}"></script>
@endforeach
@endsection