<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OnlineCourseQuiz extends Model
{
    protected $fillable = ['title', 'description', 'link', 'is_active'];
}
