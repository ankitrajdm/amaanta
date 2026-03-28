<?php

namespace App\Exports;

use App\Models\ContactForm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ContactFormsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate = null, $endDate = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = ContactForm::query();

        if ($this->startDate) {
            $query->whereDate('created_at', '>=', $this->startDate);
        }

        if ($this->endDate) {
            $query->whereDate('created_at', '<=', $this->endDate);
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Phone',
            'Event Type',
            'Event Date',
            'Guests',
            'Services',
            'Budget',
            'Message',
            'Status',
            'Response Status',
            'Responded At',
            'Admin Notes',
            'Created At',
        ];
    }

    /**
     * @param ContactForm $contactForm
     * @return array
     */
    public function map($contactForm): array
    {
        return [
            $contactForm->id,
            $contactForm->name,
            $contactForm->email,
            $contactForm->phone,
            $contactForm->event_type,
            $contactForm->event_date ? $contactForm->event_date->format('Y-m-d') : '',
            $contactForm->guests,
            $contactForm->services ? implode(', ', $contactForm->services) : '',
            $contactForm->budget,
            $contactForm->message,
            $contactForm->status,
            $contactForm->response_status,
            $contactForm->responded_at ? $contactForm->responded_at->format('Y-m-d H:i:s') : '',
            $contactForm->admin_notes,
            $contactForm->created_at->format('Y-m-d H:i:s'),
        ];
    }
}