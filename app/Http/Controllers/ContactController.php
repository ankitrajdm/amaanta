<?php

namespace App\Http\Controllers;

use App\Models\ContactForm;
use App\Http\Requests\StoreContactFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(StoreContactFormRequest $request)
    {
        $contactForm = ContactForm::create($request->validated());

        // Send email to admin directly (for testing)
        try {
            \Illuminate\Support\Facades\Mail::to('gm.amaanta@gmail.com')->send(new \App\Mail\ContactFormSubmitted($contactForm));
        } catch (\Exception $e) {
            // Log error but don't fail the request
            \Illuminate\Support\Facades\Log::error('Failed to send admin email: ' . $e->getMessage());
        }

        // Send confirmation email to user
        try {
            \Illuminate\Support\Facades\Mail::to($contactForm->email)->send(new \App\Mail\ContactFormConfirmation($contactForm));
        } catch (\Exception $e) {
            // Log error but don't fail the request
            \Illuminate\Support\Facades\Log::error('Failed to send user confirmation email: ' . $e->getMessage());
        }

        // Check if this is an AJAX request
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you for your message. We will get back to you soon!'
            ]);
        }

        return redirect()->back()->with('status', 'Thank you for your message. We will get back to you soon!');
    }
}
