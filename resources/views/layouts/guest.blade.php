<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SIRAPOS | Sistem Informasi Reminder Posyandu</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gradient-to-br from-emerald-600 via-teal-600 to-cyan-700">

    <div class="min-h-screen flex items-center justify-center p-6">

        <div class="w-full max-w-6xl bg-white rounded-3xl overflow-hidden shadow-2xl grid lg:grid-cols-2">

            {{-- ========================= --}}
            {{-- PANEL KIRI --}}
            {{-- ========================= --}}
            <div
                class="hidden lg:flex flex-col justify-center bg-gradient-to-br from-emerald-600 to-cyan-700 text-white p-14">

                <div class="w-20 h-20 rounded-2xl bg-white/20 flex items-center justify-center text-5xl mb-8">
                    <img src="{{ asset('images/logo-SIRAPOS.png') }}" class="h-24 w-auto">
                </div>

                <h1 class="text-5xl font-extrabold tracking-wide">
                    SIRAPOS
                </h1>

                <p class="mt-4 text-xl font-semibold text-emerald-100">
                    Sistem Informasi Reminder Posyandu
                </p>

                <p class="mt-8 leading-8 text-emerald-50">
                    Membantu kader Posyandu dalam mengelola data peserta,
                    jadwal pelayanan, serta pengiriman reminder WhatsApp
                    secara otomatis sehingga pelayanan menjadi lebih efektif,
                    cepat, dan terorganisir.
                </p>

                <div class="mt-10 space-y-4 text-lg">

                    <div class="flex items-center gap-3">
                        <span>✅</span>
                        <span>Manajemen Data Posyandu</span>
                    </div>

                    <div class="flex items-center gap-3">
                        <span>👶</span>
                        <span>Data Peserta Terintegrasi</span>
                    </div>

                    <div class="flex items-center gap-3">
                        <span>📅</span>
                        <span>Jadwal Pelayanan</span>
                    </div>

                    <div class="flex items-center gap-3">
                        <span>💬</span>
                        <span>Reminder WhatsApp Otomatis</span>
                    </div>

                    <div class="flex items-center gap-3">
                        <span>📊</span>
                        <span>Laporan & Monitoring</span>
                    </div>

                </div>

                <div class="mt-auto pt-12 text-sm text-emerald-100">
                    © {{ date('Y') }} SIRAPOS<br>
                    KKN KOLABORATIF UNEJ X UIJ DESA CERMEE
                </div>

            </div>

            {{-- ========================= --}}
            {{-- PANEL KANAN --}}
            {{-- ========================= --}}
            <div class="flex items-center justify-center bg-gray-50 p-8 lg:p-14">

                <div class="w-full max-w-md">

                    {{-- Logo Mobile --}}
                    <div class="lg:hidden text-center mb-8">

                        <div
                            class="mx-auto w-16 h-16 rounded-2xl bg-emerald-600 text-white flex items-center justify-center text-3xl">
                            🏥
                        </div>

                        <h1 class="mt-4 text-3xl font-bold text-gray-800">
                            SIRAPOS
                        </h1>

                        <p class="text-gray-500">
                            Sistem Informasi Reminder Posyandu
                        </p>

                    </div>

                    {{ $slot }}

                </div>

            </div>

        </div>

    </div>

</body>

</html>
