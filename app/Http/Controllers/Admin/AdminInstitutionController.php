<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use Illuminate\Http\Request;

class AdminInstitutionController extends Controller
{
    public function index()
    {
        $institutions = Institution::paginate(15);
        return view('admin.institutions.index', compact('institutions'));
    }

    public function show(Institution $institution)
    {
        return view('admin.institutions.show', compact('institution'));
    }
}

