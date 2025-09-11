@extends('layouts.institution')

@section('content')
<div class="container">
    <div class="card shadow p-4">
        <h2 class="mb-3">Institution Payment</h2>

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

        <form action="{{ route('payments.institution.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="institution_name" placeholder="Institution Name" class="form-control mb-2" required>
            <input type="number" name="amount" placeholder="Amount" class="form-control mb-2" required>
            <input type="number" name="no_of_students" placeholder="Number of Students" class="form-control mb-2" required>
            <textarea name="paid_students_uid" placeholder="Enter UID of Paid Students (comma separated)" class="form-control mb-2" required></textarea>
            
            <label class="form-label">Upload Screenshot</label>
            <input type="file" name="screenshot" class="form-control mb-3" accept="image/*" required>
            
            <button type="submit" class="btn btn-primary w-100">Submit Payment</button>
        </form>
    </div>
</div>
@endsection

