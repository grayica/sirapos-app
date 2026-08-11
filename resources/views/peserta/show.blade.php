<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Detail Peserta
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto">

            <div class="bg-white rounded-xl shadow p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <p class="text-sm text-gray-500">Nama Peserta</p>
                        <p class="font-semibold">{{ $peserta->nama_peserta }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Jenis Peserta</p>
                        <p class="font-semibold">{{ $peserta->jenis_peserta }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Nama Penerima</p>
                        <p class="font-semibold">{{ $peserta->nama_penerima }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Hubungan Penerima</p>
                        <p class="font-semibold">{{ $peserta->hubungan_penerima }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Nomor WhatsApp</p>
                        <p class="font-semibold">{{ $peserta->nomor_whatsapp }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">RT</p>
                        <p class="font-semibold">
                            {{ $peserta->rt ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Status</p>
                        <p class="font-semibold">{{ $peserta->status }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Posyandu</p>
                        <p class="font-semibold">
                            {{ $peserta->posyandu->nama_posyandu ?? '-' }}
                        </p>
                    </div>

                    @if ($peserta->jenis_data == 'umum')
                        <div>
                            <p class="text-sm text-gray-500">Tanggal Lahir</p>
                            <p class="font-semibold">
                                {{ \Carbon\Carbon::parse($peserta->tanggal_lahir)->translatedFormat('d F Y') }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Usia</p>
                            <p class="font-semibold">
                                {{ $peserta->umur_lengkap }}
                            </p>
                        </div>
                    @endif

                    @if ($peserta->jenis_data == 'hamil')
                        <div class="md:col-span-2 mt-4 rounded-xl border border-pink-200 bg-pink-50 p-5">

                            <h3 class="text-lg font-semibold text-pink-700 mb-4">
                                Informasi Kehamilan
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                                <div>
                                    <p class="text-sm text-gray-500">
                                        Usia Kehamilan
                                    </p>

                                    <p class="font-semibold">
                                        {{ $peserta->usia_kehamilan }} Minggu
                                    </p>
                                </div>

                                <div>
                                    <p class="text-sm text-gray-500">
                                        Perkiraan Mulai Kehamilan
                                    </p>

                                    <p class="font-semibold">
                                        {{ $peserta->tanggal_mulai_kehamilan?->translatedFormat('d F Y') }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-sm text-gray-500">
                                        Perkiraan HPL
                                    </p>

                                    <p class="font-semibold">
                                        {{ $peserta->hpl?->translatedFormat('d F Y') }}
                                    </p>
                                </div>

                            </div>

                        </div>
                    @endif

                </div>

                <div class="flex justify-end gap-3 mt-8">

                    <a href="{{ route('peserta.edit', $peserta) }}"
                        class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                        Edit
                    </a>

                    <a href="{{ route('peserta.index') }}"
                        class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                        Kembali
                    </a>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>
