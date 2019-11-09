<?php $__env->startSection('content'); ?>
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('/trang-chu')); ?>">Home</a></li>
                <li class="active">Thanh toán giỏ hàng</li>
            </ol>
        </div>
    </div>
    <div class="review-payment">
        <h2>Xem lại giỏ hàng</h2>
    </div>
    <div class="table-responsive cart_info">
        <?php
                    $content = Cart::content();
                    // echo '<pre>';
                    // print_r($content);
                    // echo '<pre>';
                ?>
        <table class="table table-condensed">
            <thead>
                <tr class="cart_menu">
                    
                    <td class="description">Tên sản phẩm</td>
                    <td class="price">Giá</td>
                    <td class="quantity">Số lượng</td>
                    <td class="total">Tổng tiền</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v_content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr>
                    
                    <td class="cart_description">
                            <a href="<?php echo e(URL::to('/chi-tiet-san-pham/'.$v_content->id)); ?>"><h5><?php echo e($v_content->name); ?></h5></a>
                    </td>
                    <td class="cart_price">
                        <?php echo e(number_format($v_content->price).' '.'VND'); ?>

                    </td>
                    <td class="cart_quantity">
                        <form action="<?php echo e(URL::to('/update-cart-quanlity')); ?>" method="POST">
                            <?php echo e(csrf_field()); ?>

                            <input class="cart_quantity_input" type="number" name="cart_qty" value="<?php echo e($v_content->qty); ?>">
                            
                            <input type="hidden" value="<?php echo e($v_content->rowId); ?>" name="rowId_cart" id="">
                            <input type="submit" value="Cập nhật" name="update_qty" class="btn btn-default btn-sm">


                        </form>
                    </td>
                    <td class="cart_total">
                        <p class="cart_total_price">
                            <?php
                                        $subtotal = $v_content->price *  $v_content->qty;
                                        echo number_format($subtotal).' '.'VND';
                                    ?>
                        </p>
                    </td>
                    <td class="cart_delete">
                        <a class="cart_quantity_delete" href="<?php echo e(URL::to('/delete-to-cart/'.$v_content->rowId)); ?>"><i
                                class="fa fa-times"></i></a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <h4>Chọn hình thức thanh toán</h4>
    <form action="<?php echo e(URL::to('/order-place')); ?>" method="POST">
        <?php echo e(csrf_field()); ?>

        <div style="margin:40px 0; font-size: 20px" class="payment-options">
            <span>
                <label><input type="checkbox" name="payment_option" value="1"> Thanh toán qua thẻ ATM</label>
            </span>
            <span>
                <label><input type="checkbox" name="payment_option" value="2"> Thanh toán khi nhận hàng</label>
            </span>
            <span>
                <label><input type="checkbox" name="payment_option" value="3"> Thanh toán thẻ ghi nợ</label>
            </span>
            <input type="submit" value="Đặt hàng" style="width: 80px; height: 30px; margin-top: -10px" name="send_order_place" class="btn btn-primary btn-sm">
        </div>
    </form>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\website-online\resources\views/pages/checkout/payment.blade.php ENDPATH**/ ?>