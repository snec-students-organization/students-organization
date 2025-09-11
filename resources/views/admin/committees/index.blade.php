@extends('layouts.app')

@section('title', 'Committee Members')

@section('content')
<div class="container-fluid px-0">

    {{-- Page Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 p-3 bg-primary text-white rounded shadow-sm">
        <h1 class="h3 mb-2 mb-sm-0">
            <i class="bi bi-people-fill me-2"></i> Committee Members
        </h1>
        <a href="{{ route('admin.committees.create') }}" class="btn btn-light btn-sm shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Add Member
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Card with Table --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">

            {{-- Responsive Table --}}
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>College</th>
                            <th>Committee Type</th>
                            <th>Sub Committee</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($members as $member)
                            <tr>
                                <td>
                                    @if($member->image)
                                        <img src="{{ asset('storage/' . $member->image) }}" 
                                             alt="{{ $member->name }}" 
                                             class="rounded-circle border shadow-sm"
                                             style="width: 60px; height: 60px; object-fit: cover;">
                                    @else
                                        <span class="badge bg-secondary">No Image</span>
                                    @endif
                                </td>
                                <td class="fw-semibold">{{ $member->name }}</td>
                                <td>{{ $member->position }}</td>
                                <td>{{ $member->college_name ?? '-' }}</td>
                                <td class="text-capitalize">{{ $member->committee_type }}</td>
                                <td class="text-capitalize">{{ $member->sub_committee ?? '-' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.committees.edit', $member->id) }}" 
                                       class="btn btn-warning btn-sm me-1">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.committees.destroy', $member->id) }}" 
                                          method="POST" 
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure?')">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="bi bi-exclamation-circle me-2"></i> No committee members found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $members->links() }}
    </div>
</div>

@endsection    