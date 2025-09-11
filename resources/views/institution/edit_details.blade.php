@extends('layouts.institution')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">✏️ Edit Institution Details</h4>
                    <a href="{{ route('institution.dashboard') }}" class="btn btn-sm btn-light">Back</a>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('institution.details.update') }}">
                        @csrf
                        @method('PUT')

                        {{-- Full Name --}}
                        <div class="mb-3">
                            <label for="full_name" class="form-label fw-semibold">Full Name*</label>
                            <input type="text" name="full_name" id="full_name"
                                   value="{{ old('full_name', $institution->full_name) }}"
                                   class="form-control @error('full_name') is-invalid @enderror" required>
                            @error('full_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Short Name --}}
                        <div class="mb-3">
                            <label for="short_name" class="form-label fw-semibold">Short Name</label>
                            <input type="text" name="short_name" id="short_name"
                                   value="{{ old('short_name', $institution->short_name) }}"
                                   class="form-control">
                        </div>

                        {{-- Stream --}}
                        <div class="mb-3">
                            <label for="stream" class="form-label fw-semibold">Stream</label>
                            <input type="text" name="stream" id="stream"
                                   value="{{ old('stream', $institution->stream) }}"
                                   class="form-control">
                        </div>

                        {{-- Affiliation Number --}}
                        <div class="mb-3">
                            <label for="affiliation_number" class="form-label fw-semibold">Affiliation Number</label>
                            <input type="text" name="affiliation_number" id="affiliation_number"
                                   value="{{ old('affiliation_number', $institution->affiliation_number) }}"
                                   class="form-control">
                        </div>

                        {{-- Place --}}
                        <div class="mb-3">
                            <label for="place" class="form-label fw-semibold">Place</label>
                            <input type="text" name="place" id="place"
                                   value="{{ old('place', $institution->place) }}"
                                   class="form-control">
                        </div>

                        {{-- Address --}}
                        <div class="mb-3">
                            <label for="address" class="form-label fw-semibold">Address</label>
                            <textarea name="address" id="address" 
                                      class="form-control">{{ old('address', $institution->address) }}</textarea>
                        </div>

                        {{-- Organization Name --}}
                        <div class="mb-3">
                            <label for="organization_name" class="form-label fw-semibold">Organization Name</label>
                            <input type="text" name="organization_name" id="organization_name"
                                   value="{{ old('organization_name', $institution->organization_name) }}"
                                   class="form-control">
                        </div>

                        {{-- Organization Short Name --}}
                        <div class="mb-3">
                            <label for="organization_short_name" class="form-label fw-semibold">Organization Short Name</label>
                            <input type="text" name="organization_short_name" id="organization_short_name"
                                   value="{{ old('organization_short_name', $institution->organization_short_name) }}"
                                   class="form-control">
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('institution.dashboard') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save"></i> Update Details
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


