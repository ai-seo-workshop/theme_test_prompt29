
<div class="mng-section-label">
    <span><?php echo e(trans_theme('related_posts')); ?></span>
</div>
<?php $__empty_1 = true; $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<div class="mng-list-item">
    <div class="mng-list-item__img-wrap">
        <a href="<?php echo e($item->url); ?>">
            <img src="<?php echo e($item->head_img); ?>" alt="<?php echo e($item->head_img_alt); ?>" class="mng-list-item__img" loading="lazy">
        </a>
    </div>
    <div class="mng-list-item__body">
        <a href="<?php echo e($item->category ? $item->category->url : '#'); ?>" class="mng-cat-tag"><?php echo $item->category_name; ?></a>
        <span class="mng-time"> / <?php echo e(date('Y-m-d', strtotime($item->published_at))); ?></span>
        <div class="mng-list-item__title">
            <a href="<?php echo e($item->url); ?>"><?php echo $item->title; ?></a>
        </div>
        <p class="mng-list-item__excerpt"><?php echo $item->summary; ?></p>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
<p><?php echo e(trans_theme('page_not_found')); ?></p>
<?php endif; ?>
<?php /**PATH /Library/WebServer/Documents/work/php/site_template/resources/views/themes/mynewsgh/partials/article-list.blade.php ENDPATH**/ ?>