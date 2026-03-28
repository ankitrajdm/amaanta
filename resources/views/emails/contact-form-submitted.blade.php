@extends('layouts.email')

@section('content')
<div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;">
    <h2 style="color: #333;">New Contact Form Submission</h2>

    <div style="background-color: #f9f9f9; padding: 20px; margin: 20px 0; border-radius: 5px;">
        <h3>Contact Details:</h3>
        <p><strong>Name:</strong> {{ $contactForm->name }}</p>
        <p><strong>Email:</strong> {{ $contactForm->email }}</p>
        <p><strong>Phone:</strong> {{ $contactForm->phone }}</p>
        <p><strong>Event Type:</strong> {{ $contactForm->event_type }}</p>
        <p><strong>Event Date:</strong> {{ $contactForm->event_date ? $contactForm->event_date->format('d M Y') : 'Not specified' }}</p>
        <p><strong>Number of Guests:</strong> {{ $contactForm->guests }}</p>
        <p><strong>Services Required:</strong> {{ $contactForm->services ? implode(', ', $contactForm->services) : 'None' }}</p>
        <p><strong>Budget:</strong> {{ $contactForm->budget }}</p>
    </div>

    <div style="background-color: #fff; padding: 20px; margin: 20px 0; border: 1px solid #ddd; border-radius: 5px;">
        <h3>Message:</h3>
        <p style="white-space: pre-wrap;">{{ $contactForm->message }}</p>
    </div>

    <p style="color: #666; font-size: 12px;">
        This email was sent from the Amaanta Farms contact form on {{ now()->format('d M Y \a\t H:i') }}.
    </p>
</div>
@endsection