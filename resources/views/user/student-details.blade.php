@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3>Complete Your Details</h3>

    <form method="POST" action="{{ route('user.student.update') }}" class="row g-4">
        @csrf
        @method('PUT')

        <div class="col-md-6">
            <label class="form-label">Father's Name</label>
            <input type="text" name="father_name" class="form-control" value="{{ old('father_name', $student->father_name) }}" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Contact Number</label>
            <input type="text" name="contact_number" class="form-control" value="{{ old('contact_number', $student->contact_number) }}" required>
        </div>

        <div class="col-md-12">
            <label class="form-label">Address</label>
            <textarea name="address" class="form-control" required>{{ old('address', $student->address) }}</textarea>
        </div>

        <div class="col-12 text-end">
            <button type="submit" class="btn btn-success">Save Details</button>
        </div>
    </form>
</div>
@endsection
