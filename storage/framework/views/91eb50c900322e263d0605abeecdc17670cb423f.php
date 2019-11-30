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
                <tr class="cart_menu" style="text-align:center">
                    
                    <td class="description">Tên sản phẩm</td>
                    <td class="price">Giá</td>
                    <td class="quantity">Số lượng</td>
                    <td class="total">Tổng tiền</td>
                    <td></td>
                </tr>
            </thead>
            <tbody style="text-align:center">
                <?php $total_order = 0 ?>
                <?php $__currentLoopData = $content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v_content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr>
                    
                    <td class="cart_description">
                            <a href="<?php echo e(URL::to('/chi-tiet-san-pham/'.$v_content->id)); ?>"><h5><?php echo e($v_content->name); ?></h5></a>
                    </td>
                    <td class="cart_price">
                        <?php echo e(number_format($v_content->price, 2).' '.'VND'); ?>

                    </td>
                    <td class="cart_quantity">
                        <form action="<?php echo e(URL::to('/update-cart-quanlity')); ?>" method="POST">
                            <?php echo e(csrf_field()); ?>

                            <input style="border:none; font-weight: bold; font-size: 18px"  class="cart_quantity_input" type="text" name="cart_qty" value="<?php echo e($v_content->qty); ?>">
                            
                            <input type="hidden" value="<?php echo e($v_content->rowId); ?>" name="rowId_cart" id="">
                            


                        </form>
                    </td>
                    <td class="cart_total">
                        <p class="cart_total_price">
                            <?php
                                        $subtotal = $v_content->price *  $v_content->qty;
                                        $total_order = $total_order + $subtotal;
                                        echo number_format($subtotal, 2).' '.'VND';
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

    <section id="do_action">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="total_area" style="    padding: 20px 25px 30px 0;margin-bottom: 20px">
                            <ul>
                                <li>Phí vận chuyển <span>Free</span></li>
                                <li>Tổng Tiền <span><?php echo e(number_format($total_order, 2).' '.'VND'); ?></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <h4>Chọn hình thức thanh toán</h4>
    <form action="<?php echo e(URL::to('/order-place')); ?>" method="POST">
        <?php echo e(csrf_field()); ?>

        <div style="margin:20px 10px; display: flex" class="payment-options">
            <select  name="payment_option" style="height: 40px; width: 40%">
                <option value="1" >
                    Thanh toán qua thẻ ATM
                </option>
                <option value="2" selected>
                    Thanh toán khi nhận hàng
                </option>
                <option value="3">
                    Thanh toán thẻ ghi nợ
                </option>
            </select>
            <input type="number" name="total_order" value=<?php echo e($total_order); ?> hidden>
            <input type="submit" value="Đặt hàng" style="width: 80px; height: 30px; font-size: 14px; margin: 5px 0 0 50px" name="send_order_place" class="btn btn-primary btn-sm">
            <button style=" width: auto; height: 30px; font-size: 14px; margin: 5px 0 0 20px; border: none; background-color: #FE980F" ><a style="color: white" href="<?php echo e(URL::to('/trang-chu')); ?>">Tiếp tục mua sắm</a></button>
        </div>
    </form>
</section>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\website-online\resources\views/pages/checkout/payment.blade.php ENDPATH**/ ?>