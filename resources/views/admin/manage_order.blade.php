@extends('admin_layout')
@section('admin_content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Quản lý hóa đơn</h1>
<?php
                $message = Session::get('message');
                if($message){
                    echo '<span style="color:red">' .$message. '</span>';
                    Session::put('message',null);
                }
            ?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header">
        <form action="{{URL::to('/manage-order')}}" , method="GET">
            <h6 class="m-0 font-weight-bold text-left text-primary">Danh sách hóa đơn</h6>
            <div class="row input-group input-group-sm mb-3 col-6">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="select-order-status">Lọc theo: </label>
                </div>
                <select class="custom-select" id="select-order-status" name="order_status">
                    <option selected value="Đang chờ xử lý">Đang chờ xử lý</option>
                    <option value="Xác nhận đơn hàng">Xác nhận đơn hàng</option>
                    <option value="Đang giao hàng">Đang giao hàng</option>
                    <option value="Hủy đơn hàng">Hủy đơn hàng</option>
                    <option value="Xác nhận thanh toán">Xác nhận thanh toán</option>
                    <option value="Xem tất cả">Xem tất cả</option>
                </select>
            </div>
            <button class="btn btn-sm btn-primary submit-choose status" type="submit"> Submit</button>
        </form>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Tên người đặt</th>
                        <th>Ngày đặt</th>
                        <th>Tổng giá tiền</th>
                        <th>Tình trạng</th>
                        <th class="text-center">Chú ý</th>
                        <th class="text-center">Xem -- Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_order as $key => $order)
                    <tr>
                        <td>{{ $order -> customer_name }}</td>
                        <td>{{ $order -> created_at }}</td>
                        <td>{{number_format($order -> order_total, 0) }} VND</td>
                        <td>{{ $order -> order_status }}</td>
                        <td class="text-center">...</td>
                        <td class="text-center">
                            <a href="{{URL::to('/view-order/'.$order->order_id)}}}" class="active" ui-toggle-class="">
                                <i class="fa fa-edit text-success text-active"></i>
                            </a> --
                            <a onclick="return confirm('Bạn có chắn chắc muốn xóa không ?')"
                                href="{{URL::to('/delete-order/'.$order->order_id)}}}" class="active"
                                ui-toggle-class="">
                                <i class="fa fa-times text-danger text"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="{{asset('public/backend/vendor/jquery/jquery.min.js')}}"></script>
<script>
    var order_status = @json($order_status);
    $("#select-order-status").val(order_status);
</script>
@endsection
