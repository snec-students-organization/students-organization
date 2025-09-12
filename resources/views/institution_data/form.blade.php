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
            <input type="text" class="form-control @error('college_name') is-invalid @enderror" name="college_name" value="{{ old('college_name', $institutionData->college_name ?? '') }}" required>
            @error('college_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="stream" class="form-label">Stream</label>
            <input type="text" class="form-control @error('stream') is-invalid @enderror" name="stream" value="{{ old('stream', $institutionData->stream ?? '') }}" required>
            @error('stream') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="affiliation_number" class="form-label">Affiliation Number</label>
            <input type="text" class="form-control @error('affiliation_number') is-invalid @enderror" name="affiliation_number" value="{{ old('affiliation_number', $institutionData->affiliation_number ?? '') }}" required>
            @error('affiliation_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="full_address" class="form-label">Full Address</label>
            <textarea class="form-control @error('full_address') is-invalid @enderror" name="full_address" rows="3" required>{{ old('full_address', $institutionData->full_address ?? '') }}</textarea>
            @error('full_address') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="college_organization_full_name" class="form-label">College Organization (Full Name)</label>
            <input type="text" class="form-control @error('college_organization_full_name') is-invalid @enderror" name="college_organization_full_name" value="{{ old('college_organization_full_name', $institutionData->college_organization_full_name ?? '') }}" required>
            @error('college_organization_full_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="college_organization_short_name" class="form-label">College Organization (Short Name)</label>
            <input type="text" class="form-control @error('college_organization_short_name') is-invalid @enderror" name="college_organization_short_name" value="{{ old('college_organization_short_name', $institutionData->college_organization_short_name ?? '') }}" required>
            @error('college_organization_short_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="membership_number" class="form-label">Membership Number</label>
            <input type="text" class="form-control @error('membership_number') is-invalid @enderror" name="membership_number" value="{{ old('membership_number', $institutionData->membership_number ?? '') }}" required>
            @error('membership_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <hr>

        <h4>Organization Director</h4>
        <div class="mb-3">
            <label for="organization_director_name" class="form-label">Name</label>
            <input type="text" class="form-control @error('organization_director_name') is-invalid @enderror" name="organization_director_name" value="{{ old('organization_director_name', $institutionData->organization_director_name ?? '') }}" required>
            @error('organization_director_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="organization_director_contact" class="form-label">Contact Number</label>
            <input type="text" class="form-control @error('organization_director_contact') is-invalid @enderror" name="organization_director_contact" value="{{ old('organization_director_contact', $institutionData->organization_director_contact ?? '') }}" required>
            @error('organization_director_contact') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <hr>

        <h4>Chairman</h4>
        <div class="mb-3">
            <label for="chairman_name" class="form-label">Name</label>
            <input type="text" class="form-control @error('chairman_name') is-invalid @enderror" name="chairman_name" value="{{ old('chairman_name', $institutionData->chairman_name ?? '') }}" required>
            @error('chairman_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="chairman_contact" class="form-label">Contact Number</label>
            <input type="text" class="form-control @error('chairman_contact') is-invalid @enderror" name="chairman_contact" value="{{ old('chairman_contact', $institutionData->chairman_contact ?? '') }}" required>
            @error('chairman_contact') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <hr>

        <h4>Convener</h4>
        <div class="mb-3">
            <label for="convener_name" class="form-label">Name</label>
            <input type="text" class="form-control @error('convener_name') is-invalid @enderror" name="convener_name" value="{{ old('convener_name', $institutionData->convener_name ?? '') }}" required>
            @error('convener_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="convener_contact" class="form-label">Contact Number</label>
            <input type="text" class="form-control @error('convener_contact') is-invalid @enderror" name="convener_contact" value="{{ old('convener_contact', $institutionData->convener_contact ?? '') }}" required>
            @error('convener_contact') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <hr>

        <h4>Treasurer</h4>
        <div class="mb-3">
            <label for="treasurer_name" class="form-label">Name</label>
            <input type="text" class="form-control @error('treasurer_name') is-invalid @enderror" name="treasurer_name" value="{{ old('treasurer_name', $institutionData->treasurer_name ?? '') }}" required>
            @error('treasurer_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="treasurer_contact" class="form-label">Contact Number</label>
            <input type="text" class="form-control @error('treasurer_contact') is-invalid @enderror" name="treasurer_contact" value="{{ old('treasurer_contact', $institutionData->treasurer_contact ?? '') }}" required>
            @error('treasurer_contact') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <hr>

        <h4>Councilers</h4>
        <div class="mb-3">
            <label for="councilers_name_contact" class="form-label">Names & Contact Numbers (Separate multiple by commas)</label>
            <textarea class="form-control @error('councilers_name_contact') is-invalid @enderror" name="councilers_name_contact" rows="3" required>{{ old('councilers_name_contact', $institutionData->councilers_name_contact ?? '') }}</textarea>
            @error('councilers_name_contact') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
