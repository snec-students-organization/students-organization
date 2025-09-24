<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'upi_id',
        'gpay_number',
        'qr_code_path',
        'screenshot_path',
        'uid_number',
        'college_name',
        'name',
        'class',
        'institution_name',
        'no_of_students',
        'paid_students_uid',
        'amount',
        'description',
    ];
}

