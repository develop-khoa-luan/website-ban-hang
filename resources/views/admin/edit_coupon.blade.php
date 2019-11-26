@extends('admin_layout')
@section('admin_content')
@foreach ($edit_coupon as $key => $edit_coupon)
<form role="form" action="{{URL::to('/update-coupon/'.$edit_coupon ->coupon_id)}}" method="POST">
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
                        <input type="text" name="coupon_name" class="form-control" id="exampleInputEmail1"
                        value="{{$edit_coupon->coupon_name}}">
                    </div>
                    

                    <div class="form-group">
                        <label for="exampleInputPassword1">Phần trăm chiết khấu</label>
                        <input type="text" name="coupon_amount" class="form-control" id="exampleInputEmail1"
                            placeholder="Phần trăm chiết khấu..." value="{{$edit_coupon->coupon_amount}}">
                    </div>

                    {{-- Use Jquery to change the coupon status by click button, see at backend/demo/add-product.js --}}
                    <input type="number" value="0" name="coupon_status" id="coupon_status" readonly hidden />
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
                        <a href="{{URL::to('/all-coupon')}}"><input type="button" class="btn btn-danger col-12 mt-2" value="Hủy"/></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="{{asset('public/backend/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('public/backend/js/custom-js/coupon.js')}}"></script>
@endforeach
@endsection