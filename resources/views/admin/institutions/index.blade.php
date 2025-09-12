@extends('layouts.app') {{-- Adjust as per your admin layout --}}

@section('content')
<div class="container py-4">
    <h1>Institutions</h1>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Short Name</th>
                <th>Affiliation Number</th>
                <th>Place</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($institutions as $institution)
                <tr>
                    <td>{{ $institution->full_name }}</td>
                    <td>{{ $institution->short_name }}</td>
                    <td>{{ $institution->affiliation_number }}</td>
                    <td>{{ $institution->place }}</td>
                    <td>{{ $institution->is_approved ? 'Approved' : 'Pending' }}</td>
                    <td>
                        <a href="{{ route('admin.institutions.show', $institution) }}" class="btn btn-sm btn-info">View Details</a>
                        {{-- Add edit or approve buttons as needed --}}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No institutions found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $institutions->links() }}
</div>
@endsection
