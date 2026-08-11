<x-app-layout>

    <div class="p-8">

        <div class="max-w-4xl mx-auto">

            <div class="bg-white rounded-2xl shadow-md border border-slate-200 p-8">

                <div class="flex justify-between items-center mb-8">

                    <div>

                        <h1 class="text-3xl font-bold text-slate-800">

                            Detail User

                        </h1>

                        <p class="text-slate-500 mt-2">

                            Informasi lengkap akun pengguna.

                        </p>

                    </div>

                    <a href="{{ route('users.index') }}"
                        class="bg-slate-100 hover:bg-slate-200 px-4 py-2 rounded-lg">

                        Kembali

                    </a>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <div>

                        <p class="text-sm text-gray-500">
                            Nama
                        </p>

                        <p class="font-semibold">
                            {{ $user->name }}
                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500">
                            Email
                        </p>

                        <p class="font-semibold">
                            {{ $user->email }}
                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500">
                            Role
                        </p>

                        <p class="font-semibold">

                            @if($user->isSuperAdmin())

                                👑 Super Admin

                            @else

                                👷 Worker

                            @endif

                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500">
                            Status
                        </p>

                        <p class="font-semibold">

                            @if($user->isAktif())

                                <span class="text-green-600">
                                    Aktif
                                </span>

                            @else

                                <span class="text-red-600">
                                    Nonaktif
                                </span>

                            @endif

                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500">
                            Dibuat
                        </p>

                        <p class="font-semibold">
                            {{ $user->created_at->translatedFormat('d F Y H:i') }}
                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500">
                            Terakhir Diubah
                        </p>

                        <p class="font-semibold">
                            {{ $user->updated_at->translatedFormat('d F Y H:i') }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
