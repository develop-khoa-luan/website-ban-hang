@extends('admin_layout')
@section('admin_content')
<form role="form" action="{{URL::to('/save-product')}}" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}
    <?php
                $message = Session::get('message');
                if($message){
                    echo '<span style="color:red">' .$message. '</span>';
                    Session::put('message',null);
                }
        ?>
    <div class="row">
        <div class="col-lg-9 col-md-8">
            <div class="card m-1 border border-primary">
                <div class="card-header p-2 text-primary border-botton border-primary">
                    Nhập thông tin sản phẩm
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="text-dark" for="exampleInputEmail1">Tên sản phẩm:</label>
                        <input type="text" name="product_name" class="form-control" id="exampleInputEmail1"
                            placeholder="Tên sản phẩm...">
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label class="text-dark for=" exampleInputPassword1">Danh mục sản phẩm:</label>
                                <select name="product_cate" class="form-control input-sm m-bot15">
                                    @foreach($cate_product as $key => $cate)
                                    <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label class="text-dark for=" exampleInputPassword1">Thương hiệu sản phẩm:</label>
                                <select name="product_brand" class="form-control input-sm m-bot15">
                                    @foreach($brand_product as $key => $brand)
                                    <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Giá sản phẩm</label>
                                <input type="number" name="product_price" class="form-control" id="exampleInputEmail1"
                                    placeholder="Giá sản phẩm...">
                            </div>

                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số lượng sản phẩm</label>
                                <input type="number" name="product_quantity" class="form-control"
                                    id="exampleInputEmail1" placeholder="Số lượng sản phẩm...">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình ảnh sản Phẩm</label>
                                <a href="#" class="btn btn-primary btn-circle btn-sm" id="open-child-window"><i
                                        class="fas fa-plus-circle"></i></a>
                                <div class="row ml-1">
                                    <input id="get-image" name="new_image" type="text" readonly
                                        class="col-11 form-control" placeholder="Chọn hình sản phẩm...">
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
                        <label class="text-dark for=" exampleInputPassword1">Mô tả sản phẩm:</label>
                        <textarea style="resize: none" rows="4" name="product_desc" class="form-control"
                            id="exampleInputPassword1" placeholder="Mô tả..."></textarea>
                    </div>
                    <div class="form-group">
                        <label class="text-dark for=" exampleInputPassword1">Nội dung sản phẩm:</label>
                        <textarea style="resize: none" rows="8" name="product_content" class="form-control"
                            id="contentWithCkeditor" placeholder="Nội dung..."></textarea>
                    </div>
                    <input type="number" value="0" name="product_status" id="product_status" readonly hidden />
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
                        <button type="submit" id="btn-public" class="btn btn-success col-12">Hiển thị</button>
                    </div>
                    <div class="col-12">
                        <button type="submit" id="btn-draft" class="btn btn-secondary col-12 mt-2">Bản nháp</button>
                    </div>
                    <div class="col-12">
                        <a href="{{URL::to('/all-product')}}"><input type="button" class="btn btn-danger col-12 mt-2"
                                value="Hủy" /></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript" src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>
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