@extends('layouts.app')

@section('content')
<h1>{{ $page?->title ?? 'Contact' }}</h1>
<p>Phone: {{ $settings['contact_no'] ?? 'N/A' }}</p>
<p>Email: {{ $settings['contact_email'] ?? 'N/A' }}</p>
<p>Address: {{ $settings['address'] ?? 'N/A' }}</p>

<form method="POST" action="{{ route('contact.store') }}" style="display:grid; gap:0.5rem; max-width:500px;">
    @csrf
    <input name="name" placeholder="Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input name="phone" placeholder="Phone">
    <textarea name="message" placeholder="Message" required></textarea>
    <button type="submit">Submit Enquiry</button>
</form>
@endsection
