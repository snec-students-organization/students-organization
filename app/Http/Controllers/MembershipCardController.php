<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class MembershipCardController extends Controller
{
    public function download(Request $request)
    {
        $institution = auth('institution')->user();
        $selectedData = $institution->institutionData()->first();

        $pdf = Pdf::loadView('pdf.membership-card', compact('institution', 'selectedData'))
                  ->setPaper('a4', 'landscape');

        return $pdf->download("MembershipCard-{$institution->membership_number}.pdf");
    }
}
