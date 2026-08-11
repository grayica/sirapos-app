<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIRAPOS') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">

    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased bg-slate-100">

    <div class="flex min-h-screen overflow-x-hidden">

        {{-- Sidebar --}}
        @include('layouts.sidebar')

        {{-- Content --}}
        <div class="flex-1 lg:ml-72 flex flex-col min-w-0">

            {{-- Topbar --}}
            @include('layouts.topbar')

            {{-- Main --}}
            <main class="flex-1 p-8">

                @if (session('success'))
                    <div id="success-alert"
                        cclass="mb-4 lg:mb-6 rounded-xl bg-green-100 border border-green-300 text-green-700 px-5 py-4">

                        {{ session('success') }}

                    </div>
                @endif

                @if (session('warning'))
                    <div id="warning-alert"
                        class="mb-4 lg:mb-6 rounded-xl bg-yellow-100 border border-yellow-300 text-yellow-700 px-5 py-4">

                        {{ session('warning') }}

                    </div>
                @endif

                @if (session('error'))
                    <div id="error-alert"
                        class="mb-4 lg:mb-6 rounded-xl bg-red-100 border border-red-300 text-red-700 px-5 py-4">

                        {{ session('error') }}

                    </div>
                @endif

                {{ $slot }}

            </main>

        </div>

    </div>

    <script>
        setTimeout(() => {

            document.getElementById('success-alert')?.remove();

            document.getElementById('warning-alert')?.remove();

            document.getElementById('error-alert')?.remove();

        }, 4000);

        document.querySelectorAll('.delete-form').forEach(form => {

            form.addEventListener('submit', function(e) {

                e.preventDefault();

                Swal.fire({

                    title: 'Yakin ingin menghapus?',

                    text: 'Data tidak dapat dikembalikan.',

                    icon: 'warning',

                    showCancelButton: true,

                    confirmButtonColor: '#dc2626',

                    cancelButtonColor: '#64748b',

                    confirmButtonText: 'Ya',

                    cancelButtonText: 'Batal'

                }).then((result) => {

                    if (result.isConfirmed) {

                        form.submit();

                    }

                });

            });

        });
    </script>

<script>
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const menuButton = document.getElementById('menuButton');

    if(menuButton){

    menuButton.addEventListener('click',()=>{

    sidebar.classList.remove('-translate-x-full');

    overlay.classList.remove('hidden');

    });

    }

    if(overlay){

    overlay.addEventListener('click',()=>{

    sidebar.classList.add('-translate-x-full');

    overlay.classList.add('hidden');

    });

    }

</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>

</html>
