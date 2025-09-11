<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cover_image',
        'marked',  // Allow mass assignment for marked
    ];

    protected $casts = [
        'marked' => 'boolean',  // Cast marked as boolean
    ];

    /**
     * Get all images for this gallery event.
     */
    public function images()
    {
        return $this->hasMany(EventImage::class);
    }

    /**
     * Scope a query to only include marked events.
     */
    public function scopeMarked($query)
    {
        return $query->where('marked', true);
    }
}
