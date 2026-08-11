<x-app-layout>

    <div class="p-4 sm:p-6 lg:p-8">
        <div class="max-w-7xl mx-auto">
            <div class="mb-10 flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">

                <div>

                    <h1 class="text-4xl font-bold tracking-tight text-slate-800">
                        Data Jadwal
                    </class=>

                    <p class="mt-2 text-base text-slate-500">
                        Kelola jadwal kegiatan Posyandu dan pengiriman reminder.
                    </p>

                </div>

                <div class="flex flex-wrap gap-3">

                    <a href="{{ route('jadwal.export.pdf') }}"
                       class="inline-flex w-full sm:w-auto items-center justify-center gap-2 rounded-xl bg-red-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-red-700">

                        📄 Export PDF

                    </a>

                    <a href="{{ route('jadwal.create') }}"
                        class="inline-flex w-full sm:w-auto items-center justify-center gap-2 rounded-xl bg-emerald-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-emerald-700">

                        + Tambah Jadwal

                    </a>

                </div>

            </div>

            @if (session('success'))
                <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('warning'))
                <div class="mb-6 rounded-xl border border-yellow-200 bg-yellow-50 px-4 py-3 text-yellow-700">
                    {{ session('warning') }}
                </div>
            @endif

            <div class="rounded-3xl border border-slate-200 bg-white shadow-sm overflow-hidden">

                <form method="GET" action="{{ route('jadwal.index') }}" class="flex flex-wrap items-center gap-3 p-6 border-b border-slate-200 bg-slate-50">

                    {{-- Search --}}
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari lokasi atau Posyandu..." class="h-12 w-full md:w-80 rounded-xl border-slate-200 px-4 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">

                    {{-- Status --}}
                    <select name="status" onchange="this.form.submit()" class="h-12 w-full md:w-80 rounded-xl border-slate-200 px-4 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">

                        <option value="">Semua Status</option>

                        <option value="Draft" {{ request('status') == 'Draft' ? 'selected' : '' }}>
                            Draft
                        </option>

                        <option value="Scheduled" {{ request('status') == 'Scheduled' ? 'selected' : '' }}>
                            Scheduled
                        </option>

                        <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>
                            Completed
                        </option>

                        <option value="Cancelled" {{ request('status') == 'Cancelled' ? 'selected' : '' }}>
                            Cancelled
                        </option>

                    </select>

                    {{-- Posyandu --}}
                    @if (auth()->user()->isSuperAdmin())

                        <select name="posyandu_id" onchange="this.form.submit()" class="h-12 rounded-xl border-slate-200 px-4 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">

                            <option value="">Semua Posyandu</option>

                            @foreach ($posyandus as $posyandu)
                                <option value="{{ $posyandu->id }}"
                                    {{ request('posyandu_id') == $posyandu->id ? 'selected' : '' }}>

                                    {{ $posyandu->nama_posyandu }}

                                </option>
                            @endforeach

                        </select>

                    @endif

                    <button class="h-12 rounded-xl bg-emerald-600 px-6 font-medium text-white shadow-sm transition hover:bg-emerald-700">

                        Cari

                    </button>

                    <a href="{{ route('jadwal.index') }}" class="rounded-xl bg-slate-200 px-5 py-2">

                        Reset

                    </a>

                </form>

                <div class="overflow-x-auto">

                   <table class="min-w-[900px] w-full">
                        <thead class="bg-slate-50 border-b border-slate-200">
                            <tr>

                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    No
                                </th>

                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Posyandu
                                </th>

                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Tanggal
                                </th>

                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Jam
                                </th>

                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Lokasi
                                </th>

                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Status
                                </th>

                            </tr>
                        </thead>

                        <tbody>

                            @forelse($jadwals as $index => $jadwal)
                                <tr class="border-b border-slate-100 transition duration-150 hover:bg-slate-50">

                                    <td class="px-4 py-3 text-center">
                                        {{ $jadwals->firstItem() + $index }}
                                    </td>

                                    <td class="px-6 py-4 text-slate-600">
                                        <div class="font-medium text-slate-800">
                                            {{ $jadwal->posyandu->nama_posyandu }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 text-slate-600">
                                        {{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d M Y') }}
                                    </td>

                                    <td class="px-6 py-4 text-slate-600">
                                        {{ \Carbon\Carbon::parse($jadwal->jam)->format('H:i') }} WIB
                                    </td>

                                    <td class="px-6 py-4 text-slate-600">
                                        {{ $jadwal->lokasi }}
                                    </td>

                                    <td class="px-4 py-3 text-center">

                                        @if ($jadwal->status == 'Draft')
                                            <span
                                                class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                                                Draft
                                            </span>
                                        @elseif($jadwal->status == 'Scheduled')
                                            <span
                                                class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                                Scheduled
                                            </span>
                                        @elseif($jadwal->status == 'Completed')
                                            <span
                                                class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                                Completed
                                            </span>
                                        @else
                                            <span
                                                class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                                🚫 Cancelled
                                            </span>
                                        @endif

                                    </td>

                                    <td class="px-6 py-4 text-slate-600">

                                        <div class="flex justify-center gap-2">

                                            @if (in_array($jadwal->status, ['Draft', 'Scheduled']))
                                                <a href="{{ route('jadwal.edit', $jadwal->id) }}" title="Edit"
                                                    class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-amber-200 bg-amber-50 text-amber-600 transition hover:bg-amber-100">

                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"
                                                        class="h-5 w-5">

                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m16.862 4.487 1.687-1.688a2.25 2.25 0 1 1 3.182 3.182L10.582 17.13a4.5 4.5 0 0 1-1.897 1.13L6 19.5l1.24-2.685a4.5 4.5 0 0 1 1.13-1.897L16.862 4.487Z" />

                                                    </svg>

                                                </a>
                                            @endif

                                            @if (in_array($jadwal->status, ['Draft', 'Scheduled']))
                                                <form action="{{ route('jadwal.cancel', $jadwal->id) }}" method="POST"
                                                    class="inline">

                                                    @csrf
                                                    @method('PATCH')

                                                    <button type="submit" title="Batalkan Jadwal"
                                                        onclick="return confirm('Yakin ingin membatalkan jadwal ini?')"
                                                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-300 bg-slate-100 text-slate-600 transition hover:bg-slate-200">

                                                        ✖

                                                    </button>

                                                </form>
                                            @endif

                                            @if ($jadwal->status == 'Draft')
                                                <form action="{{ route('jadwal.destroy', $jadwal->id) }}"
                                                    method="POST" class="inline delete-form">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" title="Hapus"
                                                        onclick="return confirm('Yakin ingin menghapus jadwal ini?')"
                                                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-red-200 bg-red-50 text-red-600 transition hover:bg-red-100">

                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"
                                                            class="h-5 w-5">

                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673A2.25 2.25 0 0 1 15.916 21.75H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0A48.11 48.11 0 0 1 8.25 5.393m7.5 0V4.5A2.25 2.25 0 0 0 13.5 2.25h-3A2.25 2.25 0 0 0 8.25 4.5v.893m7.5 0a48.667 48.667 0 0 0-7.5 0" />

                                                        </svg>

                                                    </button>

                                                </form>
                                            @endif

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="8" class="border px-4 py-10 text-center">

                                        <div class="py-8 text-center text-slate-500">

                                            <div class="text-5xl mb-3">📅</div>

                                            @if (request('search'))
                                                <p class="font-semibold">
                                                    Tidak ditemukan jadwal.
                                                </p>

                                                <p class="text-sm mt-2">
                                                    Kata kunci:
                                                    <strong>"{{ request('search') }}"</strong>
                                                </p>
                                            @else
                                                <p class="font-semibold">
                                                    Belum ada jadwal Posyandu.
                                                </p>

                                                <p class="text-sm mt-2">
                                                    Silakan tambahkan jadwal terlebih dahulu.
                                                </p>
                                            @endif

                                        </div>

                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                    <div class="border-t border-slate-200 px-6 py-4">
                        {{ $jadwals->links() }}
                    </div>

                </div> {{-- overflow-x-auto --}}

            </div>
        </div>
</x-app-layout>
