<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'title', 'message', 'pdf_path', 'user_type', 'event_id', 'read_at',
    ];

    // Relationship to event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}

