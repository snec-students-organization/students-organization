<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdmissionData;
use Illuminate\Http\Request;

class ScratchCardPaymentController extends Controller
{
    public function index()
    {
        $payments = AdmissionData::where('is_scratched', true)
            ->where('scratch_card_amount', '>', 0)
            ->latest()
            ->paginate(20);

        return view('admin.data_collection.scratch_card_payments', compact('payments'));
    }

    public function markAsPaid($id)
    {
        $payment = AdmissionData::findOrFail($id);
        $payment->update(['is_paid' => true]);

        return redirect()->back()->with('success', 'Payment marked as paid successfully!');
    }
}
