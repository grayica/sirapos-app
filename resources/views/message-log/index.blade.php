<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold">
            Riwayat Pengiriman Reminder
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto">

            <div class="bg-white rounded-lg shadow p-6">

                <h3 class="text-xl font-semibold mb-6">
                    Message Log
                </h3>

                <table class="min-w-full border-collapse">

                    <thead>

                    <tr class="bg-gray-100">

                        <th class="border px-4 py-3">No</th>

                        <th class="border px-4 py-3">Peserta</th>

                        <th class="border px-4 py-3">Posyandu</th>

                        <th class="border px-4 py-3">Tanggal</th>

                        <th class="border px-4 py-3">Status</th>

                        <th class="border px-4 py-3">Waktu Kirim</th>

                    </tr>

                    </thead>

                    <tbody>

                    @forelse($logs as $log)

                    <tr>

                        <td class="border px-4 py-3">
                            {{ $loop->iteration }}
                        </td>

                        <td class="border px-4 py-3">
                            {{ $log->peserta->nama_penerima }}
                        </td>

                        <td class="border px-4 py-3">
                            {{ $log->jadwal->posyandu->nama_posyandu }}
                        </td>

                        <td class="border px-4 py-3">
                            {{ \Carbon\Carbon::parse($log->jadwal->tanggal)->format('d M Y') }}
                        </td>

                        <td class="border px-4 py-3 text-center">

                            @if($log->status == 'Sent')

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                    Sent
                                </span>

                            @elseif($log->status == 'Pending')

                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                    Pending
                                </span>

                            @else

                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                    Failed
                                </span>

                            @endif

                        </td>

                        <td class="border px-4 py-3">

                            {{ $log->sent_at
                                ? \Carbon\Carbon::parse($log->sent_at)->format('d M Y H:i')
                                : '-' }}

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6"
                            class="border px-4 py-6 text-center text-gray-500">

                            Belum ada riwayat reminder.

                        </td>

                    </tr>

                    @endforelse

                    </tbody>

                </table>

                <div class="mt-5">
                    {{ $logs->links() }}
                </div>

            </div>

        </div>
    </div>

</x-app-layout>
