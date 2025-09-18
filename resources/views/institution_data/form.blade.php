@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Institution Data Submission</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('institution-data.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="college_name" class="form-label">College Name</label>
            <input type="text" name="college_name" id="college_name" class="form-control"
                value="{{ old('college_name', $institutionData->college_name ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="stream" class="form-label">Stream</label>
            <input type="text" name="stream" id="stream" class="form-control"
                value="{{ old('stream', $institutionData->stream ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="affiliation_number" class="form-label">Affiliation Number</label>
            <input type="text" name="affiliation_number" id="affiliation_number" class="form-control"
                value="{{ old('affiliation_number', $institutionData->affiliation_number ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="full_address" class="form-label">Full Address</label>
            <textarea name="full_address" id="full_address" class="form-control" required>{{ old('full_address', $institutionData->full_address ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="college_organization_full_name" class="form-label">Organization Full Name</label>
            <input type="text" name="college_organization_full_name" id="college_organization_full_name" class="form-control"
                value="{{ old('college_organization_full_name', $institutionData->college_organization_full_name ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="college_organization_short_name" class="form-label">Organization Short Name</label>
            <input type="text" name="college_organization_short_name" id="college_organization_short_name" class="form-control"
                value="{{ old('college_organization_short_name', $institutionData->college_organization_short_name ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="membership_number" class="form-label">Membership Number</label>
            <input type="text" id="membership_number" class="form-control" 
                value="{{ $institution->membership_number }}" readonly>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Organization Email</label>
            <input type="email" name="email" id="email" class="form-control"
                value="{{ old('email', $institutionData->email ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="organization_director_name" class="form-label">Director Name</label>
            <input type="text" name="organization_director_name" id="organization_director_name" class="form-control"
                value="{{ old('organization_director_name', $institutionData->organization_director_name ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="organization_director_contact" class="form-label">Director Contact</label>
            <input type="text" name="organization_director_contact" id="organization_director_contact" class="form-control"
                value="{{ old('organization_director_contact', $institutionData->organization_director_contact ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="chairman_name" class="form-label">Chairman Name</label>
            <input type="text" name="chairman_name" id="chairman_name" class="form-control"
                value="{{ old('chairman_name', $institutionData->chairman_name ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="chairman_contact" class="form-label">Chairman Contact</label>
            <input type="text" name="chairman_contact" id="chairman_contact" class="form-control"
                value="{{ old('chairman_contact', $institutionData->chairman_contact ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="convener_name" class="form-label">Convener Name</label>
            <input type="text" name="convener_name" id="convener_name" class="form-control"
                value="{{ old('convener_name', $institutionData->convener_name ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="convener_contact" class="form-label">Convener Contact</label>
            <input type="text" name="convener_contact" id="convener_contact" class="form-control"
                value="{{ old('convener_contact', $institutionData->convener_contact ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="treasurer_name" class="form-label">Treasurer Name</label>
            <input type="text" name="treasurer_name" id="treasurer_name" class="form-control"
                value="{{ old('treasurer_name', $institutionData->treasurer_name ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="treasurer_contact" class="form-label">Treasurer Contact</label>
            <input type="text" name="treasurer_contact" id="treasurer_contact" class="form-control"
                value="{{ old('treasurer_contact', $institutionData->treasurer_contact ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="councilers_name_contact" class="form-label">Councilors (Name & Contact)</label>
            <textarea name="councilers_name_contact" id="councilers_name_contact" class="form-control" required>{{ old('councilers_name_contact', $institutionData->councilers_name_contact ?? '') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
