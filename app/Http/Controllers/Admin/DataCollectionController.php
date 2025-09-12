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
        $institutions = InstitutionData::with('institution')->paginate(20);
        return view('admin.data_collection.institutions', compact('institutions'));
    }
}
