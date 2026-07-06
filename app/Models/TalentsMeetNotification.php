<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TalentsMeetNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'sender_role',
        'topic',
        'description',
    ];

    /**
     * Get the user who sent the notification.
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
