<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Institution extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'full_name',
        'short_name',
        'stream',
        'affiliation_number',
        'place',
        'address',
        'organization_name',
        'organization_short_name',
        
    ];

    protected $hidden = [
        'password',
    ];
    
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function organization()
    {
        return $this->hasOne(Organization::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'institution_name', 'name');
    }
    public function institutionData()
{
    return $this->hasOne(InstitutionData::class);
}

}


