<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold">
            Tambah Posyandu
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-6">

            <div class="bg-white shadow rounded-lg p-6">

                <form action="{{ route('posyandu.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block mb-2">Nama Posyandu</label>
                        <input
                            type="text"
                            name="nama_posyandu"
                            value="{{ old('nama_posyandu') }}"
                            class="w-full rounded-lg px-4 py-2 border @error('nama_posyandu') border-red-500 @else border-gray-300 @enderror">

                        @error('nama_posyandu')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">Dusun</label>
                        <input
                            type="text"
                            name="dusun"
                            value="{{ old('dusun') }}"
                            class="w-full rounded-lg px-4 py-2 border @error('dusun') border-red-500 @else border-gray-300 @enderror">

                        @error('dusun')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2">Lokasi</label>
                       <input
                            type="text"
                            name="lokasi"
                            value="{{ old('lokasi') }}"
                            class="w-full rounded-lg px-4 py-2 border @error('lokasi') border-red-500 @else border-gray-300 @enderror">

                        @error('lokasi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-3">
                        <button
                            type="submit"
                            class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                            Simpan
                        </button>

                        <a
                            href="{{ route('posyandu.index') }}"
                            class="bg-gray-500 text-white px-5 py-2 rounded-lg hover:bg-gray-600">
                            Kembali
                        </a>
                    </div>

                </form>
            </div>

        </div>
    </div>
</x-app-layout>
