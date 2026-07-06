<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeeklyTalentsMeet extends Model
{
    use HasFactory;

    protected $fillable = [
        'institution_id',
        'title',
        'meet_date',
        'qiraath',
        'presidential_address',
        'inauguration_talk',
        'welcome_speech',
        'speeches',
        'songs',
        'vote_of_thanks'
    ];

    /**
     * Get the institution that owns the WeeklyTalentsMeet
     */
    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
}
