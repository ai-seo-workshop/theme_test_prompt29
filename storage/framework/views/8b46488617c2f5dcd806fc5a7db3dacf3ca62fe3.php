
<?php if(isset($latestBlogs) && $latestBlogs->isNotEmpty()): ?>
<div class="mng-section-label">
    <span><?php echo e(trans_theme('popular_articles')); ?></span>
</div>
<div class="mng-grid-4">
<?php $__currentLoopData = $latestBlogs->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="mng-card">
        <div class="mng-card__img-wrap">
            <a href="<?php echo e($item->url); ?>">
                <img src="<?php echo e($item->head_img); ?>" alt="<?php echo e($item->head_img_alt); ?>" class="mng-card__img" loading="lazy">
            </a>
        </div>
        <div class="mng-card__body">
            <a href="<?php echo e($item->category ? $item->category->url : '#'); ?>" class="mng-cat-tag"><?php echo $item->category_name; ?></a>
            <span class="mng-time"> / <?php echo e(date('Y-m-d', strtotime($item->published_at))); ?></span>
            <div class="mng-card__title">
                <a href="<?php echo e($item->url); ?>"><?php echo $item->title; ?></a>
            </div>
            <p class="mng-card__excerpt"><?php echo $item->summary; ?></p>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php endif; ?>
<?php /**PATH /Library/WebServer/Documents/work/php/site_template/resources/views/themes/mynewsgh/partials/home-staff-pick.blade.php ENDPATH**/ ?>