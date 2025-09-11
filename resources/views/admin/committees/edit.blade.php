@extends('layouts.app')

@section('title', 'Edit Committee Member')

@section('content')
<div class="container-fluid">
    

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-pencil-square me-2 text-primary"></i>
                        Update Member Details
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.committees.update', $member->id) }}" 
                          method="POST" 
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            {{-- Committee Type --}}
                            <div class="col-md-6 mb-3">
                                <label for="committee_type" class="form-label fw-semibold">Committee Type</label>
                                <select name="committee_type" id="committee_type" class="form-select" required>
                                    <option value="main" {{ $member->committee_type == 'main' ? 'selected' : '' }}>Main Committee</option>
                                    <option value="sub" {{ $member->committee_type == 'sub' ? 'selected' : '' }}>Sub Committee</option>
                                </select>
                                <div class="form-text">Select the committee type for this member</div>
                            </div>

                            {{-- Sub Committee --}}
                            <div class="col-md-6 mb-3" id="sub_committee_wrapper" style="{{ $member->committee_type == 'sub' ? '' : 'display:none;' }}">
                                <label for="sub_committee" class="form-label fw-semibold">Sub Committee</label>
                                <select name="sub_committee" id="sub_committee" class="form-select">
                                    <option value="">-- Select Sub Committee --</option>
                                    <option value="media_hub" {{ $member->sub_committee == 'media_hub' ? 'selected' : '' }}>Media Hub</option>
                                    <option value="creative_commune" {{ $member->sub_committee == 'creative_commune' ? 'selected' : '' }}>Creative Commune</option>
                                    <option value="literary" {{ $member->sub_committee == 'literary' ? 'selected' : '' }}>Literary</option>
                                    <option value="cultural_sphere" {{ $member->sub_committee == 'cultural_sphere' ? 'selected' : '' }}>Cultural Sphere</option>
                                </select>
                                <div class="form-text">Select the specific sub committee</div>
                            </div>
                        </div>

                        <div class="row">
                            {{-- Name --}}
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label fw-semibold">Member Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $member->name) }}" required>
                                <div class="form-text">Enter the full name of the committee member</div>
                            </div>

                            {{-- Position --}}
                            <div class="col-md-6 mb-3">
                                <label for="position" class="form-label fw-semibold">Position</label>
                                <input type="text" name="position" class="form-control" value="{{ old('position', $member->position) }}" required>
                                <div class="form-text">e.g., President, Secretary, Treasurer</div>
                            </div>
                        </div>

                        <div class="row">
                            {{-- College Name --}}
                            <div class="col-md-6 mb-3">
                                <label for="college_name" class="form-label fw-semibold">College Name</label>
                                <input type="text" name="college_name" class="form-control" value="{{ old('college_name', $member->college_name) }}">
                                <div class="form-text">The college or institution the member represents</div>
                            </div>

                            {{-- Image --}}
                            <div class="col-md-6 mb-3">
                                <label for="image" class="form-label fw-semibold">Profile Image</label>
                                <input type="file" name="image" class="form-control" accept="image/*">
                                @if($member->image)
                                    <div class="mt-3">
                                        <p class="mb-1 small text-muted">Current Image:</p>
                                        <img src="{{ asset('storage/' . $member->image) }}" alt="Current Image" width="120" class="img-thumbnail">
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="checkbox" name="remove_image" id="remove_image" value="1">
                                            <label class="form-check-label small" for="remove_image">
                                                Remove current image
                                            </label>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-text">Recommended: Square image, 300x300 pixels</div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                            <a href="{{ route('admin.committees.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-x-circle me-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-1"></i> Update Member
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const committeeType = document.getElementById('committee_type');
        const subCommitteeWrapper = document.getElementById('sub_committee_wrapper');
        
        function toggleSubCommittee() {
            if (committeeType.value === 'sub') {
                subCommitteeWrapper.style.display = 'block';
            } else {
                subCommitteeWrapper.style.display = 'none';
                document.getElementById('sub_committee').value = '';
            }
        }
        
        committeeType.addEventListener('change', toggleSubCommittee);
    });
</script>

@endpush