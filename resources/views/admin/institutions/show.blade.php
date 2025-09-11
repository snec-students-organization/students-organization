@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h1>Institution Details</h1>

    <div class="card mb-4">
        <div class="card-header">
            <h4>{{ $institution->full_name }}</h4>
        </div>
        <div class="card-body">
            <p><strong>Short Name:</strong> {{ $institution->short_name }}</p>
            <p><strong>Stream:</strong> {{ $institution->stream }}</p>
            <p><strong>Affiliation Number:</strong> {{ $institution->affiliation_number }}</p>
            <p><strong>Place:</strong> {{ $institution->place }}</p>
            <p><strong>Address:</strong> {{ $institution->address }}</p>
            <p><strong>Organization Name:</strong> {{ $institution->organization_name }}</p>
            <p><strong>Organization Short Name:</strong> {{ $institution->organization_short_name }}</p>
            <p><strong>Status:</strong> {{ $institution->is_approved ? 'Approved' : 'Pending' }}</p>
        </div>
    </div>

    <a href="{{ route('admin.institutions.index') }}" class="btn btn-secondary">Back to Institutions</a>

    {{-- Add approve/reject buttons or edit functionality if needed --}}
</div>
@endsection
