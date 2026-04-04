<?php

// app/Http/Controllers/Admin/DataCollectionController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentData;
use App\Models\InstitutionData;
use App\Models\AdmissionData;
use App\Exports\AdmissionDataExport;
use Maatwebsite\Excel\Facades\Excel;

class DataCollectionController extends Controller
{
    public function admissionDataIndex()
    {
        // Fetch all admissions and group by uid_no in PHP for now (since count is small)
        // In a larger system, we might want to use a more complex query or DB-level grouping
        $admissions = AdmissionData::latest()->get()->groupBy('uid_no');
        
        return view('admin.data_collection.admission', compact('admissions'));
    }

    public function exportAdmissionData()
    {
        return Excel::download(new AdmissionDataExport, 'admission_data_' . date('Y-m-d') . '.xlsx');
    }

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
