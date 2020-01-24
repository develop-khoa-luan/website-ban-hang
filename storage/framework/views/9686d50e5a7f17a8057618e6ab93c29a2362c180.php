<?php $__env->startSection('admin_content'); ?>
<?php $__currentLoopData = $edit_coupon; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $edit_coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<form role="form" action="<?php echo e(URL::to('/update-coupon/'.$edit_coupon ->coupon_id)); ?>" method="POST">
    <?php echo e(csrf_field()); ?>

    <?php
                $message = Session::get('message');
                if($message){
                    echo '<span style="color:red">' .$message. '</span>';
                    Session::put('message',null);
                }
        ?>
        <h3 class="h3 text-primary mt-4 mb-4">Cập nhập thương hiệu sản phẩm</h3>
    <div class="row">
        <div class="col-lg-9 col-md-8">
            <div class="card m-1 border border-primary">
                <div class="card-header p-2 text-primary border-botton border-primary">
                    Nhập thông tin thương hiệu
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên thương hiệu</label>
                        <input type="text" name="coupon_name" class="form-control" id="exampleInputEmail1"
                        value="<?php echo e($edit_coupon->coupon_name); ?>">
                    </div>
                    

                    <div class="form-group">
                        <label for="exampleInputPassword1">Phần trăm chiết khấu</label>
                        <input type="text" name="coupon_amount" class="form-control" id="exampleInputEmail1"
                            placeholder="Phần trăm chiết khấu..." value="<?php echo e($edit_coupon->coupon_amount); ?>">
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
                        <button type="submit" id="btn-public" class="btn btn-success col-12">Hiển thị</button>
                    </div>
                    <div class="col-12">
                        <a href="<?php echo e(URL::to('/all-coupon')); ?>"><input type="button" class="btn btn-danger col-12 mt-2" value="Hủy"/></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="<?php echo e(asset('public/backend/vendor/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/backend/js/custom-js/coupon.js')); ?>"></script>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\website-online\resources\views/admin/edit_coupon.blade.php ENDPATH**/ ?>