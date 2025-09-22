@extends('layouts.institution')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h4 class="mb-0">
                        <i class="bi bi-person-plus-fill"></i> Add New Student
                    </h4>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('institution.students.store') }}" class="row g-4">
                        @csrf

                        {{-- Student Name --}}
                        <div class="col-md-12">
                            <label for="name" class="form-label fw-semibold">Student Name</label>
                            <input type="text" name="name" id="name"
                                   class="form-control form-control-lg @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}" placeholder="Enter student full name" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- UID --}}
                        <div class="col-md-6">
                            <label for="uid" class="form-label fw-semibold">UID</label>
                            <input type="text" name="uid" id="uid"
                                   class="form-control form-control-lg @error('uid') is-invalid @enderror"
                                   value="{{ old('uid') }}" placeholder="Enter UID" required>
                            @error('uid') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Class --}}
                        <div class="col-md-6">
                            <label for="class" class="form-label fw-semibold">Class</label>
                            <select name="class" id="class"
                                    class="form-select form-select-lg @error('class') is-invalid @enderror" required>
                                <option value="">-- Select Class --</option>
                                <option value="HS1" {{ old('class') == 'HS1' ? 'selected' : '' }}>HS1</option>
                                <option value="HS2" {{ old('class') == 'HS2' ? 'selected' : '' }}>HS2</option>
                                <option value="HS3" {{ old('class') == 'HS3' ? 'selected' : '' }}>HS3</option>
                                <option value="S1" {{ old('class') == 'S1' ? 'selected' : '' }}>S1</option>
                                <option value="S2" {{ old('class') == 'S2' ? 'selected' : '' }}>S2</option>
                                <option value="D1" {{ old('class') == 'D1' ? 'selected' : '' }}>D1</option>
                                <option value="D2" {{ old('class') == 'D2' ? 'selected' : '' }}>D2</option>
                                <option value="D3" {{ old('class') == 'D3' ? 'selected' : '' }}>D3</option>
                                <option value="D4" {{ old('class') == 'D4' ? 'selected' : '' }}>D4</option>
                                <option value="PG1" {{ old('class') == 'PG1' ? 'selected' : '' }}>PG1</option>
                                <option value="PG2" {{ old('class') == 'PG2' ? 'selected' : '' }}>PG2</option>
                            </select>
                            @error('class') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Stream --}}
                        <div class="col-md-12">
                            <label for="stream" class="form-label fw-semibold">Stream</label>
                            <select name="stream" id="stream"
                                    class="form-select form-select-lg @error('stream') is-invalid @enderror" required>
                                <option value="">-- Select Stream --</option>
                                <option value="sharea" {{ old('stream') == 'sharea' ? 'selected' : '' }}>Sharea</option>
                                <option value="sharea plus" {{ old('stream') == 'sharea plus' ? 'selected' : '' }}>Sharea Plus</option>
                                <option value="she" {{ old('stream') == 'she' ? 'selected' : '' }}>She</option>
                                <option value="she plus" {{ old('stream') == 'she plus' ? 'selected' : '' }}>She Plus</option>
                                <option value="life" {{ old('stream') == 'life' ? 'selected' : '' }}>Life</option>
                                <option value="life plus" {{ old('stream') == 'life plus' ? 'selected' : '' }}>Life Plus</option>
                                <option value="bayyinath" {{ old('stream') == 'bayyinath' ? 'selected' : '' }}>Bayyinath</option>
                            </select>
                            @error('stream') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Submit --}}
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary btn-lg px-5 shadow-sm">
                                <i class="bi bi-check-circle-fill me-1"></i> Save Student
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
