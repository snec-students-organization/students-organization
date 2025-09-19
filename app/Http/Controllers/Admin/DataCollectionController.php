<?php

// app/Http/Controllers/Admin/DataCollectionController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentData;
use App\Models\InstitutionData;

class DataCollectionController extends Controller
{
    public function studentDataIndex()
    {
        $students = StudentData::with('user')->paginate(20);
        return view('admin.data_collection.students', compact('students'));
    }

   public function institutionDataIndex()
{
    // Get all institutions, grouped by stream
    $institutions = InstitutionData::with('institution')
        ->orderBy('stream')
        ->get()
        ->groupBy('stream');

    return view('admin.data_collection.institutions', compact('institutions'));
}

}
