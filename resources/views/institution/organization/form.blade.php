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
                    <label class="form-label fw-semibold">College Name</label>
                    <input type="text" 
                           name="college_name" 
                           value="{{ old('college_name', $organization->college_name ?? '') }}" 
                           class="form-control @error('college_name') is-invalid @enderror">
                    @error('college_name') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>

                {{-- Organization Name --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Organization Name</label>
                    <input type="text" 
                           name="organization_name" 
                           value="{{ old('organization_name', $organization->organization_name ?? '') }}" 
                           class="form-control @error('organization_name') is-invalid @enderror">
                    @error('organization_name') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>

                {{-- Director --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Director Name</label>
                    <input type="text" 
                           name="organization_director_name" 
                           value="{{ old('organization_director_name', $organization->organization_director_name ?? '') }}" 
                           class="form-control @error('organization_director_name') is-invalid @enderror">
                    @error('organization_director_name') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Director Number</label>
                    <input type="text" 
                           name="organization_director_number" 
                           value="{{ old('organization_director_number', $organization->organization_director_number ?? '') }}" 
                           class="form-control @error('organization_director_number') is-invalid @enderror">
                    @error('organization_director_number') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>

                {{-- Counciler --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Counciler Name</label>
                    <input type="text" 
                           name="counciler_name" 
                           value="{{ old('counciler_name', $organization->counciler_name ?? '') }}" 
                           class="form-control @error('counciler_name') is-invalid @enderror">
                    @error('counciler_name') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Counciler Number</label>
                    <input type="text" 
                           name="counciler_number" 
                           value="{{ old('counciler_number', $organization->counciler_number ?? '') }}" 
                           class="form-control @error('counciler_number') is-invalid @enderror">
                    @error('counciler_number') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>

                {{-- Chairman --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Chairman Name</label>
                    <input type="text" 
                           name="chairman_name" 
                           value="{{ old('chairman_name', $organization->chairman_name ?? '') }}" 
                           class="form-control @error('chairman_name') is-invalid @enderror">
                    @error('chairman_name') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Chairman Number</label>
                    <input type="text" 
                           name="chairman_number" 
                           value="{{ old('chairman_number', $organization->chairman_number ?? '') }}" 
                           class="form-control @error('chairman_number') is-invalid @enderror">
                    @error('chairman_number') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>

                {{-- Convenor --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Convenor Name</label>
                    <input type="text" 
                           name="convenor_name" 
                           value="{{ old('convenor_name', $organization->convenor_name ?? '') }}" 
                           class="form-control @error('convenor_name') is-invalid @enderror">
                    @error('convenor_name') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Convenor Number</label>
                    <input type="text" 
                           name="convenor_number" 
                           value="{{ old('convenor_number', $organization->convenor_number ?? '') }}" 
                           class="form-control @error('convenor_number') is-invalid @enderror">
                    @error('convenor_number') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>

                {{-- Stream --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Stream</label>
                    <select name="stream" class="form-select @error('stream') is-invalid @enderror" required>
                        <option value="">-- Select Stream --</option>
                        @foreach ($streams as $stream)
                            <option value="{{ $stream }}" 
                                {{ (old('stream', $organization->stream ?? '') == $stream) ? 'selected' : '' }}>
                                {{ ucfirst($stream) }}
                            </option>
                        @endforeach
                    </select>
                    @error('stream') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>

                {{-- Submit --}}
                <div class="col-12">
                    <button type="submit" class="btn btn-primary px-4">
                        {{ isset($organization) ? 'Update' : 'Save' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

