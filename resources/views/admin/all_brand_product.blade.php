@extends('admin_layout')
@section('admin_content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Thương hiệu</h1>
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
        <h6 class="m-0 font-weight-bold text-primary">Danh sách thương hiệu</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th>Tên thương hiệu</th>
                        <th>Hiển thị</th>
                        <th>Sửa -- Xóa</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($all_brand_product as $key => $brand_pro)
                    <tr>
                        <td>{{ $brand_pro -> brand_name }}</td>
                        <td>
                            <span class="text-ellipsis">
                                <?php
                                        if($brand_pro -> brand_status == 0){
                                ?>
                                <a href="{{URL::to('/unactive-brand-product/'.$brand_pro ->brand_id)}}"><span
                                        style="color: brown; font-size: 20px"
                                        class="fa fa-angle-double-down"></span></a>
                                <?php
                                    }else{
                                    ?>
                                <a href="{{URL::to('/active-brand-product/'.$brand_pro ->brand_id)}}"><span
                                        style="color: blue; font-size: 20px" class="fa fa-angle-double-up"></span></a>
                                <?php
                                        }
                                    ?>
                            </span></td>
                        <td align="center">
                            <a href="{{URL::to('/edit-brand-product/'.$brand_pro->brand_id)}}}" class="active"
                                ui-toggle-class="">
                                <i class="fa fa-edit text-success text-active"></i>
                            </a> -- 
                            <a onclick="return confirm('Bạn có chắn chắc muốn xóa không ?')"
                                href="{{URL::to('/delete-brand-product/'.$brand_pro->brand_id)}}}" class="active"
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