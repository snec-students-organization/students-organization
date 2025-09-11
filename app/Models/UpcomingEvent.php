<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UpcomingEvent extends Model
{
    protected $fillable = ['title', 'event_date', 'location', 'description', 'image'];

    protected $casts = [
        'event_date' => 'datetime',
    ];
}
