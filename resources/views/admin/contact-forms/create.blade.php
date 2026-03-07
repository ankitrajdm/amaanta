@extends('admin.layout')

@section('title', isset($contactForm) ? 'Edit Contact Form' : 'Create Contact Form')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h1>{{ isset($contactForm) ? 'Edit Contact Form' : 'Create Contact Form' }}</h1>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ isset($contactForm) ? route('admin.contact-forms.update', $contactForm) : route('admin.contact-forms.store') }}" method="POST">
            @csrf
            @if(isset($contactForm))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="name" class="form-label">Form Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $contactForm->name ?? '') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Recipient Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $contactForm->email ?? '') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="subject" class="form-label">Email Subject <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" value="{{ old('subject', $contactForm->subject ?? '') }}" required>
                @error('subject')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="message" class="form-label">Default Message</label>
                <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="3">{{ old('message', $contactForm->message ?? '') }}</textarea>
                @error('message')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                    <option value="">Select Status</option>
                    <option value="active" {{ old('status', $contactForm->status ?? '') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', $contactForm->status ?? '') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> {{ isset($contactForm) ? 'Update' : 'Create' }} Contact Form
                </button>
                <a href="{{ route('admin.contact-forms.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
