@extends('layout_update')
@section('content_update')
<section id="cart_items">
    <div class="container">
    </div>
    <div class="review-payment">
        <h2>Cảm ơn bạn đã mua hàng! Chúng tôi sẽ liên lạc với bạn sớm nhất.</h2>
    </div>
    <div style="display:flex">
        <a href="{{URL::to('/order-place')}}"><button  style="display:block" class="btn btn-warning">
            Tiếp tục mua sắm
        </button></a>
        <a style="margin: 0 0 0 15px" href="{{URL::to('/order-place')}}"><button  style="display:block" class="btn btn-success">
            Xem đơn hàng    
        </button></a>
    </div>
    @endsection