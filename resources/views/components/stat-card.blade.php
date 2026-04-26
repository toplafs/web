@props([
    'title',
    'value',
    'badgeText',
    'badgeColor' => 'gray',
])

@php
    $colors = [
        'blue'   => 'bg-blue-50 text-blue-600',
        'yellow' => 'bg-yellow-50 text-yellow-600',
        'green'  => 'bg-emerald-50 text-emerald-600',
        'gray'   => 'bg-gray-100 text-gray-500',
    ];
    $badgeClass = $colors[$badgeColor] ?? $colors['gray'];
@endphp

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex flex-col gap-3">
    <p class="text-sm text-gray-500 font-medium">{{ $title }}</p>
    <div class="flex items-end justify-between">
        <p class="text-3xl font-bold text-gray-800">{{ $value }}</p>
        <span class="text-xs font-semibold px-3 py-1.5 rounded-full {{ $badgeClass }} flex items-center gap-1">
            @if ($badgeColor === 'green')
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            @endif
            {{ $badgeText }}
        </span>
    </div>
</div>
