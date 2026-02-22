

<?php $__env->startSection('content'); ?>
<section class="section-padding">
	<div class="container">
		<div class="card">
			<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
				<h2 style="margin:0">Manage Pages</h2>
				<a href="#" class="btn">New Page</a>
			</div>

			<div style="overflow:auto">
				<table style="width:100%; border-collapse:collapse">
					<thead>
						<tr style="text-align:left; border-bottom:1px solid #eee">
							<th style="padding:8px">Title</th>
							<th style="padding:8px">Slug</th>
							<th style="padding:8px">Sections</th>
							<th style="padding:8px">Status</th>
							<th style="padding:8px">Actions</th>
						</tr>
					</thead>
					<tbody>
					<?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td style="padding:10px"><?php echo e($page->title); ?></td>
							<td style="padding:10px"><?php echo e($page->slug); ?></td>
							<td style="padding:10px"><?php echo e($page->sections_count); ?></td>
							<td style="padding:10px"><?php echo e($page->is_active ? 'Active' : 'Inactive'); ?></td>
							<td style="padding:10px">
								<a href="<?php echo e(route('admin.pages.edit', $page)); ?>" class="btn secondary">Edit</a>
							</td>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', ['page_title' => 'Pages', 'settings' => $settings ?? []], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\amaanta\resources\views/admin/pages/index.blade.php ENDPATH**/ ?>