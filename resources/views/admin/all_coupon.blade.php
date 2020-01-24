@extends('admin_layout')
@section('admin_content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Mã khuyến mãi</h1>
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
        <h6 class="m-0 font-weight-bold text-primary">Danh sách mã khuyến mãi</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th>Mã khyến mãi</th>
                        <th>Chiết khấu</th>
                        <th>Trạng thái</th>
                        <th>Sửa -- Xóa</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($all_coupon as $key => $coupon_pro)
                    <tr>
                        <td>{{ $coupon_pro -> coupon_name }}</td>
                        <td>{{ $coupon_pro -> coupon_amount }}</td>
                        <td>
                            <span class="text-ellipsis">
                                <?php
                                        if($coupon_pro -> coupon_status == 0){
                                    ?>
                                <a href="{{URL::to('/unactive-coupon/'.$coupon_pro ->coupon_id)}}"><span
                                        style="color: brown; font-size: 20px"
                                        class="fa fa-times"></span></a>
                                <?php
                                    }else{
                                    ?>
                                <a href="{{URL::to('/active-coupon/'.$coupon_pro ->coupon_id)}}"><span
                                        style="color: blue; font-size: 20px" class="fa fa-check"></span></a>
                                <?php
                                        }
                                    ?>
                            </span></td>
                        <td style="text-align=center">
                            <a href="{{URL::to('/edit-coupon/'.$coupon_pro->coupon_id)}}}" class="active"
                                ui-toggle-class="">
                                <i class="fa fa-edit text-success text-active"></i>
                            </a> -- 
                            <a onclick="return confirm('Bạn có chắn chắc muốn xóa không ?')"
                                href="{{URL::to('/delete-coupon/'.$coupon_pro->coupon_id)}}}" class="active"
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