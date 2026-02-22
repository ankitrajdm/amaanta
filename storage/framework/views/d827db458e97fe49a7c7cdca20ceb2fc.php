

<?php $__env->startSection('content'); ?>
<section class="section-padding">
	<div class="container">
		<div class="card">
			<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
				<h2 style="margin:0">Testimonials</h2>
				<a href="#" class="btn">Add Testimonial</a>
			</div>

			<div>
				<?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="card" style="margin-bottom:10px; display:flex; gap:12px; align-items:flex-start">
						<div style="flex:1">
							<div style="font-weight:700"><?php echo e($t->author_name); ?> <span style="color:#666; font-weight:500">— <?php echo e($t->author_title); ?></span></div>
							<div style="color:#444; margin-top:6px"><?php echo e($t->quote); ?></div>
						</div>
						<div style="display:flex; gap:8px; align-items:center">
							<a href="#" class="btn secondary">Edit</a>
						</div>
					</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', ['page_title' => 'Testimonials', 'settings' => $settings ?? []], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\amaanta\resources\views/admin/testimonials/index.blade.php ENDPATH**/ ?>