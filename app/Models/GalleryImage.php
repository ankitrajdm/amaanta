<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'image_path', 'event_name', 'event_id', 'service_id', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
