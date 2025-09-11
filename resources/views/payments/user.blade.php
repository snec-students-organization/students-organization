@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow p-4">
        <h2 class="mb-3">User Payment</h2>

        @php
            $setting = \App\Models\PaymentSetting::first();
        @endphp

        <p>Scan QR or pay to:</p>
        <p><b>UPI:</b> {{ $setting->upi_id ?? 'Not set' }}</p>
        <p><b>GPay:</b> {{ $setting->gpay_number ?? 'Not set' }}</p>

        @if(!empty($setting->qr_image))
            <img src="{{ asset('storage/'.$setting->qr_image) }}" width="200" class="mb-3">
        @else
            <p><i>No QR uploaded</i></p>
        @endif

        {{-- Error Messages --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('payments.user.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="uid_number" placeholder="UID Number" class="form-control mb-2" required>
            <input type="text" name="college_name" placeholder="College Name" class="form-control mb-2" required>
            <input type="text" name="name" placeholder="Name" class="form-control mb-2" required>
            <input type="text" name="class" placeholder="Class" class="form-control mb-2" required>
            <input type="number" name="amount" placeholder="Amount" class="form-control mb-2" required>
            
            <label class="form-label">Upload Screenshot</label>
            <input type="file" name="screenshot" class="form-control mb-3" accept="image/*" required>
            
            <button type="submit" class="btn btn-primary w-100">Submit Payment</button>
        </form>
    </div>
</div>
@endsection

