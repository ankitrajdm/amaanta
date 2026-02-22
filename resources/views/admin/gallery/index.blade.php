@extends('layouts.admin', ['page_title' => 'Gallery', 'settings' => $settings ?? []])

@section('content')
<section class="section-padding">
	<div class="container">
		<div class="card">
			<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
				<h2 style="margin:0">Memorybook / Gallery</h2>
				<form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data" style="display:flex; gap:8px; align-items:center; margin:0">
					@csrf
					<input type="text" name="title" placeholder="Title" required style="padding:8px">
					<input type="file" name="image" accept="image/*" required style="padding:6px">
					<input type="text" name="event_name" placeholder="Event / Event name" style="padding:8px">
					<button class="btn" type="submit">Upload</button>
				</form>
			</div>

			<div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(180px,1fr)); gap:12px">
				@foreach($images as $image)
					<div class="card" style="padding:8px; text-align:center">
						<div style="height:140px; background:#fafafa; display:flex; align-items:center; justify-content:center; margin-bottom:8px">
							<img src="{{ $image->image_path }}" alt="{{ $image->title }}" style="max-width:100%; max-height:100%">
						</div>
						<div style="font-weight:600">{{ $image->title }}</div>
						<div style="color:#666; font-size:13px">{{ $image->event_name }}</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
</section>
@endsection
