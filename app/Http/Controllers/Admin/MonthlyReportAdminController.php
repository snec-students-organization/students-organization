<?php
// app/Http/Controllers/Admin/MonthlyReportAdminController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MonthlyReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MonthlyReportAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = MonthlyReport::with('institution')->latest();

        if ($request->filled('month')) {
            $query->where('month', $request->month);
        }

        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        $reports = $query->paginate(20);

        return view('admin.reports.index', compact('reports'));
    }
}
