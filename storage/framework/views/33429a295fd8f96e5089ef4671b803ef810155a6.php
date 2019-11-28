<?php $__env->startSection('content'); ?>


<section id="cart_items">
    <div class="container" style="width: 100%">
        <div class="breadcrumbs" >
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('/')); ?>" >Home</a></li>
                <li class="active">Giỏ hàng</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <?php
                $content = Cart::content();
            ?>
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu" style="text-align:center">
                        <td class="description">Tên sản phẩm</td>
                        
                        <td class="price">Giá</td>
                        <td class="size">Size</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Tổng tiền</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php $total_order = 0 ?>
                    <?php $__currentLoopData = $content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v_content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr style="text-align:center">
                        
                        <td class="cart_description">
                            <a href="<?php echo e(URL::to('/chi-tiet-san-pham/'.$v_content->id)); ?>"><h5><?php echo e($v_content->name); ?></h5></a>
                        </td>
                        
                        <td class="cart_price">
                            <?php echo e(number_format($v_content->price).' '.'VND'); ?>

                        </td>
                        <td class="cart_size">&nbsp;&nbsp;<?php echo e($v_content->options->size); ?>

                        </td>
                        <td class="cart_quantity">
                            <form action="<?php echo e(URL::to('/update-cart-quanlity')); ?>" method="POST">
                                <?php echo e(csrf_field()); ?>

                                <input class="cart_quantity_input" type="number" min="0" max="" name="cart_qty" value="<?php echo e($v_content->qty); ?>">
                                
                                <input type="hidden" value="<?php echo e($v_content->rowId); ?>" name="rowId_cart" id="">
                                <input type="submit" style="margin-left: -20px" value="Cập nhật" name="update_qty" class="btn btn-default btn-sm">
                            </form>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">
                                <?php
                                    $subtotal = $v_content->price *  $v_content->qty;
                                    $total_order = $total_order + $subtotal;
                                    echo number_format($subtotal, 0).' '.'VND';
                                ?>
                            </p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="<?php echo e(URL::to('/delete-to-cart/'.$v_content->rowId)); ?>"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<section id="do_action">
    <div class="container">

        <div class="row">

            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Phí vận chuyển <span>Free</span></li>
                        <li>Tổng Tiền <span><?php echo e(number_format($total_order, 0).' '.'VND'); ?></span></li>
                    </ul>
                        <?php
                            $customer_id = Session::get('customer_id');
                            if($customer_id != NULL){
                        ?>
                        <a class="btn btn-default check_out" href="<?php echo e(URL::to('/checkout')); ?>">Thanh toán</a>
                        <?php
                        }else{	
                        ?>
                         <a class="btn btn-default check_out" href="<?php echo e(URL::to('/login-checkout')); ?>">Thanh toán</a>
                        <?php
                        }
                        ?>
                        
                </div>
            </div>
        </div>
    </div>
</section>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\website-online\resources\views/pages/cart/show_cart.blade.php ENDPATH**/ ?>