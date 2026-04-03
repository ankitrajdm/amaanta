<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestFeedback extends Model
{
    use HasFactory;

    protected $table = 'guest_feedbacks';

    protected $fillable = [
        'guest_name',
        'room_number',
        'check_in_date',
        'check_out_date',
        'heard_about_us',
        'reservation_method',
        'visit_purpose',
        'service_quality',
        'cleanliness',
        'staff_rating',
        'additional_feedback',
        'agree_to_submit',
        'status'
    ];

    protected $casts = [
        'check_in_date' => 'date',
        'check_out_date' => 'date',
        'agree_to_submit' => 'boolean',
    ];
}
