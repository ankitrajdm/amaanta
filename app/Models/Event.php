<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'description', 'event_date', 'location', 'image', 'service_id', 'is_active'];

    protected function casts(): array
    {
        return [
            'event_date' => 'datetime',
            'is_active' => 'boolean',
        ];
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function galleryImages()
    {
        return $this->hasMany(GalleryImage::class);
    }
}
