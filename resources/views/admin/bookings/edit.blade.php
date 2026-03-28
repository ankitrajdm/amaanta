@extends('admin.layout')

@section('title', 'Edit Booking')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Edit Booking</h1>
            <a href="{{ route('admin.bookings.show', $booking) }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Details
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.bookings.update', $booking) }}">
            @csrf
            @method('PUT')

            <div class="row">
                <!-- Customer Name -->
                <div class="col-md-6 mb-3">
                    <label for="customer_name" class="form-label">Customer Name *</label>
                    <input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name', $booking->customer_name) }}" class="form-control" required>
                    @error('customer_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Phone -->
                <div class="col-md-6 mb-3">
                    <label for="phone" class="form-label">Phone Number *</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone', $booking->phone) }}" class="form-control" required>
                    @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Event Date -->
                <div class="col-md-6 mb-3">
                    <label for="event_date" class="form-label">Event Date *</label>
                    <input type="date" id="event_date" name="event_date" value="{{ old('event_date', $booking->event_date ? $booking->event_date->format('Y-m-d') : '') }}" class="form-control" required>
                    @error('event_date')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Status -->
                <div class="col-md-6 mb-3">
                    <label for="status" class="form-label">Status *</label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="pending" {{ old('status', $booking->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ old('status', $booking->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="completed" {{ old('status', $booking->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ old('status', $booking->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    @error('status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Cost Breakdown -->
            <h5 class="mt-4 mb-3">Cost Breakdown</h5>
            <div class="row">
                <!-- Lawn Cost -->
                <div class="col-md-6 mb-3">
                    <label for="lawn_cost" class="form-label">Lawn Cost (₹)</label>
                    <input type="number" id="lawn_cost" name="lawn_cost" step="0.01" min="0" value="{{ old('lawn_cost', $booking->lawn_cost ?? '') }}" class="form-control">
                    @error('lawn_cost')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Decoration Cost -->
                <div class="col-md-6 mb-3">
                    <label for="decoration_cost" class="form-label">Decoration Cost (₹)</label>
                    <input type="number" id="decoration_cost" name="decoration_cost" step="0.01" min="0" value="{{ old('decoration_cost', $booking->decoration_cost ?? '') }}" class="form-control">
                    @error('decoration_cost')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Catering Cost -->
                <div class="col-md-6 mb-3">
                    <label for="catering_cost" class="form-label">Catering Cost (₹)</label>
                    <input type="number" id="catering_cost" name="catering_cost" step="0.01" min="0" value="{{ old('catering_cost', $booking->catering_cost ?? '') }}" class="form-control">
                    @error('catering_cost')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Other Charges -->
                <div class="col-md-6 mb-3">
                    <label for="other_charges" class="form-label">Other Charges (₹)</label>
                    <input type="number" id="other_charges" name="other_charges" step="0.01" min="0" value="{{ old('other_charges', $booking->other_charges ?? '') }}" class="form-control">
                    @error('other_charges')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Total Cost -->
                <div class="col-md-6 mb-3">
                    <label for="total_cost" class="form-label">Total Cost (₹) *</label>
                    <input type="number" id="total_cost" name="total_cost" step="0.01" min="0" value="{{ old('total_cost', $booking->total_cost) }}" class="form-control" required>
                    @error('total_cost')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Advance Payment -->
                <div class="col-md-6 mb-3">
                    <label for="advance_payment" class="form-label">Advance Payment (₹) *</label>
                    <input type="number" id="advance_payment" name="advance_payment" step="0.01" min="0" value="{{ old('advance_payment', $booking->advance_payment) }}" class="form-control" required>
                    @error('advance_payment')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Payment Mode -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="payment_mode" class="form-label">Payment Mode *</label>
                    <select id="payment_mode" name="payment_mode" class="form-control" required>
                        <option value="">Select Payment Mode</option>
                        <option value="Cash" {{ old('payment_mode', $booking->payment_mode) == 'Cash' ? 'selected' : '' }}>Cash</option>
                        <option value="UPI" {{ old('payment_mode', $booking->payment_mode) == 'UPI' ? 'selected' : '' }}>UPI</option>
                        <option value="Bank Transfer" {{ old('payment_mode', $booking->payment_mode) == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                    </select>
                    @error('payment_mode')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Notes -->
            <div class="mb-3">
                <label for="notes" class="form-label">Additional Notes</label>
                <textarea id="notes" name="notes" rows="4" class="form-control">{{ old('notes', $booking->notes) }}</textarea>
                @error('notes')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.bookings.show', $booking) }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Booking</button>
            </div>
        </form>
    </div>
</div>

<script>
// Auto-calculate total cost
document.addEventListener('DOMContentLoaded', function() {
    function calculateTotal() {
        const lawnCost = parseFloat(document.getElementById('lawn_cost').value) || 0;
        const decorationCost = parseFloat(document.getElementById('decoration_cost').value) || 0;
        const cateringCost = parseFloat(document.getElementById('catering_cost').value) || 0;
        const otherCharges = parseFloat(document.getElementById('other_charges').value) || 0;

        const total = lawnCost + decorationCost + cateringCost + otherCharges;
        document.getElementById('total_cost').value = total.toFixed(2);
    }

    // Add event listeners for cost calculation
    ['lawn_cost', 'decoration_cost', 'catering_cost', 'other_charges'].forEach(id => {
        document.getElementById(id).addEventListener('input', calculateTotal);
    });
});
</script>
@endsection