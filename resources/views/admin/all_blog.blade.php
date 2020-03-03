@extends('admin_layout')
@section('admin_content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Tin tức</h1>
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
        <h6 class="m-0 font-weight-bold text-primary">Danh sách tin tức</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th>Tên bài viết</th>
                        <th>Hình ảnh</th>
                        <th>Tóm tắt</th>
                        <th>Tác giả</th>
                        <th>Hiển thị</th>
                        <th>Sửa -- Xóa</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($all_blog as $item)
                    <tr>
                        <td>{{$item->title}}</td>
                        <td><img src="public/uploads/product/{{$item->featured_image}}" width="100" height="100"></td>
                        <td>{{$item->alias}}</td>
                        <td>{{$item->admin_name}}</td>
                        <td>
                                <span class="text-ellipsis">
                                    <?php
                                            if($item -> status == 0){
                                        ?>
                                    <a href="{{URL::to('/active-blog/'.$item ->id)}}"><span
                                            style="color: brown; font-size: 20px"
                                            class="fa fa-angle-double-down"></span></a>
                                    <?php
                                        }else{
                                        ?>
                                    <a href="{{URL::to('/unactive-blog/'.$item ->id)}}"><span
                                            style="color: blue; font-size: 20px" class="fa fa-angle-double-up"></span></a>
                                    <?php
                                            }
                                        ?>
                                </span></td>
                        <td>
                        <a href="{{URL::to('/edit-blog-detail/'.$item->id)}}" class="active" ui-toggle-class="">
                                <i class="fa fa-edit text-success text-active"></i>
                            </a> --
                            <a onclick="return confirm('Bạn có chắn chắc muốn xóa không ?')" href="{{URL::to('/delete-blog/'.$item->id)}}" class="active"
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