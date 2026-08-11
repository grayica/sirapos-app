@props([
'href'=>'#',
'color'=>'blue'
])

@php

$colors=[

'blue'=>'bg-blue-600 hover:bg-blue-700',

'green'=>'bg-green-600 hover:bg-green-700',

'red'=>'bg-red-600 hover:bg-red-700'

];

@endphp

<a

href="{{ $href }}"

class="inline-flex items-center px-5 py-3 rounded-xl text-white font-semibold transition {{ $colors[$color] }}"

>

{{ $slot }}

</a>
