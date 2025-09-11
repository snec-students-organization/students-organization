@extends('layouts.institution')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">➕ Add New Student</h4>
                    
                    {{-- Students List Button --}}
                    <a href="{{ route('institution.students.index') }}" class="btn btn-light btn-sm">
                        <i class="bi bi-list-ul"></i> Students List
                    </a>
                </div>

                <div class="card-body p-4">
                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- Student Form --}}
                    <form method="POST" action="{{ route('institution.students.store') }}" class="row g-4">
                        @csrf

                        {{-- Student Name --}}
                        <div class="col-md-12">
                            <label for="name" class="form-label fw-semibold">Student Name</label>
                            <input type="text" name="name" id="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}" placeholder="Enter full name" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- UID --}}
                        <div class="col-md-6">
                            <label for="uid" class="form-label fw-semibold">UID</label>
                            <input type="text" name="uid" id="uid"
                                   class="form-control @error('uid') is-invalid @enderror"
                                   value="{{ old('uid') }}" placeholder="Enter unique ID" required>
                            @error('uid')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Class --}}
                        <div class="col-md-6">
                            <label for="class" class="form-label fw-semibold">Class</label>
                            <input type="text" name="class" id="class"
                                   class="form-control @error('class') is-invalid @enderror"
                                   value="{{ old('class') }}" placeholder="Eg: S1,S2,D1,D2,D3" required>
                            @error('class')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Submit --}}
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-person-plus"></i> Add Student
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
