<?php

// app/Models/InstitutionData.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstitutionData extends Model
{
   protected $fillable = [
    'college_name',
    'stream',
    'affiliation_number',
    'full_address',
    'college_organization_full_name',
    'college_organization_short_name',
    'membership_number',
    'email', // ✅ new
    'organization_director_name',
    'organization_director_contact',
    'chairman_name',
    'chairman_contact',
    'convener_name',
    'convener_contact',
    'treasurer_name',
    'treasurer_contact',
    'councilers_name_contact',
];


    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
    

}
