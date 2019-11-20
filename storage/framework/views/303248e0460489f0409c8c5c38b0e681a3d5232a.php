<?php $__env->startSection('admin_content'); ?>
<form role="form" action="<?php echo e(URL::to('/save-category-product')); ?>" method="POST">
    <?php echo e(csrf_field()); ?>

    <?php
                $message = Session::get('message');
                if($message){
                    echo '<span style="color:red">' .$message. '</span>';
                    Session::put('message',null);
                }
        ?>
        <h3 class="h3 text-primary mt-4 mb-4">Thêm danh mục sản phẩm</h3>
    <div class="row">
        <div class="col-lg-9 col-md-8">
            <div class="card m-1 border border-primary">
                <div class="card-header p-2 text-primary border-botton border-primary">
                    Nhập thông tin danh mục
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên danh mục</label>
                        <input type="text" name="category_product_name" class="form-control" id="exampleInputEmail1"
                            placeholder="Tên danh mục...">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mô tả danh mục</label>
                        <textarea style="resize: none" rows="4" name="category_product_desc" class="form-control"
                            id="exampleInputPassword1" placeholder="Mô tả..."></textarea>
                    </div>
                    
                    <input type="number" value="0" name="category_product_status" id="category_status" readonly hidden />
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
                        <a href="<?php echo e(URL::to('/all-product')); ?>"><input type="button" class="btn btn-danger col-12 mt-2" value="Hủy"/></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="<?php echo e(asset('public/backend/vendor/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/backend/js/custom-js/category.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\website-online\resources\views/admin/add_category_product.blade.php ENDPATH**/ ?>