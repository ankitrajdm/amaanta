@extends('admin.layout')

@section('title', 'Edit Page: ' . $page->title)

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h1>Edit Page: {{ $page->title }}</h1>
    </div>
</div>

<!-- Page Details Card -->
<div class="card mb-4">
    <div class="card-header bg-light">
        <h5 class="mb-0">Page Details</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.pages.update', $page) }}">
            @csrf 
            @method('PUT')
            
            <div class="mb-3">
                <label for="title" class="form-label">Page Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                       id="title" name="title" value="{{ old('title', $page->title) }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="meta_title" class="form-label">Meta Title (SEO)</label>
                <input type="text" class="form-control @error('meta_title') is-invalid @enderror" 
                       id="meta_title" name="meta_title" value="{{ old('meta_title', $page->meta_title) }}" 
                       maxlength="160" placeholder="Max 160 characters">
                @error('meta_title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="meta_description" class="form-label">Meta Description (SEO)</label>
                <textarea class="form-control @error('meta_description') is-invalid @enderror" 
                          id="meta_description" name="meta_description" rows="3" 
                          maxlength="255" placeholder="Max 255 characters">{{ old('meta_description', $page->meta_description) }}</textarea>
                @error('meta_description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1"
                           {{ old('is_active', $page->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">
                        Publish Page
                    </label>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Save Page
                </button>
                <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </div>
</div>

<!-- Page Sections -->
<div>
    <h3 class="mb-3">Page Sections</h3>
    
    @forelse($page->sections as $section)
        <div class="card mb-4">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0">Section {{ $loop->iteration }}</h5>
                    <small class="text-muted">Key: {{ $section->section_key ?? 'N/A' }}</small>
                </div>
                <span class="badge {{ $section->is_active ? 'bg-success' : 'bg-danger' }}">
                    {{ $section->is_active ? 'Active' : 'Inactive' }}
                </span>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.sections.update', $section) }}" enctype="multipart/form-data">
                    @csrf 
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="heading_{{ $section->id }}" class="form-label">Heading</label>
                                <input type="text" class="form-control" 
                                       id="heading_{{ $section->id }}" name="heading" 
                                       value="{{ old('heading', $section->heading) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="content_{{ $section->id }}" class="form-label">Content (HTML allowed)</label>
                                <textarea class="form-control html-editor" id="content_{{ $section->id }}" 
                                          name="content" rows="5">{{ old('content', $section->content) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="meta_description_{{ $section->id }}" class="form-label">Description / extra text (optional)</label>
                                <textarea class="form-control html-editor" id="meta_description_{{ $section->id }}" name="meta_description" rows="3">{{ old('meta_description', $section->meta['description'] ?? '') }}</textarea>
                            </div>
                            @if($section->section_key === 'what_we_do')
                                <div class="mb-3">
                                    <label for="meta_button_text_{{ $section->id }}" class="form-label">Button Text</label>
                                    <input type="text" class="form-control" id="meta_button_text_{{ $section->id }}" name="meta_button_text" value="{{ old('meta_button_text', $section->meta['button_text'] ?? '') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="meta_button_url_{{ $section->id }}" class="form-label">Button URL</label>
                                    <input type="text" class="form-control" id="meta_button_url_{{ $section->id }}" name="meta_button_url" value="{{ old('meta_button_url', $section->meta['button_url'] ?? '') }}">
                                </div>
                            @endif
                            @if($section->section_key === 'about_intro')
                                <div class="mb-3">
                                    <label for="meta_subheading_{{ $section->id }}" class="form-label">Subheading</label>
                                    <input type="text" class="form-control" id="meta_subheading_{{ $section->id }}" name="meta_subheading" value="{{ old('meta_subheading', $section->meta['subheading'] ?? '') }}">
                                </div>
                            @endif
                            @if($section->section_key === 'main_content')
                                <div class="mb-3">
                                    <label for="meta_subtitle_{{ $section->id }}" class="form-label">Subtitle</label>
                                    <input type="text" class="form-control" id="meta_subtitle_{{ $section->id }}" name="meta_subtitle" value="{{ old('meta_subtitle', $section->meta['subtitle'] ?? '') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="meta_highlight_{{ $section->id }}" class="form-label">Highlight Word</label>
                                    <input type="text" class="form-control" id="meta_highlight_{{ $section->id }}" name="meta_highlight" value="{{ old('meta_highlight', $section->meta['highlight'] ?? '') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="meta_bullet1_{{ $section->id }}" class="form-label">Bullet Point 1 (HTML allowed)</label>
                                    <textarea class="form-control html-editor" id="meta_bullet1_{{ $section->id }}" name="meta_bullet1" rows="2">{{ old('meta_bullet1', $section->meta['bullet1'] ?? '') }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="meta_bullet2_{{ $section->id }}" class="form-label">Bullet Point 2 (HTML allowed)</label>
                                    <textarea class="form-control html-editor" id="meta_bullet2_{{ $section->id }}" name="meta_bullet2" rows="2">{{ old('meta_bullet2', $section->meta['bullet2'] ?? '') }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="meta_image_{{ $section->id }}" class="form-label">Section Image URL</label>
                                    <input type="text" class="form-control" id="meta_image_{{ $section->id }}" name="meta_image" value="{{ old('meta_image', $section->meta['image'] ?? '') }}" placeholder="e.g., /assets/img/about.jfif">
                                </div>
                            @endif
                            @if(in_array($section->section_key, ['our_services', 'faq']))
                                <div class="mb-3">
                                    <label for="meta_subtitle_{{ $section->id }}" class="form-label">Subtitle</label>
                                    <input type="text" class="form-control" id="meta_subtitle_{{ $section->id }}" name="meta_subtitle" value="{{ old('meta_subtitle', $section->meta['subtitle'] ?? '') }}">
                                </div>
                            @endif
                            @if($section->section_key === 'faq')
                                <div class="mb-3">
                                    <label for="meta_faqs_{{ $section->id }}" class="form-label">FAQs (JSON)</label>
                                    <textarea class="form-control" id="meta_faqs_{{ $section->id }}" name="meta_faqs" rows="5" placeholder='[{"question":"Question 1", "answer":"Answer 1"}, ...]'>{{ old('meta_faqs', json_encode($section->meta['faqs'] ?? [])) }}</textarea>
                                    <small class="form-text text-muted">Enter FAQs as JSON array of objects with 'question' and 'answer'.</small>
                                </div>
                            @endif
                            @if($section->section_key === 'services_section')
                                <div class="mb-3">
                                    <label for="meta_subtitle_{{ $section->id }}" class="form-label">Subtitle</label>
                                    <input type="text" class="form-control" id="meta_subtitle_{{ $section->id }}" name="meta_subtitle" value="{{ old('meta_subtitle', $section->meta['subtitle'] ?? '') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="meta_highlight_{{ $section->id }}" class="form-label">Highlight Word</label>
                                    <input type="text" class="form-control" id="meta_highlight_{{ $section->id }}" name="meta_highlight" value="{{ old('meta_highlight', $section->meta['highlight'] ?? '') }}">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Service 1</h6>
                                        <div class="mb-3">
                                            <label for="meta_service1_title_{{ $section->id }}" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="meta_service1_title_{{ $section->id }}" name="meta_service1_title" value="{{ old('meta_service1_title', $section->meta['service1_title'] ?? '') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="meta_service1_content_{{ $section->id }}" class="form-label">Content (HTML allowed)</label>
                                            <textarea class="form-control html-editor" id="meta_service1_content_{{ $section->id }}" name="meta_service1_content" rows="3">{{ old('meta_service1_content', $section->meta['service1_content'] ?? '') }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="meta_service1_image_{{ $section->id }}" class="form-label">Image URL</label>
                                            <input type="text" class="form-control" id="meta_service1_image_{{ $section->id }}" name="meta_service1_image" value="{{ old('meta_service1_image', $section->meta['service1_image'] ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Service 2</h6>
                                        <div class="mb-3">
                                            <label for="meta_service2_title_{{ $section->id }}" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="meta_service2_title_{{ $section->id }}" name="meta_service2_title" value="{{ old('meta_service2_title', $section->meta['service2_title'] ?? '') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="meta_service2_content_{{ $section->id }}" class="form-label">Content (HTML allowed)</label>
                                            <textarea class="form-control html-editor" id="meta_service2_content_{{ $section->id }}" name="meta_service2_content" rows="3">{{ old('meta_service2_content', $section->meta['service2_content'] ?? '') }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="meta_service2_image_{{ $section->id }}" class="form-label">Image URL</label>
                                            <input type="text" class="form-control" id="meta_service2_image_{{ $section->id }}" name="meta_service2_image" value="{{ old('meta_service2_image', $section->meta['service2_image'] ?? '') }}">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Section Image</label>
                                @if(!empty($section->meta['image']) && $section->meta['image'])
                                    <div class="mb-2">
                                        <img src="{{ $section->meta['image'] }}" alt="section" class="img-thumbnail" style="max-height: 150px;">
                                    </div>
                                @endif
                                <input type="file" class="form-control" name="image" accept="image/*">
                                <small class="form-text text-muted">Optional. Max 5MB</small>
                            </div>

                            <div class="mb-3">
                                <label for="position_{{ $section->id }}" class="form-label">Position</label>
                                <input type="number" class="form-control" 
                                       id="position_{{ $section->id }}" name="position" 
                                       value="{{ old('position', $section->position) }}" min="1" required>
                            </div>

                            <div class="mb-3">
                                <label for="meta_{{ $section->id }}" class="form-label">Additional data (JSON)</label>
                                <textarea class="form-control" id="meta_{{ $section->id }}" name="meta" rows="3" placeholder='{"key":"value"}'>{{ old('meta', json_encode($section->meta ?? [])) }}</textarea>
                                <small class="form-text text-muted">Optional JSON structure for extra fields (e.g. short text, bullets, image URLs).</small>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" 
                                       id="is_active_{{ $section->id }}" name="is_active" value="1"
                                       {{ old('is_active', $section->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active_{{ $section->id }}">
                                    Active
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Section
                        </button>
                        <button type="button" class="btn btn-danger ms-2" onclick="if(confirm('Delete this section?')){document.getElementById('delete-section-{{ $section->id }}').submit();}">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </div>
                </form>
                <form id="delete-section-{{ $section->id }}" method="POST" action="{{ route('admin.sections.destroy', $section) }}" style="display:none;">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    @empty
        <div class="alert alert-info">
            <p class="mb-0">This page has no sections yet.</p>
        </div>
    @endforelse

    <!-- add new section -->
    <div class="card mb-4 border-primary">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Add New Section</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.sections.store', $page) }}" enctype="multipart/form-data">
                @csrf
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
                            <input type="number" class="form-control" id="new_position" name="position" value="{{ $page->sections->count() + 1 }}" min="1" required>
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

@endsection
