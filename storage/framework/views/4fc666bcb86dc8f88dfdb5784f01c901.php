

<?php $__env->startSection('title', 'Edit Page: ' . $page->title); ?>

<?php $__env->startSection('content'); ?>
<div class="row mb-4">
    <div class="col-md-12">
        <h1>Edit Page: <?php echo e($page->title); ?></h1>
    </div>
</div>

<!-- Page Details Card -->
<div class="card mb-4">
    <div class="card-header bg-light">
        <h5 class="mb-0">Page Details</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="<?php echo e(route('admin.pages.update', $page)); ?>">
            <?php echo csrf_field(); ?> 
            <?php echo method_field('PUT'); ?>
            
            <div class="mb-3">
                <label for="title" class="form-label">Page Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                       id="title" name="title" value="<?php echo e(old('title', $page->title)); ?>" required>
                <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label">Page Slug <span class="text-danger">*</span></label>
                <input type="text" class="form-control <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                       id="slug" name="slug" value="<?php echo e(old('slug', $page->slug)); ?>" required>
                <small class="form-text text-muted">Use '/services', '/memorybook' routes here. Actual front-end route mapping may be swapped by admin rules.</small>
                <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-3">
                <label for="meta_title" class="form-label">Meta Title (SEO)</label>
                <input type="text" class="form-control <?php $__errorArgs = ['meta_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                       id="meta_title" name="meta_title" value="<?php echo e(old('meta_title', $page->meta_title)); ?>" 
                       maxlength="160" placeholder="Max 160 characters">
                <?php $__errorArgs = ['meta_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-3">
                <label for="meta_description" class="form-label">Meta Description (SEO)</label>
                <textarea class="form-control <?php $__errorArgs = ['meta_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                          id="meta_description" name="meta_description" rows="3" 
                          maxlength="255" placeholder="Max 255 characters"><?php echo e(old('meta_description', $page->meta_description)); ?></textarea>
                <?php $__errorArgs = ['meta_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1"
                           <?php echo e(old('is_active', $page->is_active) ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="is_active">
                        Publish Page
                    </label>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Save Page
                </button>
                <a href="<?php echo e(route('admin.pages.index')); ?>" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </div>
</div>

<!-- Page Sections -->
<div>
    <h3 class="mb-3">Page Sections</h3>
    
    <?php $__empty_1 = true; $__currentLoopData = $page->sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="card mb-4">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0">Section <?php echo e($loop->iteration); ?></h5>
                    <small class="text-muted">Key: <?php echo e($section->section_key ?? 'N/A'); ?></small>
                </div>
                <span class="badge <?php echo e($section->is_active ? 'bg-success' : 'bg-danger'); ?>">
                    <?php echo e($section->is_active ? 'Active' : 'Inactive'); ?>

                </span>
            </div>
            <div class="card-body">
                <form method="POST" action="<?php echo e(route('admin.sections.update', $section)); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?> 
                    <?php echo method_field('PUT'); ?>
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="heading_<?php echo e($section->id); ?>" class="form-label">Heading</label>
                                <input type="text" class="form-control" 
                                       id="heading_<?php echo e($section->id); ?>" name="heading" 
                                       value="<?php echo e(old('heading', $section->heading)); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="content_<?php echo e($section->id); ?>" class="form-label">Content (HTML allowed)</label>
                                <textarea class="form-control html-editor" id="content_<?php echo e($section->id); ?>" 
                                          name="content" rows="5"><?php echo e(old('content', $section->content)); ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="meta_description_<?php echo e($section->id); ?>" class="form-label">Description / extra text (optional)</label>
                                <textarea class="form-control html-editor" id="meta_description_<?php echo e($section->id); ?>" name="meta_description" rows="3"><?php echo e(old('meta_description', $section->meta['description'] ?? '')); ?></textarea>
                            </div>
                            <?php if($section->section_key === 'what_we_do'): ?>
                                <div class="mb-3">
                                    <label for="meta_button_text_<?php echo e($section->id); ?>" class="form-label">Button Text</label>
                                    <input type="text" class="form-control" id="meta_button_text_<?php echo e($section->id); ?>" name="meta_button_text" value="<?php echo e(old('meta_button_text', $section->meta['button_text'] ?? '')); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="meta_button_url_<?php echo e($section->id); ?>" class="form-label">Button URL</label>
                                    <input type="text" class="form-control" id="meta_button_url_<?php echo e($section->id); ?>" name="meta_button_url" value="<?php echo e(old('meta_button_url', $section->meta['button_url'] ?? '')); ?>">
                                </div>
                            <?php endif; ?>
                            <?php if($section->section_key === 'about_intro'): ?>
                                <div class="mb-3">
                                    <label for="meta_subheading_<?php echo e($section->id); ?>" class="form-label">Subheading</label>
                                    <input type="text" class="form-control" id="meta_subheading_<?php echo e($section->id); ?>" name="meta_subheading" value="<?php echo e(old('meta_subheading', $section->meta['subheading'] ?? '')); ?>">
                                </div>
                            <?php endif; ?>
                            <?php if($section->section_key === 'main_content'): ?>
                                <div class="mb-3">
                                    <label for="meta_subtitle_<?php echo e($section->id); ?>" class="form-label">Subtitle</label>
                                    <input type="text" class="form-control" id="meta_subtitle_<?php echo e($section->id); ?>" name="meta_subtitle" value="<?php echo e(old('meta_subtitle', $section->meta['subtitle'] ?? '')); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="meta_highlight_<?php echo e($section->id); ?>" class="form-label">Highlight Word</label>
                                    <input type="text" class="form-control" id="meta_highlight_<?php echo e($section->id); ?>" name="meta_highlight" value="<?php echo e(old('meta_highlight', $section->meta['highlight'] ?? '')); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="meta_bullet1_<?php echo e($section->id); ?>" class="form-label">Bullet Point 1 (HTML allowed)</label>
                                    <textarea class="form-control html-editor" id="meta_bullet1_<?php echo e($section->id); ?>" name="meta_bullet1" rows="2"><?php echo e(old('meta_bullet1', $section->meta['bullet1'] ?? '')); ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="meta_bullet2_<?php echo e($section->id); ?>" class="form-label">Bullet Point 2 (HTML allowed)</label>
                                    <textarea class="form-control html-editor" id="meta_bullet2_<?php echo e($section->id); ?>" name="meta_bullet2" rows="2"><?php echo e(old('meta_bullet2', $section->meta['bullet2'] ?? '')); ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="meta_image_<?php echo e($section->id); ?>" class="form-label">Section Image URL</label>
                                    <input type="text" class="form-control" id="meta_image_<?php echo e($section->id); ?>" name="meta_image" value="<?php echo e(old('meta_image', $section->meta['image'] ?? '')); ?>" placeholder="e.g., /assets/img/about.jfif">
                                </div>
                            <?php endif; ?>
                            <?php if(in_array($section->section_key, ['our_services', 'faq'])): ?>
                                <div class="mb-3">
                                    <label for="meta_subtitle_<?php echo e($section->id); ?>" class="form-label">Subtitle</label>
                                    <input type="text" class="form-control" id="meta_subtitle_<?php echo e($section->id); ?>" name="meta_subtitle" value="<?php echo e(old('meta_subtitle', $section->meta['subtitle'] ?? '')); ?>">
                                </div>
                            <?php endif; ?>
                            <?php if($section->section_key === 'faq'): ?>
                                <div class="mb-3">
                                    <label for="meta_faqs_<?php echo e($section->id); ?>" class="form-label">FAQs (JSON)</label>
                                    <textarea class="form-control" id="meta_faqs_<?php echo e($section->id); ?>" name="meta_faqs" rows="5" placeholder='[{"question":"Question 1", "answer":"Answer 1"}, ...]'><?php echo e(old('meta_faqs', json_encode($section->meta['faqs'] ?? []))); ?></textarea>
                                    <small class="form-text text-muted">Enter FAQs as JSON array of objects with 'question' and 'answer'.</small>
                                </div>
                            <?php endif; ?>
                            <?php if($section->section_key === 'services_section'): ?>
                                <div class="mb-3">
                                    <label for="meta_subtitle_<?php echo e($section->id); ?>" class="form-label">Subtitle</label>
                                    <input type="text" class="form-control" id="meta_subtitle_<?php echo e($section->id); ?>" name="meta_subtitle" value="<?php echo e(old('meta_subtitle', $section->meta['subtitle'] ?? '')); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="meta_highlight_<?php echo e($section->id); ?>" class="form-label">Highlight Word</label>
                                    <input type="text" class="form-control" id="meta_highlight_<?php echo e($section->id); ?>" name="meta_highlight" value="<?php echo e(old('meta_highlight', $section->meta['highlight'] ?? '')); ?>">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Service 1</h6>
                                        <div class="mb-3">
                                            <label for="meta_service1_title_<?php echo e($section->id); ?>" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="meta_service1_title_<?php echo e($section->id); ?>" name="meta_service1_title" value="<?php echo e(old('meta_service1_title', $section->meta['service1_title'] ?? '')); ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="meta_service1_content_<?php echo e($section->id); ?>" class="form-label">Content (HTML allowed)</label>
                                            <textarea class="form-control html-editor" id="meta_service1_content_<?php echo e($section->id); ?>" name="meta_service1_content" rows="3"><?php echo e(old('meta_service1_content', $section->meta['service1_content'] ?? '')); ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="meta_service1_image_<?php echo e($section->id); ?>" class="form-label">Image URL</label>
                                            <input type="text" class="form-control" id="meta_service1_image_<?php echo e($section->id); ?>" name="meta_service1_image" value="<?php echo e(old('meta_service1_image', $section->meta['service1_image'] ?? '')); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Service 2</h6>
                                        <div class="mb-3">
                                            <label for="meta_service2_title_<?php echo e($section->id); ?>" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="meta_service2_title_<?php echo e($section->id); ?>" name="meta_service2_title" value="<?php echo e(old('meta_service2_title', $section->meta['service2_title'] ?? '')); ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="meta_service2_content_<?php echo e($section->id); ?>" class="form-label">Content (HTML allowed)</label>
                                            <textarea class="form-control html-editor" id="meta_service2_content_<?php echo e($section->id); ?>" name="meta_service2_content" rows="3"><?php echo e(old('meta_service2_content', $section->meta['service2_content'] ?? '')); ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="meta_service2_image_<?php echo e($section->id); ?>" class="form-label">Image URL</label>
                                            <input type="text" class="form-control" id="meta_service2_image_<?php echo e($section->id); ?>" name="meta_service2_image" value="<?php echo e(old('meta_service2_image', $section->meta['service2_image'] ?? '')); ?>">
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Section Image</label>
                                <?php if(!empty($section->meta['image']) && $section->meta['image']): ?>
                                    <div class="mb-2">
                                        <img src="<?php echo e($section->meta['image']); ?>" alt="section" class="img-thumbnail" style="max-height: 150px;">
                                    </div>
                                <?php endif; ?>
                                <input type="file" class="form-control" name="image" accept="image/*">
                                <small class="form-text text-muted">Optional. Max 5MB</small>
                            </div>

                            <div class="mb-3">
                                <label for="position_<?php echo e($section->id); ?>" class="form-label">Position</label>
                                <input type="number" class="form-control" 
                                       id="position_<?php echo e($section->id); ?>" name="position" 
                                       value="<?php echo e(old('position', $section->position)); ?>" min="1" required>
                            </div>

                            <div class="mb-3">
                                <label for="meta_<?php echo e($section->id); ?>" class="form-label">Additional data (JSON)</label>
                                <textarea class="form-control" id="meta_<?php echo e($section->id); ?>" name="meta" rows="3" placeholder='{"key":"value"}'><?php echo e(old('meta', json_encode($section->meta ?? []))); ?></textarea>
                                <small class="form-text text-muted">Optional JSON structure for extra fields (e.g. short text, bullets, image URLs).</small>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" 
                                       id="is_active_<?php echo e($section->id); ?>" name="is_active" value="1"
                                       <?php echo e(old('is_active', $section->is_active) ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="is_active_<?php echo e($section->id); ?>">
                                    Active
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Section
                        </button>
                        <button type="button" class="btn btn-danger ms-2" onclick="if(confirm('Delete this section?')){document.getElementById('delete-section-<?php echo e($section->id); ?>').submit();}">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </div>
                </form>
                <form id="delete-section-<?php echo e($section->id); ?>" method="POST" action="<?php echo e(route('admin.sections.destroy', $section)); ?>" style="display:none;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                </form>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="alert alert-info">
            <p class="mb-0">This page has no sections yet.</p>
        </div>
    <?php endif; ?>

    <!-- add new section -->
    <div class="card mb-4 border-primary">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Add New Section</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="<?php echo e(route('admin.sections.store', $page)); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="new_section_key" class="form-label">Section Key</label>
                            <input type="text" class="form-control" id="new_section_key" name="section_key" placeholder="e.g. banner" required>
                        </div>
                        <div class="mb-3">
                            <label for="new_heading" class="form-label">Heading</label>
                            <input type="text" class="form-control" id="new_heading" name="heading" required>
                        </div>
                        <div class="mb-3">
                            <label for="new_content" class="form-label">Content</label>
                            <textarea class="form-control html-editor" id="new_content" name="content" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="new_meta_description" class="form-label">Description / additional text (optional)</label>
                            <textarea class="form-control html-editor" id="new_meta_description" name="meta_description" rows="3" placeholder="HTML allowed, used by some templates"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="new_meta_button_text" class="form-label">Button Text</label>
                            <input type="text" class="form-control" id="new_meta_button_text" name="meta_button_text">
                        </div>
                        <div class="mb-3">
                            <label for="new_meta_button_url" class="form-label">Button URL</label>
                            <input type="text" class="form-control" id="new_meta_button_url" name="meta_button_url">
                        </div>
                        <div class="mb-3">
                            <label for="new_meta" class="form-label">Other Meta JSON</label>
                            <textarea class="form-control" id="new_meta" name="meta" rows="2" placeholder='{"key":"value"}'></textarea>
                            <small class="form-text text-muted">Optional additional data (bullets, extra text, etc.)</small>
                        </div>
                        <div class="mb-3">
                            <label for="new_position" class="form-label">Position</label>
                            <input type="number" class="form-control" id="new_position" name="position" value="<?php echo e($page->sections->count() + 1); ?>" min="1" required>
                        </div>
                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="new_is_active" name="is_active" value="1" checked>
                            <label class="form-check-label" for="new_is_active">Active</label>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Section Image</label>
                            <input type="file" class="form-control" name="image" accept="image/*">
                            <small class="form-text text-muted">Optional. Max 5MB</small>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Add Section</button>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\amaanta\resources\views/admin/pages/edit.blade.php ENDPATH**/ ?>