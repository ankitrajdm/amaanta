

<?php $__env->startSection('content'); ?>
<!-- Hero Section -->
<?php
    // allow custom blog page header via a Page record with sections
    $hero = null;
    if(isset(
        $page) && $page && $page->sections) {
        $hero = $page->sections->first();
    }
?>
<section style="background: linear-gradient(135deg, var(--primary) 0%, rgba(100, 50, 150, 0.9) 100%); color: white; padding: 100px 0; text-align: center;">
    <div class="container">
        <h1 class="display-4 fw-bold mb-3" style="font-family: 'Playfair Display', serif;">
            <?php echo $hero->heading ?? 'Blog & Insights'; ?>

        </h1>
        <p class="lead">
            <?php echo $hero->content ?? 'Articles, tips, and stories from our world'; ?>

        </p>
        <?php if(isset($hero->meta['description'])): ?>
            <p class="mt-3"><?php echo $hero->meta['description']; ?></p>
        <?php endif; ?>
    </div>
</section>

<!-- Blog Content -->
<section>
    <div class="container">
        <div class="row g-5">
            <!-- Blog Posts -->
            <div class="col-lg-8">
                <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="card feature-card mb-4">
                        <?php if($post->featured_image): ?>
                            <img src="<?php echo e(strpos($post->featured_image, 'http') === 0 || strpos($post->featured_image, '/') === 0 ? $post->featured_image : asset('storage/' . $post->featured_image)); ?>" style="height: 300px; object-fit: cover;" alt="<?php echo e($post->title); ?>">
                        <?php else: ?>
                            <div style="height: 300px; background: linear-gradient(135deg, var(--accent), var(--primary)); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-newspaper fa-4x" style="color: rgba(255,255,255,0.3);"></i>
                            </div>
                        <?php endif; ?>
                        <div class="card-body">
                            <div class="mb-3">
                                <small class="text-muted">
                                    <i class="fas fa-calendar-alt"></i> <?php echo e($post->created_at->format('M d, Y')); ?>

                                </small>
                            </div>
                            <h3 class="card-title"><?php echo e($post->title); ?></h3>
                            <p class="card-text"><?php echo e(substr($post->excerpt ?? $post->content, 0, 200)); ?>...</p>
                            <div class="d-flex align-items-center justify-content-between">
                                <a href="<?php echo e(route('blog.detail', $post->slug)); ?>" class="btn btn-sm" style="background: var(--accent); color: #1a0033; border: none; text-decoration: none;">
                                    Read Full Article <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> No blog posts available at the moment.
                    </div>
                <?php endif; ?>

                <!-- Pagination -->
                <?php if($posts->hasPages()): ?>
                    <div class="d-flex justify-content-center mt-4">
                        <?php echo e($posts->links()); ?>

                    </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Search -->
                <div class="card mb-4" style="border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Search Articles</h5>
                        <form method="GET" action="<?php echo e(route('blog')); ?>">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search..." value="<?php echo e(request('search')); ?>">
                                <button class="btn" style="background: var(--primary); color: white; border: 1px solid var(--primary);" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Categories -->
                <?php if($categories->count() > 0): ?>
                    <div class="card mb-4" style="border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Categories</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <a href="<?php echo e(route('blog')); ?>" class="text-decoration-none" style="color: var(--primary);">
                                        <i class="fas fa-folder"></i> All Posts
                                    </a>
                                </li>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="mb-2">
                                        <a href="<?php echo e(route('blog', ['category' => $category->slug])); ?>" class="text-decoration-none" style="color: var(--primary);">
                                            <i class="fas fa-folder"></i> <?php echo e($category->name); ?>

                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Tags -->
                <?php if($popularTags->count() > 0): ?>
                    <div class="card" style="border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Popular Tags</h5>
                            <div>
                                <?php $__currentLoopData = $popularTags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(route('blog', ['tag' => $tag->slug])); ?>" class="badge" style="background: var(--primary); text-decoration: none; color: white; font-size: 0.85rem; padding: 0.5rem 0.75rem; margin: 0.25rem;">
                                        <?php echo e($tag->name); ?>

                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\amaanta\resources\views\pages\blog.blade.php ENDPATH**/ ?>