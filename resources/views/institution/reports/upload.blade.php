@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h2>Upload Monthly Report</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('institution.reports.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">College Name</label>
            <input type="text" name="college_name" class="form-control" value="{{ old('college_name') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Month</label>
            <select name="month" class="form-control" required>
                @foreach(['January','February','March','April','May','June','July','August','September','October','November','December'] as $m)
                    <option value="{{ $m }}">{{ $m }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Year</label>
            <input type="number" name="year" class="form-control" value="{{ now()->year }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Report File</label>
            <input type="file" name="report_file" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
@endsection
