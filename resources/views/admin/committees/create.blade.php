@extends('layouts.app')

@section('title', 'Add Committee Member')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow">
                <div class="card-header py-3 bg-primary text-white">
                    <h4 class="m-0"><i class="bi bi-person-plus me-2"></i>Add Committee Member</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <h5><i class="bi bi-exclamation-triangle-fill me-2"></i>Validation Error</h5>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('admin.committees.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-section mb-4">
                            <h5 class="text-primary mb-3"><i class="bi bi-diagram-3 me-2"></i>Committee Details</h5>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="committee_type" class="form-label required-label">Committee Type</label>
                                    <select name="committee_type" id="committee_type" class="form-select" required>
                                        <option value="">-- Select Type --</option>
                                        <option value="main" {{ old('committee_type') == 'main' ? 'selected' : '' }}>Main Committee</option>
                                        <option value="sub" {{ old('committee_type') == 'sub' ? 'selected' : '' }}>Sub Committee</option>
                                    </select>
                                    <div class="form-text">Select whether this is for the main or a sub committee</div>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <div id="subCommitteeWrapper" style="display:none;">
                                        <label for="sub_committee" class="form-label">Sub Committee</label>
                                        <select name="sub_committee" id="sub_committee" class="form-select">
                                            <option value="">-- Select Sub Committee --</option>
                                            <option value="media_hub" {{ old('sub_committee') == 'media_hub' ? 'selected' : '' }}>Media Hub</option>
                                            <option value="creative_commune" {{ old('sub_committee') == 'creative_commune' ? 'selected' : '' }}>Creative Commune</option>
                                            <option value="cultural_sphere" {{ old('sub_committee') == 'cultural_sphere' ? 'selected' : '' }}>Cultural Sphere</option>
                                            <option value="literary" {{ old('sub_committee') == 'literary' ? 'selected' : '' }}>Literary</option>
                                        </select>
                                        <div class="form-text">Select the specific sub committee</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-section mb-4">
                            <h5 class="text-primary mb-3"><i class="bi bi-person-badge me-2"></i>Member Information</h5>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label required-label">Full Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                                    <div class="form-text">Enter the member's full name</div>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label required-label">Position</label>
                                    <input type="text" name="position" class="form-control" value="{{ old('position') }}" required>
                                    <div class="form-text">e.g., President, Secretary, etc.</div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">College Name</label>
                                    <input type="text" name="college_name" class="form-control" value="{{ old('college_name') }}">
                                    <div class="form-text">The member's affiliated college</div>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Profile Image</label>
                                    <input type="file" name="image" class="form-control" accept="image/*">
                                    <div class="form-text">Recommended size: 300x300 pixels</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <a href="{{ route('admin.committees.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-2"></i>Back to List
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-plus-circle me-2"></i>Add Member
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .required-label:after {
        content: " *";
        color: #dc3545;
    }
    .form-section {
        border-left: 4px solid #0d6efd;
        padding-left: 15px;
        margin-bottom: 25px;
    }
    .form-control:focus, .form-select:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const committeeType = document.getElementById("committee_type");
        const subWrapper = document.getElementById("subCommitteeWrapper");

        function toggleSubCommittee() {
            if (committeeType.value === "sub") {
                subWrapper.style.display = "block";
            } else {
                subWrapper.style.display = "none";
                document.getElementById("sub_committee").value = "";
            }
        }

        // Initial check (in case of validation error reload)
        toggleSubCommittee();

        // On change
        committeeType.addEventListener("change", toggleSubCommittee);
    });
</script>
@endpush