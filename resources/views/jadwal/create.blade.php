<x-app-layout>

    <div class="p-8">

        <div class="max-w-4xl mx-auto">

            <div class="mb-8">

                <h1 class="text-3xl font-bold text-slate-800">
                    Tambah Jadwal
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    Tambahkan jadwal kegiatan Posyandu.
                </p>

            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-md">

                <form action="{{ route('jadwal.store') }}" method="POST">

                    @csrf

                    {{-- Posyandu --}}
                    <div class="mb-5">

                        <label class="block mb-2 text-sm font-semibold text-slate-700">
                            Posyandu
                        </label>

                        @if(auth()->user()->isSuperAdmin())

                            <select
                                name="posyandu_id"
                                class="w-full rounded-xl border border-slate-300 px-4 py-2.5">

                                <option value="">Pilih Posyandu</option>

                                @foreach($posyandus as $posyandu)

                                    <option
                                        value="{{ $posyandu->id }}"
                                        {{ old('posyandu_id') == $posyandu->id ? 'selected' : '' }}>

                                        {{ $posyandu->nama_posyandu }}

                                    </option>

                                @endforeach

                            </select>

                        @else

                            <input
                                type="hidden"
                                name="posyandu_id"
                                value="{{ auth()->user()->posyandu_id }}">

                            <div
                                class="rounded-xl bg-slate-100 px-4 py-3">

                                {{ auth()->user()->posyandu->nama_posyandu }}

                            </div>

                        @endif

                        @error('posyandu_id')

                            <p class="text-red-500 text-sm mt-1">

                                {{ $message }}

                            </p>

                        @enderror

                    </div>

                    {{-- Tanggal --}}
                    <div class="mb-5">

                        <label class="block mb-2 text-sm font-semibold">

                            Tanggal

                        </label>

                        <input
                            type="date"
                            name="tanggal"
                            value="{{ old('tanggal') }}"
                            class="w-full rounded-xl border border-slate-300 px-4 py-2.5">

                        @error('tanggal')

                            <p class="text-red-500 text-sm mt-1">

                                {{ $message }}

                            </p>

                        @enderror

                    </div>

                    {{-- Jam --}}
                    <div class="mb-5">

                        <label class="block mb-2 text-sm font-semibold">

                            Jam

                        </label>

                        <input
                            type="time"
                            name="jam"
                            value="{{ old('jam') }}"
                            class="w-full rounded-xl border border-slate-300 px-4 py-2.5">

                        @error('jam')

                            <p class="text-red-500 text-sm mt-1">

                                {{ $message }}

                            </p>

                        @enderror

                    </div>

                    {{-- Lokasi --}}
                    <div class="mb-6">

                        <label class="block mb-2 text-sm font-semibold">

                            Lokasi

                        </label>

                        <input
                            type="text"
                            name="lokasi"
                            value="{{ old('lokasi') }}"
                            class="w-full rounded-xl border border-slate-300 px-4 py-2.5">

                        @error('lokasi')

                            <p class="text-red-500 text-sm mt-1">

                                {{ $message }}

                            </p>

                        @enderror

                    </div>

                    <div class="flex justify-end gap-3 border-t pt-6">

                        <a
                            href="{{ route('jadwal.index') }}"
                            class="rounded-xl bg-slate-200 px-5 py-2.5">

                            Batal

                        </a>

                        <button
                            type="submit"
                            name="action"
                            value="draft"
                            class="rounded-xl bg-gray-500 px-5 py-2.5 text-white">

                            Simpan Draft

                        </button>

                        <button
                            type="submit"
                            name="action"
                            value="schedule"
                            class="rounded-xl bg-emerald-600 px-5 py-2.5 text-white">

                            Simpan Jadwal

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>
