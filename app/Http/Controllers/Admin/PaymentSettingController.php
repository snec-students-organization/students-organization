<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentSetting;

class PaymentSettingController extends Controller
{
    public function edit()
    {
        $setting = PaymentSetting::first();
        return view('admin.payment_settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'upi_id' => 'required|string',
            'gpay_number' => 'required|string',
            'qr_image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $setting = PaymentSetting::first() ?? new PaymentSetting();
        $setting->upi_id = $request->upi_id;
        $setting->gpay_number = $request->gpay_number;

        if ($request->hasFile('qr_image')) {
            $path = $request->file('qr_image')->store('payments', 'public');
            $setting->qr_image = $path;
        }

        $setting->save();

        return redirect()->back()->with('success', 'Payment settings updated successfully!');
    }
}
