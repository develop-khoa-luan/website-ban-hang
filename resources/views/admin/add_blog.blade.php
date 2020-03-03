@extends('admin_layout')
@section('admin_content')
<form role="form" action="{{URL::to('/save-blog')}}" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}
    <?php
                $message = Session::get('message');
                if($message){
                    echo '<span style="color:red">' .$message. '</span>';
                    Session::put('message',null);
                }
        ?>
    <div class="row">
        <div class="col-lg-9 col-md-12">
            <div class="card m-1 border border-primary">
                <div class="card-header p-2 text-primary border-botton border-primary">
                    Nhập thông tin bản tin
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="text-dark" for="exampleInputEmail1">Tên bản tin:</label>
                        <input type="text" name="title" class="form-control" id="exampleInputEmail1"
                            placeholder="Tên bản tin.." required>
                    </div>
                    <div class="form-group">
                        <label class="text-dark for=" exampleInputPassword1">Tóm tắt bản tin:</label>
                        <textarea style="resize: none" rows="4" name="alias" class="form-control"
                            id="exampleInputPassword1" placeholder="Tóm tắt..." required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình ảnh:</label>
                                <a href="#" class="btn btn-primary btn-circle btn-sm" id="open-child-window"><i
                                        class="fas fa-plus-circle"></i></a>
                                <div class="row ml-1">
                                    <input id="get-image" name="featured_image" type="text" readonly
                                        class="col-11 form-control" required placeholder="Chọn hình ảnh...">
                                    <div class="d-flex align-items-center">
                                        <a href="#" class="btn btn-danger btn-circle btn-sm ml-1" id="delete-image"><i
                                                class="fas fa-trash"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="form-group">
                                <img id="current-image" src="" width="100" height="100">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="text-dark" for="exampleInputPassword1">Nội dung bản tin:</label>
                        <textarea style="resize: none" rows="8" name="content" class="form-control"
                            id="contentWithCkeditor" placeholder="Nội dung..." required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Hiển thị</label>
                        <select name="status" class="form-control input-sm m-bot15">
                            <option value="1">Hiển thị</option>
                            <option value="0">Ẩn</option>
                        </select>
                    </div>
                    {{-- <input type="number" value="0" name="product_status" id="product_status" readonly hidden /> --}}
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-12">
            <div class="card m-1 border border-primary mt-1">
                <div class="card-header p-2 text-primary border-botton border-primary">
                    Hành động
                </div>
                <div class="card-body">
                    <div class="col-12">
                        <button type="submit" id="btn-public" class="btn btn-success col-12">Thêm mới</button>
                    </div>

                    <div class="col-12">
                        <a href="{{URL::to('/add-blog')}}"><input type="button" class="btn btn-danger col-12 mt-2"
                                value="Hủy" /></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>
<script type="text/javascript" src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('public/backend/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('public/backend/js/custom-js/blog.js')}}"></script>
<script>
    // This will hold the handle of the child window
        var __CHILD_WINDOW_HANDLE = null;
        

        $("#open-child-window").on('click', function() {
            __CHILD_WINDOW_HANDLE = window.open('{{URL::to('/gallery')}}', '_blank', 'width=1200,height=600,left=200,top=50');
        });
        
        $("#send-message-child").on('click', function() {
            if($.trim($("#message").val()) != '') {
                __CHILD_WINDOW_HANDLE.ProcessParentMessage($("#message").val());
                $("#message").val('');
            }
        });
        
        function ProcessChildMessage(message) {
            $("#get-image").val(message);
            var get_image = $("#get-image").val();
            var change_src = '{{URL::to('/public/uploads/product/')}}'+'/'+get_image;
            debugger;
            $("#current-image").attr('src', change_src);
        }
        
        $("#delete-image").on("click", function(){
            $("#get-image").val("");
            $("#current-image").attr('src', "");
        });

        CKEDITOR.replace('contentWithCkeditor', {
            filebrowserBrowseUrl: '{{URL::to("/gallery")}}'
         });
</script>
@endsection