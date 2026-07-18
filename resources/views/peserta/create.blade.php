<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold">
            Tambah Peserta
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-6">

            <div class="bg-white shadow rounded-lg p-6">

                @if($errors->any())
                    <div class="mb-4 rounded-lg bg-red-100 border border-red-300 text-red-700 p-4">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('peserta.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block mb-2">Posyandu</label>

                        <select name="posyandu_id"
                                class="w-full border rounded-lg px-4 py-2"
                                required>

                            <option value="">-- Pilih Posyandu --</option>

                            @foreach($posyandus as $posyandu)
                                <option value="{{ $posyandu->id }}"
                                    {{ old('posyandu_id') == $posyandu->id ? 'selected' : '' }}>
                                    {{ $posyandu->nama_posyandu }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">Nama Penerima</label>
                        <input type="text"
                               name="nama_penerima"
                               value="{{ old('nama_penerima') }}"
                               class="w-full border rounded-lg px-4 py-2"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">Hubungan Penerima</label>

                        <select name="hubungan_penerima"
                                class="w-full border rounded-lg px-4 py-2">

                            <option value="Ibu">Ibu</option>
                            <option value="Ayah">Ayah</option>
                            <option value="Wali">Wali</option>

                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">Nama Peserta</label>
                        <input type="text"
                               name="nama_peserta"
                               value="{{ old('nama_peserta') }}"
                               class="w-full border rounded-lg px-4 py-2"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">Jenis Peserta</label>

                        <select name="jenis_peserta"
                                class="w-full border rounded-lg px-4 py-2">

                            <option value="Balita">Balita</option>
                            <option value="Ibu Hamil">Ibu Hamil</option>

                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">Nomor WhatsApp</label>
                        <input type="text"
                               name="nomor_whatsapp"
                               value="{{ old('nomor_whatsapp') }}"
                               class="w-full border rounded-lg px-4 py-2"
                               placeholder="08xxxxxxxxxx"
                               required>
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2">Status</label>

                        <select name="status"
                                class="w-full border rounded-lg px-4 py-2">

                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>

                        </select>
                    </div>

                    <div class="flex gap-3">
                        <button type="submit"
                                class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                            Simpan
                        </button>

                        <a href="{{ route('peserta.index') }}"
                           class="bg-gray-500 text-white px-5 py-2 rounded-lg hover:bg-gray-600">
                            Kembali
                        </a>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>
