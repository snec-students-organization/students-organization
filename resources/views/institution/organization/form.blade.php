@extends('layouts.institution')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
                {{ isset($organization) ? 'Edit Organization' : 'Add Organization' }}
            </h4>
        </div>

        <div class="card-body p-4">
            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('institution.organization.save') }}" method="POST" class="row g-4">
                @csrf

                {{-- College Name --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Name of Institution <span class="text-danger">*</span></label>
                    <input type="text" 
                           name="college_name" 
                           value="{{ old('college_name', $organization->college_name ?? auth('institution')->user()->name) }}" 
                           class="form-control @error('college_name') is-invalid @enderror"
                           placeholder="Enter College Name" required>
                    @error('college_name') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>

                {{-- Affiliation Number --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Affiliation Number <span class="text-danger">*</span></label>
                    <input type="text" 
                           name="affiliation_number" 
                           value="{{ old('affiliation_number', $organization->affiliation_number ?? auth('institution')->user()->affiliation_number ?? '') }}" 
                           class="form-control @error('affiliation_number') is-invalid @enderror"
                           placeholder="Enter Affiliation Number" required>
                    @error('affiliation_number') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>

                {{-- Organization Name --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Name of Students' Organization <span class="text-danger">*</span></label>
                    <input type="text" 
                           name="organization_name" 
                           value="{{ old('organization_name', $organization->organization_name ?? '') }}" 
                           class="form-control @error('organization_name') is-invalid @enderror"
                           placeholder="Enter Organization Name" required>
                    @error('organization_name') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>

                {{-- Contact Number --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Contact No: (Specialised for Organization) <span class="text-danger">*</span></label>
                    <input type="text" 
                           name="contact_number" 
                           value="{{ old('contact_number', $organization->contact_number ?? '') }}" 
                           class="form-control @error('contact_number') is-invalid @enderror"
                           placeholder="Enter Contact Number" required>
                    @error('contact_number') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>

                {{-- Email --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Mail ID <span class="text-danger">*</span></label>
                    <input type="email" 
                           name="email" 
                           value="{{ old('email', $organization->email ?? auth('institution')->user()->email) }}" 
                           class="form-control @error('email') is-invalid @enderror"
                           placeholder="Enter Mail ID" required>
                    @error('email') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>

                {{-- Submit --}}
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary px-4">
                        {{ isset($organization) ? 'Update' : 'Save' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
