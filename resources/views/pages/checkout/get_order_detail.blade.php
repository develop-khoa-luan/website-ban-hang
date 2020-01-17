@extends('layout_update')
@section('content_update')
<section id="cart_items">

<div class="row">
    <div class="col-12 col-sm-12 col-md-12">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-6">
                <div class="card border border-primary mb-3">
                    <div style="align:center" class="card-header p-2 text-primary border-botton border-primary text-center">
                        <b>THÔNG TIN ĐƠN HÀNG</b>
                    </div>
                    <div class="card-body">
                        <div class="card-form p-2">
                            <div class="row border-bottom">
                                <div class="col-12 col-sm-6 col-md-6 text-danger">
                                    Tên khách hàng:
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 text-dark">
                                    {{$get_order_detail->customer_name}}
                                </div>
                            </div>
                        </div>
                        <div class="card-form p-2">
                            <div class="row border-bottom">
                                <div class="col-12 col-sm-6 col-md-6 text-danger">
                                    Email:
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 text-dark">
                                    {{$get_order_detail->customer_email}}
                                </div>
                            </div>
                        </div>
                        <div class="card-form p-2">
                            <div class="row border-bottom">
                                <div class="col-12 col-sm-6 col-md-6 text-danger">
                                    Số điện thoại:
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 text-dark">
                                    {{$get_order_detail->customer_phone}}
                                </div>
                            </div>
                        </div>
                        <div class="card-form p-2">
                            <div class="row border-bottom">
                                <div class="col-12 col-sm-6 col-md-6 text-danger">
                                    Thời gian đặt hàng:
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 text-dark">
                                    {{$get_order_detail->created_at}}
                                </div>
                            </div>
                        </div>
                        <div class="card-form p-2">
                            <div class="row border-bottom">
                                <div class="col-12 col-sm-6 col-md-6 text-danger">
                                    Trạng thái đơn hàng:
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 text-dark">
                                    {{$get_order_detail->order_status}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         
        </div>
    </div>
</div>
</section>
@endsection