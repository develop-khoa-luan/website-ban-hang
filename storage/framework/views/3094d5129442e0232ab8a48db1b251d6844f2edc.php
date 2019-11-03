 
<?php $__env->startSection('content'); ?>
<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Đăng nhập</h2>
                    <form action="#">
                        <input type="text" name="user_account" placeholder="Nhập tài khoản" />
                        <input type="password" name="password_account" placeholder="Nhập mật khẩu" />
                        <span>
                            <input type="checkbox" class="checkbox"> 
                            Ghi nhớ tài khoản
                        </span>
                        <button type="submit" class="btn btn-default">Đăng nhập</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">Hoặc</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>Đăng kí tài khoản</h2>
                <form action="<?php echo e(URL::to('/add-customer')); ?>" method="POST">
                        <?php echo e(csrf_field()); ?>

                        <input type="text" name="customer_name" placeholder="Nhập họ tên"/>
                        <input type="email" name="customer_email" placeholder="Nhập email"/>
                        <input type="password" name="customer_password" placeholder="Nhập mật khẩu"/>
                        <input type="text" name="customer_phone" placeholder="Nhập số điện thoại"/>
                        <button type="submit" class="btn btn-default">Đăng kí</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\website-online\resources\views/pages/checkout/login_checkout.blade.php ENDPATH**/ ?>