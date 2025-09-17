@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">🎓 Students by Institution</h2>

    {{-- 🔍 Search Bar --}}
    <div class="mb-4">
        <form method="GET" action="{{ route('admin.students.byInstitution') }}" class="d-flex gap-2">
            <input type="text" name="search" class="form-control"
                   placeholder="🔍 Search by college name"
                   value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Search</button>
            @if(request('search'))
                <a href="{{ route('admin.students.byInstitution') }}" class="btn btn-secondary">Reset</a>
            @endif
        </form>
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
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ $institution->name }}</h5>
                <small>{{ $institution->email }}</small>
            </div>
            <div class="card-body">
                @if($institution->students->isEmpty())
                    <p class="text-muted">No students added yet.</p>
                @else
                    {{-- 📥 Export This College --}}
                    <div class="mb-3 d-flex justify-content-end">
                        <a href="{{ route('admin.students.exportByInstitution', $institution->id) }}" class="btn btn-outline-success btn-sm">
                            📥 Export {{ $institution->name }} Students
                        </a>
                    </div>

                    @php
                        // Group students by class
                        $studentsByClass = $institution->students->groupBy('class');
                    @endphp

                    @foreach($studentsByClass as $className => $students)
                        <h5 class="mt-4 mb-3 text-primary">📌 Class: {{ $className }}</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>UID</th>
                                        <th>Stream</th>
                                        <th>Father</th>
                                        <th>Address</th>
                                        <th>Contact</th>
                                        <th>Status</th>
                                        <th>Update</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $student)
                                        <tr>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->uid }}</td>
                                            <td>{{ $student->stream ?? '—' }}</td>
                                            <td>{{ $student->father_name ?? '—' }}</td>
                                            <td>{{ $student->address ?? '—' }}</td>
                                            <td>{{ $student->contact_number ?? '—' }}</td>
                                            <td>
                                                <span class="badge 
                                                    @if($student->status == 'pending') bg-warning text-dark
                                                    @elseif($student->status == 'verified') bg-success
                                                    @else bg-info text-dark @endif">
                                                    {{ ucfirst($student->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.student.updateStatus', $student->id) }}" method="POST" class="d-flex gap-2">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select name="status" class="form-select form-select-sm w-auto">
                                                        <option value="pending" {{ $student->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="verified" {{ $student->status == 'verified' ? 'selected' : '' }}>Verified</option>
                                                        <option value="working_fund" {{ $student->status == 'working_fund' ? 'selected' : '' }}>Working Fund</option>
                                                    </select>
                                                    <button type="submit" class="btn btn-sm btn-primary">✔</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
