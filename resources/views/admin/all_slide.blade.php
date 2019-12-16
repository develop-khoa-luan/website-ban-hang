@extends('admin_layout')
@section('admin_content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Quản lý ảnh bìa</h1>
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
        <h6 class="m-0 font-weight-bold text-primary">Danh sách ảnh bìa</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th>Tên ảnh bìa</th>
                        <th>Hình ảnh</th>
                        <th>Hiển thị</th>
                        <th> Xóa</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                        @foreach ($all_slide as $key => $slide)
                    <tr>
                            <td>{{ $slide -> slide_name }}</td>
                            <td><img src="public/uploads/product/{{ $slide -> slide_image }}" width="200" height="100"></td>
                            <td>
                                <span class="text-ellipsis">
                                    <?php
                                        if($slide -> slide_status == 0){
                                    ?>
                                             <a href="{{URL::to('/unactive-slide/'.$slide ->slide_id)}}"><span style="color: brown; font-size: 20px" class="fa fa-angle-double-down"></span></a>
                                    <?php
                                    }else{
                                    ?>
                                        <a href="{{URL::to('/active-slide/'.$slide ->slide_id)}}"><span style="color: blue; font-size: 20px"  class="fa fa-angle-double-up"></span></a>
                                    <?php
                                        }
                                    ?>
                                </span></td>
                            <td>
                                {{-- <a href="{{URL::to('/edit-product/'.$pro->product_id)}}}" class="active" ui-toggle-class="">
                                    <i class="fa fa-edit text-success text-active"></i>
                                </a> --  --}}
                                <a onclick="return confirm('Bạn có chắn chắc muốn xóa không ?')" href="{{URL::to('/delete-slide/'.$slide->slide_id)}}}" class="active" ui-toggle-class="">
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