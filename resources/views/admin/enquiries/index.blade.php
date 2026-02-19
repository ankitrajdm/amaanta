@extends('layouts.app')
@section('content')
<h1>Contact Enquiries</h1>
<table border="1" cellpadding="6" cellspacing="0" style="border-collapse:collapse; width:100%;">
<tr><th>Name</th><th>Email</th><th>Phone</th><th>Message</th><th>Date</th></tr>
@foreach($enquiries as $enquiry)
<tr>
<td>{{ $enquiry->name }}</td>
<td>{{ $enquiry->email }}</td>
<td>{{ $enquiry->phone }}</td>
<td>{{ $enquiry->message }}</td>
<td>{{ $enquiry->created_at }}</td>
</tr>
@endforeach
</table>
{{ $enquiries->links() }}
@endsection
