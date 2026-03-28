<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'phone',
        'event_date',
        'lawn_cost',
        'decoration_cost',
        'catering_cost',
        'other_charges',
        'total_cost',
        'advance_payment',
        'payment_mode',
        'notes',
        'status',
    ];

    protected $casts = [
        'event_date' => 'date',
        'lawn_cost' => 'decimal:2',
        'decoration_cost' => 'decimal:2',
        'catering_cost' => 'decimal:2',
        'other_charges' => 'decimal:2',
        'total_cost' => 'decimal:2',
        'advance_payment' => 'decimal:2',
    ];
}
