<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|regex:/^[0-9+\-\s()]+$/',
            'event_date' => 'required|date|after:today',
            'lawn_cost' => 'nullable|numeric|min:0',
            'decoration_cost' => 'nullable|numeric|min:0',
            'catering_cost' => 'nullable|numeric|min:0',
            'other_charges' => 'nullable|numeric|min:0',
            'total_cost' => 'required|numeric|min:0',
            'advance_payment' => 'required|numeric|min:0|lte:total_cost',
            'payment_mode' => 'required|in:Cash,UPI,Bank Transfer',
            'notes' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'customer_name.required' => 'Customer name is required.',
            'phone.required' => 'Phone number is required.',
            'phone.regex' => 'Please enter a valid phone number.',
            'event_date.required' => 'Event date is required.',
            'event_date.after' => 'Event date must be in the future.',
            'total_cost.required' => 'Total cost is required.',
            'advance_payment.required' => 'Advance payment is required.',
            'advance_payment.lte' => 'Advance payment cannot exceed total cost.',
            'payment_mode.required' => 'Payment mode is required.',
            'payment_mode.in' => 'Invalid payment mode selected.',
        ];
    }
}
