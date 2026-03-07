

<?php $__env->startSection('title', isset($post) ? 'Edit Post' : 'Create New Post'); ?>
<?php $__env->startSection('page-title', isset($post) ? 'Edit Post' : 'Create New Post'); ?>

<?php $__env->startSection('content'); ?>
<!-- TinyMCE Editor CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tinymce@6/skins/ui/oxide/skin.min.css">
<div class="row mb-4">
    <div class="col-md-12">
        <h1><?php echo e(isset($post) ? 'Edit Post' : 'Create New Post'); ?></h1>
    </div>
</div>

<div class="row">
    <!-- Main Content Area -->
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-body">
                <form method="POST" action="<?php echo e(isset($post) ? route('admin.posts.update', $post) : route('admin.posts.store')); ?>" enctype="multipart/form-data" id="postForm">
                    <?php echo csrf_field(); ?>
                    <?php if(isset($post)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Post Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" value="<?php echo e(old('title', $post->title ?? '')); ?>" required class="form-control form-control-lg" placeholder="Enter post title">
                        <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger small mt-1"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Post Slug <span class="text-danger">*</span></label>
                        <input type="text" name="slug" value="<?php echo e(old('slug', $post->slug ?? '')); ?>" required class="form-control" placeholder="post-url-slug">
                        <small class="text-muted">Used for URLs. Must be unique.</small>
                        <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger small mt-1"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Post Excerpt <small class="text-muted">(Summary)</small></label>
                        <textarea name="excerpt" rows="3" class="form-control" placeholder="Brief summary of the post (optional)"><?php echo e(old('excerpt', $post->excerpt ?? '')); ?></textarea>
                        <small class="text-muted">This appears as a preview in listings.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Post Content <span class="text-danger">*</span></label>
                        <textarea name="content" required rows="12" class="form-control" id="contentEditor" placeholder="Write your detailed post content here..."><?php echo e(old('content', $post->content ?? '')); ?></textarea>
                        <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger small mt-1"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-3">
                        <label class="form-check-label fw-bold">
                            <input type="checkbox" name="is_published" value="1" <?php echo e(old('is_published', $post->is_published ?? false) ? 'checked' : ''); ?> class="form-check-input">
                            <strong>Publish this post</strong> (Make visible on website)
                        </label>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> <?php echo e(isset($post) ? 'Update Post' : 'Create Post'); ?></button>
                        <a href="<?php echo e(route('admin.posts.index')); ?>" class="btn btn-secondary"><i class="fas fa-times"></i> Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="col-md-4">
        <!-- Featured Image -->
        <div class="card mb-4">
            <div class="card-header bg-light">
                <h6 class="mb-0 fw-bold">Featured Image</h6>
            </div>
            <div class="card-body">
                <!-- Preview Section -->
                <div class="mb-3 text-center">
                    <?php if(isset($post) && $post->featured_image): ?>
                    <div id="imagePreview" class="mb-3">
                        <img src="<?php echo e($post->featured_image); ?>" alt="Featured Image" class="img-thumbnail" style="max-width: 100%; height: auto; max-height: 200px;">
                    </div>
                    <?php else: ?>
                    <div id="imagePreview" class="mb-3" style="display:none;">
                        <img id="previewImg" src="" alt="Preview" class="img-thumbnail" style="max-width: 100%; height: auto; max-height: 200px;">
                    </div>
                    <div id="noImage" class="text-muted py-4">
                        <i class="fas fa-image fa-3x mb-2 d-block opacity-50"></i>
                        <small>No image uploaded yet</small>
                    </div>
                    <?php endif; ?>
                </div>
                
                <!-- Upload Input -->
                <input type="file" name="featured_image" accept="image/jpg,image/jpeg,image/png,image/webp,image/gif" class="form-control" id="featuredImageInput" onchange="previewImage(event)">
                <small class="text-muted d-block mt-2">JPG, PNG, WEBP, GIF (Max 5MB)</small>
                
                <!-- Existing Images Gallery -->
                <div class="mt-4">
                    <label class="form-label fw-bold d-block mb-2">Or Select from Uploaded Images</label>
                    <div id="existingImages" class="row g-2">
                        <?php
                            try {
                                $files = \Illuminate\Support\Facades\Storage::disk('public')->files('blogs');
                                foreach ($files as $file) {
                                    $url = \Illuminate\Support\Facades\Storage::url($file);
                                    $filename = basename($file);
                                    echo '<div class="col-6">';
                                    echo '<div class="existing-image-thumbnail" onclick="selectExistingImage(\'' . $url . '\')" style="cursor:pointer; border:2px solid #ddd; border-radius:4px; padding:4px; transition:all 0.3s;">';
                                    echo '<img src="' . $url . '" alt="' . $filename . '" style="width:100%; height:80px; object-fit:cover; border-radius:2px;">';
                                    echo '<small class="d-block text-center mt-1 text-truncate">' . $filename . '</small>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                            } catch (\Exception $e) {
                                echo '<div class="alert alert-info mb-0"><small>No blog images uploaded yet</small></div>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Category -->
        <div class="card mb-4">
            <div class="card-header bg-light">
                <h6 class="mb-0 fw-bold">Category</h6>
            </div>
            <div class="card-body">
                <div class="input-group mb-2">
                    <select name="category" id="categorySelect" class="form-select">
                        <option value="">-- Select Category --</option>
                        <?php $__currentLoopData = \App\Models\Category::where('is_active', true)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cat->name); ?>" <?php echo e(old('category', $post->category ?? '') == $cat->name ? 'selected' : ''); ?>><?php echo e($cat->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#categoryModal" title="Add new category">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
                <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger small mt-1"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <!-- Tags -->
        <div class="card mb-4">
            <div class="card-header bg-light">
                <h6 class="mb-0 fw-bold">Tags</h6>
            </div>
            <div class="card-body">
                <div class="mb-2">
                    <input type="text" id="tagInput" class="form-control mb-2" placeholder="Type tag and press Enter">
                    <button type="button" class="btn btn-outline-primary btn-sm w-100" onclick="addTagFromInput()">
                        <i class="fas fa-plus"></i> Add Tag
                    </button>
                </div>
                <div id="selectedTags" class="mb-2">
                    <?php if(isset($post) && $post->tags->count() > 0): ?>
                        <?php $__currentLoopData = $post->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="badge bg-primary me-1 mb-1">
                                <?php echo e($tag->name); ?>

                                <button type="button" class="btn-close btn-close-white ms-1" onclick="removeTag(this)" data-tag-id="<?php echo e($tag->id); ?>"></button>
                            </span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
                <input type="hidden" name="tags" id="tagsInput" value="">
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('noImage').style.display = 'none';
            document.getElementById('imagePreview').style.display = 'block';
            document.getElementById('previewImg').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
}

function selectExistingImage(imageUrl) {
    // Show preview
    document.getElementById('noImage').style.display = 'none';
    document.getElementById('imagePreview').style.display = 'block';
    document.getElementById('previewImg').src = imageUrl;
    
    // Create hidden input to store the selected image URL
    let hiddenInput = document.getElementById('selectedImageUrl');
    if (!hiddenInput) {
        hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.id = 'selectedImageUrl';
        hiddenInput.name = 'selected_image_url';
        document.getElementById('postForm').appendChild(hiddenInput);
    }
    hiddenInput.value = imageUrl;
    
    // Highlight selected image
    document.querySelectorAll('.existing-image-thumbnail').forEach(el => {
        el.style.borderColor = '#ddd';
        el.style.borderWidth = '2px';
    });
    
    // Find the clicked thumbnail and highlight it
    document.querySelectorAll('.existing-image-thumbnail').forEach(el => {
        if (el.querySelector('img').src === imageUrl) {
            el.style.borderColor = '#28a745';
            el.style.borderWidth = '3px';
        }
    });
}

function addCategory(event) {
    event.preventDefault();
    const categoryName = document.getElementById('newCategoryName').value;
    
    fetch('<?php echo e(route("admin.categories.store")); ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ name: categoryName, is_active: true })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const select = document.getElementById('categorySelect');
            const option = document.createElement('option');
            option.value = data.name;
            option.textContent = data.name;
            option.selected = true;
            select.appendChild(option);
            
            document.getElementById('categoryForm').reset();
            bootstrap.Modal.getInstance(document.getElementById('categoryModal')).hide();
        }
    })
    .catch(error => alert('Error adding category: ' + error));
}

