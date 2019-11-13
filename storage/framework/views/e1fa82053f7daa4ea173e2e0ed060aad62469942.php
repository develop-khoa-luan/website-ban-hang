<?php $__env->startSection('admin_content'); ?>

<div class="row">
    <div class="col-12 col-sm-9 col-md-9">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-6">
                <div class="card border border-primary mb-3">
                    <div class="card-header p-2 text-primary border-botton border-primary text-center">
                        Thông tin người mua
                    </div>
                    <div class="card-body">
                        <div class="card-form p-2">
                            <div class="row border-bottom">
                                <div class="col-12 col-sm-6 col-md-6 text-danger">
                                    Tên người mua:
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 text-dark">
                                    <?php echo e($order_by_id->customer_name); ?>

                                </div>
                            </div>
                        </div>
                        <div class="card-form p-2">
                            <div class="row border-bottom">
                                <div class="col-12 col-sm-6 col-md-6 text-danger">
                                    Email:
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 text-dark">
                                    <?php echo e($order_by_id->customer_email); ?>

                                </div>
                            </div>
                        </div>
                        <div class="card-form p-2">
                            <div class="row border-bottom">
                                <div class="col-12 col-sm-6 col-md-6 text-danger">
                                    Số điện thoại:
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 text-dark">
                                    <?php echo e($order_by_id->customer_phone); ?>

                                </div>
                            </div>
                        </div>
                        <div class="card-form p-2">
                            <div class="row border-bottom">
                                <div class="col-12 col-sm-6 col-md-6 text-danger">
                                    Ngày đặt:
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 text-dark">
                                    <?php echo e($order_by_id->created_at); ?>

                                </div>
                            </div>
                        </div>
                        <div class="card-form p-2">
                                <div class="row border-bottom">
                                    <div class="col-12 col-sm-6 col-md-6 text-danger">
                                        Trạng thái đơn hàng
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-6 text-dark">
                                        <?php echo e($order_by_id->order_status); ?>

                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6">
                <div class="card border border-primary mb-3">
                    <div class="card-header p-2 text-primary border-botton border-primary text-center">
                        Thông tin vận chuyển
                    </div>
                    <div class="card-body">
                        <div class="card-form p-2">
                            <div class="row border-bottom">
                                <div class="col-12 col-sm-6 col-md-6 text-danger">
                                    Tên người nhận:
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 text-dark">
                                    <?php echo e($order_by_id->shipping_name); ?>

                                </div>
                            </div>
                        </div>
                        <div class="card-form p-2">
                            <div class="row border-bottom">
                                <div class="col-12 col-sm-6 col-md-6 text-danger">
                                    Địa chỉ giao hàng:
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 text-dark">
                                    <?php echo e($order_by_id->shipping_address); ?>

                                </div>
                            </div>
                        </div>
                        <div class="card-form p-2">
                            <div class="row border-bottom">
                                <div class="col-12 col-sm-6 col-md-6 text-danger">
                                    Số điện thoại giao hàng:
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 text-dark">
                                    <?php echo e($order_by_id->shipping_phone); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card p-1 border border-primary">
                    <div class="card-header p-2 text-primary border-botton border-primary text-center">
                        Chi tiết đơn hàng
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="text-center">
                                        <th class="text-primary">Tên sản phẩm</th>
                                        <th class="text-primary">Số lượng</th>
                                        <th class="text-primary">Hàng Trong Kho</th>
                                        <th class="text-primary">Giá</th>
                                        <th class="text-primary">Chú ý</th>
                                        <th class="text-primary">Tổng tiền</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center content-center">
                                    <?php $__currentLoopData = $order_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $list_quantity_product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quantity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                       if($item->product_id == $quantity->product_id){ ?>

                                    <tr>
                                        <td><?php echo e($item->product_name); ?></td>
                                        <td><?php echo e(number_format($item->product_sales_quantity, 0)); ?></td>
                                        <td><?php echo e(number_format($quantity->product_quantity, 0)); ?></td>
                                        <td><?php echo e(number_format($item->product_price, 0)); ?></td>
                                        <td>
                                            <?php
                                                if($item->product_sales_quantity > $quantity->product_quantity){ ?>
                                            <span class="text-danger">Không đủ hàng</span>
                                            <?php }else {?>

                                            <?php }?>
                                        </td>
                                        <td><?php echo e(number_format($item->product_price*$item->product_sales_quantity, 0)); ?>

                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                <tfoot>
                                    <tr class="text-center">
                                        <th class="text-danger"></th>
                                        <th class="text-danger"><?php echo e(number_format($count_quantity, 0)); ?></th>
                                        <th class="text-danger"></th>
                                        <th class="text-danger"></th>
                                        <th class="text-danger"></th>
                                        <th class="text-danger"><?php echo e($order_by_id->order_total); ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-3 col-md-3">
        <div class="card p-1 border border-primary">
            <div class="card-header p-2 text-primary border-botton border-primary text-center">
                Hành động
            </div>
            <form role="form" action="<?php echo e(URL::to('/update-order/'.$order_by_id->order_id)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

            <div class="card-body">
                <div class="col-12">
                    <select name="order_status" class="col-12 form-control input-sm m-bot15">
                        <option value="Đang chờ xử lý">Đang chờ xử lý</option>
                        <option value="Xác nhận đơn hàng">Xác nhận đơn hàng</option>
                        <option value="Hủy đơn hàng">Hủy đơn hàng</option>
                        <option value="Xác nhận thanh toán">Xác nhận thanh toán</option>
                    </select>
                    <input type="submit" class="btn btn-primary col-12 mt-2" value="Xác Nhận" onclick="return confirm('Xác nhận cập nhập ?')" />
                    <a href="<?php echo e(URL::to('/manage-order')); ?>"><input type="button" class="btn btn-danger col-12 mt-2"
                            value="Hủy" /></a>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<script src="<?php echo e(asset('public/backend/vendor/jquery/jquery.min.js')); ?>"></script>
<script>

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\website-online\resources\views/admin/view_order.blade.php ENDPATH**/ ?>