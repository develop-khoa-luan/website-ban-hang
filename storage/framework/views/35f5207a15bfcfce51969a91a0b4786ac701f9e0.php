<?php $__env->startSection('content'); ?>


<?php $__currentLoopData = $details_product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


<div class="product-details">
    <meta name="_token" content="<?php echo e(csrf_token()); ?>" />
    <div class="col-sm-5">
        <div class="view-product">
            <img src="<?php echo e(URL::to('/public/uploads/product/'.$value ->product_image)); ?>" alt="" />
            
        </div>
        <div id="similar-product" class="carousel slide" data-ride="carousel">

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <a href=""><img src="../public/frontend/images/similar1.jpg" alt=""></a>
                    <a href=""><img src="../public/frontend/images/similar2.jpg" alt=""></a>
                    <a href=""><img src="../public/frontend/images/similar3.jpg" alt=""></a>
                </div>
                <div class="item">
                    <a href=""><img src="../public/frontend/images/similar1.jpg" alt=""></a>
                    <a href=""><img src="../public/frontend/images/similar2.jpg" alt=""></a>
                    <a href=""><img src="../public/frontend/images/similar3.jpg" alt=""></a>
                </div>


            </div>

            <!-- Controls -->
            <a class="left item-control" href="#similar-product" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right item-control" href="#similar-product" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>

    </div>
    <div class="col-sm-7">
        <div class="card">
            <!--/product-information-->
            <form>
                <div class="card-header">
                    <input id="product_id_hidden" name="product_id_hidden" type="hidden"
                        value="<?php echo e($value->product_id); ?>" />
                    <h2 style="font-size: 40px; color: #FE980F"><?php echo e($value->product_name); ?></h2>
                </div>
                <div class="card-body">
                    <div class="card-title" style="margin-top: 20px">
                        <span style="font-size: 25px"><?php echo e(number_format($value->product_price).' '.'VND'); ?></span>
                    </div>
                    <div class="card-text">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group ">
                                    <label for="product-size">Size: </label>
                                    <select class="form-control product-size" style="width: 100px" id="product-size">
                                        <?php $__currentLoopData = $all_product_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->product_size); ?>"><?php echo e($item->product_size); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <label for="quantity">Số lượng:</label>
                                <input style="width: 100px" class="form-control" id="quantity" name="qty" type="number"
                                    min="0" max="" value="1" />
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <button id="btn-buy-now" class="btn btn-fefault btn-danger cart btn-buy-now">
                                <i class="fa fa-shopping-cart"></i>
                                Mua ngay
                            </button>
                            <button id="btn-add-to-cart" class="btn btn-fefault cart btn-add-to-cart">
                                <i class="fa fa-shopping-cart"></i>
                                Thêm vào giỏ hàng
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            
            <p><b>Trạng thái: <span class="show-quantity"></span><span class="sold-out text-danger"></span></b></p>
            <p><b>Thương hiệu:</b> <?php echo e($value->brand_name); ?> </p>
            <p><b>Danh mục:</b> <?php echo e($value->category_name); ?> </p>
        </div>
        <!--/product-information-->
    </div>
</div>



<div class="category-tab shop-details-tab ">
    <!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#details" data-toggle="tab">Details</a></li>
            <li><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
        </ul>
    </div>
    <div class="tab-content ">
        <div class="tab-pane fade active in" id="details">
            <p><?php echo $value->product_content; ?></p>

        </div>



        <div class="tab-pane fade " id="reviews">
            <div class="col-sm-12">
                <ul>
                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                </ul>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur.</p>
                <p><b>Write Your Review</b></p>

                <form action="#">
                    <span>
                        <input type="text" placeholder="Your Name" />
                        <input type="email" placeholder="Email Address" />
                    </span>
                    <textarea name=""></textarea>
                    <b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
                    <button type="button" class="btn btn-default pull-right">
                        Submit
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<div class="recommended_items">
    <!--recommended_items-->
    <h2 class="title text-center">recommended items</h2>

    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
                <?php $__currentLoopData = $related_product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $relate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="../public/uploads/product/<?php echo e($relate->product_image); ?>" class="card-img-top"
                                    alt="" />
                                <input id="quantity_relate"  type="number" min="0" max="" value="1" hidden />
                                <input id="product_id_relate"  type="hidden"
                                    value="<?php echo e($relate->product_id); ?>" />
                                <h2><?php echo e(number_format($relate->product_price).' '.'VND'); ?></h2>
                                <p><?php echo e($relate->product_name); ?></p>
                                <a href="#" class="btn btn-default btn-add-to-cart-relate"><i
                                        class="fa fa-shopping-cart"></i>Thêm
                                    vào giỏ hàng</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>
        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>
    </div>
