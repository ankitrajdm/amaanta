<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceSliderImage extends Model
{
    use HasFactory;

    protected $fillable = ['service_slider_id', 'image_path'];

    public function slider()
    {
        return $this->belongsTo(ServiceSlider::class, 'service_slider_id');
    }
}
