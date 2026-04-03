<?php

namespace App\Http\Controllers;

use App\Models\GuestFeedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GuestFeedbackController extends Controller
{
    public function create()
    {
        return view('pages.guest-feedback');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'guest_name' => 'required|string|max:255',
            'room_number' => 'required|string|max:50',
            'check_in_date' => 'required|date|before_or_equal:check_out_date',
            'check_out_date' => 'required|date|after_or_equal:check_in_date',
            'heard_about_us' => 'required|in:Friends & Family,Social Media,Ads,Other',
            'reservation_method' => 'required|in:Travel Agency,Online,Application,Other',
            'visit_purpose' => 'required|in:Vacation,Wedding,Business,Other',
            'service_quality' => 'required|in:Excellent,Very Good,Good,Satisfactory,Poor',
            'cleanliness' => 'required|in:Excellent,Very Good,Good,Satisfactory,Poor',
            'staff_rating' => 'required|in:Excellent,Very Good,Good,Satisfactory,Poor',
            'additional_feedback' => 'nullable|string|max:1000',
            'agree_to_submit' => 'required|accepted',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        GuestFeedback::create($request->all());

        return back()->with('success', 'Thank you for your feedback! Your response has been submitted successfully.');
    }
}
