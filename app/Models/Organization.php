<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'institution_id',
        'stream',
        'college_name',
        'organization_name',
        'organization_director_name',
        'organization_director_number',
        'counciler_name',
        'counciler_number',
        'chairman_name',
        'chairman_number',
        'convenor_name',
        'convenor_number',
    ];
}

