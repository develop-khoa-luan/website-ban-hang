<?php $__env->startSection('content'); ?>
<div class="col-sm-9">
    <div class="blog-post-area">
        <h2 class="title text-center">Bản tin mới nhất</h2>
        <?php $__currentLoopData = $all_blog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="single-blog-post">
            <h3><?php echo e($blog->title); ?></h3>
            <div class="post-meta">
                <ul>
                    <li><i class="fa fa-user"></i> <?php echo e($blog->admin_name); ?></li>
                    <li><i class="fa fa-clock-o"></i><?php echo e(date('H:i', strtotime($blog->updated_at))); ?></li>
                    <li><i class="fa fa-calendar"></i><?php echo e(date('d-M-y', strtotime($blog->updated_at))); ?></li>
                </ul>
                <span>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half-o"></i>
                </span>
            </div>
            <a href="">
            <img src="<?php echo e(URL::to('/public/uploads/product/'.$blog->featured_image)); ?>" style="height: 390px; width: 846px" alt="">
            </a>
            <p><?php echo e($blog->alias); ?></p>
            <a class="btn btn-primary" href="<?php echo e(URL::to('/blog/'.$blog->id)); ?>">Đọc thêm</a>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div class="pagination-area">
            <ul class="pagination">
                <li><a href="" class="active">1</a></li>
                <li><a href="">2</a></li>
                <li><a href="">3</a></li>
                <li><a href=""><i class="fa fa-angle-double-right"></i></a></li>
            </ul>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\website-online\resources\views/pages/blog/blog.blade.php ENDPATH**/ ?>