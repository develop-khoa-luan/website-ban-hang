@extends('admin_layout')
@section('admin_content')
<form role="form" action="{{URL::to('/save-slide')}}" method="POST">
    {{csrf_field()}}
    <?php
                $message = Session::get('message');
                if($message){
                    echo '<span style="color:red">' .$message. '</span>';
                    Session::put('message',null);
                }
        ?>
        <h3 class="h3 text-primary mt-4 mb-4">Thêm ảnh bìa</h3>
    <div class="row">
        <div class="col-lg-9 col-md-8">
            <div class="card m-1 border border-primary">
                <div class="card-header p-2 text-primary border-botton border-primary">
                    Nhập thông tin ảnh bìa
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên ảnh bìa</label>
                        <input type="text" name="slide_name" required class="form-control" id="exampleInputEmail1"
                            placeholder="Tên ảnh bìa...">
                    </div>

                    <div class="row">
                        <div class="col-lg-8 col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình ảnh bìa</label>
                                <a href="#" class="btn btn-primary btn-circle btn-sm" id="open-child-window"><i
                                        class="fas fa-plus-circle"></i></a>
                                <div class="row ml-1">
                                    <input id="get-image" name="slide_image" type="text" readonly
                                        class="col-11 form-control" placeholder="Chọn ảnh..." required>
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
                        <label for="exampleInputPassword1">Trạng thái</label>
                        <select name="slide_status" class="form-control input-sm m-bot15">
                            <option value="1" selected>Áp dụng</option>
                            <option value="0">Không áp dụng</option> 
                        </select>
                    </div>
                   
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4">
            <div class="card m-1 border border-primary">
                <div class="card-header p-2 text-primary border-botton border-primary">
                    Hành động
                </div>
                <div class="card-body">
                    <div class="col-12">
                        <button type="submit" id="btn-public" class="btn btn-success col-12">Thêm mới</button>
                    </div>
        
                    <div class="col-12">
                        <a href="{{URL::to('/add-slide')}}"><input type="button" class="btn btn-danger col-12 mt-2" value="Hủy"/></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="{{asset('public/backend/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('public/backend/js/custom-js/add-product.js')}}"></script>
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