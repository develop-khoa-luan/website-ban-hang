@extends('layout_update') 
@section('content_update')
<section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{URL::to('/')}}">Home</a></li>
                    <li class="active">Thanh toán</li>
                </ol>
            </div><!--/breadcrums-->
    
            <div class="shopper-informations">
                <div class="row">
                    
                    <div class="col-sm-12 clearfix" style="margin: -50px 0 0 0">
                        <div class="bill-to">
                            <p style="font-weight:bold">Điền thông tin giao hàng</p>
                            <div class="form-one">
                                <form action="{{URL::to('/save-checkout-customer')}}" method="POST">
                                    {{ csrf_field()}}
                                    <input type="text" name="shipping_email" required="required" placeholder="Email*">
                                    <input type="text" name="shipping_name" required="required" placeholder="Họ tên *">
                                    <input type="text" name="shipping_address" required="required" placeholder="Địa chỉ *">
                                    <input type="text" name="shipping_phone" required="required" placeholder="Số điện thoại">
                                    <textarea name="shipping_notes"  required="required" placeholder="Ghi chú đơn hàng" rows="5"></textarea>
                                    <input type="submit" value="Gửi" name="send_order" class="btn btn-primary">
                                </form>
                            </div>
                        </div>
                    </div>
                                   
                </div>
            </div>
        
        </div>
    </section>

@endsection