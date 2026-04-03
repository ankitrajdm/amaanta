@extends('admin.layout')

@section('title', 'Edit Guest Feedback')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Edit Guest Feedback</h1>
            <div>
                <a href="{{ route('admin.guest-feedbacks.show', $guestFeedback) }}" class="btn btn-info me-2">
                    <i class="fas fa-eye"></i> View
                </a>
                <a href="{{ route('admin.guest-feedbacks.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Edit Guest Feedback Form</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.guest-feedbacks.update', $guestFeedback) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Guest Information -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h6 class="text-primary mb-3"><i class="fas fa-user"></i> Guest Information</h6>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="guest_name" class="form-label">Guest Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('guest_name') is-invalid @enderror" id="guest_name" name="guest_name" value="{{ old('guest_name', $guestFeedback->guest_name) }}" required>
                                @error('guest_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="room_number" class="form-label">Room Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('room_number') is-invalid @enderror" id="room_number" name="room_number" value="{{ old('room_number', $guestFeedback->room_number) }}" required>
                                @error('room_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="check_in_date" class="form-label">Check-in Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('check_in_date') is-invalid @enderror" id="check_in_date" name="check_in_date" value="{{ old('check_in_date', $guestFeedback->check_in_date ? $guestFeedback->check_in_date->format('Y-m-d') : '') }}" required>
                                @error('check_in_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="check_out_date" class="form-label">Check-out Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('check_out_date') is-invalid @enderror" id="check_out_date" name="check_out_date" value="{{ old('check_out_date', $guestFeedback->check_out_date ? $guestFeedback->check_out_date->format('Y-m-d') : '') }}" required>
                                @error('check_out_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- How they heard about us -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h6 class="text-primary mb-3"><i class="fas fa-bullhorn"></i> How did they hear about us? <span class="text-danger">*</span></h6>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                @php $heardOptions = ['Friends & Family', 'Social Media', 'Ads', 'Other']; @endphp
                                @foreach($heardOptions as $option)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="heard_about_us" id="heard_{{ str_replace(' ', '_', $option) }}" value="{{ $option }}" {{ old('heard_about_us', $guestFeedback->heard_about_us) == $option ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="heard_{{ str_replace(' ', '_', $option) }}">
                                        {{ $option }}
                                    </label>
                                </div>
                                @endforeach
                                @error('heard_about_us')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Reservation Method -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h6 class="text-primary mb-3"><i class="fas fa-calendar-check"></i> How did they make their reservation? <span class="text-danger">*</span></h6>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                @php $reservationOptions = ['Travel Agency', 'Online', 'Application', 'Other']; @endphp
                                @foreach($reservationOptions as $option)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="reservation_method" id="reservation_{{ str_replace(' ', '_', $option) }}" value="{{ $option }}" {{ old('reservation_method', $guestFeedback->reservation_method) == $option ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="reservation_{{ str_replace(' ', '_', $option) }}">
                                        {{ $option }}
                                    </label>
                                </div>
                                @endforeach
                                @error('reservation_method')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Visit Purpose -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h6 class="text-primary mb-3"><i class="fas fa-map-marker-alt"></i> Purpose of Visit <span class="text-danger">*</span></h6>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                @php $purposeOptions = ['Vacation', 'Wedding', 'Business', 'Other']; @endphp
                                @foreach($purposeOptions as $option)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="visit_purpose" id="purpose_{{ $option }}" value="{{ $option }}" {{ old('visit_purpose', $guestFeedback->visit_purpose) == $option ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="purpose_{{ $option }}">
                                        {{ $option }}
                                    </label>
                                </div>
                                @endforeach
                                @error('visit_purpose')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Ratings -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h6 class="text-primary mb-3"><i class="fas fa-star"></i> Ratings <span class="text-danger">*</span></h6>
                        </div>
                        @php $ratingOptions = ['Excellent', 'Very Good', 'Good', 'Satisfactory', 'Poor']; @endphp

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Service Quality</label>
                                <select class="form-select @error('service_quality') is-invalid @enderror" name="service_quality" required>
                                    <option value="">Select Rating</option>
                                    @foreach($ratingOptions as $option)
                                    <option value="{{ $option }}" {{ old('service_quality', $guestFeedback->service_quality) == $option ? 'selected' : '' }}>{{ $option }}</option>
                                    @endforeach
                                </select>
                                @error('service_quality')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Cleanliness</label>
                                <select class="form-select @error('cleanliness') is-invalid @enderror" name="cleanliness" required>
                                    <option value="">Select Rating</option>
                                    @foreach($ratingOptions as $option)
                                    <option value="{{ $option }}" {{ old('cleanliness', $guestFeedback->cleanliness) == $option ? 'selected' : '' }}>{{ $option }}</option>
                                    @endforeach
                                </select>
                                @error('cleanliness')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Staff</label>
                                <select class="form-select @error('staff_rating') is-invalid @enderror" name="staff_rating" required>
                                    <option value="">Select Rating</option>
                                    @foreach($ratingOptions as $option)
                                    <option value="{{ $option }}" {{ old('staff_rating', $guestFeedback->staff_rating) == $option ? 'selected' : '' }}>{{ $option }}</option>
                                    @endforeach
                                </select>
                                @error('staff_rating')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Additional Feedback -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h6 class="text-primary mb-3"><i class="fas fa-comment"></i> Additional Feedback</h6>
                            <div class="mb-3">
                                <textarea class="form-control @error('additional_feedback') is-invalid @enderror" name="additional_feedback" rows="4" placeholder="Any additional comments or suggestions...">{{ old('additional_feedback', $guestFeedback->additional_feedback) }}</textarea>
                                @error('additional_feedback')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" name="status" required>
                                    <option value="new" {{ old('status', $guestFeedback->status) == 'new' ? 'selected' : '' }}>New</option>
                                    <option value="reviewed" {{ old('status', $guestFeedback->status) == 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                                    <option value="archived" {{ old('status', $guestFeedback->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Agreement</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="agree_to_submit" value="1" id="agree_to_submit" {{ old('agree_to_submit', $guestFeedback->agree_to_submit) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="agree_to_submit">
                                        Agreed to submit feedback
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Guest Feedback
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection