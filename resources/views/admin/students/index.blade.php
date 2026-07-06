@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">🎓 Students by Institution</h2>

    {{-- 🔍 Search & Filter Bar --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body bg-white rounded-3 p-3">
            <form method="GET" action="{{ route('admin.students.byInstitution') }}" class="row g-3 align-items-center">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-search"></i></span>
                        <input type="text" name="search" class="form-control border-start-0 ps-0"
                               placeholder="Search by college name..."
                               value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-funnel"></i></span>
                        <select name="stream" class="form-select border-start-0 ps-0">
                            <option value="">-- All Streams --</option>
                            @foreach($streams as $stream)
                                <option value="{{ $stream }}" {{ request('stream') == $stream ? 'selected' : '' }}>
                                    {{ ucfirst($stream) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100 fw-semibold">
                        <i class="bi bi-filter"></i> Apply Filters
                    </button>
                    @if(request('search') || request('stream'))
                        <a href="{{ route('admin.students.byInstitution') }}" class="btn btn-outline-secondary w-50">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- 📥 Export All Students --}}
    <div class="mb-4 d-flex justify-content-end">
        <a href="{{ route('admin.students.exportAll') }}" class="btn btn-success">
            📥 Export All Students
        </a>
    </div>

    {{-- ✅ Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @foreach($institutions as $institution)
        @include('admin.students.partials.institution_card', ['institution' => $institution])
    @endforeach
</div>
@endsection
