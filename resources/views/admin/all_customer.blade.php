@extends('admin_layout')
@section('admin_content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Quản lý thông tin khách hàng</h1>
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
        <h6 class="m-0 font-weight-bold text-primary">Danh sách khách hàng</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th>ID khách hàng</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        {{-- <th>tong tien</th> --}}
                        <th>Xem chi tiết</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($all_customer as $key => $customer_pro)
                    <tr>
                        <td>{{ $customer_pro -> customer_id }}</td>
                        <td>{{ $customer_pro -> customer_name }}</td>
                        <td>{{ $customer_pro -> customer_email }}</td>
                        {{-- @foreach ($sum_order as $key => $sum_pro)
                        <td>{{ $sum_pro -> order_total }}</td>
                        @endforeach --}}
                        <td style="text-align=center">
                            <a href="{{URL::to('/view-customer/'.$customer_pro->customer_id)}}}" class="active"
                                ui-toggle-class="">
                                <i class="fa fa-edit text-success text-active"></i>
                            </a> 
                            {{-- <a onclick="return confirm('Bạn có chắn chắc muốn xóa không ?')"
                                href="{{URL::to('/delete-customer/'.$customer_pro->customer_id)}}}" class="active"
                                ui-toggle-class="">
                                <i class="fa fa-times text-danger text"></i>
                            </a> --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection