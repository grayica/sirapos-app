<x-app-layout>

    <div class="p-8">
        <div class="max-w-4xl mx-auto">
            <div class="mb-8">

                <h1 class="text-3xl font-bold text-slate-800">
                    Tambah Peserta
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    Tambahkan data peserta Posyandu baru.
                </p>

            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-md">

                <form action="{{ route('peserta.store') }}" method="POST">
                    @csrf

                    <input type="hidden" id="jenis_peserta" name="jenis_peserta"
                        value="{{ old('jenis_peserta', $peserta->jenis_peserta ?? '') }}">

                    <input type="hidden" name="jenis_data" value="{{ $jenisData }}">

                    @include('peserta._form')

                    <div class="mt-8 flex items-center justify-end gap-3">

                        <button type="submit"
                            class="inline-flex items-center rounded-xl bg-emerald-600 px-5 py-2.5 font-medium text-white transition hover:bg-emerald-700">
                            Simpan
                        </button>

                        <a href="{{ route('peserta.index') }}"
                            class="inline-flex items-center rounded-xl bg-slate-100 px-5 py-2.5 font-medium text-slate-700 transition hover:bg-slate-200">
                            Kembali
                        </a>

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>
