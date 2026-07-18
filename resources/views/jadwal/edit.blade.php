<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold">
            Edit Jadwal Posyandu
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto">

            <div class="bg-white shadow rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    {{-- Posyandu --}}
                    <div class="mb-4">
                        <label class="block font-semibold mb-2">
                            Posyandu
                        </label>

                        <select
                            name="posyandu_id"
                            class="w-full border rounded-lg px-4 py-2"
                            required>

                            @foreach($posyandus as $posyandu)
                                <option
                                    value="{{ $posyandu->id }}"
                                    {{ old('posyandu_id', $jadwal->posyandu_id) == $posyandu->id ? 'selected' : '' }}>

                                    {{ $posyandu->nama_posyandu }}

                                </option>
                            @endforeach

                        </select>
                    </div>

                    {{-- Tanggal --}}
                    <div class="mb-4">
                        <label class="block font-semibold mb-2">
                            Tanggal
                        </label>

                        <input
                            type="date"
                            name="tanggal"
                            value="{{ old('tanggal', $jadwal->tanggal) }}"
                            class="w-full border rounded-lg px-4 py-2"
                            required>
                    </div>

                    {{-- Jam --}}
                    <div class="mb-4">
                        <label class="block font-semibold mb-2">
                            Jam
                        </label>

                        <input
                            type="time"
                            name="jam"
                            value="{{ old('jam', $jadwal->jam) }}"
                            class="w-full border rounded-lg px-4 py-2"
                            required>
                    </div>

                    {{-- Lokasi --}}
                    <div class="mb-4">
                        <label class="block font-semibold mb-2">
                            Lokasi
                        </label>

                        <input
                            type="text"
                            name="lokasi"
                            value="{{ old('lokasi', $jadwal->lokasi) }}"
                            class="w-full border rounded-lg px-4 py-2"
                            required>
                    </div>

                    {{-- Status --}}
                    <div class="mb-6">
                        <label class="block font-semibold mb-2">
                            Status
                        </label>

                        <select
                            name="status"
                            class="w-full border rounded-lg px-4 py-2"
                            required>

                            <option value="Draft"
                                {{ old('status', $jadwal->status) == 'Draft' ? 'selected' : '' }}>
                                Draft
                            </option>

                            <option value="Scheduled"
                                {{ old('status', $jadwal->status) == 'Scheduled' ? 'selected' : '' }}>
                                Scheduled
                            </option>

                            <option value="Completed"
                                {{ old('status', $jadwal->status) == 'Completed' ? 'selected' : '' }}>
                                Completed
                            </option>

                            <option value="Cancelled"
                                {{ old('status', $jadwal->status) == 'Cancelled' ? 'selected' : '' }}>
                                Cancelled
                            </option>

                        </select>
                    </div>

                    <div class="flex justify-end gap-3">

                        <a href="{{ route('jadwal.index') }}"
                           class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Update Jadwal
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>
