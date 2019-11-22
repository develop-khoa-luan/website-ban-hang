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
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách hóa đơn</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Tên người đặt</th>
                        <th>Ngày đặt</th>
                        <th>Tổng giá tiền</th>
                        <th>tình trạng</th>
                        <th>Chú ý</th>
                        <th class="text-center">Xem -- Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_order as $key => $order)
                    <tr>
                        <td>{{ $order -> customer_name }}</td>
                        <td>{{ $order -> created_at }}</td>
                        <td>{{ $order -> order_total }}</td>
                        <td>{{ $order -> order_status }}</td>
                        <td>...</td>
                        <td >
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
@endsection