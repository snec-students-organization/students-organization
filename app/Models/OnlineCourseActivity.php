<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OnlineCourseActivity extends Model
{
    protected $fillable = ['title', 'description', 'link', 'is_active'];
}
