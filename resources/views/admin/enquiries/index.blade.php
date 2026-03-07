@extends('admin.layout')

@section('title','Enquiries')
@section('page-title','Enquiries')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h1>Contact Enquiries</h1>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($enquiries as $enquiry)
                        <tr>
                            <td>{{ $enquiry->name }}</td>
                            <td>{{ $enquiry->email }}</td>
                            <td>{{ $enquiry->phone }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($enquiry->message, 80) }}</td>
                            <td>{{ $enquiry->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $enquiries->links() }}</div>
    </div>
</div>
@endsection
