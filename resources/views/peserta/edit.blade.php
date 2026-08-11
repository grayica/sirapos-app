<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold">
            Edit Peserta
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-6">

            <div class="bg-white shadow rounded-lg p-6">

                <form
                    action="{{ route('peserta.update', $peserta->id) }}"
                    method="POST">

                    @csrf
                    @method('PUT')

                    @include('peserta._form')

                    <div class="flex gap-3 mt-6">

                        <button
                            type="submit"
                            class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                            Simpan Perubahan
                        </button>

                        <a
                            href="{{ route('peserta.index') }}"
                            class="bg-gray-500 text-white px-5 py-2 rounded-lg hover:bg-gray-600">
                            Kembali
                        </a>

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>
