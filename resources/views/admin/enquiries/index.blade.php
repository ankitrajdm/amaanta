@extends('layouts.admin', ['page_title' => 'Enquiries', 'settings' => $settings ?? []])

@section('content')
<section class="section-padding">
	<div class="container">
		<div class="card">
			<h2 style="margin-top:0">Contact Enquiries</h2>
			<div style="overflow:auto">
				<table style="width:100%; border-collapse:collapse;">
					<thead>
						<tr style="border-bottom:1px solid #eee; text-align:left">
							<th style="padding:8px">Name</th>
							<th style="padding:8px">Email</th>
							<th style="padding:8px">Phone</th>
							<th style="padding:8px">Message</th>
							<th style="padding:8px">Date</th>
						</tr>
					</thead>
					<tbody>
					@foreach($enquiries as $enquiry)
						<tr>
							<td style="padding:10px">{{ $enquiry->name }}</td>
							<td style="padding:10px">{{ $enquiry->email }}</td>
							<td style="padding:10px">{{ $enquiry->phone }}</td>
							<td style="padding:10px">{{ \Illuminate\Support\Str::limit($enquiry->message, 80) }}</td>
							<td style="padding:10px">{{ $enquiry->created_at }}</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
			<div style="margin-top:12px">{{ $enquiries->links() }}</div>
		</div>
	</div>
</section>
@endsection
