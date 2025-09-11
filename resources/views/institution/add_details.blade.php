@extends('layouts.institution')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">🏫 Add Institution Details</h4>
                    <a href="{{ route('institution.dashboard') }}" class="btn btn-light btn-sm">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('institution.details.store') }}">
                        @csrf

                        {{-- Full Name --}}
                        <div class="mb-3">
                            <label for="full_name" class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="full_name" id="full_name"
                                   value="{{ old('full_name', $institution->full_name ?? '') }}"
                                   class="form-control @error('full_name') is-invalid @enderror" required>
                            @error('full_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Short Name --}}
                        <div class="mb-3">
                            <label for="short_name" class="form-label fw-semibold">Short Name</label>
                            <input type="text" name="short_name" id="short_name"
                                   value="{{ old('short_name', $institution->short_name ?? '') }}"
                                   class="form-control @error('short_name') is-invalid @enderror">
                            @error('short_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Stream --}}
                        <div class="mb-3">
                            <label for="stream" class="form-label fw-semibold">Stream</label>
                            <input type="text" name="stream" id="stream"
                                   value="{{ old('stream', $institution->stream ?? '') }}"
                                   class="form-control @error('stream') is-invalid @enderror">
                            @error('stream')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Affiliation Number --}}
                        <div class="mb-3">
                            <label for="affiliation_number" class="form-label fw-semibold">Affiliation Number</label>
                            <input type="text" name="affiliation_number" id="affiliation_number"
                                   value="{{ old('affiliation_number', $institution->affiliation_number ?? '') }}"
                                   class="form-control @error('affiliation_number') is-invalid @enderror">
                            @error('affiliation_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Place --}}
                        <div class="mb-3">
                            <label for="place" class="form-label fw-semibold">Place</label>
                            <input type="text" name="place" id="place"
                                   value="{{ old('place', $institution->place ?? '') }}"
                                   class="form-control @error('place') is-invalid @enderror">
                            @error('place')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Address --}}
                        <div class="mb-3">
                            <label for="address" class="form-label fw-semibold">Address</label>
                            <textarea name="address" id="address"
                                      class="form-control @error('address') is-invalid @enderror"
                                      rows="3">{{ old('address', $institution->address ?? '') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Organization Name --}}
                        <div class="mb-3">
                            <label for="organization_name" class="form-label fw-semibold">Organization Name</label>
                            <input type="text" name="organization_name" id="organization_name"
                                   value="{{ old('organization_name', $institution->organization_name ?? '') }}"
                                   class="form-control @error('organization_name') is-invalid @enderror">
                            @error('organization_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Organization Short Name --}}
                        <div class="mb-3">
                            <label for="organization_short_name" class="form-label fw-semibold">Organization Short Name</label>
                            <input type="text" name="organization_short_name" id="organization_short_name"
                                   value="{{ old('organization_short_name', $institution->organization_short_name ?? '') }}"
                                   class="form-control @error('organization_short_name') is-invalid @enderror">
                            @error('organization_short_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('institution.dashboard') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-x-circle"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Save Details
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
