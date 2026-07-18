<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold">
            Edit Posyandu
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-6">
            <div class="bg-white shadow rounded-lg p-6">

                <form action="{{ route('posyandu.update', $posyandu->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block mb-2">Nama Posyandu</label>
                        <input type="text"
                               name="nama_posyandu"
                               value="{{ old('nama_posyandu', $posyandu->nama_posyandu) }}"
                               class="w-full border rounded-lg px-4 py-2"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">Dusun</label>
                        <input type="text"
                               name="dusun"
                               value="{{ old('dusun', $posyandu->dusun) }}"
                               class="w-full border rounded-lg px-4 py-2"
                               required>
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2">Lokasi</label>
                        <input type="text"
                               name="lokasi"
                               value="{{ old('lokasi', $posyandu->lokasi) }}"
                               class="w-full border rounded-lg px-4 py-2"
                               required>
                    </div>

                    <div class="flex gap-3">
                        <button type="submit"
                                class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                            Update
                        </button>

                        <a href="{{ route('posyandu.index') }}"
                           class="bg-gray-500 text-white px-5 py-2 rounded-lg hover:bg-gray-600">
                            Batal
                        </a>
                    </div>

                </form>

                @if ($errors->any())
                    <div class="mb-4 rounded-lg bg-red-100 border border-red-300 text-red-700 p-4">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
