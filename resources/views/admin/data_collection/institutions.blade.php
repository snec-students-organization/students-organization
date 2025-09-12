@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Submitted Institution Data</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Institution</th>
                <th>College Name</th>
                <th>Stream</th>
                <th>Affiliation Number</th>
                <th>Address</th>
                <th>Organization (Full/Short)</th>
                <th>Membership Number</th>
                <th>Director (Name/Contact)</th>
                <th>Chairman (Name/Contact)</th>
                <th>Convener (Name/Contact)</th>
                <th>Treasurer (Name/Contact)</th>
                <th>Councilers</th>
                <th>Submitted At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($institutions as $inst)
                <tr>
                    <td>{{ $inst->institution->name ?? 'N/A' }}</td>
                    <td>{{ $inst->college_name }}</td>
                    <td>{{ $inst->stream }}</td>
                    <td>{{ $inst->affiliation_number }}</td>
                    <td>{{ $inst->full_address }}</td>
                    <td>{{ $inst->college_organization_full_name }} / {{ $inst->college_organization_short_name }}</td>
                    <td>{{ $inst->membership_number }}</td>
                    <td>{{ $inst->organization_director_name }} / {{ $inst->organization_director_contact }}</td>
                    <td>{{ $inst->chairman_name }} / {{ $inst->chairman_contact }}</td>
                    <td>{{ $inst->convener_name }} / {{ $inst->convener_contact }}</td>
                    <td>{{ $inst->treasurer_name }} / {{ $inst->treasurer_contact }}</td>
                    <td>{{ $inst->councilers_name_contact }}</td>
                    <td>{{ $inst->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $institutions->links() }}
</div>
@endsection
