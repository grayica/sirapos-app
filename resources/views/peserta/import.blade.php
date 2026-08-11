<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold">
            Import Data Peserta
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-xl mx-auto">

            <div class="bg-white shadow rounded-lg p-6">

                <form
                    action="{{ route('peserta.import') }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf

                    <input
                        type="file"
                        name="file"
                        accept=".xlsx,.csv"
                        class="w-full border rounded-lg p-3">

                    <button
                        class="mt-4 bg-green-600 text-white px-5 py-2 rounded-lg">

                        Import

                    </button>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>
