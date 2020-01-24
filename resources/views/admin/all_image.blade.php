@extends('admin_layout')
@section('admin_content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Quản lý hình ảnh</h1>
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
        <div class="row">
            <h6 class="col-6 m-0 font-weight-bold text-primary">Tất cả hình ảnh</h6>
            <div class="col-6 d-flex flex-row-reverse active-cyan-4 mb-4">
                <input class="col-8 form-control" type="text" id="myInput" onkeyup="myFunction()"
                    placeholder="Tìm kiếm hình ảnh" title="search..." />
            </div>
        </div>
    </div>
    <div class="card-body">
        <!-- Grid row -->
        <ul id="myUL" class="list-group">
            <div class="row">
                @foreach($photos as $photo)
                <!-- Grid column -->
                <div class="col-lg-3 col-md-6 col-sm-6   mb-4 d-flex justify-content-center">
                    <!--Modal: Name-->
                    <div id="my_model{{$photo->id}}" class="modal fade" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body ">
                                    <img src="public/uploads/product/{{ $photo->filename }}" class="img-thumbnail">
                                    <div class="col-10 text-info" id="get_name">{{ $photo->filename }}</div>
                                </div>
                                <a onclick="return confirm('Bạn có chắn chắc muốn xóa không ?')"
                                    class="btn btn-danger btn-sm text-info" ui-toggle-class="" id="delete-image"
                                    href="{{URL::to('image/delete/'.$photo->filename)}}">Xóa
                                </a>
                            </div>
                        </div>
                    </div>
                <li class="list-group-item">
                        <!--Modal: Name-->
                        <img class="img-thumbnail" style="width: 300px; height: 300px"
                            src="public/uploads/product/{{ $photo->filename }}" alt="{{ $photo->filename }}"
                            data-toggle="modal" data-target="#my_model{{$photo->id}}">
                        <p hidden>{{ $photo->filename }}</p>
                    </div>
                    <!-- Grid column -->
                </li>
                @endforeach
            </div>
        </ul>
        <!-- Grid row -->
    </div>
</div>
<script src="{{asset('public/backend/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('public/backend/js/custom-js/image.js')}}"></script>
@endsection