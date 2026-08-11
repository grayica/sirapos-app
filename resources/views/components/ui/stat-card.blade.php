@props([
    'title',
    'value',
    'subtitle' => '',
    'icon' => '📊',
    'color' => 'blue',
])

@php
$colors = [
    'blue' => 'from-blue-500 to-cyan-500',
    'green' => 'from-emerald-500 to-green-500',
    'yellow' => 'from-amber-500 to-orange-500',
    'purple' => 'from-violet-500 to-purple-500',
];

$gradient = $colors[$color] ?? $colors['blue'];
@endphp

<div
    class="group bg-white rounded-3xl shadow-sm hover:shadow-xl transition duration-300 border border-gray-100 overflow-hidden hover:-translate-y-1">

    <div class="h-2 bg-gradient-to-r {{ $gradient }}"></div>

    <div class="p-6">

        <div class="flex justify-between items-center">

            <div>

                <p class="text-sm text-gray-500">
                    {{ $title }}
                </p>

                <h2 class="text-4xl font-bold mt-2 text-gray-800">
                    {{ $value }}
                </h2>

                @if($subtitle)

                    <p class="mt-3 text-sm text-gray-400">

                        {{ $subtitle }}

                    </p>

                @endif

            </div>

            <div
                class="w-16 h-16 rounded-2xl bg-gradient-to-br {{ $gradient }} text-white flex items-center justify-center text-3xl shadow-lg group-hover:scale-110 transition">

                {{ $icon }}

            </div>

        </div>

    </div>

</div>
