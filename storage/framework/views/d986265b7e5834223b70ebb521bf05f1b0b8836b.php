 
<?php $__env->startSection('admin_content'); ?>

<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            Thêm sản phẩm

        </header>
        <?php
                $message = Session::get('message');
                if($message){
                    echo '<span style="color:red">' .$message. '</span>';
                    Session::put('message',null);
                }
        ?>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="<?php echo e(URL::to('/save-product')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                            <select name="product_cate" class="form-control input-sm m-bot15">
                                <?php $__currentLoopData = $cate_product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cate->category_id); ?>"><?php echo e($cate->category_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thương Hiệu sản phẩm</label>
                            <select name="product_brand" class="form-control input-sm m-bot15">
                                <?php $__currentLoopData = $brand_product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($brand->brand_id); ?>"><?php echo e($brand->brand_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="text" name="product_price" class="form-control" id="exampleInputEmail1" placeholder="Giá sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh sản Phẩm</label>
                            <input type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                            <textarea style="resize: none" rows="4" name="product_desc" class="form-control" id="exampleInputPassword1"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                            <textarea style="resize: none" rows="8" name="product_content" class="form-control" id="exampleInputPassword1"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="product_status" class="form-control input-sm m-bot15">
                        <option value="0">Ẩn</option>
                        <option value="1">Hiển thị</option>
                    </select>
                        </div>
                        <button type="submit" name="add_product" class="btn btn-info">Thêm sản phẩm</button>
                    </form>
                </div>

            </div>
    </section>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\website-online\resources\views/admin/add_product.blade.php ENDPATH**/ ?>