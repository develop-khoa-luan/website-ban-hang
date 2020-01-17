 
<?php $__env->startSection('content'); ?>
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('/')); ?>">Trang chủ</a></li>
                <li class="active">Thanh toán</li>
            </ol>
        </div><!--/breadcrums-->



        <div class="shopper-informations">
            <div class="row">
                
                <div class="col-sm-12 clearfix">
                    <div class="bill-to">
                        <p>Điền thông tin giao hàng</p>
                        <div class="form-one">
                            <form action="<?php echo e(URL::to('/save-checkout-customer')); ?>" method="POST">
                                <?php echo e(csrf_field()); ?>

                                <input type="text" name="shipping_email" placeholder="Email*">
                                <input type="text" name="shipping_name" placeholder="Họ tên *">
                                <input type="text" name="shipping_address" placeholder="Địa chỉ *">
                                <input type="text" name="shipping_phone" placeholder="Số điện thoại">
                                <textarea name="shipping_notes"  placeholder="Ghi chú đơn hàng" rows="16"></textarea>
                                <input type="submit" value="Gửi" name="send_order" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
               				
            </div>
        </div>
    
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\website-online\resources\views/pages/checkout/show_checkout.blade.php ENDPATH**/ ?>