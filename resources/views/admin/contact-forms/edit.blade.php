@extends('admin.layout')

@section('title', 'Edit Contact Form')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h1>Edit Contact Form</h1>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.contact-forms.update', $contactForm) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $contactForm->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $contactForm->email) }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $contactForm->phone) }}">
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="event_type" class="form-label">Event Type</label>
                <select class="form-control @error('event_type') is-invalid @enderror" id="event_type" name="event_type">
                    <option value="">Select Event Type</option>
                    <option value="Wedding" {{ old('event_type', $contactForm->event_type) === 'Wedding' ? 'selected' : '' }}>Wedding</option>
                    <option value="Birthday" {{ old('event_type', $contactForm->event_type) === 'Birthday' ? 'selected' : '' }}>Birthday</option>
                    <option value="Corporate" {{ old('event_type', $contactForm->event_type) === 'Corporate' ? 'selected' : '' }}>Corporate</option>
                    <option value="Others" {{ old('event_type', $contactForm->event_type) === 'Others' ? 'selected' : '' }}>Others</option>
                </select>
                @error('event_type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="event_date" class="form-label">Event Date</label>
                <input type="date" class="form-control @error('event_date') is-invalid @enderror" id="event_date" name="event_date" value="{{ old('event_date', $contactForm->event_date ? $contactForm->event_date->format('Y-m-d') : '') }}">
                @error('event_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="guests" class="form-label">Number of Guests</label>
                <input type="number" class="form-control @error('guests') is-invalid @enderror" id="guests" name="guests" value="{{ old('guests', $contactForm->guests) }}" min="1">
                @error('guests')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="services" class="form-label">Services Required</label>
                <div>
                    <label class="form-check-label me-3">
                        <input type="checkbox" class="form-check-input" name="services[]" value="Lawn" {{ in_array('Lawn', old('services', $contactForm->services ?? [])) ? 'checked' : '' }}> Lawn
                    </label>
                    <label class="form-check-label me-3">
                        <input type="checkbox" class="form-check-input" name="services[]" value="Decoration" {{ in_array('Decoration', old('services', $contactForm->services ?? [])) ? 'checked' : '' }}> Decoration
                    </label>
                    <label class="form-check-label me-3">
                        <input type="checkbox" class="form-check-input" name="services[]" value="Catering" {{ in_array('Catering', old('services', $contactForm->services ?? [])) ? 'checked' : '' }}> Catering
                    </label>
                    <label class="form-check-label me-3">
                        <input type="checkbox" class="form-check-input" name="services[]" value="DJ" {{ in_array('DJ', old('services', $contactForm->services ?? [])) ? 'checked' : '' }}> DJ
                    </label>
                </div>
                @error('services')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="budget" class="form-label">Budget</label>
                <input type="text" class="form-control @error('budget') is-invalid @enderror" id="budget" name="budget" value="{{ old('budget', $contactForm->budget) }}">
                @error('budget')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" value="{{ old('subject', $contactForm->subject) }}" required>
                @error('subject')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="3">{{ old('message', $contactForm->message) }}</textarea>
                @error('message')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                    <option value="">Select Status</option>
                    <option value="active" {{ old('status', $contactForm->status) === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', $contactForm->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="response_status" class="form-label">Response Status</label>
                <select class="form-control @error('response_status') is-invalid @enderror" id="response_status" name="response_status">
                    <option value="pending" {{ old('response_status', $contactForm->response_status ?? 'pending') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="responded" {{ old('response_status', $contactForm->response_status) === 'responded' ? 'selected' : '' }}>Responded</option>
                    <option value="follow_up_needed" {{ old('response_status', $contactForm->response_status) === 'follow_up_needed' ? 'selected' : '' }}>Follow Up Needed</option>
                </select>
                @error('response_status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="responded_at" class="form-label">Responded At</label>
                <input type="datetime-local" class="form-control @error('responded_at') is-invalid @enderror" id="responded_at" name="responded_at" value="{{ old('responded_at', $contactForm->responded_at ? $contactForm->responded_at->format('Y-m-d\TH:i') : '') }}">
                @error('responded_at')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="admin_notes" class="form-label">Admin Notes</label>
                <textarea class="form-control @error('admin_notes') is-invalid @enderror" id="admin_notes" name="admin_notes" rows="3">{{ old('admin_notes', $contactForm->admin_notes) }}</textarea>
                @error('admin_notes')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Update Contact Form
                </button>
                <a href="{{ route('admin.contact-forms.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection