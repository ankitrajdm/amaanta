<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'event_type',
        'event_date',
        'guests',
        'services',
        'budget',
        'message',
        'status',
        'response_status',
        'responded_at',
        'admin_notes'
    ];

    protected $casts = [
        'services' => 'array',
        'event_date' => 'date',
        'guests' => 'integer',
        'responded_at' => 'datetime',
    ];
}
