
<aside class="dlt4-sidebar">

    
    <?php if(isset($sidebarPopular) && $sidebarPopular->isNotEmpty()): ?>
    <div class="dlt4-widget">
        <div class="dlt4-widget-title"><?php echo e(trans_theme('popular_articles')); ?></div>
        <?php $__currentLoopData = $sidebarPopular->take(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="dlt4-sidebar-item">
            <div class="dlt4-sidebar-item-img">
                <a href="<?php echo e($item->url); ?>">
                    <img src="<?php echo e($item->head_img); ?>" alt="<?php echo e($item->head_img_alt); ?>" loading="lazy">
                </a>
            </div>
            <div class="dlt4-sidebar-item-body">
                <a href="<?php echo e($item->url); ?>" class="dlt4-sidebar-item-title"><?php echo $item->title; ?></a>
                <div class="dlt4-sidebar-item-date"><?php echo e(date('M j, Y', strtotime($item->published_at))); ?></div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>

    
    <?php if(isset($sidebarRecommended) && $sidebarRecommended->isNotEmpty()): ?>
    <div class="dlt4-widget">
        <div class="dlt4-widget-title"><?php echo e(trans_theme('recent_posts')); ?></div>
        <?php $__currentLoopData = $sidebarRecommended->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="dlt4-sidebar-item">
            <div class="dlt4-sidebar-item-img">
                <a href="<?php echo e($item->url); ?>">
                    <img src="<?php echo e($item->head_img); ?>" alt="<?php echo e($item->head_img_alt); ?>" loading="lazy">
                </a>
            </div>
            <div class="dlt4-sidebar-item-body">
                <a href="<?php echo e($item->url); ?>" class="dlt4-sidebar-item-title"><?php echo $item->title; ?></a>
                <div class="dlt4-sidebar-item-date"><?php echo e(date('M j, Y', strtotime($item->published_at))); ?></div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>

</aside>
<?php /**PATH /Library/WebServer/Documents/work/php/site_template/resources/views/themes/deliddedtech4/partials/sidebar.blade.php ENDPATH**/ ?>