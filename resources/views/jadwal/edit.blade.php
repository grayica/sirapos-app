<x-app-layout>

    <div class="p-8">
        <div class="max-w-4xl mx-auto">

            <div class="bg-white shadow rounded-lg p-6">
                <div class="mb-8">

                    <h1 class="text-3xl font-bold text-slate-800">
                        Edit Jadwal
                    </h1>

                    <p class="mt-2 text-sm text-slate-500">
                        Perbarui informasi jadwal kegiatan Posyandu.
                    </p>

                </div>

                <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Posyandu
                        </label>

                        <select name="posyandu_id"
                            class="w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-emerald-500 focus:ring-emerald-500"
                            <option value="">-- Pilih Posyandu --</option>

                            @foreach ($posyandus as $posyandu)
                                <option value="{{ $posyandu->id }}"
                                    {{ old('posyandu_id', $jadwal->posyandu_id) == $posyandu->id ? 'selected' : '' }}>
                                    {{ $posyandu->nama_posyandu }}
                                </option>
                            @endforeach

                        </select>

                        @error('posyandu_id')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Tanggal
                        </label>

                        <input type="date" name="tanggal" value="{{ old('tanggal', $jadwal->tanggal) }}"
                            class="w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-emerald-500 focus:ring-emerald-500"
                            @error('tanggal')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                            </div>

                        <div class="mb-4">
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Jam
                            </label>

                            <input type="time" name="jam" value="{{ old('jam', $jadwal->jam) }}"
                                class="w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-emerald-500 focus:ring-emerald-500"
                                @error('jam')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                                </div>

                            <div class="mb-4">
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Lokasi
                                </label>

                                <input type="text" name="lokasi" value="{{ old('lokasi', $jadwal->lokasi) }}"
                                    class="w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-emerald-500 focus:ring-emerald-500"
                                    @error('lokasi')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                                    </div>

                                <div class="flex justify-end gap-3 border-t border-slate-200 pt-6">

                                    <a href="{{ route('jadwal.index') }}"
                                        class="rounded-xl bg-slate-100 px-5 py-2.5 font-medium text-slate-700 hover:bg-slate-200">
                                        Batal
                                    </a>

                                    @if ($jadwal->status === 'Draft')
                                        <button type="submit" name="action" value="draft"
                                            class="rounded-xl bg-gray-500 px-5 py-2.5 font-medium text-white hover:bg-gray-600">
                                            Simpan Draft
                                        </button>

                                        <button type="submit" name="action" value="schedule"
                                            class="rounded-xl bg-emerald-600 px-5 py-2.5 font-medium text-white hover:bg-emerald-700">
                                            Simpan Jadwal
                                        </button>
                                    @else
                                        <button type="submit"
                                            class="rounded-xl bg-emerald-600 px-5 py-2.5 font-medium text-white hover:bg-emerald-700">
                                            Perbarui Jadwal
                                        </button>
                                    @endif

                                </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>
