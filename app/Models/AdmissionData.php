<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmissionData extends Model
{
    protected $fillable = [
        'student_name',
        'uid_no',
        'college_name',
        'contact_number',
        'application_number',
        'scratch_card_amount',
        'is_scratched',
        'gpay_number',
        'is_paid',
    ];
}