function addTagFromInput() {
    const input = document.getElementById('tagInput');
    const tagName = input.value.trim();
    if (tagName) {
        addTagToList(tagName);
        input.value = '';
    }
}

function addTagToList(tagName, tagId = null) {
    const container = document.getElementById('selectedTags');
    const span = document.createElement('span');
    span.className = 'badge bg-primary me-1 mb-1';
    span.innerHTML = tagName + ' <button type="button" class="btn-close btn-close-white ms-1" onclick="removeTag(this)"' + (tagId ? ' data-tag-id="' + tagId + '"' : '') + '></button>';
    container.appendChild(span);
    updateTagsInput();
}

function removeTag(btn) {
    btn.parentElement.remove();
    updateTagsInput();
}

function updateTagsInput() {
    const tags = Array.from(document.querySelectorAll('#selectedTags .badge')).map(el => {
        return el.textContent.trim().replace(/\s+$/, '');
    });
    document.getElementById('tagsInput').value = JSON.stringify(tags);
}

document.getElementById('tagInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        addTagFromInput();
    }
});
</script>

<!-- Add Category Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="categoryForm" onsubmit="addCategory(event)">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Category Name <span class="text-danger">*</span></label>
                        <input type="text" id="newCategoryName" class="form-control" required placeholder="e.g., Wedding Tips">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- TinyMCE Editor -->
<script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js"></script>
<script>
tinymce.init({
    selector: '#contentEditor',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | code',
    menu: {
        favs: { title: 'My Favorites', items: 'code visualaid' }
    },
    menubar: 'favs file edit view insert format tools table',
    height: 400,
    content_style: 'body { font-family:Segoe UI,Tahoma,Geneva,Verdana,sans-serif; font-size:14px }',
    setup: function(editor) {
        editor.on('change', function() {
            tinymce.triggerSave();
        });
    }
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\amaanta\resources\views/admin/posts/create.blade.php ENDPATH**/ ?>