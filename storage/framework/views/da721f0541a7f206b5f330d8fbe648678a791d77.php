
<?php if(isset($categories) && $categories->isNotEmpty()): ?>
<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
    $articles = isset($categoryArticles[$category->id]) ? $categoryArticles[$category->id] : collect([]);
?>
<?php if($articles->isNotEmpty()): ?>
<div class="mng-cat-section">
    <div class="mng-section-label">
        <span><?php echo $category->name; ?></span>
    </div>

    
    <div class="mng-cat-section-top">
<?php $__currentLoopData = $articles->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="mng-cat-feature-card">
            <a href="<?php echo e($item->url); ?>">
                <img src="<?php echo e($item->head_img); ?>" alt="<?php echo e($item->head_img_alt); ?>" class="mng-cat-feature-card__img" loading="lazy">
            </a>
            <div class="mng-cat-feature-card__overlay">
                <a href="<?php echo e($item->category ? $item->category->url : '#'); ?>" class="mng-cat-badge"><?php echo $item->category_name; ?></a>
                <span class="mng-time"> / <?php echo e(date('Y-m-d', strtotime($item->published_at))); ?></span>
                <div class="mng-cat-feature-card__title">
                    <a href="<?php echo e($item->url); ?>"><?php echo $item->title; ?></a>
                </div>
            </div>
        </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <div class="mng-cat-section-bottom">
<?php $__currentLoopData = $articles->skip(2)->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="mng-cat-mini-card">
            <div class="mng-cat-mini-card__img-wrap">
                <a href="<?php echo e($item->url); ?>">
                    <img src="<?php echo e($item->head_img); ?>" alt="<?php echo e($item->head_img_alt); ?>" class="mng-cat-mini-card__img" loading="lazy">
                </a>
            </div>
            <div class="mng-cat-mini-card__body">
                <a href="<?php echo e($item->category ? $item->category->url : '#'); ?>" class="mng-cat-tag"><?php echo e($item->category_name); ?></a>
                <span class="mng-time"> / <?php echo e(date('Y-m-d', strtotime($item->published_at))); ?></span>
                <div class="mng-cat-mini-card__title">
                    <a href="<?php echo e($item->url); ?>"><?php echo $item->title; ?></a>
                </div>
            </div>
        </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php /**PATH /Library/WebServer/Documents/work/php/site_template/resources/views/themes/mynewsgh/partials/home-category-section.blade.php ENDPATH**/ ?>