
<nav class="dlt4-breadcrumb" aria-label="breadcrumb">
    <ol>
<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li>
<?php if($item['url']): ?>
            <a href="<?php echo e($item['url']); ?>"><?php echo e($item['name']); ?></a>
<?php else: ?>
            <span><?php echo e($item['name']); ?></span>
<?php endif; ?>
        </li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ol>
</nav>
<?php /**PATH /Library/WebServer/Documents/work/php/site_template/resources/views/themes/deliddedtech4/partials/breadcrumb.blade.php ENDPATH**/ ?>