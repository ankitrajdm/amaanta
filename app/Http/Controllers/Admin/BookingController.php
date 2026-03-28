<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BookingsExport;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::query();

        // Date filtering
        if ($request->filled('start_date')) {
            $query->whereDate('event_date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('event_date', '<=', $request->end_date);
        }

        // Status filtering
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $bookings = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        return view('admin.bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        return view('admin.bookings.edit', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'event_date' => 'required|date',
            'lawn_cost' => 'nullable|numeric|min:0',
            'decoration_cost' => 'nullable|numeric|min:0',
            'catering_cost' => 'nullable|numeric|min:0',
            'other_charges' => 'nullable|numeric|min:0',
            'total_cost' => 'required|numeric|min:0',
            'advance_payment' => 'required|numeric|min:0',
            'payment_mode' => 'required|in:Cash,UPI,Bank Transfer',
            'notes' => 'nullable|string',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        $booking->update($request->all());

        return redirect()->route('admin.bookings.index')->with('success', 'Booking updated successfully.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('admin.bookings.index')->with('success', 'Booking deleted successfully.');
    }

    public function export(Request $request)
    {
        $query = Booking::query();

        // Date filtering
        if ($request->filled('start_date')) {
            $query->whereDate('event_date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('event_date', '<=', $request->end_date);
        }

        // Status filtering
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        return Excel::download(new BookingsExport($query), 'bookings_' . now()->format('Y-m-d') . '.xlsx');
    }
}
