<x-app-layout>

    <div class="p-8">
        <div class="max-w-7xl mx-auto">
            <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>

                    <h1 class="text-3xl font-bold text-slate-800">
                        Data User
                    </h1>

                    <p class="mt-2 text-sm text-slate-500">
                        Kelola seluruh akun pengguna SIRAPOS.
                    </p>
                </div>

                <a href="{{ route('users.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">

                    + Tambah User

                </a>

            </div>

            @if (session('success'))
                <div class="mb-4 rounded-xl border border-green-200 bg-green-50 border-green-300 text-green-700 p-4">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Search & Filter --}}
            <div class="mb-6">

                <form method="GET" action="{{ route('users.index') }}" class="flex flex-wrap gap-3">

                    {{-- Search --}}
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama atau email..." class="border rounded-lg px-4 py-2 w-72">

                    {{-- Role --}}
                    <select name="role" onchange="this.form.submit()" class="border rounded-lg px-4 py-2">

                        <option value="">Semua Role</option>

                        <option value="super_admin" {{ request('role') == 'super_admin' ? 'selected' : '' }}>

                            Super Admin

                        </option>

                        <option value="worker" {{ request('role') == 'worker' ? 'selected' : '' }}>

                            Worker

                        </option>

                    </select>

                    {{-- Status --}}
                    <select name="status" onchange="this.form.submit()" class="border rounded-lg px-4 py-2">

                        <option value="">Semua Status</option>

                        <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>

                            Pending

                        </option>

                        <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>

                            Aktif

                        </option>

                        <option value="Rejected" {{ request('status') == 'Rejected' ? 'selected' : '' }}>

                            Ditolak

                        </option>

                    </select>

                    {{-- Posyandu --}}
                    <select name="posyandu_id" onchange="this.form.submit()" class="border rounded-lg px-4 py-2">

                        <option value="">Semua Posyandu</option>

                        @foreach ($posyandus as $posyandu)
                            <option value="{{ $posyandu->id }}"
                                {{ request('posyandu_id') == $posyandu->id ? 'selected' : '' }}>

                                {{ $posyandu->nama_posyandu }}

                            </option>
                        @endforeach

                    </select>

                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 rounded-lg">

                        Cari

                    </button>

                    <a href="{{ route('users.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">

                        Reset

                    </a>

                </form>

            </div>

            <div class="rounded-2xl border border-slate-200 bg-white shadow-md">

                <table class="min-w-full">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                No</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Nama</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Email</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Role</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Status</th>
                            <th
                                class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($users as $index => $user)
                            <tr class="border-b border-slate-100 transition duration-150 hover:bg-slate-50">

                                <td class="px-6 py-4 text-slate-600">
                                    {{ $users->firstItem() + $index }}
                                </td>

                                <td class="px-6 py-4 text-slate-600">
                                    {{ $user->name }}
                                </td>

                                <td class="px-6 py-4 text-slate-600">
                                    {{ $user->email ?? '-' }}
                                </td>

                                <td class="px-6 py-4">

                                    @if ($user->isSuperAdmin())
                                        <span
                                            class="rounded-full bg-purple-100 text-purple-700 px-3 py-1 text-xs font-semibold">

                                            👑 Super Admin

                                        </span>
                                    @else
                                        <span
                                            class="rounded-full bg-blue-100 text-blue-700 px-3 py-1 text-xs font-semibold">

                                            👷 Worker

                                        </span>
                                    @endif

                                </td>

                                <td class="px-6 py-4">

                                    @if ($user->status == 'Pending')
                                        <span
                                            class="rounded-full bg-yellow-100 text-yellow-700 px-3 py-1 text-xs font-semibold">

                                            🟡 Pending

                                        </span>
                                    @elseif($user->status == 'Aktif')
                                        <span
                                            class="rounded-full bg-green-100 text-green-700 px-3 py-1 text-xs font-semibold">

                                            🟢 Aktif

                                        </span>
                                    @else
                                        <span
                                            class="rounded-full bg-red-100 text-red-700 px-3 py-1 text-xs font-semibold">

                                            🔴 Nonaktif

                                        </span>
                                    @endif

                                </td>

                                <td class="px-6 py-4 text-center whitespace-nowrap">

                                    @if ($user->status == 'Pending')
                                        <form action="{{ route('users.approve', $user) }}" method="POST"
                                            class="inline">

                                            @csrf
                                            @method('PATCH')

                                            <button onclick="return confirm('Setujui akun ini?')"
                                                class="text-green-600 hover:text-green-800 font-semibold">

                                                ✔ Setujui

                                            </button>

                                        </form>

                                        <form action="{{ route('users.reject', $user) }}" method="POST"
                                            class="inline ml-3">

                                            @csrf
                                            @method('PATCH')

                                            <button onclick="return confirm('Tolak akun ini?')"
                                                class="text-red-600 hover:text-red-800 font-semibold">

                                                ✖ Tolak

                                            </button>

                                        </form>
                                    @else
                                        <a href="{{ route('users.show', $user) }}"
                                            class="text-blue-600 hover:text-blue-800 font-medium">

                                            Detail

                                        </a>

                                        <a href="{{ route('users.edit', $user) }}"
                                            class="ml-3 text-yellow-600 hover:text-yellow-800 font-medium">

                                            Edit

                                        </a>

                                        @if (!$user->isSuperAdmin())
                                            <form action="{{ route('users.reset-password', $user) }}" method="POST"
                                                class="inline">

                                                @csrf
                                                @method('PATCH')

                                                <button onclick="return confirm('Reset password user ini?')"
                                                    class="ml-3 text-indigo-600 hover:text-indigo-800 font-medium">

                                                    🔑 Reset Password

                                                </button>

                                            </form>

                                            <form action="{{ route('users.destroy', $user) }}" method="POST"
                                                class="inline">

                                                @csrf
                                                @method('DELETE')

                                                <button onclick="return confirm('Hapus user ini?')"
                                                    class="ml-3 text-red-600 hover:text-red-800 font-medium">

                                                    Hapus

                                                </button>

                                            </form>
                                        @endif
                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="7" class="text-center py-10">
                                    <div class="text-gray-500">

                                        <div class="text-5xl mb-3">👤</div>

                                        @if (request('search'))
                                            <p class="font-semibold">
                                                Tidak ditemukan user
                                            </p>

                                            <p class="text-sm mt-2">
                                                Kata kunci:
                                                <strong>"{{ request('search') }}"</strong>
                                            </p>
                                        @else
                                            <p class="font-semibold">
                                                Belum ada data user.
                                            </p>

                                            <p class="text-sm mt-2">
                                                Silakan tambahkan user
                                            </p>
                                        @endif

                                    </div>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

                <div class="p-4">
                    {{ $users->links() }}
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
