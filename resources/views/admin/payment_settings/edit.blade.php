@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Payment Settings</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.payment-settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>UPI ID</label>
            <input type="text" name="upi_id" class="form-control" value="{{ old('upi_id', $setting->upi_id ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label>GPay Number</label>
            <input type="text" name="gpay_number" class="form-control" value="{{ old('gpay_number', $setting->gpay_number ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label>QR Image</label>
            <input type="file" name="qr_image" class="form-control">
            @if(!empty($setting->qr_image))
                <img src="{{ asset('storage/'.$setting->qr_image) }}" width="200" class="mt-2">
            @endif
        </div>
        <button class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
