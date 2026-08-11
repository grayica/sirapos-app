<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- Nama --}}
    <div class="md:col-span-2">
        <label class="mb-2 block text-sm font-semibold text-slate-700">
            Nama Lengkap
            <span class="text-red-500">*</span>
        </label>

        <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}"
            placeholder="Masukkan nama lengkap"
            class="w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-emerald-500 focus:ring-emerald-500">

        @error('name')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">

        <label class="mb-2 block text-sm font-semibold text-slate-700">

            Posyandu

        </label>

        <select name="posyandu_id" class="w-full rounded-xl border border-slate-300 px-4 py-2.5">

            <option value="">

                -- Pilih Posyandu --

            </option>

            @foreach ($posyandus as $posyandu)
                <option value="{{ $posyandu->id }}" @selected(old('posyandu_id', $user->posyandu_id ?? '') == $posyandu->id)>

                    {{ $posyandu->nama_posyandu }}

                </option>
            @endforeach

        </select>

    </div>

    {{-- Email --}}
    <div class="md:col-span-2">
        <label class="mb-2 block text-sm font-semibold text-slate-700">
            Email
            <span class="text-red-500">*</span>
        </label>

        <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}"
            placeholder="contoh@email.com"
            class="w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-emerald-500 focus:ring-emerald-500">

        @error('email')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>

    {{-- Password --}}
    <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">
            Password

            @isset($user)
                <span class="text-xs text-slate-500">(Kosongkan jika tidak ingin diubah)</span>
            @endisset
        </label>

        <input type="password" name="password"
            class="w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-emerald-500 focus:ring-emerald-500">

        @error('password')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>

    {{-- Konfirmasi Password --}}
    <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">
            Konfirmasi Password
        </label>

        <input type="password" name="password_confirmation"
            class="w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-emerald-500 focus:ring-emerald-500">
    </div>

    {{-- Status --}}
    <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">
            Status
        </label>

        <select name="status"
            class="w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-emerald-500 focus:ring-emerald-500">

            <option value="Aktif" {{ old('status', $user->status ?? 'Aktif') == 'Aktif' ? 'selected' : '' }}>
                Aktif
            </option>

            <option value="Nonaktif" {{ old('status', $user->status ?? '') == 'Nonaktif' ? 'selected' : '' }}>
                Nonaktif
            </option>

        </select>

        @error('status')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>

    {{-- Role --}}
    <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">
            Role
        </label>

        <input type="text" value="{{ $user->role ?? 'Worker' }}"
            class="w-full rounded-xl border border-slate-300 bg-slate-100 px-4 py-2.5" readonly>

        <p class="mt-1 text-xs text-slate-500">
            Semua user baru otomatis menjadi Worker.
        </p>

    </div>

</div>
