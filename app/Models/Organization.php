<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

   protected $fillable = [
    'institution_id',
    'college_name',
    'affiliation_number',
    'organization_name',
    'contact_number',
    'email',
    'status',
];

}

