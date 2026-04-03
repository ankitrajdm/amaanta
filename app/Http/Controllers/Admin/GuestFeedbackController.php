<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GuestFeedback;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GuestFeedbacksExport;

class GuestFeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = GuestFeedback::query();

        // Apply date filters
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $guestFeedbacks = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.guest-feedbacks.index', compact('guestFeedbacks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.guest-feedbacks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'guest_name' => 'required|string|max:255',
            'room_number' => 'required|string|max:50',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after_or_equal:check_in_date',
            'heard_about_us' => 'required|in:Friends & Family,Social Media,Ads,Other',
            'reservation_method' => 'required|in:Travel Agency,Online,Application,Other',
            'visit_purpose' => 'required|in:Vacation,Wedding,Business,Other',
            'service_quality' => 'required|in:Excellent,Very Good,Good,Satisfactory,Poor',
            'cleanliness' => 'required|in:Excellent,Very Good,Good,Satisfactory,Poor',
            'staff_rating' => 'required|in:Excellent,Very Good,Good,Satisfactory,Poor',
            'additional_feedback' => 'nullable|string|max:1000',
            'status' => 'required|in:new,reviewed,archived',
        ]);

        GuestFeedback::create($request->all());

        return redirect()->route('admin.guest-feedbacks.index')
            ->with('success', 'Guest feedback created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(GuestFeedback $guestFeedback)
    {
        return view('admin.guest-feedbacks.show', compact('guestFeedback'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GuestFeedback $guestFeedback)
    {
        return view('admin.guest-feedbacks.edit', compact('guestFeedback'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GuestFeedback $guestFeedback)
    {
        $request->validate([
            'guest_name' => 'required|string|max:255',
            'room_number' => 'required|string|max:50',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after_or_equal:check_in_date',
            'heard_about_us' => 'required|in:Friends & Family,Social Media,Ads,Other',
            'reservation_method' => 'required|in:Travel Agency,Online,Application,Other',
            'visit_purpose' => 'required|in:Vacation,Wedding,Business,Other',
            'service_quality' => 'required|in:Excellent,Very Good,Good,Satisfactory,Poor',
            'cleanliness' => 'required|in:Excellent,Very Good,Good,Satisfactory,Poor',
            'staff_rating' => 'required|in:Excellent,Very Good,Good,Satisfactory,Poor',
            'additional_feedback' => 'nullable|string|max:1000',
            'status' => 'required|in:new,reviewed,archived',
        ]);

        $guestFeedback->update($request->all());

        return redirect()->route('admin.guest-feedbacks.index')
            ->with('success', 'Guest feedback updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GuestFeedback $guestFeedback)
    {
        $guestFeedback->delete();

        return redirect()->route('admin.guest-feedbacks.index')
            ->with('success', 'Guest feedback deleted successfully.');
    }

    /**
     * Export guest feedbacks to Excel
     */
    public function export(Request $request)
    {
        return Excel::download(new GuestFeedbacksExport($request->query()), 'guest_feedbacks_' . now()->format('Y-m-d') . '.xlsx');
    }
}
