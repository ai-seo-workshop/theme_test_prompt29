
<?php if(isset($hotBlogs) && $hotBlogs->isNotEmpty()): ?>
<?php $heroMain = $hotBlogs->first(); ?>
<div class="dlt4-hero">

    















    
    <div class="dlt4-hero-list">
        <?php $__currentLoopData = $hotBlogs->skip(1)->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="dlt4-hero-item">
            <a href="<?php echo e($item->url); ?>">
                <img src="<?php echo e($item->head_img); ?>" alt="<?php echo e($item->head_img_alt); ?>" class="dlt4-hero-item-img" loading="lazy">
            </a>
            <div class="dlt4-hero-item-overlay">
                <a href="<?php echo e($item->category ? $item->category->url : '#'); ?>" class="dlt4-hero-item-cat"><?php echo $item->category_name; ?></a>
                <div class="dlt4-hero-item-title">
                    <a href="<?php echo e($item->url); ?>"><?php echo $item->title; ?></a>
                </div>
                <div class="dlt4-hero-item-date"><?php echo e(date('M j, Y', strtotime($item->published_at))); ?></div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

</div>
<?php endif; ?>
<?php /**PATH /Library/WebServer/Documents/work/php/site_template/resources/views/themes/deliddedtech4/partials/home-hero.blade.php ENDPATH**/ ?>