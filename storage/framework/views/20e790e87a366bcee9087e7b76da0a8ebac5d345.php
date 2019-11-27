<?php $__env->startSection('content'); ?>

<div class="features_items">
	<!--features_items-->
	<meta name="_token" content="<?php echo e(csrf_token()); ?>" />
	<h2 class="title text-center" style="margin-top: 10px">Sản phẩm mới</h2>
	<?php $__currentLoopData = $all_product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<form>
		<div class="col-sm-4">
			<div class="product-image-wrapper">
				<input name="product_id_hidden" type="hidden" value="<?php echo e($product->product_id); ?>" />
				<input name="qty" type="hidden" min="0" value="1" />
				<a href="<?php echo e(URL::to('/chi-tiet-san-pham/'.$product->product_id)); ?>">
					<div class="single-products">
						<div class="productinfo text-center">
							<img style="height:250px" src="public/uploads/product/<?php echo e($product->product_image); ?>" alt="" />
							<h2><?php echo e(number_format($product->product_price).' '.'VND'); ?></h2>
							<p><strong><?php echo e($product->product_name); ?><strong></strong></p>
							<p><?php echo e($product->brand_name); ?> </p>
            				
							<button class="btn btn-default show-modal" data-toggle="modal"
								data-target="#<?php echo e($product->product_id); ?>-modal">
								<i class="fa fa-shopping-cart"></i>
								Thêm vào giỏ hàng
							</button>
						</div>
					</div>
				</a>

			</div>
		</div>
	</form>
	<!-- Central Modal Medium Info -->
	<div class="modal fade" id="<?php echo e($product->product_id); ?>-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-notify modal-info" role="document">
			<!--Content-->
			<div class="modal-content">
				<!--Header-->
				<div class="modal-header">
					<p style="font-size: 30px"><?php echo e($product->product_name); ?></p>
				</div>
				<!--Body-->
				<div class="modal-body">
					<div class="text-center">
						<img style="height:250px" src="public/uploads/product/<?php echo e($product->product_image); ?>" alt="" />
						<p style="margin-top: 10px"><?php echo e($product->brand_name); ?> </p>
            			<p><?php echo e($product->category_name); ?> </p>
					</div>
				</div>

				<!--Footer-->
				<div class="modal-footer justify-content-center">
					<a type="button" class="btn btn-primary">Buy now <i class="far fa-gem ml-1 text-white"></i></a>
					<a type="button" class="btn btn-primary">Get it now <i class="far fa-gem ml-1 text-white"></i></a>
					<a type="button" class="btn btn-danger" data-dismiss="modal" style="margin-top: 15px">No, thanks</a>
				</div>
			</div>
			<!--/.Content-->
		</div>
	</div>
	<!-- Central Modal Medium Info -->
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<script src="<?php echo e(asset('public/frontend/js/jquery.js')); ?>"></script>
<script>
	$(document).ready(function(){
		$('.btn-add-to-cart').click(function(e){
			e.preventDefault();
		$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
		});
		$.ajax({
		url: "<?php echo e(url('/save-cart')); ?>",
		method: 'post',
		data: {
			product_id_hidden: $(this).parents()[3].children[0].value,
			qty: $(this).parents()[3].children[1].value
		},
		success: function(result){
			$(".count_cart").text(result.cart_count);
			debugger;
			alert("Thêm sản phẩm vô giỏ hàng thành công!");
		},
		error: function(result){
			alert("Thêm sản phẩm vô giỏ hàng thất bại!");
		}});
		});
		});
</script>
<!--features_items-->

 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\website-online\resources\views/pages/home.blade.php ENDPATH**/ ?>