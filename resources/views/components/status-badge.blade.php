@props(['status'])

@php
    $map = [
        'SELESAI'   => 'bg-emerald-100 text-emerald-700',
        'DIPROSES'  => 'bg-yellow-100 text-yellow-700',
        'MENUNGGU'  => 'bg-red-100 text-red-600',
    ];
    $class = $map[strtoupper($status)] ?? 'bg-gray-100 text-gray-600';
@endphp

<span class="inline-block px-3 py-1 rounded-full text-xs font-bold tracking-wide {{ $class }}">
    {{ strtoupper($status) }}
</span>
