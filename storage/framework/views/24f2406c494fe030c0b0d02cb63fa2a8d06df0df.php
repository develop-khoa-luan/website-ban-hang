<?php $__env->startSection('admin_content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Danh sách thông tin cần liên hệ</h1>
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
        <h6 class="m-0 font-weight-bold text-primary">Danh sách </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th>Stt</th>
                        <th>Họ tên</th>
                        <th style="width:100px">Email</th>
                        <th>Tiêu đề</th>
                        <th>Nội dung</th>
                        
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php $__currentLoopData = $all_contact_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($contact -> contact_id); ?></td>
                        <td><?php echo e($contact -> contact_name); ?></td>
                        <td><?php echo e($contact -> contact_email); ?></td>
                        <td><?php echo e($contact -> contact_subject); ?></td>
                        <td><?php echo e($contact -> contact_message); ?></td>
                        
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\website-online\resources\views/admin/all_contact_info.blade.php ENDPATH**/ ?>