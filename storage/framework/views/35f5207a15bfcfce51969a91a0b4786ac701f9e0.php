<?php $__env->startSection('content'); ?>


<?php $__currentLoopData = $details_product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


<div class="product-details">
    <div class="col-sm-5">
        <div class="view-product">
            <img src="<?php echo e(URL::to('/public/uploads/product/'.$value ->product_image)); ?>" alt="" />
            <h3>ZOOM</h3>
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
        <div class="product-information">
            <!--/product-information-->
            <img src="images/product-details/new.jpg" class="newarrival" alt="" />
            <h2><?php echo e($value->product_name); ?></h2>
            <p>ID Product: <?php echo e($value->product_id); ?></p>
            <img src="images/product-details/rating.png" alt="" />
            <form action="<?php echo e(URL::to('/save-cart')); ?>" method="POST">
                <?php echo e(csrf_field()); ?>

                <?php
		            $current_url = url()->current();
	            ?>
                <input type="text" name="current_url_hidden" hidden readonly value="<?php echo e($current_url); ?>" />
                <span>
                    <span><?php echo e(number_format($value->product_price).' '.'VND'); ?></span>
                    <label>Quantity:</label>
                    <?php
							if($value->product_quantity <=0 ) { ?>
							<input name="qty" type="number" min="0" max="<?php echo e($value->product_quantity); ?>" value="0" />
							<?php
							}else{
							?>
							<input name="qty" type="number" min="0" max="<?php echo e($value->product_quantity); ?>" value="1" />
							<?php }?>
                    <input name="product_id_hidden" type="hidden" value="<?php echo e($value->product_id); ?>" />
                    <button type="submit" class="btn btn-fefault cart">
                        <i class="fa fa-shopping-cart"></i>
                        Add to cart
                    </button>
                </span>
            </form>
            <p><b>Số lượng:</b> <?php echo e($value->product_quantity); ?></p>
            <p><b>Trạng thái:</b> Hàng mới</p>
            <p><b>Thương hiệu:</b> <?php echo e($value->brand_name); ?> </p>
            <p><b>Danh mục:</b> <?php echo e($value->category_name); ?> </p>
            <a href=""><img src="images/product-details/share.png" class="share img-responsive" alt="" /></a>
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
                                <h2><?php echo e(number_format($relate->product_price).' '.'VND'); ?></h2>
                                <p><?php echo e($relate->product_name); ?></p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\website-online\resources\views/pages/product/show_details.blade.php ENDPATH**/ ?>