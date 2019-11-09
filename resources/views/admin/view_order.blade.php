@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-12 col-sm-10 col-md-10">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-6">
                <div class="card border border-primary mb-3">
                    <div class="card-header p-2 text-primary border-botton border-primary text-center">
                        Thông tin người mua
                    </div>
                    <div class="card-body">
                        <div class="card-form p-2">
                            <div class="row border-bottom">
                                <div class="col-12 col-sm-6 col-md-6 text-danger">
                                    Tên người mua:
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 text-dark">
                                    {{$order_by_id->customer_name}}
                                </div>
                            </div>
                        </div>
                        <div class="card-form p-2">
                            <div class="row border-bottom">
                                <div class="col-12 col-sm-6 col-md-6 text-danger">
                                    Email:
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 text-dark">
                                    {{$order_by_id->customer_email}}
                                </div>
                            </div>
                        </div>
                        <div class="card-form p-2">
                            <div class="row border-bottom">
                                <div class="col-12 col-sm-6 col-md-6 text-danger">
                                    Số điện thoại:
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 text-dark">
                                    {{$order_by_id->customer_phone}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6">
                <div class="card border border-primary mb-3">
                    <div class="card-header p-2 text-primary border-botton border-primary text-center">
                        Thông tin vận chuyển
                    </div>
                    <div class="card-body">
                        <div class="card-form p-2">
                            <div class="row border-bottom">
                                <div class="col-12 col-sm-6 col-md-6 text-danger">
                                    Tên người nhận:
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 text-dark">
                                    {{$order_by_id->shipping_name}}
                                </div>
                            </div>
                        </div>
                        <div class="card-form p-2">
                            <div class="row border-bottom">
                                <div class="col-12 col-sm-6 col-md-6 text-danger">
                                    Địa chỉ giao hàng:
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 text-dark">
                                    {{$order_by_id->shipping_address}}
                                </div>
                            </div>
                        </div>
                        <div class="card-form p-2">
                            <div class="row border-bottom">
                                <div class="col-12 col-sm-6 col-md-6 text-danger">
                                    Số điện thoại giao hàng:
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 text-dark">
                                    {{$order_by_id->shipping_phone}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card p-1 border border-primary">
                    <div class="card-header p-2 text-primary border-botton border-primary text-center">
                        Chi tiết đơn hàng
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="text-center">
                                        <th class="text-primary">Tên sản phẩm</th>
                                        <th class="text-primary">Số lượng</th>
                                        <th class="text-primary">Giá</th>
                                        <th class="text-primary">Chú ý</th>
                                        <th class="text-primary">Tổng tiền</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center content-center">
                                    <tr>
                                        <td>{{$order_by_id->product_name}}</td>
                                        <td>{{$order_by_id->product_sales_quantity}}</td>
                                        <td>{{$order_by_id->product_price}}</td>
                                        <td>...</td>
                                        <td>{{$order_by_id->product_price*$order_by_id->product_sales_quantity}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-2 col-md-2">
        <div class="card p-1 border border-primary">
            <div class="card-header p-2 text-primary border-botton border-primary text-center">
                Hành động
            </div>
            <div class="card-body">
                <div class="col-12">
                    <a href="{{URL::to('/manage-order')}}"><input type="button" class="btn btn-danger col-12 mt-2"
                            value="Hủy" /></a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('public/backend/vendor/jquery/jquery.min.js')}}"></script>
<script>

</script>
@endsection