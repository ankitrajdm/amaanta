@extends('layouts.admin', ['page_title' => 'Posts', 'settings' => $settings ?? []])

@section('content')
<section class="section-padding">
	<div class="container">
		<div class="card">
			<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
				<h2 style="margin:0">Posts / Blog Manager</h2>
				<a href="#" class="btn">New Post</a>
			</div>

			<div style="overflow:auto">
				<table style="width:100%; border-collapse:collapse">
					<thead>
						<tr style="text-align:left; border-bottom:1px solid #eee">
							<th style="padding:8px">Title</th>
							<th style="padding:8px">Category</th>
							<th style="padding:8px">Status</th>
							<th style="padding:8px">Actions</th>
						</tr>
					</thead>
					<tbody>
					@foreach($posts as $post)
						<tr>
							<td style="padding:10px">{{ $post->title }}</td>
							<td style="padding:10px">{{ $post->category }}</td>
							<td style="padding:10px">{{ $post->is_published ? 'Published' : 'Draft' }}</td>
							<td style="padding:10px">
								<a href="#" class="btn secondary">Edit</a>
								<a href="#" class="btn" style="margin-left:6px">View</a>
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>
@endsection
