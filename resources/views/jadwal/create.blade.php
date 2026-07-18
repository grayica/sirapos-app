<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold">
            Tambah Jadwal Posyandu
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto">

            <div class="bg-white shadow rounded-lg p-6">

                <form action="{{ route('jadwal.store') }}" method="POST">

                    @csrf

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">
                            Posyandu
                        </label>

                        <select
                            name="posyandu_id"
                            class="w-full border rounded-lg px-4 py-2"
                            required>

                            <option value="">-- Pilih Posyandu --</option>

                            @foreach($posyandus as $posyandu)
                                <option value="{{ $posyandu->id }}">
                                    {{ $posyandu->nama_posyandu }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">
                            Tanggal
                        </label>

                        <input
                            type="date"
                            name="tanggal"
                            class="w-full border rounded-lg px-4 py-2"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">
                            Jam
                        </label>

                        <input
                            type="time"
                            name="jam"
                            class="w-full border rounded-lg px-4 py-2"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">
                            Lokasi
                        </label>

                        <input
                            type="text"
                            name="lokasi"
                            class="w-full border rounded-lg px-4 py-2"
                            required>
                    </div>

                    <div class="mb-6">
                        <label class="block font-semibold mb-2">
                            Status
                        </label>

                        <select
                            name="status"
                            class="w-full border rounded-lg px-4 py-2">

                            <option value="Draft">Draft</option>
                            <option value="Scheduled">Scheduled</option>
                            <option value="Completed">Completed</option>
                            <option value="Cancelled">Cancelled</option>

                        </select>
                    </div>

                    <div class="flex justify-end gap-3">

                        <a href="{{ route('jadwal.index') }}"
                           class="px-4 py-2 bg-gray-500 text-white rounded">
                            Batal
                        </a>

                        <button
                            class="px-4 py-2 bg-blue-600 text-white rounded">
                            Simpan
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>
