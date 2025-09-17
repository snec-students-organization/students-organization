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
    <select name="class" id="class"
            class="form-select @error('class') is-invalid @enderror" required>
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
