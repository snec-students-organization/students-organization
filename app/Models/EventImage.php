<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'gallery_event_id',
        'title',
        'description',
        'image_path',
        'marked',  // Allow mass assignment for marked
    ];

    protected $casts = [
        'marked' => 'boolean',  // Cast marked as boolean
    ];

    /**
     * Get the gallery event that owns the image.
     */
    public function event()
    {
        return $this->belongsTo(GalleryEvent::class, 'gallery_event_id');
    }
}
