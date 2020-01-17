@extends('admin_layout')
@section('admin_content')
<?php
                $message = Session::get('message');
                if($message){
                    echo '<span style="color:red">' .$message. '</span>';
                    Session::put('message',null);
                }
            ?>
<div class="row">
    <div class="col-12 " >
        <div class="row">
            
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
                                    {{$order_by_id_customer->shipping_name}}
                                </div>
                            </div>
                        </div>
                        <div class="card-form p-2">
                            <div class="row border-bottom">
                                <div class="col-12 col-sm-6 col-md-6 text-danger">
                                    Địa chỉ giao hàng:
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 text-dark">
                                    {{$order_by_id_customer->shipping_address}}
                                </div>
                            </div>
                        </div>
                        <div class="card-form p-2">
                            <div class="row border-bottom">
                                <div class="col-12 col-sm-6 col-md-6 text-danger">
                                    Số điện thoại giao hàng:
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 text-dark">
                                    {{$order_by_id_customer->shipping_phone}}
                                </div>
                            </div>
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
                                <th class="text-primary">Size:</th>
                                <th class="text-primary">Giá</th>
                                <th class="text-primary">Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody class="text-center content-center">
                            @foreach ($all_order_detail_view_customer as $item_cus)
                            
                            <tr>
                                <td>{{$item_cus->product_name}}</td>
                                <td>{{ number_format($item_cus->product_sales_quantity, 0) }}</td>
                                <td>{{$item_cus->product_size}}</td>
                                <td>{{ number_format($item_cus->product_price, 0) }}</td>
                                <td>{{ number_format($item_cus->product_price*$item_cus->product_sales_quantity, 0) }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="text-center">
                                <td class="text-danger"></td>
                                <td class="text-danger">{{number_format($count_quantity_view_customer, 0)}}</td>
                                <td class="text-danger"></td>
                                <td class="text-danger"></td>
                                <td class="text-danger">{{number_format($order_by_id_customer->order_total, 0)}}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('public/backend/vendor/jquery/jquery.min.js')}}"></script>
<script>

</script>
@endsection