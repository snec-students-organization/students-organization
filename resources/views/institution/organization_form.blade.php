@extends('layouts.institution')

@section('content')
<div class="container mx-auto max-w-5xl p-6">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Organization Details</h2>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="mb-6 rounded-lg bg-green-100 text-green-800 px-4 py-3">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('institution.organization.save') }}" method="POST" class="bg-white shadow rounded-lg p-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- College Name --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">College Name</label>
                <input type="text" name="college_name" value="{{ old('college_name', $organization->college_name ?? '') }}"
                       class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300 focus:border-blue-500">
                @error('college_name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Organization Name --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Organization Name</label>
                <input type="text" name="organization_name" value="{{ old('organization_name', $organization->organization_name ?? '') }}"
                       class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300 focus:border-blue-500">
                @error('organization_name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Director Name --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Director Name</label>
                <input type="text" name="organization_director_name" value="{{ old('organization_director_name', $organization->organization_director_name ?? '') }}"
                       class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300 focus:border-blue-500">
                @error('organization_director_name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Director Number --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Director Number</label>
                <input type="text" name="organization_director_number" value="{{ old('organization_director_number', $organization->organization_director_number ?? '') }}"
                       class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300 focus:border-blue-500">
                @error('organization_director_number') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Counciler Name --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Counciler Name</label>
                <input type="text" name="counciler_name" value="{{ old('counciler_name', $organization->counciler_name ?? '') }}"
                       class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300 focus:border-blue-500">
                @error('counciler_name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Counciler Number --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Counciler Number</label>
                <input type="text" name="counciler_number" value="{{ old('counciler_number', $organization->counciler_number ?? '') }}"
                       class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300 focus:border-blue-500">
                @error('counciler_number') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Chairman Name --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Chairman Name</label>
                <input type="text" name="chairman_name" value="{{ old('chairman_name', $organization->chairman_name ?? '') }}"
                       class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300 focus:border-blue-500">
                @error('chairman_name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Chairman Number --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Chairman Number</label>
                <input type="text" name="chairman_number" value="{{ old('chairman_number', $organization->chairman_number ?? '') }}"
                       class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300 focus:border-blue-500">
                @error('chairman_number') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Convenor Name --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Convenor Name</label>
                <input type="text" name="convenor_name" value="{{ old('convenor_name', $organization->convenor_name ?? '') }}"
                       class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300 focus:border-blue-500">
                @error('convenor_name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Convenor Number --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Convenor Number</label>
                <input type="text" name="convenor_number" value="{{ old('convenor_number', $organization->convenor_number ?? '') }}"
                       class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300 focus:border-blue-500">
                @error('convenor_number') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Stream --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Stream</label>
                <select name="stream" id="stream"
                        class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300 focus:border-blue-500" required>
                    <option value="">-- Select Stream --</option>
                    @foreach ($streams as $stream)
                        <option value="{{ $stream }}" {{ (old('stream', $organization->stream ?? '') == $stream) ? 'selected' : '' }}>
                            {{ ucfirst($stream) }}
                        </option>
                    @endforeach
                </select>
                @error('stream') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow">
                Save Details
            </button>
        </div>
    </form>
</div>
@endsection
