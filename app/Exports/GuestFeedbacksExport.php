<?php

namespace App\Exports;

use App\Models\GuestFeedback;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class GuestFeedbacksExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $queryParams;

    public function __construct($queryParams = [])
    {
        $this->queryParams = $queryParams;
    }

    public function query()
    {
        $query = GuestFeedback::query();

        // Apply date filters
        if (!empty($this->queryParams['start_date'])) {
            $query->whereDate('created_at', '>=', $this->queryParams['start_date']);
        }

        if (!empty($this->queryParams['end_date'])) {
            $query->whereDate('created_at', '<=', $this->queryParams['end_date']);
        }

        return $query->orderBy('created_at', 'desc');
    }

    public function headings(): array
    {
        return [
            'ID',
            'Guest Name',
            'Room Number',
            'Check-in Date',
            'Check-out Date',
            'Heard About Us',
            'Reservation Method',
            'Visit Purpose',
            'Service Quality',
            'Cleanliness',
            'Staff Rating',
            'Additional Feedback',
            'Status',
            'Created At',
        ];
    }

    public function map($feedback): array
    {
        return [
            $feedback->id,
            $feedback->guest_name,
            $feedback->room_number,
            $feedback->check_in_date ? $feedback->check_in_date->format('d M Y') : '',
            $feedback->check_out_date ? $feedback->check_out_date->format('d M Y') : '',
            $feedback->heard_about_us,
            $feedback->reservation_method,
            $feedback->visit_purpose,
            $feedback->service_quality,
            $feedback->cleanliness,
            $feedback->staff_rating,
            $feedback->additional_feedback,
            ucfirst($feedback->status),
            $feedback->created_at->format('d M Y H:i'),
        ];
    }
}
