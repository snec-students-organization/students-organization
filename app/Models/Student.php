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
        'membership_number',
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

    /**
     * Get the student's membership number.
     * If the organization details or institution data are submitted, we override/show the organization's affiliation number in the membership number.
     *
     * @param  string|null  $value
     * @return string|null
     */
    public function getMembershipNumberAttribute($value)
    {
        if (!$value) {
            return $value;
        }

        $institution = $this->institution;
        $organization = $institution?->organization;
        $institutionData = $institution?->institutionData;

        $affiliationNumber = null;
        if ($organization && $organization->affiliation_number) {
            $affiliationNumber = $organization->affiliation_number;
        } elseif ($institutionData && $institutionData->affiliation_number) {
            $affiliationNumber = $institutionData->affiliation_number;
        }

        if ($affiliationNumber) {
            $parts = explode('/', $value);
            if (count($parts) === 4) {
                $parts[2] = $affiliationNumber;
                return implode('/', $parts);
            }
        }

        return $value;
    }
}
