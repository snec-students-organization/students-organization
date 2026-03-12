@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>📝 Manage Quizzes</h2>
            <a href="{{ route('admin.online-course.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i> Back to Course
            </a>
        </div>

        {{-- Create Quiz Form --}}
        <div class="card shadow-sm border-0 mb-5">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Create New Quiz</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.quizzes.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Quiz Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description / Instructions</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="link" class="form-label">Quiz Link (Google Form, etc.)</label>
                        <input type="url" class="form-control" id="link" name="link" placeholder="https://..." required>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                        <label class="form-check-label" for="is_active">
                            Mark as Active
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i> Create Quiz
                    </button>
                </form>
            </div>
        </div>

        {{-- Quizzes List --}}
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Existing Quizzes</h5>
            </div>
            <div class="card-body">
                @if($quizzes->isEmpty())
                    <p class="text-center text-muted my-4">No quizzes created yet.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Link</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($quizzes as $quiz)
                                    <tr>
                                        <td><strong>{{ $quiz->title }}</strong></td>
                                        <td>{{ \Illuminate\Support\Str::limit($quiz->description, 50) }}</td>
                                        <td>
                                            <a href="{{ $quiz->link }}" target="_blank" class="text-decoration-none">
                                                <i class="bi bi-link-45deg"></i> Open
                                            </a>
                                        </td>
                                        <td>
                                            @if($quiz->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-secondary">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                        <td>
                                            <form action="{{ route('admin.quizzes.destroy', $quiz) }}" method="POST"
                                                onsubmit="return confirm('Delete this quiz?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection