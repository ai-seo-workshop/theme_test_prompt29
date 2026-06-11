
<div class="dlt4-latest-row">

    
    <div class="dlt4-latest-col">
        <div class="dlt4-latest-section-label"><?php echo e(trans_theme('recent_posts')); ?></div>
        <?php if(isset($latestBlogs) && $latestBlogs->isNotEmpty()): ?>
        <div class="dlt4-latest-grid">
            <?php $__currentLoopData = $latestBlogs->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="dlt4-latest-card">
                <a href="<?php echo e($item->url); ?>" class="dlt4-latest-card-wrap">
                    <img src="<?php echo e($item->head_img); ?>" alt="<?php echo e($item->head_img_alt); ?>" class="dlt4-latest-card-img" loading="lazy">
                </a>
                <a href="<?php echo e($item->category ? $item->category->url : '#'); ?>" class="dlt4-latest-card-cat"><?php echo $item->category_name; ?></a>
                <div class="dlt4-latest-card-title">
                    <a href="<?php echo e($item->url); ?>"><?php echo $item->title; ?></a>
                </div>
                <div class="dlt4-latest-card-date"><?php echo e(date('M j, Y', strtotime($item->published_at))); ?></div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>
    </div>

    
    <div class="dlt4-popular-col">
        <div class="dlt4-popular-section-label"><?php echo e(trans_theme('popular_articles')); ?></div>
        <?php if(isset($hotBlogs) && $hotBlogs->isNotEmpty()): ?>
        <div class="dlt4-popular-list">
            <?php $__currentLoopData = $hotBlogs->take(7); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="dlt4-popular-item">
                <span class="dlt4-popular-num"><?php echo e($loop->iteration); ?></span>
                <div class="dlt4-popular-item-img">
                    <a href="<?php echo e($item->url); ?>">
                        <img src="<?php echo e($item->head_img); ?>" alt="<?php echo e($item->head_img_alt); ?>" loading="lazy">
                    </a>
                </div>
                <div class="dlt4-popular-item-title">
                    <a href="<?php echo e($item->url); ?>"><?php echo $item->title; ?></a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>
    </div>

</div>
<?php /**PATH /Library/WebServer/Documents/work/php/site_template/resources/views/themes/deliddedtech4/partials/home-latest.blade.php ENDPATH**/ ?>