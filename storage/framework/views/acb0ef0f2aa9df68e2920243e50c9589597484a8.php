<?php $__env->startSection('admin_content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Quản lý hóa đơn</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách sản phẩm</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Tên người đặt</th>
                        <th>Ngày đặt</th>
                        <th>Tổng giá tiền</th>
                        <th>tình trạng</th>
                        <th>Chú ý</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $all_order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($order -> customer_name); ?></td>
                        <td>...</td>
                        <td><?php echo e($order -> order_total); ?></td>
                        <td><?php echo e($order -> order_status); ?></td>
                        <td>...</td>
                        <td align="center">
                            <a href="<?php echo e(URL::to('/view-order/'.$order->order_id)); ?>}" class="active" ui-toggle-class="">
                                <i class="fa fa-edit text-success text-active"></i>
                            </a>
                            <a onclick="return confirm('Bạn có chắn chắc muốn xóa không ?')"
                                href="<?php echo e(URL::to('/delete-order/'.$order->order_id)); ?>}" class="active"
                                ui-toggle-class="">
                                <i class="fa fa-times text-danger text"></i>
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
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\website-online\resources\views/admin/manage_order.blade.php ENDPATH**/ ?>