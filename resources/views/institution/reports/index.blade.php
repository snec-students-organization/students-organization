@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h2>My Monthly Reports</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <ul class="list-group">
        @forelse($reports as $report)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $report->college_name }} - {{ $report->month }} {{ $report->year }}
                <a href="{{ Storage::url($report->file_path) }}" target="_blank" class="btn btn-sm btn-success">Download</a>
            </li>
        @empty
            <li class="list-group-item text-muted">No reports uploaded.</li>
        @endforelse
    </ul>
</div>
@endsection
