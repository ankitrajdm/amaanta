<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
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
            'name' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns|max:255',
            'phone' => 'required|string|regex:/^[0-9+\-\s()]+$/|min:10|max:20',
            'event_type' => 'required|string|max:255',
            'event_date' => 'required|date',
            'guests' => 'required|integer|min:1|max:1000',
            'services' => 'required|array|min:1',
            'services.*' => 'string|in:Lawn,Decoration,Catering,DJ',
            'budget' => 'required|string|max:255',
            'message' => 'nullable|string',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Your name is required.',
            'email.required' => 'Your email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'phone.required' => 'Your phone number is required.',
            'event_type.required' => 'Please select an event type.',
            'event_date.required' => 'Event date is required.',
            'event_date.after' => 'Event date must be today or in the future.',
            'guests.required' => 'Number of guests is required.',
            'guests.min' => 'At least 1 guest is required.',
            'guests.max' => 'Maximum 1000 guests allowed.',
            'services.required' => 'Please select at least one service.',
            'services.min' => 'Please select at least one service.',
            'budget.required' => 'Budget information is required.',
            'subject.required' => 'Subject is required.',
            'message.required' => 'Message is required.',
            'message.min' => 'Message must be at least 10 characters.',
        ];
    }
}
