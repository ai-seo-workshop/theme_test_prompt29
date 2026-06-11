
<?php
    $featuredPost = isset($hotBlogs) ? $hotBlogs->first() : null;
    $leftItems    = isset($hotBlogs) ? $hotBlogs->skip(1)->take(2) : collect();
    $rightItems   = isset($hotBlogs) ? $hotBlogs->skip(3)->take(5) : collect();
?>

<?php if($featuredPost): ?>
<div class="mng-hero">

    
    <div class="mng-hero-left">
<?php $__currentLoopData = $leftItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="mng-hero-left-item">
            <a href="<?php echo e($item->url); ?>">
                <img src="<?php echo e($item->head_img); ?>" alt="<?php echo e($item->head_img_alt); ?>" class="mng-hero-left-item__img" loading="lazy">
            </a>
            <div class="mng-hero-left-item__body">
                <a href="<?php echo e($item->category ? $item->category->url : '#'); ?>" class="mng-cat-tag"><?php echo $item->category_name; ?></a>
                <span class="mng-time"> / <?php echo e(date('Y-m-d', strtotime($item->published_at))); ?></span>
                <div class="mng-hero-left-item__title">
                    <a href="<?php echo e($item->url); ?>"><?php echo $item->title; ?></a>
                </div>
            </div>
        </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <div class="mng-hero-center">
        <a href="<?php echo e($featuredPost->url); ?>">
            <img src="<?php echo e($featuredPost->head_img); ?>" alt="<?php echo e($featuredPost->head_img_alt); ?>" class="mng-hero-center__img" loading="eager">
        </a>
        <div class="mng-hero-center__overlay">
            <a href="<?php echo e($featuredPost->category ? $featuredPost->category->url : '#'); ?>" class="mng-cat-badge"><?php echo $featuredPost->category_name; ?></a>
            <span class="mng-time" style="color: #fff"> / <?php echo e(date('Y-m-d', strtotime($featuredPost->published_at))); ?></span>
            <div class="mng-hero-center__title">
                <a href="<?php echo e($featuredPost->url); ?>"><?php echo $featuredPost->title; ?></a>
            </div>
            <p class="mng-hero-center__summary"><?php echo $featuredPost->summary; ?></p>
        </div>
    </div>

    
    <div class="mng-hero-right">
<?php $__currentLoopData = $rightItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="mng-hero-right-item">
            <div class="mng-hero-right-item__img">
                <a href="<?php echo e($item->url); ?>">
                    <img src="<?php echo e($item->head_img); ?>" alt="<?php echo e($item->head_img_alt); ?>" loading="lazy">
                </a>
            </div>
            <div class="mng-hero-right-item__body">
                <a href="<?php echo e($item->category ? $item->category->url : '#'); ?>" class="mng-cat-tag"><?php echo $item->category_name; ?></a>
                <span class="mng-time"> / <?php echo e(date('Y-m-d', strtotime($item->published_at))); ?></span>
                <div class="mng-hero-right-item__title">
                    <a href="<?php echo e($item->url); ?>"><?php echo $item->title; ?></a>
                </div>
            </div>
        </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

</div>
<?php endif; ?>
<?php /**PATH /Library/WebServer/Documents/work/php/site_template/resources/views/themes/mynewsgh/partials/home-hero.blade.php ENDPATH**/ ?>