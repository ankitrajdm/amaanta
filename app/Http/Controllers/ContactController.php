<?php

namespace App\Http\Controllers;

use App\Models\ContactEnquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190'],
            'phone' => ['nullable', 'string', 'max:80'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        ContactEnquiry::create($data);

        return back()->with('status', 'Thank you! We received your enquiry.');
    }
}
