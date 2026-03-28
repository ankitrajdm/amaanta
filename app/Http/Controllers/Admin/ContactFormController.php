<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactForm;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ContactFormsExport;

class ContactFormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ContactForm::query();

        // Apply date filters if provided
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $contactForms = $query->latest()->paginate(15);

        return view('admin.contact-forms.index', compact('contactForms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.contact-forms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'event_type' => 'nullable|string|max:255',
            'event_date' => 'nullable|date',
            'guests' => 'nullable|integer|min:1|max:1000',
            'services' => 'nullable|array',
            'services.*' => 'string|in:Lawn,Decoration,Catering,DJ',
            'budget' => 'nullable|string|max:255',
            'message' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'response_status' => 'nullable|in:pending,responded,follow_up_needed',
            'responded_at' => 'nullable|date',
            'admin_notes' => 'nullable|string',
        ]);

        ContactForm::create($validated);

        return redirect()->route('admin.contact-forms.index')->with('success', 'Contact form created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ContactForm $contactForm)
    {
        return view('admin.contact-forms.show', compact('contactForm'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContactForm $contactForm)
    {
        return view('admin.contact-forms.edit', compact('contactForm'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContactForm $contactForm)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'event_type' => 'nullable|string|max:255',
            'event_date' => 'nullable|date',
            'guests' => 'nullable|integer|min:1|max:1000',
            'services' => 'nullable|array',
            'services.*' => 'string|in:Lawn,Decoration,Catering,DJ',
            'budget' => 'nullable|string|max:255',
            'message' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'response_status' => 'nullable|in:pending,responded,follow_up_needed',
            'responded_at' => 'nullable|date',
            'admin_notes' => 'nullable|string',
        ]);

        $contactForm->update($validated);

        return redirect()->route('admin.contact-forms.index')->with('success', 'Contact form updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactForm $contactForm)
    {
        $contactForm->delete();
        return redirect()->route('admin.contact-forms.index')->with('success', 'Contact form deleted successfully.');
    }

    /**
     * Export contact forms to Excel.
     */
    public function export(Request $request)
    {
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        $filename = 'contact-forms';
        if ($startDate && $endDate) {
            $filename .= '-' . $startDate . '-to-' . $endDate;
        } else {
            $filename .= '-' . now()->format('Y-m-d');
        }

        return Excel::download(new ContactFormsExport($startDate, $endDate), $filename . '.xlsx');
    }
}
