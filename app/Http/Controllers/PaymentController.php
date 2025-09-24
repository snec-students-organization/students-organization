<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    /**
     * Show user payment form
     */
    public function createUserPayment()
    {
        return view('payments.user');
    }

    /**
     * Store user payment
     */
    public function storeUserPayment(Request $request)
    {
        $request->validate([
            'uid_number'   => 'required|string|max:50',
            'college_name' => 'required|string|max:255',
            'name'         => 'required|string|max:255',
            'class'        => 'required|string|max:100',
            'amount'       => 'required|numeric|min:1',
            'screenshot'   => 'required|image|max:2048',
        ]);

        $screenshotPath = $request->file('screenshot')->store('payments', 'public');

        Payment::create([
            'type'          => 'user',
            'uid_number'    => $request->uid_number,
            'college_name'  => $request->college_name,
            'name'          => $request->name,
            'class'         => $request->class,
            'amount'        => $request->amount,
            'screenshot_path' => $screenshotPath,
        ]);

        return redirect()->back()->with('success', 'Payment submitted successfully!');
    }

    /**
     * Show institution payment form
     */
    public function createInstitutionPayment()
    {
        return view('payments.institution');
    }

    /**
     * Store institution payment
     */
    public function storeInstitutionPayment(Request $request)
    {
        $request->validate([
            'institution_name' => 'required|string|max:255',
            'amount'           => 'required|numeric|min:1',
            'no_of_students'   => 'required|integer|min:1',
            'paid_students_uid'=> 'required|string',
            'screenshot'       => 'required|image|max:2048',
            'description'      => 'nullable|string|max:1000',
        ]);

        $screenshotPath = $request->file('screenshot')->store('payments', 'public');

        Payment::create([
            'type'              => 'institution',
            'institution_name'  => $request->institution_name,
            'amount'            => $request->amount,
            'no_of_students'    => $request->no_of_students,
            'paid_students_uid' => json_encode(array_map('trim', explode(',', $request->paid_students_uid))),
            'screenshot_path'   => $screenshotPath,
            'description'      => $request->description,
        ]);

        return redirect()->back()->with('success', 'Institution payment submitted successfully!');
    }

    /**
     * Admin view of all payments
     */
    public function adminIndex()
    {
        $payments = Payment::latest()->get();
        return view('admin.payments.index', compact('payments'));
    }
}

