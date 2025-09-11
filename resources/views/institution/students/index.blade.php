@extends('layouts.institution')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Students List</h5>
            <a href="{{ route('institution.students.create') }}" class="btn btn-light btn-sm">
                <i class="bi bi-person-plus"></i> Add Student
            </a>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">UID</th>
                            <th scope="col">Class</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                            <tr>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->uid }}</td>
                                <td>{{ $student->class }}</td>
                                <td>
                                    @if($student->status === 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @elseif($student->status === 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($student->status) }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">No students found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-center">
                {{ $students->links() }}
            </div>
        </div>
    </div>
</div>
@endsection



