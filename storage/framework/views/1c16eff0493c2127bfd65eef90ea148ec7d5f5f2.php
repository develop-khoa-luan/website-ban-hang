<?php $__env->startSection('admin_content'); ?>

<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            Thêm thương hiệu sản phẩm
            
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
                <form role="form" action="<?php echo e(URL::to('/save-brand-product')); ?>" method="POST">
                    <?php echo e(csrf_field()); ?>

                <div class="form-group">
                    <label for="exampleInputEmail1">Tên thương hiệu</label>
                    <input type="text" name="brand_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                    <textarea style="resize: none" rows = "8" name="brand_product_desc" class="form-control" id="exampleInputPassword1" placeholder="Mô tả danh mục"> 
                    </textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Hiển thị</label>
                    <select name="brand_product_status" class="form-control input-sm m-bot15">
                        <option value="0">Ẩn</option>
                        <option value="1">Hiển thị</option>
                    </select>
                </div>
                <button type="submit" name="add_brand_product" class="btn btn-info">Thêm mới</button>
            </form>
            </div>

        </div>
    </section>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\website-online\resources\views/admin/add_brand_product.blade.php ENDPATH**/ ?>