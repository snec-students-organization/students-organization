<?php 
// app/Models/MonthlyReport.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyReport extends Model
{
    protected $fillable = ['institution_id', 'college_name', 'month', 'year', 'file_path'];

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
}
