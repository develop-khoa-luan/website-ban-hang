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
                                <label class="text-dark for="exampleInputPassword1">Danh mục sản phẩm:</label>
                                <select name="product_cate" class="form-control input-sm m-bot15">
                                    @foreach($cate_product as $key => $cate)
                                    <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label class="text-dark for="exampleInputPassword1">Thương hiệu sản phẩm:</label>
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
                                <label class="text-dark for="exampleInputEmail1">Giá sản phẩm:</label>
                                <input type="number" name="product_price" class="form-control" id="exampleInputEmail1"
                                    placeholder="Giá sản phẩm...">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label class="text-dark for="exampleInputEmail1">Hình ảnh sản phẩm:</label>
                                <input type="file" name="product_image" class="btn" id="exampleInputEmail1">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label class="text-dark for="exampleInputEmail1">Số lượng sản phẩm:</label>
                                <input type="number" name="product_quantity" class="form-control" id="exampleInputEmail1"
                                    placeholder="Số lượng sản phẩm...">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="text-dark for="exampleInputPassword1">Mô tả sản phẩm:</label>
                        <textarea style="resize: none" rows="4" name="product_desc" class="form-control"
                            id="exampleInputPassword1" placeholder="Mô tả..."></textarea>
                    </div>
                    <div class="form-group">
                        <label class="text-dark for="exampleInputPassword1">Nội dung sản phẩm:</label>
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
                        <a href="{{URL::to('/all-product')}}"><input type="button" class="btn btn-danger col-12 mt-2" value="Hủy"/></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection