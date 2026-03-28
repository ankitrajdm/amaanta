<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Http\Requests\StoreBookingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmation;

class BookingController extends Controller
{
    public function create()
    {
        return view('pages.booking');
    }

    public function store(StoreBookingRequest $request)
    {
        try {
            $booking = Booking::create($request->validated());

            // Send confirmation email (optional - you can implement this later)
            // Mail::to($request->email)->send(new BookingConfirmation($booking));

            return response()->json([
                'success' => true,
                'message' => 'Booking submitted successfully! We will contact you soon to confirm your booking.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while submitting your booking. Please try again.'
            ], 500);
        }
    }
}
