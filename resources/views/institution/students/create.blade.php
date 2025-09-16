<form method="POST" action="{{ route('institution.students.store') }}" class="row g-4">
    @csrf

    {{-- Student Name --}}
    <div class="col-md-12">
        <label for="name" class="form-label fw-semibold">Student Name</label>
        <input type="text" name="name" id="name"
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name') }}" required>
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    {{-- UID --}}
    <div class="col-md-6">
        <label for="uid" class="form-label fw-semibold">UID</label>
        <input type="text" name="uid" id="uid"
               class="form-control @error('uid') is-invalid @enderror"
               value="{{ old('uid') }}" required>
        @error('uid') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    {{-- Class --}}
    <div class="col-md-6">
        <label for="class" class="form-label fw-semibold">Class</label>
        <input type="text" name="class" id="class"
               class="form-control @error('class') is-invalid @enderror"
               value="{{ old('class') }}" placeholder="Eg: HS1, HS2, S1, D1" required>
        @error('class') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    {{-- Stream --}}
    <div class="col-md-12">
        <label for="stream" class="form-label fw-semibold">Stream</label>
        <select name="stream" id="stream"
                class="form-select @error('stream') is-invalid @enderror" required>
            <option value="">-- Select Stream --</option>
            <option value="sharea">Sharea</option>
            <option value="sharea plus">Sharea Plus</option>
            <option value="she">She</option>
            <option value="she plus">She Plus</option>
            <option value="life">Life</option>
            <option value="life plus">Life Plus</option>
            <option value="bayyinath">Bayyinath</option>
        </select>
        @error('stream') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    {{-- Submit --}}
    <div class="col-12 text-end">
        <button type="submit" class="btn btn-primary px-4">
            <i class="bi bi-person-plus"></i> Add Student
        </button>
    </div>
</form>
