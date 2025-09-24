@extends('layouts.institution')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-warning text-dark rounded-top-4">
                    <h4 class="mb-0">
                        <i class="bi bi-pencil-square"></i> Edit Student
                    </h4>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('institution.students.update', $student->id) }}" class="row g-4">
                        @csrf
                        @method('PUT')

                        {{-- Student Name --}}
                        <div class="col-md-12">
                            <label for="name" class="form-label fw-semibold">Student Name</label>
                            <input type="text" name="name" id="name"
                                   class="form-control form-control-lg @error('name') is-invalid @enderror"
                                   value="{{ old('name', $student->name) }}" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Father Name --}}
                        <div class="col-md-12">
                            <label for="father_name" class="form-label fw-semibold">Father's Name</label>
                            <input type="text" name="father_name" id="father_name"
                                   class="form-control form-control-lg @error('father_name') is-invalid @enderror"
                                   value="{{ old('father_name', $student->father_name) }}" required>
                            @error('father_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Address --}}
                        <div class="col-md-12">
                            <label for="address" class="form-label fw-semibold">Address</label>
                            <textarea name="address" id="address" rows="3"
                                      class="form-control form-control-lg @error('address') is-invalid @enderror"
                                      required>{{ old('address', $student->address) }}</textarea>
                            @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Contact Number --}}
                        <div class="col-md-6">
                            <label for="contact_number" class="form-label fw-semibold">Contact Number</label>
                            <input type="text" name="contact_number" id="contact_number"
                                   class="form-control form-control-lg @error('contact_number') is-invalid @enderror"
                                   value="{{ old('contact_number', $student->contact_number) }}" required>
                            @error('contact_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- UID --}}
                        <div class="col-md-6">
                            <label for="uid" class="form-label fw-semibold">UID</label>
                            <input type="text" name="uid" id="uid"
                                   class="form-control form-control-lg @error('uid') is-invalid @enderror"
                                   value="{{ old('uid', $student->uid) }}" required>
                            @error('uid') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Class --}}
                        <div class="col-md-6">
                            <label for="class" class="form-label fw-semibold">Class</label>
                            <select name="class" id="class"
                                    class="form-select form-select-lg @error('class') is-invalid @enderror" required>
                                <option value="">-- Select Class --</option>
                                @foreach(['HS1','HS2','HS3','S1','S2','D1','D2','D3','D4','PG1','PG2'] as $class)
                                    <option value="{{ $class }}" {{ old('class', $student->class) == $class ? 'selected' : '' }}>
                                        {{ $class }}
                                    </option>
                                @endforeach
                            </select>
                            @error('class') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Stream --}}
                        <div class="col-md-6">
                            <label for="stream" class="form-label fw-semibold">Stream</label>
                            <select name="stream" id="stream"
                                    class="form-select form-select-lg @error('stream') is-invalid @enderror" required>
                                <option value="">-- Select Stream --</option>
                                @foreach([
                                    'sharea','sharea plus','she','she plus','life','life plus','bayyinath',
                                    'life for girls','life plus for girls'
                                ] as $stream)
                                    <option value="{{ $stream }}" {{ old('stream', $student->stream) == $stream ? 'selected' : '' }}>
                                        {{ ucfirst($stream) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('stream') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Submit --}}
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-warning btn-lg px-5 shadow-sm">
                                <i class="bi bi-check-circle-fill me-1"></i> Update Student
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
