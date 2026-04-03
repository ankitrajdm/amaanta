

<?php $__env->startSection('title', 'Edit Service Slider'); ?>
<?php $__env->startSection('page-title', 'Edit Service Slider'); ?>

<?php $__env->startSection('content'); ?>
<div class="row mb-4">
    <div class="col-md-12">
        <h1>Edit Service Image Slider</h1>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="<?php echo e(route('admin.slider.update', $slider)); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="mb-3">
                <label for="service_id" class="form-label">Select Service</label>
                <select name="service_id" id="service_id" class="form-control" required>
                    <option value="">-- Select Service --</option>
                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($service->id); ?>" <?php if($slider->service_id == $service->id): ?> selected <?php endif; ?>><?php echo e($service->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Slider Title</label>
                <input type="text" name="title" id="title" class="form-control" value="<?php echo e($slider->title); ?>" required>
            </div>
            <div class="mb-3">
                <label for="images" class="form-label">Upload Images (add more)</label>
                <input type="file" name="images[]" id="images" class="form-control" accept="image/*" multiple>
                <div id="image-preview" class="mt-3"></div>
            </div>
            <div class="mb-3">
                <label class="form-label">Current Images</label>
                <div>
                    <?php $__currentLoopData = $slider->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <img src="<?php echo e(asset('storage/' . ltrim($img->image_path, '/'))); ?>" alt="" width="60" style="margin:2px;">
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update Slider</button>
        </form>
    </div>
</div>

<script>
document.getElementById('images').addEventListener('change', function(e) {
    const preview = document.getElementById('image-preview');
    preview.innerHTML = '';
    Array.from(e.target.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.style.width = '100px';
            img.style.margin = '5px';
            preview.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\amaanta\resources\views\admin\slider\edit.blade.php ENDPATH**/ ?>