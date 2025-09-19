<?php
// app/Http/Controllers/MonthlyReportController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MonthlyReport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MonthlyReportController extends Controller
{
    // Show upload form
    public function create()
    {
        return view('institution.reports.upload');
    }

    // Store uploaded report
    public function store(Request $request)
    {
        $request->validate([
            'college_name' => 'required|string|max:255',
            'month' => 'required|string',
            'year' => 'required|integer',
            'report_file' => 'required|mimes:pdf,doc,docx,xlsx,xls|max:5120',
        ]);

        $institution = Auth::guard('institution')->user();
        $file = $request->file('report_file');

        // Generate a unique filename
        $filename = time() . '_' . $file->getClientOriginalName();

        // Store the file in storage/app/public/reports
        $path = $file->storeAs('reports', $filename, 'public');

        // Save record
        MonthlyReport::create([
            'institution_id' => $institution->id,
            'college_name' => $request->college_name,
            'month' => $request->month,
            'year' => $request->year,
            'file_path' => $path,
        ]);

        return redirect()->route('institution.reports.index')
            ->with('success', 'Report uploaded successfully!');
    }

    // List uploaded reports for this institution
    public function index()
    {
        $institution = Auth::guard('institution')->user();
        $reports = MonthlyReport::where('institution_id', $institution->id)
                    ->latest()
                    ->get();

        return view('institution.reports.index', compact('reports'));
    }

    // Optional: download a report
    public function download(MonthlyReport $report)
    {
        $this->authorize('view', $report); // Optional: use policies

        return Storage::download($report->file_path);
    }
}
