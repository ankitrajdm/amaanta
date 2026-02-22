

<?php $__env->startSection('content'); ?>
<section class="section-padding">
	<div class="container">
		<div class="card">
			<h2 style="margin-top:0">Edit Page — <?php echo e($page->title); ?></h2>
			<form method="POST" action="<?php echo e(route('admin.pages.update', $page)); ?>"><?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
				<div style="margin-bottom:12px">
					<label>Title</label>
					<input name="title" value="<?php echo e($page->title); ?>" style="width:100%; padding:8px; margin-top:6px">
				</div>
				<div style="margin-bottom:12px">
					<label>Meta Title</label>
					<input name="meta_title" value="<?php echo e($page->meta_title); ?>" style="width:100%; padding:8px; margin-top:6px" placeholder="Meta title">
				</div>
				<div style="margin-bottom:12px">
					<label>Meta Description</label>
					<input name="meta_description" value="<?php echo e($page->meta_description); ?>" style="width:100%; padding:8px; margin-top:6px" placeholder="Meta description">
				</div>
				<div style="margin-bottom:12px">
					<label><input type="checkbox" name="is_active" value="1" <?php echo e($page->is_active ? 'checked' : ''); ?>> Active</label>
				</div>
				<button class="btn">Save Page</button>
			</form>
		</div>

		<div style="margin-top:16px">
			<?php $__currentLoopData = $page->sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="card" style="margin-bottom:12px">
					<h4 style="margin:0 0 8px 0">Section: <?php echo e($section->section_key); ?></h4>
					<form method="POST" action="<?php echo e(route('admin.sections.update', $section)); ?>" enctype="multipart/form-data"><?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
						<div style="margin-bottom:8px">
							<label>Heading</label>
							<input name="heading" value="<?php echo e($section->heading); ?>" style="width:100%; padding:8px; margin-top:6px">
						</div>
						<div style="margin-bottom:8px">
							<label>Content</label>
							<textarea name="content" style="width:100%; padding:8px; margin-top:6px"><?php echo e($section->content); ?></textarea>
						</div>
						<div style="margin-bottom:8px">
							<label>Section Image (optional)</label>
							<?php if(!empty($section->meta['image'])): ?>
								<div style="margin:6px 0"><img src="<?php echo e($section->meta['image']); ?>" alt="section image" style="max-height:120px; display:block"></div>
							<?php endif; ?>
							<input type="file" name="image" accept="image/*" style="margin-top:6px">
						</div>
						<div style="margin-bottom:8px">
							<label>Extra JSON meta (optional)</label>
							<textarea name="meta" placeholder='{"key":"value"}' style="width:100%; padding:8px; margin-top:6px"><?php echo e(json_encode($section->meta ?? [])); ?></textarea>
						</div>
						<div style="display:flex; gap:12px; align-items:center">
							<div>
								<label>Position</label>
								<input type="number" name="position" value="<?php echo e($section->position); ?>" style="width:80px; padding:6px; margin-left:6px">
							</div>
							<div>
								<label><input type="checkbox" name="is_active" value="1" <?php echo e($section->is_active ? 'checked' : ''); ?>> Active</label>
							</div>
							<div style="margin-left:auto">
								<button class="btn">Save Section</button>
							</div>
						</div>
					</form>
				</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	</div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', ['page_title' => 'Edit Page', 'settings' => $settings ?? []], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\amaanta\resources\views/admin/pages/edit.blade.php ENDPATH**/ ?>