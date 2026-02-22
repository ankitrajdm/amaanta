@extends('layouts.admin', ['page_title' => 'Edit Page', 'settings' => $settings ?? []])

@section('content')
<section class="section-padding">
	<div class="container">
		<div class="card">
			<h2 style="margin-top:0">Edit Page — {{ $page->title }}</h2>
			<form method="POST" action="{{ route('admin.pages.update', $page) }}">@csrf @method('PUT')
				<div style="margin-bottom:12px">
					<label>Title</label>
					<input name="title" value="{{ $page->title }}" style="width:100%; padding:8px; margin-top:6px">
				</div>
				<div style="margin-bottom:12px">
					<label>Meta Title</label>
					<input name="meta_title" value="{{ $page->meta_title }}" style="width:100%; padding:8px; margin-top:6px" placeholder="Meta title">
				</div>
				<div style="margin-bottom:12px">
					<label>Meta Description</label>
					<input name="meta_description" value="{{ $page->meta_description }}" style="width:100%; padding:8px; margin-top:6px" placeholder="Meta description">
				</div>
				<div style="margin-bottom:12px">
					<label><input type="checkbox" name="is_active" value="1" {{ $page->is_active ? 'checked' : '' }}> Active</label>
				</div>
				<button class="btn">Save Page</button>
			</form>
		</div>

		<div style="margin-top:16px">
			@foreach($page->sections as $section)
				<div class="card" style="margin-bottom:12px">
					<h4 style="margin:0 0 8px 0">Section: {{ $section->section_key }}</h4>
					<form method="POST" action="{{ route('admin.sections.update', $section) }}" enctype="multipart/form-data">@csrf @method('PUT')
						<div style="margin-bottom:8px">
							<label>Heading</label>
							<input name="heading" value="{{ $section->heading }}" style="width:100%; padding:8px; margin-top:6px">
						</div>
						<div style="margin-bottom:8px">
							<label>Content</label>
							<textarea name="content" style="width:100%; padding:8px; margin-top:6px">{{ $section->content }}</textarea>
						</div>
						<div style="margin-bottom:8px">
							<label>Section Image (optional)</label>
							@if(!empty($section->meta['image']))
								<div style="margin:6px 0"><img src="{{ $section->meta['image'] }}" alt="section image" style="max-height:120px; display:block"></div>
							@endif
							<input type="file" name="image" accept="image/*" style="margin-top:6px">
						</div>
						<div style="margin-bottom:8px">
							<label>Extra JSON meta (optional)</label>
							<textarea name="meta" placeholder='{"key":"value"}' style="width:100%; padding:8px; margin-top:6px">{{ json_encode($section->meta ?? []) }}</textarea>
						</div>
						<div style="display:flex; gap:12px; align-items:center">
							<div>
								<label>Position</label>
								<input type="number" name="position" value="{{ $section->position }}" style="width:80px; padding:6px; margin-left:6px">
							</div>
							<div>
								<label><input type="checkbox" name="is_active" value="1" {{ $section->is_active ? 'checked' : '' }}> Active</label>
							</div>
							<div style="margin-left:auto">
								<button class="btn">Save Section</button>
							</div>
						</div>
					</form>
				</div>
			@endforeach
		</div>
	</div>
</section>

@endsection
