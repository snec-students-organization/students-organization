@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <!-- Header + Add Button -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h4 mb-0 text-gray-800">Organizations</h2>

                @if(auth()->user() && auth()->user()->role === 'admin')
                    <a href="{{ route('admin.organizations.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle me-1"></i> Add Organization
                    </a>
                @endif
            </div>

            <!-- Flash Message -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>College Name</th>
                            <th>Affiliation Number</th>
                            <th>Organization Name</th>
                            <th>Contact Number</th>
                            <th>Mail ID</th>
                            @if(auth()->user() && auth()->user()->role === 'admin')
                                <th class="text-center">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($organizations as $organization)
                            <tr>
                                <td class="fw-semibold">{{ $organization->college_name }}</td>
                                <td>{{ $organization->affiliation_number }}</td>
                                
                                <!-- Organization Name + Verify Section -->
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="fw-semibold">{{ $organization->organization_name }}</span>

                                        @if(auth()->user() && auth()->user()->role === 'admin')
                                            <div class="mt-1">
                                                <span class="badge {{ $organization->status === 'verified' ? 'bg-success' : 'bg-warning text-dark' }}">
                                                    {{ ucfirst($organization->status) }}
                                                </span>
                                            </div>

                                            <form action="{{ route('admin.organizations.verify', $organization->id) }}" method="POST" class="mt-2 d-flex align-items-center gap-2">
                                                @csrf
                                                @method('PUT')
                                                <select name="status" class="form-select form-select-sm w-auto">
                                                    <option value="pending" {{ $organization->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="verified" {{ $organization->status === 'verified' ? 'selected' : '' }}>Verified</option>
                                                </select>
                                                <button type="submit" class="btn btn-sm btn-outline-success">Update</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>

                                <!-- Contact Number -->
                                <td>{{ $organization->contact_number }}</td>

                                <!-- Mail ID -->
                                <td>{{ $organization->email }}</td>

                                @if(auth()->user() && auth()->user()->role === 'admin')
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('admin.organizations.edit', $organization->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-pencil-square me-1"></i> Edit
                                            </a>

                                            <form action="{{ route('admin.organizations.destroy', $organization->id) }}" method="POST" 
                                                  onsubmit="return confirm('Are you sure you want to delete this organization?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="bi bi-trash me-1"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ auth()->user() && auth()->user()->role === 'admin' ? '6' : '5' }}" 
                                    class="text-center py-4 text-muted">
                                    No organizations found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                @if($organizations->hasPages())
                    <div class="mt-3 d-flex justify-content-center">
                        {{ $organizations->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
