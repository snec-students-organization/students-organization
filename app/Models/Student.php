<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'institution_id',
        'name',
        'uid',
        'class',
        'status',
    ];

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
}
