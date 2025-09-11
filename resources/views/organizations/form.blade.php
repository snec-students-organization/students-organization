<div class="grid grid-cols-2 gap-4">
    {{-- Institution (College) Dropdown --}}
    <div class="col-span-2">
        <label for="institution_id" class="form-label">College Name <span class="text-danger">*</span></label>
        <select name="institution_id" id="institution_id" class="w-full border p-2 rounded @error('institution_id') border-red-600 @enderror" required>
            <option value="">-- Select College --</option>
            @foreach($institutions as $institution)
                <option value="{{ $institution->id }}" {{ (old('institution_id', $organization->institution_id ?? '') == $institution->id) ? 'selected' : '' }}>
                    {{ $institution->full_name ?? $institution->name }}
                </option>
            @endforeach
        </select>
        @error('institution_id')
            <p class="text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- College Name - optional if you want it separately (remove if using dropdown above) --}}
    {{-- <div>
        <label for="college_name" class="form-label">College Name <span class="text-danger">*</span></label>
        <input type="text" name="college_name" id="college_name" value="{{ old('college_name', $organization->college_name ?? '') }}" class="w-full border p-2 rounded @error('college_name') border-red-600 @enderror">
        @error('college_name') <p class="text-red-600 mt-1">{{ $message }}</p> @enderror
    </div> --}}

    <div>
        <label for="organization_name" class="form-label">Organization Name <span class="text-danger">*</span></label>
        <input type="text" name="organization_name" id="organization_name" value="{{ old('organization_name', $organization->organization_name ?? '') }}" class="w-full border p-2 rounded @error('organization_name') border-red-600 @enderror" required>
        @error('organization_name') <p class="text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="organization_director_name" class="form-label">Director Name <span class="text-danger">*</span></label>
        <input type="text" name="organization_director_name" id="organization_director_name" value="{{ old('organization_director_name', $organization->organization_director_name ?? '') }}" class="w-full border p-2 rounded @error('organization_director_name') border-red-600 @enderror" required>
        @error('organization_director_name') <p class="text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="organization_director_number" class="form-label">Director Number <span class="text-danger">*</span></label>
        <input type="text" name="organization_director_number" id="organization_director_number" value="{{ old('organization_director_number', $organization->organization_director_number ?? '') }}" class="w-full border p-2 rounded @error('organization_director_number') border-red-600 @enderror" required>
        @error('organization_director_number') <p class="text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="counciler_name" class="form-label">Counciler Name <span class="text-danger">*</span></label>
        <input type="text" name="counciler_name" id="counciler_name" value="{{ old('counciler_name', $organization->counciler_name ?? '') }}" class="w-full border p-2 rounded @error('counciler_name') border-red-600 @enderror" required>
        @error('counciler_name') <p class="text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="counciler_number" class="form-label">Counciler Number <span class="text-danger">*</span></label>
        <input type="text" name="counciler_number" id="counciler_number" value="{{ old('counciler_number', $organization->counciler_number ?? '') }}" class="w-full border p-2 rounded @error('counciler_number') border-red-600 @enderror" required>
        @error('counciler_number') <p class="text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="chairman_name" class="form-label">Chairman Name <span class="text-danger">*</span></label>
        <input type="text" name="chairman_name" id="chairman_name" value="{{ old('chairman_name', $organization->chairman_name ?? '') }}" class="w-full border p-2 rounded @error('chairman_name') border-red-600 @enderror" required>
        @error('chairman_name') <p class="text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="chairman_number" class="form-label">Chairman Number <span class="text-danger">*</span></label>
        <input type="text" name="chairman_number" id="chairman_number" value="{{ old('chairman_number', $organization->chairman_number ?? '') }}" class="w-full border p-2 rounded @error('chairman_number') border-red-600 @enderror" required>
        @error('chairman_number') <p class="text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="convenor_name" class="form-label">Convenor Name <span class="text-danger">*</span></label>
        <input type="text" name="convenor_name" id="convenor_name" value="{{ old('convenor_name', $organization->convenor_name ?? '') }}" class="w-full border p-2 rounded @error('convenor_name') border-red-600 @enderror" required>
        @error('convenor_name') <p class="text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="convenor_number" class="form-label">Convenor Number <span class="text-danger">*</span></label>
        <input type="text" name="convenor_number" id="convenor_number" value="{{ old('convenor_number', $organization->convenor_number ?? '') }}" class="w-full border p-2 rounded @error('convenor_number') border-red-600 @enderror" required>
        @error('convenor_number') <p class="text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Stream Dropdown --}}
    <div class="col-span-2">
        <label for="stream" class="form-label">Stream <span class="text-danger">*</span></label>
        <select name="stream" id="stream" class="w-full border p-2 rounded @error('stream') border-red-600 @enderror" required>
            <option value="">-- Select Stream --</option>
            @foreach ($streams as $stream)
                <option value="{{ $stream }}" {{ (old('stream', $organization->stream ?? '') == $stream) ? 'selected' : '' }}>
                    {{ ucfirst($stream) }}
                </option>
            @endforeach
        </select>
        @error('stream')
            <p class="text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>
