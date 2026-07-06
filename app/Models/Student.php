<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'institution_id',
        'name',
        'uid',
        'stream',
        'class',
        'father_name',
        'address',
        'contact_number',
        'whatsapp_number',
        'country',
        'state',
        'district',
        'constituency',
        'place',
        'date_of_birth',
        'photo',
        'interested_areas',
        'status',
    ];

    protected $casts = [
        'interested_areas' => 'array',
    ];

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function onlineCourseRegistration()
    {
        return $this->hasOne(OnlineCourseRegistration::class);
    }

    public function onlineCourseAttendances()
    {
        return $this->hasMany(OnlineCourseAttendance::class);
    }
}
