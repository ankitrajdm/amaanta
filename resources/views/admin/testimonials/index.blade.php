@extends('layouts.admin', ['page_title' => 'Testimonials', 'settings' => $settings ?? []])

@section('content')
<section class="section-padding">
	<div class="container">
		<div class="card">
			<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
				<h2 style="margin:0">Testimonials</h2>
				<a href="#" class="btn">Add Testimonial</a>
			</div>

			<div>
				@foreach($testimonials as $t)
					<div class="card" style="margin-bottom:10px; display:flex; gap:12px; align-items:flex-start">
						<div style="flex:1">
							<div style="font-weight:700">{{ $t->author_name }} <span style="color:#666; font-weight:500">— {{ $t->author_title }}</span></div>
							<div style="color:#444; margin-top:6px">{{ $t->quote }}</div>
						</div>
						<div style="display:flex; gap:8px; align-items:center">
							<a href="#" class="btn secondary">Edit</a>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
</section>
@endsection
