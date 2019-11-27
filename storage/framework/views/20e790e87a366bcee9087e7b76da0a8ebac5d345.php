<?php $__env->startSection('content'); ?>

<div class="features_items">
	<!--features_items-->
	<meta name="_token" content="<?php echo e(csrf_token()); ?>" />
	<h2 class="title text-center" style="margin-top: 10px">Sản phẩm mới</h2>
	<?php $__currentLoopData = $all_product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<form>
		<div class="col-sm-4">
			<div class="product-image-wrapper">
				<input name="product_id_hidden" id="product_id" type="hidden" value="<?php echo e($product->product_id); ?>" />
				<input name="qty" type="hidden" min="0" value="1" />
				<a href="<?php echo e(URL::to('/chi-tiet-san-pham/'.$product->product_id)); ?>">
					<div class="single-products">
						<div class="productinfo text-center">
							<img style="height:250px" src="public/uploads/product/<?php echo e($product->product_image); ?>" alt="" />
							<h2><?php echo e(number_format($product->product_price).' '.'VND'); ?></h2>
							<p><strong><?php echo e($product->product_name); ?><strong></strong></p>
							<p><?php echo e($product->brand_name); ?> </p>
							
							<button class="btn btn-default show-modal-product-detail" data-toggle="modal"
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
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<!-- Central Modal Medium Info -->
	<div class="modal fade" id="modal-product-detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-notify modal-info" role="document">
			<!--Content-->
			<div class="modal-content">
				<!--Header-->
				<input class="modal-product-id" id="modal-product-id" type="text" readonly hidden/>
				<div class="col-5 col-md-7 col-lg-7 col-xl-7">
					<img id="modal-product-image" style="height:200px; width: 200px; margin-top: 30px; margin-left: 40px" alt="" />
				</div>
				<!--Body-->
				<div class="col-5 col-md-5 col-lg-5 col-xl-5">
					<p style="font-size: 20px; margin-top: 10px" id="modal-product-name"></p>
					<div class="">
						<p style="margin-top: 10px" id="modal-product-brand"></p>
						<p id="modal-product-category"></p>
						<label for="product-size">Size: </label>
						<select class="form-control modal-product-size" style="width: 85px" id="product-size">
						</select>

						<label for="quantity">Số lượng:</label>
						<input style="width: 85px" class="form-control modal-product-quantity" id="quantity" name="qty"
							type="number" min="0" max="" value="1" />
					</div>
				</div>

				<!--Footer-->
				<div class="modal-footer" style="margin-top: 0; border-bottom-right-radius: 1px">
					<a type="button" class="btn btn-primary btn-add-to-cart-modal">Thêm ngay <i class="far fa-gem ml-1 text-white"></i></a>
					<a type="button" class="btn btn-danger" data-dismiss="modal" style="margin-top: 15px">Hủy </a>
				</div>
			</div>
			<!--/.Content-->
		</div>
	</div>
	<!-- Central Modal Medium Info -->
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

		$('.show-modal-product-detail').click(function(e){
			$("#modal-product-detail").modal('show');
			
			$.ajax({
					url: "<?php echo e(url('/get-product')); ?>",
					method: 'get',
					data: {
						product_id: $(this).parents()[4].children[0].value
					},  
					success: function(data) {
						$("#modal-product-name").text(data.product[0].product_name);
						$("#modal-product-image").attr('src', 'public/uploads/product/'+data.product[0].product_image);
						$("#modal-product-brand").text(data.product[0].brand_name);
						$("#modal-product-category").text(data.product[0].category_name);
						$("#modal-product-id").val(data.product[0].product_id);
					}
				});
		});

		$('.show-modal-product-detail').click(function(e){
			$.ajax({
					url: "<?php echo e(url('/get-product-detail')); ?>",
					method: 'get',
					data: {
						product_id: $(this).parents()[4].children[0].value
					},  
					success: function(data) {
						$(".option-size").remove();
						var products_detail = data.product_detail;
						products_detail.forEach(element => {
						var html = `<option class = "option-size" value="`+element.product_size+`">`+element.product_size+`</option>`;
						$(".modal-product-size").append(html);
						});
					}
				});
		});

		//add-to-cart
        $('.btn-add-to-cart-modal').click(function(e){
		debugger;
		e.preventDefault();
		$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
        });
		$.ajax({
		url: "<?php echo e(url('/save-cart-with-size')); ?>",
		method: 'post',
		data: {
			product_id_hidden: $(this).parents().find("#modal-product-id").val(),
			qty: $(this).parents().find(".modal-product-quantity").val(),
            product_size: $(this).parents().find(".modal-product-size").val()
		},
		success: function(result){
			$("#modal-product-detail").modal('hide');
			$(".count_cart").text(result.cart_count);
		},
		error: function(result){
			alert("Thêm sản phẩm vô giỏ hàng thất bại!");
        }});
        });

	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\website-online\resources\views/pages/home.blade.php ENDPATH**/ ?>