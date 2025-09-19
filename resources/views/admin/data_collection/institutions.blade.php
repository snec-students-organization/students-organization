@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h2 class="mb-4">Submitted Institution Data (Grouped by Stream)</h2>

    @forelse($institutions as $stream => $group)
        <div class="mb-5">
            <h4 class="bg-primary text-white p-2 rounded">
                {{ strtoupper($stream) }} Stream
            </h4>

            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover align-middle mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>Institution</th>
                                    <th>College Name</th>
                                    <th>Affiliation Number</th>
                                    <th>Address</th>
                                    <th>Organization (Full/Short)</th>
                                    <th>Membership Number</th>
                                    <th>Email</th>
                                    <th>Director (Name/Contact)</th>
                                    <th>Chairman (Name/Contact)</th>
                                    <th>Convener (Name/Contact)</th>
                                    <th>Treasurer (Name/Contact)</th>
                                    <th>Councilers</th>
                                    <th>Submitted At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($group as $inst)
                                    <tr>
                                        <td>{{ $inst->institution->name ?? 'N/A' }}</td>
                                        <td>{{ $inst->college_name }}</td>
                                        <td>{{ $inst->affiliation_number }}</td>
                                        <td>{{ $inst->full_address }}</td>
                                        <td>{{ $inst->college_organization_full_name }} / {{ $inst->college_organization_short_name }}</td>
                                        <td>{{ $inst->institution->membership_number ?? '-' }}</td>
                                        <td>{{ $inst->email ?? '-' }}</td>
                                        <td>{{ $inst->organization_director_name }} / {{ $inst->organization_director_contact }}</td>
                                        <td>{{ $inst->chairman_name }} / {{ $inst->chairman_contact }}</td>
                                        <td>{{ $inst->convener_name }} / {{ $inst->convener_contact }}</td>
                                        <td>{{ $inst->treasurer_name }} / {{ $inst->treasurer_contact }}</td>
                                        <td>{{ $inst->councilers_name_contact }}</td>
                                        <td>{{ optional($inst->created_at)->format('Y-m-d H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <p class="text-muted">No submitted institution data found.</p>
    @endforelse
</div>
@endsection
