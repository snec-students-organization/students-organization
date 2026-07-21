@extends('layouts.institution')

@push('styles')
<style>
.area-chip {
    background: #f8f9fa;
    border-color: #dee2e6 !important;
    user-select: none;
}
.area-chip:hover {
    background: #fff8e1;
    border-color: #f0a500 !important;
}
.area-chip.selected {
    background: #fff8e1;
    border-color: #f0a500 !important;
}
.area-chip .area-icon {
    opacity: 0.2;
    font-size: 1rem;
    transition: opacity 0.2s;
    color: #f0a500;
}
.area-chip.selected .area-icon {
    opacity: 1;
}
</style>
@endpush

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
                    <form method="POST" action="{{ route('institution.students.update', $student->id) }}" class="row g-4" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Student Name --}}
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-semibold text-dark">Student Name</label>
                            <input type="text" name="name" id="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $student->name) }}" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- UID --}}
                        <div class="col-md-6">
                            <label for="uid" class="form-label fw-semibold text-dark">UID</label>
                            <input type="text" name="uid" id="uid"
                                   class="form-control @error('uid') is-invalid @enderror"
                                   value="{{ old('uid', $student->uid) }}" required>
                            @error('uid') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Class --}}
                        <div class="col-md-6">
                            <label for="class" class="form-label fw-semibold text-dark">Class</label>
                            <select name="class" id="class"
                                    class="form-select @error('class') is-invalid @enderror" required>
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
                            <label for="stream" class="form-label fw-semibold text-dark">Stream</label>
                            <select name="stream" id="stream"
                                    class="form-select @error('stream') is-invalid @enderror" required>
                                <option value="">-- Select Stream --</option>
                                @foreach([
                                    'sharia','sharia plus','she','she plus','life','life plus','bayyinath',
                                    'life for girls','life plus for girls'
                                ] as $stream)
                                    <option value="{{ $stream }}" {{ old('stream', $student->stream) == $stream ? 'selected' : '' }}>
                                        {{ ucfirst($stream) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('stream') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Contact Number --}}
                        <div class="col-md-6">
                            <label for="contact_number" class="form-label fw-semibold text-dark">Contact Number</label>
                            <input type="text" name="contact_number" id="contact_number"
                                   class="form-control @error('contact_number') is-invalid @enderror"
                                   value="{{ old('contact_number', $student->contact_number) }}" placeholder="Enter contact number" required>
                            @error('contact_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Whatsapp Number --}}
                        <div class="col-md-6">
                            <label for="whatsapp_number" class="form-label fw-semibold text-dark">WhatsApp Number</label>
                            <input type="text" name="whatsapp_number" id="whatsapp_number"
                                   class="form-control @error('whatsapp_number') is-invalid @enderror"
                                   value="{{ old('whatsapp_number', $student->whatsapp_number) }}" placeholder="Enter WhatsApp number" required>
                            @error('whatsapp_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Date of Birth --}}
                        <div class="col-md-6">
                            <label for="date_of_birth" class="form-label fw-semibold text-dark">Date of Birth</label>
                            <input type="date" name="date_of_birth" id="date_of_birth"
                                   class="form-control @error('date_of_birth') is-invalid @enderror"
                                   value="{{ old('date_of_birth', $student->date_of_birth) }}" required>
                            @error('date_of_birth') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Place --}}
                        <div class="col-md-6">
                            <label for="place" class="form-label fw-semibold text-dark">Place</label>
                            <input type="text" name="place" id="place"
                                   class="form-control @error('place') is-invalid @enderror"
                                   value="{{ old('place', $student->place) }}" placeholder="Enter place" required>
                            @error('place') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Constituency --}}
                        <div class="col-md-6">
                            <label for="constituency" class="form-label fw-semibold text-dark">Constituency</label>
                            <input type="text" name="constituency" id="constituency"
                                   class="form-control @error('constituency') is-invalid @enderror"
                                   value="{{ old('constituency', $student->constituency) }}" placeholder="Enter constituency" required>
                            @error('constituency') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- District --}}
                        <div class="col-md-6">
                            <label for="district" class="form-label fw-semibold text-dark">District</label>
                            <input type="text" name="district" id="district"
                                   class="form-control @error('district') is-invalid @enderror"
                                   value="{{ old('district', $student->district) }}" placeholder="Enter district" required>
                            @error('district') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- State --}}
                        <div class="col-md-6">
                            <label for="state" class="form-label fw-semibold text-dark">State</label>
                            <input type="text" name="state" id="state"
                                   class="form-control @error('state') is-invalid @enderror"
                                   value="{{ old('state', $student->state ?? 'Kerala') }}" placeholder="Enter state" required>
                            @error('state') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Country --}}
                        <div class="col-md-6">
                            <label for="country" class="form-label fw-semibold text-dark">Country</label>
                            <input type="text" name="country" id="country"
                                   class="form-control @error('country') is-invalid @enderror"
                                   value="{{ old('country', $student->country ?? 'India') }}" placeholder="Enter country" required>
                            @error('country') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Current Photo Preview --}}
                        @if($student->photo)
                            <div class="col-md-12">
                                <label class="form-label fw-semibold text-dark d-block">Current Student Photo</label>
                                <div class="position-relative d-inline-block">
                                    <img src="{{ asset('storage/' . $student->photo) }}" alt="Student Photo" class="img-thumbnail rounded-3 shadow-sm" style="max-height: 150px;">
                                </div>
                            </div>
                        @endif

                        {{-- Photo --}}
                        @php
                            $isBoysCollege = in_array(auth()->user()->stream, ['sharia', 'sharia plus', 'bayyinath']);
                            $photoRequired = $isBoysCollege && !$student->photo;
                        @endphp
                        <div class="col-md-12">
                            <label for="photo" class="form-label fw-semibold text-dark">
                                Change Photo 
                                @if($photoRequired)
                                    <span class="text-danger fw-normal">(Required)</span>
                                @else
                                    <span class="text-muted fw-normal">(Optional)</span>
                                @endif
                            </label>
                            <input type="file" name="photo" id="photo" accept="image/*"
                                   class="form-control @error('photo') is-invalid @enderror"
                                   {{ $photoRequired ? 'required' : '' }}>
                            @error('photo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Interested Areas --}}
                        <div class="col-md-12">
                            <label class="form-label fw-semibold text-dark">
                                <i class="bi bi-stars me-1 text-warning"></i> Interested Areas
                                <span class="text-muted fw-normal">(Select all that apply)</span>
                            </label>
                            @error('interested_areas') <div class="text-danger small mb-2">{{ $message }}</div> @enderror
                            @php
                                $areaOptions = [
                                    'Speech', 'Motivation Classes', 'Training', 'Fiction Writing',
                                    'Non-Fiction Writing', 'Research', 'Journalism',
                                    'Photography & Videography', 'Graphic Designing', 'Video Editing',
                                    'Content & Script Writing', 'English Language', 'Arabic Language',
                                    'Urdu Language', 'Other Languages', 'Art', 'Singing',
                                    'Field Work', 'Information Technology', 'Others',
                                ];

                                // Extract any saved custom text from stored areas
                                $rawSaved        = $student->interested_areas ?? [];
                                $savedLangText   = '';
                                $savedOthersText = '';
                                $normalizedAreas = [];
                                foreach ($rawSaved as $a) {
                                    if (str_starts_with($a, 'Other Languages: ')) {
                                        $savedLangText = substr($a, strlen('Other Languages: '));
                                        $normalizedAreas[] = 'Other Languages';
                                    } elseif (str_starts_with($a, 'Others: ')) {
                                        $savedOthersText = substr($a, strlen('Others: '));
                                        $normalizedAreas[] = 'Others';
                                    } else {
                                        $normalizedAreas[] = $a;
                                    }
                                }

                                $savedAreas    = old('interested_areas', $normalizedAreas);
                                $oldLangText   = old('other_languages_text', $savedLangText);
                                $oldOthersText = old('others_text', $savedOthersText);
                            @endphp
                            <div class="row g-2 mt-1">
                                @foreach($areaOptions as $area)
                                    <div class="col-md-4 col-sm-6">
                                        <label class="area-chip d-flex align-items-center gap-2 px-3 py-2 rounded-3 border {{ in_array($area, $savedAreas) ? 'selected' : '' }}"
                                               style="cursor:pointer; transition: all 0.2s;"
                                               data-area="{{ $area }}">
                                            <input type="checkbox" name="interested_areas[]" value="{{ $area }}"
                                                   class="area-checkbox d-none"
                                                   {{ in_array($area, $savedAreas) ? 'checked' : '' }}>
                                            <span class="area-icon"><i class="bi bi-check-circle-fill"></i></span>
                                            <span class="small fw-medium text-dark">{{ $area }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            {{-- Extra text for "Other Languages" --}}
                            <div id="other_languages_extra" class="mt-3 {{ in_array('Other Languages', $savedAreas) ? '' : 'd-none' }}">
                                <label for="other_languages_text" class="form-label small fw-semibold text-primary">
                                    <i class="bi bi-translate me-1"></i> Please specify the language(s):
                                </label>
                                <input type="text" name="other_languages_text" id="other_languages_text"
                                       class="form-control"
                                       placeholder="e.g. French, German, Malayalam…"
                                       value="{{ $oldLangText }}">
                            </div>

                            {{-- Extra text for "Others" --}}
                            <div id="others_extra" class="mt-3 {{ in_array('Others', $savedAreas) ? '' : 'd-none' }}">
                                <label for="others_text" class="form-label small fw-semibold text-primary">
                                    <i class="bi bi-pencil me-1"></i> Please specify your interest:
                                </label>
                                <input type="text" name="others_text" id="others_text"
                                       class="form-control"
                                       placeholder="e.g. Cooking, Robotics…"
                                       value="{{ $oldOthersText }}">
                            </div>
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

@push('scripts')
<script>
document.querySelectorAll('.area-chip').forEach(function(chip) {
    chip.addEventListener('click', function() {
        var checkbox = chip.querySelector('.area-checkbox');
        checkbox.checked = !checkbox.checked;
        chip.classList.toggle('selected', checkbox.checked);

        var area = chip.getAttribute('data-area');

        if (area === 'Other Languages') {
            var el = document.getElementById('other_languages_extra');
            el.classList.toggle('d-none', !checkbox.checked);
            if (!checkbox.checked) document.getElementById('other_languages_text').value = '';
        }

        if (area === 'Others') {
            var el = document.getElementById('others_extra');
            el.classList.toggle('d-none', !checkbox.checked);
            if (!checkbox.checked) document.getElementById('others_text').value = '';
        }
    });
});
</script>
@endpush
