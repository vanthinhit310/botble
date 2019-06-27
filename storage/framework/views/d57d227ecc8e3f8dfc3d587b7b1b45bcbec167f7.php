<div id="edit-slug-box" <?php if(empty($value) && !$errors->has($name)): ?> class="hidden" <?php endif; ?>>
    <label class="control-label required" for="current-slug"><?php echo e(trans('core/base::forms.permalink')); ?>:</label>
    <span id="sample-permalink">
        <a class="permalink" target="_blank" href="<?php echo e(str_replace('--slug--', $value, url($prefix . '/' . config('packages.slug.general.pattern')))); ?><?php echo e($ending_url); ?>">
            <span class="default-slug"><?php echo e(url($prefix)); ?>/<span id="editable-post-name"><?php echo e($value); ?></span><?php echo e($ending_url); ?></span>
        </a>
    </span>
    ‎<span id="edit-slug-buttons">
        <button type="button" class="btn btn-secondary" id="change_slug"><?php echo e(trans('core/base::forms.edit')); ?></button>
        <button type="button" class="save btn btn-secondary" id="btn-ok"><?php echo e(trans('core/base::forms.ok')); ?></button>
        <button type="button" class="cancel button-link"><?php echo e(trans('core/base::forms.cancel')); ?></button>
    </span>
</div>
<input type="hidden" id="current-slug" name="<?php echo e($name); ?>" value="<?php echo e($value); ?>">
<div data-url="<?php echo e(route('slug.create')); ?>" data-view="<?php echo e(rtrim(str_replace('--slug--', '', url($prefix . '/' . config('packages.slug.general.pattern'))), '/') . '/'); ?>" id="slug_id" data-id="<?php echo e($id); ?>"></div>
<input type="hidden" name="slug_id" value="<?php echo e($id); ?>"><?php /**PATH C:\xampp\htdocs\botble\platform\packages/slug/resources/views//permalink.blade.php ENDPATH**/ ?>