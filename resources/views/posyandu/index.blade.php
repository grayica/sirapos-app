<x-app-layout>

    <div class="p-4 sm:p-6 lg:p-8">

        <div class="max-w-7xl mx-auto">

            <div class="flex items-start justify-between mb-8">

                <div>

                    <h1 class="text-4xl font-bold text-slate-800">

                        Data Posyandu

                    </h1>

                    <p class="mt-2 text-slate-500">

                        Kelola seluruh data Posyandu yang terdaftar.

                    </p>

                </div>

                <a href="{{ route('posyandu.create') }}"
                    class="inline-flex items-center gap-2
        px-6 py-3
        rounded-2xl
        bg-emerald-600
        hover:bg-emerald-700
        text-white
        shadow-lg
        transition">

                    <span class="text-xl">＋</span>

                    Tambah Posyandu

                </a>

            </div>

            @if (session('success'))
                <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="rounded-2xl border border-slate-200 bg-white shadow-md">

                <div class="border-b border-slate-200 p-6">

                    <form action="{{ route('posyandu.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">

                        <div class="flex-1">

                            <input type="text" autocomplete="off" name="search" value="{{ request('search') }}"
                                placeholder="Cari nama Posyandu..."
                                class="w-full rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500">

                        </div>

                        <div class="w-full lg:w-56">

                            <select name="sort" onchange="this.form.submit()"
                                class="w-full rounded-xl  border-slate-300 focus:border-emerald-500 focus:ring-emerald-500">

                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>
                                    Terbaru
                                </option>

                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>
                                    Terlama
                                </option>

                                <option value="az" {{ request('sort') == 'az' ? 'selected' : '' }}>
                                    Nama A-Z
                                </option>

                                <option value="za" {{ request('sort') == 'za' ? 'selected' : '' }}>
                                    Nama Z-A
                                </option>

                            </select>

                        </div>

                        <div class="flex gap-2">

                            <button type="submit"
                                class="rounded-xl bg-emerald-600 px-5 py-2.5 text-white font-medium hover:bg-emerald-700">

                                Cari

                            </button>

                            <a href="{{ route('posyandu.index') }}"
                                class="rounded-xl bg-slate-100 px-5 py-2.5 text-slate-700 hover:bg-slate-200">

                                Reset

                            </a>

                        </div>

                    </form>

                </div>

                <div class="overflow-x-auto">

                    <table class="min-w-[850px] w-full">

                        <thead class="bg-slate-50 border-b border-slate-200">

                            <tr>

                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    No
                                </th>

                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Nama Posyandu
                                </th>

                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Dusun
                                </th>

                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Lokasi
                                </th>

                                <th
                                    class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Aksi
                                </th>

                            </tr>

                        </thead>

                        <tbody class="divide-y divide-slate-100">

                            @forelse($posyandus as $index => $posyandu)
                                <tr class="border-b border-slate-100 transition duration-150 hover:bg-slate-50">

                                    <td class="px-6 py-4 text-sm text-slate-600">
                                        {{ $posyandus->firstItem() + $index }}
                                    </td>

                                    <td class="px-6 py-4">

                                        <div class="font-medium text-slate-800">
                                            {{ $posyandu->nama_posyandu }}
                                        </div>

                                    </td>

                                    <td class="px-6 py-4 text-slate-600">
                                        {{ $posyandu->dusun }}
                                    </td>

                                    <td class="px-6 py-4 text-slate-600">
                                        {{ $posyandu->lokasi }}
                                    </td>

                                    <td class="px-6 py-4">

                                        <div class="flex items-center justify-center gap-2">

                                            {{-- Detail --}}
                                            <a href="{{ route('posyandu.show', $posyandu) }}" title="Detail"
                                                class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 text-slate-600 transition hover:bg-slate-100">

                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"
                                                    class="h-5 w-5">

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.25 12s3.75-7.5 9.75-7.5S21.75 12 21.75 12 18 19.5 12 19.5 2.25 12 2.25 12Z" />

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 15.75A3.75 3.75 0 1 0 12 8.25a3.75 3.75 0 0 0 0 7.5Z" />

                                                </svg>

                                            </a>

                                            {{-- Edit --}}
                                            <a href="{{ route('posyandu.edit', $posyandu->id) }}" title="Edit"
                                                class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-amber-200 bg-amber-50 text-amber-600 transition hover:bg-amber-100">

                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"
                                                    class="h-5 w-5">

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m16.862 4.487 1.687-1.688a2.25 2.25 0 1 1 3.182 3.182L10.582 17.13a4.5 4.5 0 0 1-1.897 1.13L6 19.5l1.24-2.685a4.5 4.5 0 0 1 1.13-1.897L16.862 4.487Z" />

                                                </svg>

                                            </a>

                                            {{-- Delete --}}
                                            <form action="{{ route('posyandu.destroy', $posyandu->id) }}"
                                                method="POST" class="delete-form">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" title="Hapus"
                                                    class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-red-200 bg-red-50 text-red-600 transition hover:bg-red-100">

                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"
                                                        class="h-5 w-5">

                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673A2.25 2.25 0 0 1 15.916 21H8.084a2.25 2.25 0 0 1-2.244-1.327L4.772 5.79m14.456 0A48.108 48.108 0 0 0 15.75 5.25m3.478.54a48.11 48.11 0 0 1-7.956 0m0 0A48.64 48.64 0 0 0 8.25 5.25m3.022.54V4.5A2.25 2.25 0 0 1 13.5 2.25h-3A2.25 2.25 0 0 0 8.25 4.5v1.29" />

                                                    </svg>

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="5" class="px-6 py-16">

                                        <div class="flex flex-col items-center justify-center text-center">

                                            <div class="text-5xl mb-4">
                                                📍
                                            </div>

                                            <h3 class="text-lg font-semibold text-slate-700">

                                                Belum ada data Posyandu

                                            </h3>

                                            <p class="mt-2 text-sm text-slate-500">

                                                Silakan tambahkan Posyandu pertama.

                                            </p>

                                        </div>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="flex items-center justify-between border-t border-slate-200 bg-slate-50 px-6 py-4">

                    {{ $posyandus->links() }}

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
