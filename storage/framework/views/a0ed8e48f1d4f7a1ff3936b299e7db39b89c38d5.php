<?php if(!empty($errors) && $errors->has($name)): ?>
    <div class="text-danger">
        <small><?php echo e($errors->first($name)); ?></small>
    </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\botble\platform\core/base/resources/views//elements/forms/error.blade.php ENDPATH**/ ?>