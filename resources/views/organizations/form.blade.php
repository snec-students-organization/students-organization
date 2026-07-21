<div class="grid grid-cols-2 gap-4">
    {{-- Institution (College) Dropdown --}}
    <div class="col-span-2">
        <label for="institution_id" class="form-label">Name of Institution <span class="text-danger">*</span></label>
        <select name="institution_id" id="institution_id" class="w-full border p-2 rounded @error('institution_id') border-red-600 @enderror" required {{ isset($organization) ? 'disabled' : '' }}>
            <option value="">-- Select College --</option>
            @foreach($institutions as $institution)
                <option value="{{ $institution->id }}" {{ (old('institution_id', $organization->institution_id ?? '') == $institution->id) ? 'selected' : '' }}>
                    {{ $institution->full_name ?? $institution->name }}
                </option>
            @endforeach
        </select>
        {{-- Hidden input for institution_id if disabled on edit --}}
        @if(isset($organization))
            <input type="hidden" name="institution_id" value="{{ $organization->institution_id }}">
        @endif
        @error('institution_id')
            <p class="text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Affiliation Number --}}
    <div class="col-span-2">
        <label for="affiliation_number" class="form-label">Affiliation Number <span class="text-danger">*</span></label>
        <input type="text" name="affiliation_number" id="affiliation_number" value="{{ old('affiliation_number', $organization->affiliation_number ?? '') }}" class="w-full border p-2 rounded @error('affiliation_number') border-red-600 @enderror" placeholder="Enter Affiliation Number" required>
        @error('affiliation_number') <p class="text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Name of Students' Organization --}}
    <div class="col-span-2">
        <label for="organization_name" class="form-label">Name of Students' Organization <span class="text-danger">*</span></label>
        <input type="text" name="organization_name" id="organization_name" value="{{ old('organization_name', $organization->organization_name ?? '') }}" class="w-full border p-2 rounded @error('organization_name') border-red-600 @enderror" placeholder="Enter Organization Name" required>
        @error('organization_name') <p class="text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Contact Number --}}
    <div class="col-span-2">
        <label for="contact_number" class="form-label">Contact No: (Specialised for Organization) <span class="text-danger">*</span></label>
        <input type="text" name="contact_number" id="contact_number" value="{{ old('contact_number', $organization->contact_number ?? '') }}" class="w-full border p-2 rounded @error('contact_number') border-red-600 @enderror" placeholder="Enter Contact Number" required>
        @error('contact_number') <p class="text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Email --}}
    <div class="col-span-2">
        <label for="email" class="form-label">Mail ID <span class="text-danger">*</span></label>
        <input type="email" name="email" id="email" value="{{ old('email', $organization->email ?? '') }}" class="w-full border p-2 rounded @error('email') border-red-600 @enderror" placeholder="Enter Mail ID" required>
        @error('email') <p class="text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>
</div>
