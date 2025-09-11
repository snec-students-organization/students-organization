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

            <!-- Stream Filter -->
            <form method="GET" action="{{ route('organizations.index') }}" class="row g-2 align-items-center mb-3">
                <div class="col-auto">
                    <label for="stream" class="col-form-label fw-semibold">Filter by Stream:</label>
                </div>
                <div class="col-auto">
                    <select name="stream" id="stream" onchange="this.form.submit()" class="form-select">
                        <option value="">All Streams</option>
                        @foreach ($streams as $stream)
                            <option value="{{ $stream }}" @if ($selectedStream == $stream) selected @endif>
                                {{ ucfirst($stream) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>College Name</th>
                            <th>Organization Name</th>
                            <th>Director</th>
                            <th>Counciler</th>
                            <th>Chairman</th>
                            <th>Convenor</th>
                            @if(auth()->user() && auth()->user()->role === 'admin')
                                <th class="text-center">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($organizations as $organization)
                            <tr>
                                <td class="fw-semibold">{{ $organization->college_name }}</td>
                                <td>{{ $organization->organization_name }}</td>
                                <td>
                                    {{ $organization->organization_director_name }}
                                    @if(auth()->user() && auth()->user()->role === 'admin')
                                        <br><small class="text-muted">📞 {{ $organization->organization_director_number }}</small>
                                    @endif
                                </td>
                                <td>
                                    {{ $organization->counciler_name }}
                                    @if(auth()->user() && auth()->user()->role === 'admin')
                                        <br><small class="text-muted">📞 {{ $organization->counciler_number }}</small>
                                    @endif
                                </td>
                                <td>
                                    {{ $organization->chairman_name }}
                                    @if(auth()->user() && auth()->user()->role === 'admin')
                                        <br><small class="text-muted">📞 {{ $organization->chairman_number }}</small>
                                    @endif
                                </td>
                                <td>
                                    {{ $organization->convenor_name }}
                                    @if(auth()->user() && auth()->user()->role === 'admin')
                                        <br><small class="text-muted">📞 {{ $organization->convenor_number }}</small>
                                    @endif
                                </td>

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
                                <td colspan="{{ auth()->user() && auth()->user()->role === 'admin' ? '7' : '6' }}" 
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
