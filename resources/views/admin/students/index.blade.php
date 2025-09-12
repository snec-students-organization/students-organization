@extends('layouts.app')

@section('content')
<div class="container my-4">
    @foreach($institutions as $institution)
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">{{ $institution->name }}</h4>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0 align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Name</th>
                                <th>UID</th>
                                <th>Class</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($institution->students as $student)
                                <tr>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->uid }}</td>
                                    <td>{{ $student->class }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($student->status == 'pending') bg-warning text-dark
                                            @elseif($student->status == 'verified') bg-success
                                            @elseif($student->status == 'working_fund') bg-info text-dark
                                            @endif">
                                            {{ ucfirst($student->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.students.update_status', $student) }}" class="d-flex gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" class="form-select form-select-sm w-auto">
                                                <option value="pending" @selected($student->status == 'pending')>Pending</option>
                                                <option value="verified" @selected($student->status == 'verified')>Verified</option>
                                                <option value="working_fund" @selected($student->status == 'working_fund')>Working Fund</option>
                                            </select>
                                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-3">
                                        No students in this institution.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection