<?php $__env->startSection('admin_content'); ?>
<form role="form" action="<?php echo e(URL::to('/save-coupon')); ?>" method="POST">
    <?php echo e(csrf_field()); ?>

    <?php
                $message = Session::get('message');
                if($message){
                    echo '<span style="color:red">' .$message. '</span>';
                    Session::put('message',null);
                }
        ?>
        <h3 class="h3 text-primary mt-4 mb-4">Thêm mã khuyến mãi</h3>
    <div class="row">
        <div class="col-lg-9 col-md-8">
            <div class="card m-1 border border-primary">
                <div class="card-header p-2 text-primary border-botton border-primary">
                    Nhập thông tin khuyến mãi
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Mã khuyến mãi</label>
                        <input type="text" name="coupon_name" maxlength="4" required class="form-control" id="exampleInputEmail1"
                            placeholder="Mã khuyến mãi...">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Phần trăm chiết khấu</label>
                        <input type="text" name="coupon_amount" class="form-control" id="exampleInputEmail1"
                            placeholder="Phần trăm chiết khấu...">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Trạng thái</label>
                        <select name="coupon_status" class="form-control input-sm m-bot15">
                            <option value="1" selected>Áp dụng</option>
                            <option value="0">Không áp dụng</option> 
                        </select>
                    </div>
                   
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4">
            <div class="card m-1 border border-primary">
                <div class="card-header p-2 text-primary border-botton border-primary">
                    Hành động
                </div>
                <div class="card-body">
                    <div class="col-12">
                        <button type="submit" id="btn-public" class="btn btn-success col-12">Thêm mới</button>
                    </div>
        
                    <div class="col-12">
                        <a href="<?php echo e(URL::to('/add-coupon')); ?>"><input type="button" class="btn btn-danger col-12 mt-2" value="Hủy"/></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="<?php echo e(asset('public/backend/vendor/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/backend/js/custom-js/brand.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\website-online\resources\views/admin/add_coupon.blade.php ENDPATH**/ ?>