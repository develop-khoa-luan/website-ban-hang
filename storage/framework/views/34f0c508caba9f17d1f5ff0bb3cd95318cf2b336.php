<?php $__env->startSection('admin_content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Quản lý thông tin khách hàng</h1>
<?php
        $message = Session::get('message');
        if($message){
                echo '<span style="color:red">' .$message. '</span>';
                Session::put('message',null);
        }
?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách khách hàng</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th>ID khách hàng</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        
                        <th>Xem chi tiết</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php $__currentLoopData = $all_customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $customer_pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($customer_pro -> customer_id); ?></td>
                        <td><?php echo e($customer_pro -> customer_name); ?></td>
                        <td><?php echo e($customer_pro -> customer_email); ?></td>
                        
                        <td style="text-align=center">
                            <a href="<?php echo e(URL::to('/view-customer/'.$customer_pro->customer_id)); ?>}" class="active"
                                ui-toggle-class="">
                                <i class="fa fa-edit text-success text-active"></i>
                            </a> 
                            
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\website-online\resources\views/admin/all_customer.blade.php ENDPATH**/ ?>