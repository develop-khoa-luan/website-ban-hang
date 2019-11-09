<?php $__env->startSection('content'); ?>

<div class="features_items">
	<!--features_items-->
	<h2 class="title text-center" style="margin-top: 10px">Sản phẩm mới</h2>
	<?php $__currentLoopData = $all_product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<form action="<?php echo e(URL::to('/save-cart')); ?>" method="POST">
		<?php echo e(csrf_field()); ?>

		<?php
			$current_url = url()->current();
		?>
		<input type="text" name="current_url_hidden" hidden readonly value="<?php echo e($current_url); ?>" />
		<div class="col-sm-4">
			<div class="product-image-wrapper">
				<input name="product_id_hidden" type="hidden" value="<?php echo e($product->product_id); ?>" />
				<input name="qty" type="hidden" min="0" value="1" />
				<a href="<?php echo e(URL::to('/chi-tiet-san-pham/'.$product->product_id)); ?>">
					<div class="single-products">
						<div class="productinfo text-center">
							<img src="public/uploads/product/<?php echo e($product->product_image); ?>" alt="" />
							<h2><?php echo e(number_format($product->product_price).' '.'VND'); ?></h2>
							<p><?php echo e($product->product_name); ?></p>
							<button type="submit" class="btn btn-default add-to-cart">
								<i class="fa fa-shopping-cart"></i>
								Thêm vào giỏ hàng
							</button>
						</div>
					</div>
				</a>

			</div>
		</div>
	</form>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>
<!--features_items-->

 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\website-online\resources\views/pages/home.blade.php ENDPATH**/ ?>