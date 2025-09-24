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

                @php
                    // Group students by class
                    $studentsByClass = $students->groupBy('class');
                @endphp

                @foreach($studentsByClass as $class => $classStudents)
                    <h6 class="bg-light px-3 py-2 fw-bold">{{ $class }}</h6>
                    <table class="table table-striped table-hover align-middle mb-3">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Father's Name</th>
                                <th scope="col">Address</th>
                                <th scope="col">Contact Number</th>
                                <th scope="col">UID</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($classStudents as $student)
                                <tr>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->father_name }}</td>
                                    <td>{{ $student->address }}</td>
                                    <td>{{ $student->contact_number }}</td>
                                    <td>{{ $student->uid }}</td>
                                    <td>
                                        @if($student->status === 'approved')
                                            <span class="badge bg-success">Approved</span>
                                        @elseif($student->status === 'pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @else
                                            <span class="badge bg-secondary">{{ ucfirst($student->status) }}</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('institution.students.edit', $student->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        <form action="{{ route('institution.students.destroy', $student->id) }}" method="POST" class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this student?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endforeach

                @if($students->isEmpty())
                    <p class="text-center text-muted py-3">No students found</p>
                @endif

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
