<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold">
            📩 Detail Reminder
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-5xl mx-auto">

            <div class="bg-white shadow rounded-xl p-8">

                <h3 class="text-2xl font-bold text-gray-800 mb-8">
                    Informasi Pengiriman Reminder
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="font-semibold text-gray-600">
                            Nama Peserta
                        </label>

                        <p class="mt-1 text-lg">
                            {{ $messageLog->peserta->nama_penerima }}
                        </p>
                    </div>

                    <div>
                        <label class="font-semibold text-gray-600">
                            Nomor WhatsApp
                        </label>

                        <p class="mt-1 text-lg">
                            {{ $messageLog->peserta->nomor_whatsapp }}
                        </p>
                    </div>

                    <div>
                        <label class="font-semibold text-gray-600">
                            Posyandu
                        </label>

                        <p class="mt-1 text-lg">
                            {{ $messageLog->jadwal->posyandu->nama_posyandu }}
                        </p>
                    </div>

                    <div>
                        <label class="font-semibold text-gray-600">
                            Tanggal Posyandu
                        </label>

                        <p class="mt-1 text-lg">
                            {{ \Carbon\Carbon::parse($messageLog->jadwal->tanggal)->format('d F Y') }}
                        </p>
                    </div>

                    <div>
                        <label class="font-semibold text-gray-600">
                            Jenis Reminder
                        </label>

                        <p class="mt-1 text-lg">
                            {{ $messageLog->reminder_type }}
                        </p>
                    </div>

                    <div>

                        <label class="font-semibold text-gray-600">
                            Status
                        </label>

                        <div class="mt-2">

                            @if($messageLog->status == 'Sent')

                                <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full">
                                    ✅ Sent
                                </span>

                            @elseif($messageLog->status == 'Pending')

                                <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full">
                                    ⏳ Pending
                                </span>

                            @else

                                <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full">
                                    ❌ Failed
                                </span>

                            @endif

                        </div>

                    </div>

                    <div>

                        <label class="font-semibold text-gray-600">
                            Waktu Kirim
                        </label>

                        <p class="mt-1 text-lg">

                            {{ $messageLog->sent_at
                                ? \Carbon\Carbon::parse($messageLog->sent_at)->format('d F Y H:i')
                                : '-' }}

                        </p>

                    </div>

                </div>

                <hr class="my-8">

                <div>

                    <label class="font-semibold text-gray-600">
                        Isi Pesan WhatsApp
                    </label>

                    <div class="mt-3 bg-gray-100 rounded-lg p-5 whitespace-pre-line">

                        {{ $messageLog->message }}

                    </div>

                </div>

                <div class="mt-8">

                    <label class="font-semibold text-gray-600">
                        Response Provider (Fonnte)
                    </label>

                    <div class="mt-3 bg-blue-50 rounded-lg p-5 whitespace-pre-line">

                        {{ $messageLog->provider_response ?? '-' }}

                    </div>

                </div>

                <div class="mt-10">

                    <a href="{{ route('message-log.index') }}"
                        class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-3 rounded-lg">

                        ← Kembali

                    </a>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
