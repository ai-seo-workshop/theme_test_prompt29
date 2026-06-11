
<?php $__empty_1 = true; $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<div class="dlt4-list-card">
    <a href="<?php echo e($blog->url); ?>" class="dlt4-list-card-img-wrap">
        <img src="<?php echo e($blog->head_img); ?>" alt="<?php echo e($blog->head_img_alt); ?>" class="dlt4-list-card-img" loading="lazy">
    </a>
    <div class="dlt4-list-card-body">
        <a href="<?php echo e($blog->category ? $blog->category->url : '#'); ?>" class="dlt4-list-card-cat"><?php echo e($blog->category_name); ?></a>
        <div class="dlt4-list-card-title">
            <a href="<?php echo e($blog->url); ?>"><?php echo $blog->title; ?></a>
        </div>
        <p class="dlt4-list-card-summary"><?php echo $blog->summary; ?></p>
        <div class="dlt4-list-card-date"><?php echo e(date('M j, Y', strtotime($blog->published_at))); ?></div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
<div style="padding: 20px 0; color: var(--dlt4-text-muted);">
    <?php echo e(trans_theme('page_not_found')); ?>

</div>
<?php endif; ?>
<?php /**PATH /Library/WebServer/Documents/work/php/site_template/resources/views/themes/deliddedtech4/partials/article-list.blade.php ENDPATH**/ ?>