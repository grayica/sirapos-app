<x-app-layout>

    <div class="p-4 sm:p-6 lg:p-8">
        <div class="max-w-7xl mx-auto">
            <div class="mb-8 flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">

                <div>

                    <h1 class="text-3xl lg:text-4xl font-bold tracking-tight text-slate-800">
                        Data Peserta
                    </h1>

                    <p class="mt-2 text-base text-slate-500">
                        Kelola seluruh data peserta Posyandu.
                    </p>

                </div>

                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">

                    <button id="btnTambahPeserta"
                        class="inline-flex items-center rounded-xl bg-emerald-600 px-6 py-3 font-medium text-white shadow-sm transition hover:bg-emerald-700">

                        + Tambah Peserta

                    </button>

                    <a href="{{ route('peserta.export.pdf', request()->query()) }}"
                        class="inline-flex items-center rounded-xl bg-red-600 px-6 py-3 font-medium text-white shadow-sm transition hover:bg-red-700">

                        📄 Export PDF

                    </a>

                </div>

            </div>

            @if (session('success'))
                <div class="mb-4 rounded-xl border border-green-200 bg-green-50 border-green-300 text-green-700 p-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-6">

                <form method="GET" action="{{ route('peserta.index') }}" class="flex flex-wrap gap-3">

                    {{-- Search --}}
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari peserta..."
                        class="w-full sm:w-72 rounded-xl border px-4 py-3">

                    {{-- Jenis Peserta --}}
                    <select name="jenis_peserta" onchange="this.form.submit()"
                        class="w-full sm:w-auto rounded-xl px-4 py-2">

                        <option value="">Semua Jenis</option>

                        <option value="Bayi" {{ request('jenis') == 'Bayi' ? 'selected' : '' }}>👶 Bayi</option>

                        <option value="Balita" {{ request('jenis') == 'Balita' ? 'selected' : '' }}>🧒 Balita</option>

                        <option value="Anak" {{ request('jenis') == 'Anak' ? 'selected' : '' }}>👦 Anak</option>

                        <option value="Remaja" {{ request('jenis') == 'Remaja' ? 'selected' : '' }}>🧑 Remaja</option>

                        <option value="Usia Produktif" {{ request('jenis') == 'Usia Produktif' ? 'selected' : '' }}>💼
                            Usia Produktif</option>

                        <option value="Ibu Hamil" {{ request('jenis') == 'Ibu Hamil' ? 'selected' : '' }}>🤰 Ibu Hamil
                        </option>

                        <option value="Lansia" {{ request('jenis') == 'Lansia' ? 'selected' : '' }}>👴 Lansia</optioon>

                    </select>

                    {{-- Status --}}
                    <select name="status" onchange="this.form.submit()" class="border rounded-lg px-4 py-2">

                        <option value="">Semua Status</option>

                        <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>
                            Aktif
                        </option>

                        <option value="Nonaktif" {{ request('status') == 'Nonaktif' ? 'selected' : '' }}>
                            Nonaktif
                        </option>

                    </select>

                    {{-- Posyandu (Super Admin) --}}
                    @if (auth()->user()->isSuperAdmin())

                        <select name="posyandu_id" onchange="this.form.submit()" class="border rounded-lg px-4 py-2">

                            <option value="">Semua Posyandu</option>

                            @foreach ($posyandus as $posyandu)
                                <option value="{{ $posyandu->id }}"
                                    {{ request('posyandu_id') == $posyandu->id ? 'selected' : '' }}>

                                    {{ $posyandu->nama_posyandu }}

                                </option>
                            @endforeach

                        </select>

                    @endif

                    <button class="bg-blue-600 hover:bg-blue-700 text-white w-full sm:w-auto px-5 py-3 rounded-lg">

                        Cari

                    </button>

                    <a href="{{ route('peserta.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">

                        Reset

                    </a>

                </form>

            </div>

            <div class="rounded-2xl border border-slate-200 bg-white shadow-md overflow-hidden">

                <div class="overflow-x-auto">

                    <table class="min-w-[900px] w-full">
                        <thead class="bg-slate-50 border-b border-slate-200">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    No</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Posyandu</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Nama Peserta</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Jenis</th>

                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    WhatsApp</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Status</th>
                                <th
                                    class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($pesertas as $index => $peserta)
                                <tr class="border-b border-slate-100 transition duration-150 hover:bg-slate-50">

                                    <td class="px-6 py-4 text-slate-600">
                                        {{ $pesertas->firstItem() + $index }}
                                    </td>

                                    <td class="px-6 py-4 text-slate-600">
                                        {{ $peserta->posyandu?->nama_posyandu ?? '-' }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="font-medium text-slate-800">
                                            {{ $peserta->nama_peserta }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 text-slate-600">
                                        {{ $peserta->jenis_peserta ?? '-' }}
                                    </td>

                                    <td class="px-6 py-4 text-slate-600">
                                        {{ $peserta->nomor_whatsapp }}
                                    </td>

                                    <td class="px-6 py-4 text-slate-600">
                                        {{ $peserta->status }}
                                    </td>

                                    <td class="px-6 py-4 text-center space-x-2">
                                        <a href="{{ route('peserta.show', $peserta) }}"
                                            class="text-blue-600 font-medium hover:text-blue-800">
                                            Detail
                                        </a>

                                        <a href="{{ route('peserta.edit', $peserta->id) }}"
                                            class="text-yellow-600 hover:underline">
                                            Edit
                                        </a>

                                        <form action="{{ route('peserta.test-wa', $peserta) }}" method="POST"
                                            class="inline">

                                            @csrf

                                            <button class="text-green-600 hover:underline">

                                                Tes WA

                                            </button>

                                        </form>

                                        <form action="{{ route('peserta.destroy', $peserta->id) }}" method="POST"
                                            class="inline delete-form">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="text-red-600 hover:underline">
                                                Hapus
                                            </button>

                                        </form>
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="7" class="text-center py-10">
                                        <div class="text-gray-500">

                                            <div class="text-5xl mb-3">👶</div>

                                            @if (request('search'))
                                                <p class="font-semibold">
                                                    Tidak ditemukan data peserta
                                                </p>

                                                <p class="text-sm mt-2">
                                                    Kata kunci:
                                                    <strong>"{{ request('search') }}"</strong>
                                                </p>
                                            @else
                                                <p class="font-semibold">
                                                    Belum ada data peserta.
                                                </p>

                                                <p class="text-sm mt-2">
                                                    Silakan tambahkan peserta untuk memulai.
                                                </p>
                                            @endif

                                        </div>
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                    <div class="p-4">
                        {{ $pesertas->links() }}
                    </div>

                </div>

            </div>
        </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.getElementById('btnTambahPeserta').addEventListener('click', function() {

        Swal.fire({
            title: 'Pilih Jenis Data',
            text: 'Silakan pilih data yang akan ditambahkan.',
            icon: 'question',

            showDenyButton: true,

            confirmButtonText: '🤰 Ibu Hamil',
            denyButtonText: '👨 Peserta Umum',

            showCloseButton: true,
            allowOutsideClick: true,
            allowEscapeKey: true,

            width: window.innerWidth < 640 ? '90%' : '32rem',

        }).then((result) => {

            if (result.isConfirmed) {

                window.location =
                    "{{ route('peserta.create') }}?jenis_data=hamil";

            } else if (result.isDenied) {

                window.location =
                    "{{ route('peserta.create') }}?jenis_data=umum";

            }

        });

    });
</script>
