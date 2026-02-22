@extends('layouts.admin', ['page_title' => 'Pages', 'settings' => $settings ?? []])

@section('content')
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
					@foreach($pages as $page)
						<tr>
							<td style="padding:10px">{{ $page->title }}</td>
							<td style="padding:10px">{{ $page->slug }}</td>
							<td style="padding:10px">{{ $page->sections_count }}</td>
							<td style="padding:10px">{{ $page->is_active ? 'Active' : 'Inactive' }}</td>
							<td style="padding:10px">
								<a href="{{ route('admin.pages.edit', $page) }}" class="btn secondary">Edit</a>
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
