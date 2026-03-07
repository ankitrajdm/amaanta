@extends('admin.layout')

@section('title', isset($faq) ? 'Edit FAQ' : 'Create FAQ')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h1>{{ isset($faq) ? 'Edit FAQ' : 'Create FAQ' }}</h1>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ isset($faq) ? route('admin.faqs.update', $faq) : route('admin.faqs.store') }}" method="POST">
            @csrf
            @if(isset($faq))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="question" class="form-label">Question <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('question') is-invalid @enderror" id="question" name="question" value="{{ old('question', $faq->question ?? '') }}" required>
                @error('question')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="answer" class="form-label">Answer <span class="text-danger">*</span></label>
                <textarea class="form-control @error('answer') is-invalid @enderror" id="answer" name="answer" rows="5" required>{{ old('answer', $faq->answer ?? '') }}</textarea>
                @error('answer')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <input type="text" class="form-control @error('category') is-invalid @enderror" id="category" name="category" value="{{ old('category', $faq->category ?? '') }}" placeholder="e.g., General, Services">
                @error('category')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ old('is_active', $faq->is_active ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">
                        Active
                    </label>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> {{ isset($faq) ? 'Update' : 'Create' }} FAQ
                </button>
                <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
