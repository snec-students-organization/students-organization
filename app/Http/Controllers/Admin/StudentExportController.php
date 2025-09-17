<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\StudentsExport;
use App\Exports\AllStudentsExport;
use Maatwebsite\Excel\Facades\Excel;

class StudentExportController extends Controller
{
    public function exportInstitutionStudents($institutionId)
    {
        return Excel::download(new StudentsExport($institutionId), 'students.xlsx');
    }

    public function exportAllStudents()
    {
        return Excel::download(new AllStudentsExport(), 'all_students.xlsx');
    }
}