</div>
<script src="<?php echo e(asset('public/frontend/js/jquery.js')); ?>"></script>
<script>
    $(document).ready(function(){
        //add-to-cart at product relate
		$('.btn-add-to-cart-relate').click(function(e){
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
			product_id_hidden: $(this).parent()[0].children[2].value,
			qty: $(this).parent()[0].children[1].value
		},
		success: function(result){
			$(".count_cart").text(result.cart_count);
			alert("Thêm sản phẩm vô giỏ hàng thành công!");
		},
		error: function(result){
			alert("Thêm sản phẩm vô giỏ hàng thất bại!");
        }});
        });

        //add-to-cart
        $('.btn-buy-now').click(function(e){
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
			product_id_hidden: $("#product_id_hidden").val(),
			qty: $("#quantity").val(),
            product_size: $('#product-size :selected').val()
		},
		success: function(result){
			$(".count_cart").text(result.cart_count);
			window.open("<?php echo e(URL::to('/show-cart')); ?>", "_self");
		},
		error: function(result){
			alert("Thêm sản phẩm vô giỏ hàng thất bại!");
        }});
        });

        //add-to-cart at product detail
        $('.btn-add-to-cart').click(function(e){
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
			product_id_hidden: $("#product_id_hidden").val(),
			qty: $("#quantity").val(),
            product_size: $('#product-size :selected').val()
		},
		success: function(result){
			$(".count_cart").text(result.cart_count);
			alert("Thêm sản phẩm vô giỏ hàng thành công!");
		},
		error: function(result){
			alert("Thêm sản phẩm vô giỏ hàng thất bại!");
        }});
        });

        //get quantity
        $('.product-size').click(function(){ 
            var product_id = $("#product_id_hidden").val();
            var product_size = $('#product-size :selected').val();
            $.ajax({
				url: "<?php echo e(url('/get-quantity')); ?>",
		        method: 'get',
		        data: {
			        product_id: product_id,
			        product_size: product_size
		        },  
				success: function(data) {
                    if(data.product_quantity <= 0)
                    {
                        $(".sold-out").text("Hết Hàng");
                        $(".show-quantity").text("");
                        $("#btn-add-to-cart").hide();
                        $("#btn-buy-now").hide();
                    }else{
                        $(".show-quantity").text("Còn Hàng");
                        $(".sold-out").text("");
                        $("#btn-add-to-cart").show();
                        $("#btn-buy-now").show();
                    }
                    $("#quantity").attr('max',data.product_quantity);
				}
			});
		});

            //get quantity auto show without click
            $.ajax({
				url: "<?php echo e(url('/get-quantity')); ?>",
		        method: 'get',
		        data: {
			        product_id: $("#product_id_hidden").val(),
			        product_size: $('#product-size :selected').val()
		        },  
				success: function(data) {
                    if(data.product_quantity <= 0)
                    {
                        $(".sold-out").text("Hết Hàng");
                        $(".show-quantity").text("");
                        $("#btn-add-to-cart").hide();
                        $("#btn-buy-now").hide();
                    }else{
                        $(".show-quantity").text("Còn Hàng");
                        $(".sold-out").text("");
                        $("#btn-add-to-cart").show();
                        $("#btn-buy-now").show();
                    }
                    $("#quantity").attr('max',data.product_quantity);
				}
			});
        
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\website-online\resources\views/pages/product/show_details.blade.php ENDPATH**/ ?>