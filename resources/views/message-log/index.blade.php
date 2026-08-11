<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold">
            Riwayat Pengiriman Reminder
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto">

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">

                <h3 class="text-2xl font-bold text-gray-800">
                    📩 Message Log
                </h3>

                <div class="flex gap-2">

                    <form method="GET" action="{{ route('message-log.index') }}" class="flex flex-wrap gap-3">

                        {{-- Search --}}
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari peserta atau Posyandu..." class="border rounded-lg px-4 py-2 w-72">

                        {{-- Status --}}
                        <select name="status" onchange="this.form.submit()" class="border rounded-lg px-4 py-2">

                            <option value="">Semua Status</option>

                            <option value="Sent" {{ request('status') == 'Sent' ? 'selected' : '' }}>

                                Sent

                            </option>

                            <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>

                                Pending

                            </option>

                            <option value="Failed" {{ request('status') == 'Failed' ? 'selected' : '' }}>

                                Failed

                            </option>

                        </select>

                        {{-- Posyandu --}}
                        @if (auth()->user()->isSuperAdmin())

                            <select name="posyandu_id" onchange="this.form.submit()"
                                class="border rounded-lg px-4 py-2">

                                <option value="">Semua Posyandu</option>

                                @foreach ($posyandus as $posyandu)
                                    <option value="{{ $posyandu->id }}"
                                        {{ request('posyandu_id') == $posyandu->id ? 'selected' : '' }}>

                                        {{ $posyandu->nama_posyandu }}

                                    </option>
                                @endforeach

                            </select>

                        @endif

                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 rounded-lg">

                            Cari

                        </button>

                        <a href="{{ route('message-log.index') }}"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">

                            Reset

                        </a>

                    </form>
                    <a href="{{ route('message-log.pdf') }}"
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">

                        📄 Export PDF

                    </a>

                </div>

            </div>

            </form>

            <table class="min-w-full border-collapse">

                <thead>

                    <tr class="bg-gray-100">

                        <th class="border px-4 py-3">No</th>

                        <th class="border px-4 py-3">Peserta</th>

                        <th class="border px-4 py-3">Posyandu</th>

                        <th class="border px-4 py-3">Tanggal</th>

                        <th class="border px-4 py-3">Status</th>

                        <th class="border px-4 py-3">Waktu Kirim</th>

                        <th class="border px-4 py-3 text-center">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($logs as $log)
                        <tr>

                            <td class="border px-4 py-3">
                                {{ $logs->firstItem() + $loop->index }}
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

                                @if ($log->status == 'Sent')
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

                                {{ $log->sent_at ? \Carbon\Carbon::parse($log->sent_at)->format('d M Y H:i') : '-' }}

                            </td>

                            <td class="border px-4 py-3 text-center">

                                <a href="{{ route('message-log.show', $log) }}"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded">

                                    👁 Detail

                                </a>

                            </td>
                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="border px-4 py-6 text-center text-gray-500">

                                <div class="text-gray-500">

                                    <div class="text-5xl mb-3">
                                        📨
                                    </div>

                                    @if (request('search'))
                                        <p class="font-semibold">
                                            Tidak ditemukan riwayat reminder.
                                        </p>

                                        <p class="text-sm mt-2">
                                            Kata kunci:
                                            <strong>"{{ request('search') }}"</strong>
                                        </p>
                                    @else
                                        <p class="font-semibold">
                                            Belum ada riwayat reminder.
                                        </p>

                                        <p class="text-sm mt-2">
                                            Riwayat pengiriman akan muncul di sini.
                                        </p>
                                    @endif

                                </div>

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
