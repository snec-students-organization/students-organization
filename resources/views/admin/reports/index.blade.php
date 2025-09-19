@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h2>All Monthly Reports</h2>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('admin.reports.index') }}" class="row g-3 mb-3">
        <div class="col-md-3">
            <select name="month" class="form-control">
                <option value="">-- Select Month --</option>
                @foreach(['January','February','March','April','May','June','July','August','September','October','November','December'] as $m)
                    <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>{{ $m }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <input type="number" name="year" class="form-control" placeholder="Year" value="{{ request('year') }}">
        </div>

        <div class="col-md-2">
            <button class="btn btn-primary">Filter</button>
        </div>
    </form>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Institution</th>
                <th>College Name</th>
                <th>Month</th>
                <th>Year</th>
                <th>Report</th>
                <th>Uploaded At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
                <tr>
                    <td>{{ $report->institution->name ?? 'N/A' }}</td>
                    <td>{{ $report->college_name }}</td>
                    <td>{{ $report->month }}</td>
                    <td>{{ $report->year }}</td>
                    <td>
                        <a href="{{ Storage::url($report->file_path) }}" target="_blank" class="btn btn-sm btn-primary">View</a>
                    </td>
                    <td>{{ $report->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $reports->links() }}
</div>
@endsection
