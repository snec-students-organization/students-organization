@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">🎓 Online Course Management</h2>
            <div>
                <a href="{{ route('admin.activities.index') }}" class="btn btn-outline-success me-2">
                    <i class="bi bi-list-check me-2"></i> Manage Activities
                </a>
                <a href="{{ route('admin.quizzes.index') }}" class="btn btn-outline-warning me-2">
                    <i class="bi bi-question-circle me-2"></i> Manage Quizzes
                </a>
                <a href="{{ route('admin.feature_flags.index') }}" class="btn btn-outline-primary">
                    <i class="bi bi-sliders me-2"></i> Settings
                </a>
            </div>
        </div>

        {{-- Settings Card --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">⚙️ Course Settings</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.online-course.settings.update') }}" method="POST">
                    @csrf
                    <div class="row align-items-end">
                        <div class="col-md-8">
                            <label for="class_room_link" class="form-label">Class Room Meeting Link</label>
                            <input type="url" class="form-control" id="class_room_link" name="class_room_link"
                                value="{{ $meetingLink ?? '' }}" placeholder="https://meet.google.com/..." required>
                            <div class="form-text">Paste the Google Meet, Zoom, or Teams link here.</div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i> Save Link
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="card shadow-sm border-0 bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Total Registered Students</h5>
                        <p class="display-4 fw-bold mb-0">{{ $students->total() }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm border-0 bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Attendance Marked Today</h5>
                        <p class="display-4 fw-bold mb-0">
                            {{ \App\Models\OnlineCourseAttendance::whereDate('attendance_date', now())->count() }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Registered Students & Attendance</h5>
            </div>
            <div class="card-body">
                @if($students->isEmpty())
                    <p class="text-center text-muted my-5">No students registered yet.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Student Name</th>
                                    <th>UID</th>
                                    <th>Registration Date</th>
                                    <th class="text-center">Total Attendance</th>
                                    <th class="text-center">Today's Attendance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                    <tr>
                                        <td>
                                            <div class="fw-bold">{{ $student->name }}</div>
                                            <small class="text-muted">{{ $student->email }}</small>
                                        </td>
                                        <td>{{ $student->uid }}</td>
                                        <td>
                                            {{ $student->onlineCourseRegistration->created_at->format('M d, Y') }}
                                            <br>
                                            <small
                                                class="text-muted">{{ $student->onlineCourseRegistration->created_at->format('h:i A') }}</small>
                                        </td>
                                        <td class="text-center">
                                            <span
                                                class="badge bg-info text-dark fs-6">{{ $student->online_course_attendances_count }}</span>
                                        </td>
                                        <td class="text-center">
                                            @if($student->onlineCourseAttendances->where('attendance_date', now()->toDateString())->isNotEmpty())
                                                <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Marked</span>
                                            @else
                                                <span class="badge bg-secondary"><i class="bi bi-dash-circle me-1"></i> Not
                                                    Marked</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $students->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection