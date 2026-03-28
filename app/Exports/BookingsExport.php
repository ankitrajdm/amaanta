<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BookingsExport implements FromQuery, WithHeadings, WithMapping
{
    protected $query;

    public function __construct(Builder $query)
    {
        $this->query = $query;
    }

    public function query()
    {
        return $this->query;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Customer Name',
            'Phone',
            'Event Date',
            'Lawn Cost',
            'Decoration Cost',
            'Catering Cost',
            'Other Charges',
            'Total Cost',
            'Advance Payment',
            'Payment Mode',
            'Notes',
            'Status',
            'Created At',
        ];
    }

    public function map($booking): array
    {
        return [
            $booking->id,
            $booking->customer_name,
            $booking->phone,
            $booking->event_date ? $booking->event_date->format('Y-m-d') : '',
            $booking->lawn_cost ?? 0,
            $booking->decoration_cost ?? 0,
            $booking->catering_cost ?? 0,
            $booking->other_charges ?? 0,
            $booking->total_cost,
            $booking->advance_payment,
            $booking->payment_mode,
            $booking->notes ?? '',
            $booking->status,
            $booking->created_at ? $booking->created_at->format('Y-m-d H:i:s') : '',
        ];
    }
}
