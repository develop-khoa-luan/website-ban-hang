<?php $__env->startSection('admin_content'); ?>
<?php $__currentLoopData = $edit_product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<form role="form" action="<?php echo e(URL::to('/update-product/'.$pro->product_id)); ?>" method="POST" enctype="multipart/form-data">
    <?php echo e(csrf_field()); ?>

    <?php
                $message = Session::get('message');
                if($message){
                    echo '<span style="color:red">' .$message. '</span>';
                    Session::put('message',null);
                }
        ?>
    <div class="row">
        <div class="col-lg-8 col-md-12">
            <div class="card m-1 border border-primary">
                <div class="card-header p-2 text-primary border-botton border-primary">
                    Nhập thông tin sản phẩm
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên sản phẩm</label>
                        <input type="text" name="product_name" class="form-control" id="exampleInputEmail1"
                            value="<?php echo e($pro->product_name); ?>">
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                <select name="product_cate" class="form-control input-sm m-bot15">
                                    <?php $__currentLoopData = $cate_product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($cate-> category_id == $pro -> category_id): ?>
                                    <option selected value="<?php echo e($cate-> category_id); ?>"><?php echo e($cate->category_name); ?></option>
                                    <?php else: ?>
                                    <option value="<?php echo e($cate->category_id); ?>"><?php echo e($cate->category_name); ?></option>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Thương Hiệu sản phẩm</label>
                                <select name="product_brand" class="form-control input-sm m-bot15">
                                    <?php $__currentLoopData = $brand_product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($cate-> category_id == $pro -> category_id): ?>
                                    <option selected value="<?php echo e($brand-> brand_id); ?>"><?php echo e($brand->brand_name); ?></option>
                                    <?php else: ?>
                                    <option value="<?php echo e($brand->brand_id); ?>"><?php echo e($brand->brand_name); ?></option>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Giá sản phẩm</label>
                                <input type="number" name="product_price" class="form-control" id="exampleInputEmail1"
                                    value="<?php echo e($pro->product_price); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình ảnh sản Phẩm</label>
                                <a href="#" class="btn btn-primary btn-circle btn-sm" id="open-child-window"><i
                                        class="fas fa-plus-circle"></i></a>
                                <div class="row">
                                    <input id="get-image" name="new_image" type="text" readonly
                                        class="col-10 form-control ml-2" value="<?php echo e($pro->product_image); ?>">
                                    <div class="d-flex align-items-center">
                                        <a href="#" class="btn btn-danger btn-circle btn-sm ml-1" id="delete-image"><i
                                                class="fas fa-trash"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="form-group">
                                <img id="current-image"
                                    src="<?php echo e(URL::to('/public/uploads/product/'.$pro->product_image)); ?>" width="100"
                                    height="100">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                        <textarea style="resize: none" rows="4" name="product_desc" class="form-control"
                            id="exampleInputPassword1"> <?php echo e($pro->product_desc); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                        <textarea style="resize: none" rows="8" name="product_content" class="form-control"
                            id="contentWithCkeditor"><?php echo e($pro->product_content); ?></textarea>
                    </div>
                    <input type="number" value="0" name="product_status" id="product_status" readonly hidden />
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="card m-1 border border-primary">
                <div class="card-header p-2 text-primary border-botton border-primary">
                    Chi tiết sản phẩm
                </div>
                <div class="card-body">
                    <input type="number" name="count_product_detail" id="count_product_detail" class="count_product_detail" hidden
                        value=<?php echo e($count_detail); ?>>
                    <div class="row d-flex justify-content-center">
                        <div class="col-5 d-flex justify-content-right">Size</div>
                        <div class="col-1"></div>
                        <div class="col-5 d-flex justify-content-right">Số lượng</div>
                        <div class="col-1"></div>
                    </div>
                    <?php $i = 0 ?>
                    <?php $__currentLoopData = $all_product_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $i++ ?>
                    <div id=<?php echo e($i); ?> class="row mt-2 d-flex justify-content-center">
                        <input type="text" name="product_size_<?php echo e($i); ?>" id="product_size_<?php echo e($i); ?>"
                    class="form-control col-5" id="exampleInputEmail1" placeholder="Size..." value="<?php echo e($item->product_size); ?>">
                        <div class="col-1"></div>
                        <input type="number" name="product_quantity_<?php echo e($i); ?>"
                            id="product_quantity_<?php echo e($i); ?>" class="form-control col-5" id="exampleInputEmail1"
                    placeholder="Số lượng..." value="<?php echo e($item->product_quantity); ?>">
                        <div class="col-1 d-flex align-items-center"><i
                                class="text-danger fas fa-minus-circle delete-product-detail"></i>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="append-product-detail"></div>
                    <div class="row mt-2 d-flex justify-content-center">
                        <div class="col-5"></div>
                        <div class="col-1 d-flex justify-content-center"><i
                                class="text-success fas fa-plus-circle add-product-detail"></i></div>
                        <div class="col-5"></div>
                        <div class="col-1"></div>
                    </div>
                </div>
            </div>
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
                        <a href="<?php echo e(URL::to('/all-product')); ?>"><input type="button" class="btn btn-danger col-12 mt-2"
                                value="Hủy" /></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript" src="<?php echo e(asset('public/backend/ckeditor/ckeditor.js')); ?>"></script>
<script src="<?php echo e(asset('public/backend/vendor/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/backend/js/custom-js/edit-product.js')); ?>"></script>
<script>
    // This will hold the handle of the child window
        var __CHILD_WINDOW_HANDLE = null;
        

        $("#open-child-window").on('click', function() {
            __CHILD_WINDOW_HANDLE = window.open('<?php echo e(URL::to('/gallery')); ?>', '_blank', 'width=1200,height=600,left=200,top=50');
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
            var change_src = '<?php echo e(URL::to('/public/uploads/product/')); ?>'+'/'+get_image;
            debugger;
            $("#current-image").attr('src', change_src);
        }
        
        $("#delete-image").on("click", function(){
            $("#get-image").val("");
            $("#current-image").attr('src', "");
        });

        CKEDITOR.replace('contentWithCkeditor', {
            filebrowserBrowseUrl: '<?php echo e(URL::to("/gallery")); ?>'
         });
</script>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\website-online\resources\views/admin/edit_product.blade.php ENDPATH**/ ?>