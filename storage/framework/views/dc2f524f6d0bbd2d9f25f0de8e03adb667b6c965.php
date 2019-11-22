 
<?php $__env->startSection('content'); ?>

<div class="features_items">
    <!--features_items-->
    <?php $__currentLoopData = $brand_name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $brand_name_show): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <h2 class="title text-center"><?php echo e($brand_name_show->brand_name); ?></h2>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	
    <?php $__currentLoopData = $brand_by_id; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <a href="<?php echo e(URL::to('/chi-tiet-san-pham/'.$product->product_id)); ?>">
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                    <img  src="../public/uploads/product/<?php echo e($product->product_image); ?>" class="card-img-top" alt="" />
                        <h2><?php echo e(number_format($product->product_price).' '.'VND'); ?></h2>
                        <p><?php echo e($product->product_name); ?></p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                    </div>
                    
                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#"><i class="fa fa-plus-square"></i>Thêm yêu thích</a></li>
                        <li><a href="#"><i class="fa fa-plus-square"></i>Thêm so sánh</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\website-online\resources\views/pages/brand/show_brand.blade.php ENDPATH**/ ?>