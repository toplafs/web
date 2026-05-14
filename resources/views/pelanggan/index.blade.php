@extends('layouts.app')
@section('title', 'Daftar Pelanggan')

@section('content')

@php
    $pageUrl = fn($p) => route('pelanggan.index', array_filter(['search' => $search, 'page' => $p]));

    $pages = [];
    if ($lastPage <= 6) {
        $pages = range(1, $lastPage);
    } else {
        $pages[] = 1;
        if ($currentPage > 3) $pages[] = '...';
        for ($i = max(2, $currentPage - 1); $i <= min($lastPage - 1, $currentPage + 1); $i++) {
            $pages[] = $i;
        }
        if ($currentPage < $lastPage - 2) $pages[] = '...';
        $pages[] = $lastPage;
    }

    $initials = function(string $nama): string {
        $words = preg_split('/\s+/', trim($nama));
        if (count($words) >= 2) {
            return strtoupper(mb_substr($words[0], 0, 1) . mb_substr($words[1], 0, 1));
        }
        return strtoupper(mb_substr($nama, 0, 2));
    };
@endphp

{{-- Page header --}}
<div class="flex items-center justify-between mb-8 gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Daftar Pelanggan</h1>
        <p class="text-gray-400 text-sm mt-1">Kelola informasi data pelanggan editorial Topia</p>
    </div>

    <div class="flex items-center gap-3 shrink-0">
        {{-- Search --}}
        <form method="GET" action="{{ route('pelanggan.index') }}" class="relative">
            <div class="pointer-events-none absolute inset-y-0 left-3.5 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z" />
                </svg>
            </div>
            <input type="text"
                   name="search"
                   value="{{ $search }}"
                   placeholder="Cari pelanggan..."
                   class="bg-white border border-gray-200 text-sm text-gray-700 rounded-xl pl-10 pr-4 py-2.5 w-64 focus:outline-none focus:ring-2 focus:ring-[#1B7080]/30 shadow-sm" />
            @if ($search)
                <a href="{{ route('pelanggan.index') }}"
                   class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            @endif
        </form>

        {{-- Tambah Pelanggan --}}
        <a href="{{ route('pelanggan.create') }}"
           class="flex items-center gap-2 bg-[#1B7080] hover:bg-[#155f6d] text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition-colors shadow-sm whitespace-nowrap">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
            </svg>
            Tambah Pelanggan
        </a>
    </div>
</div>

{{-- Table card --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

    @if ($pelanggan->isEmpty())
        <div class="flex flex-col items-center justify-center py-20 text-gray-400 gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <p class="text-sm font-medium">Tidak ada pelanggan ditemukan</p>
            @if ($search)
                <a href="{{ route('pelanggan.index') }}" class="text-xs text-[#1B7080] hover:underline">Reset pencarian</a>
            @endif
        </div>
    @else
        <table class="w-full text-sm">
            <thead>
                <tr class="text-xs font-semibold text-gray-400 tracking-wider uppercase border-b border-gray-100">
                    <th class="px-6 py-4 text-left w-16">No</th>
                    <th class="px-6 py-4 text-left">Nama</th>
                    <th class="px-6 py-4 text-left">Instansi</th>
                    <th class="px-6 py-4 text-left">Alamat</th>
                    <th class="px-4 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach ($pelanggan as $index => $item)
                @php
                    $inits = $initials($item['nama']);
                @endphp
                <tr class="hover:bg-gray-50/70 transition-colors">
                    <td class="px-6 py-4 text-gray-400 font-medium">
                        {{ $from + $index }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-blue-100 text-[#1B7080] flex items-center justify-center text-xs font-bold shrink-0">
                                {{ $inits }}
                            </div>
                            <span class="font-semibold text-gray-800">{{ $item['nama'] }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-gray-500">
                        {{ $item['instansi'] ?: '-' }}
                    </td>
                    <td class="px-6 py-4 text-gray-500 max-w-xs">
                        {{ $item['alamat'] }}
                    </td>
                    <td class="px-4 py-4">
                        <div class="relative flex items-center justify-end">
                            <button onclick="toggleDropdown(this)"
                                    data-edit-url="{{ route('pelanggan.edit', $item['id']) }}"
                                    class="p-1.5 text-gray-300 hover:text-gray-500 transition-colors rounded-lg hover:bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <circle cx="12" cy="5"  r="1.5" /><circle cx="12" cy="12" r="1.5" /><circle cx="12" cy="19" r="1.5" />
                                </svg>
                            </button>
                            <div class="dropdown-menu hidden absolute right-7 top-1/2 -translate-y-1/2 z-20
                                        bg-white border border-gray-100 rounded-xl shadow-lg py-1 min-w-30">
                                <a href="{{ route('pelanggan.edit', $item['id']) }}"
                                   class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {{-- Pagination --}}
    @if ($total > 0)
    <div class="flex items-center justify-between px-6 py-4 border-t border-gray-100">
        <p class="text-sm text-gray-400">
            Menampilkan
            <span class="font-medium text-gray-600">{{ $from }}–{{ $to }}</span>
            dari
            <span class="font-medium text-gray-600">{{ number_format($total) }}</span>
            pelanggan
        </p>
        <div class="flex items-center gap-1">
            @if ($currentPage > 1)
                <a href="{{ $pageUrl($currentPage - 1) }}"
                   class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-500 hover:bg-gray-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
            @endif

            @foreach ($pages as $p)
                @if ($p === '...')
                    <span class="w-8 h-8 flex items-center justify-center text-gray-400 text-sm">…</span>
                @else
                    <a href="{{ $pageUrl($p) }}"
                       class="w-8 h-8 rounded-lg flex items-center justify-center text-sm font-medium transition-colors
                              {{ $p === $currentPage
                                    ? 'bg-[#1B7080] text-white'
                                    : 'text-gray-500 hover:bg-gray-100' }}">
                        {{ $p }}
                    </a>
                @endif
            @endforeach

            @if ($currentPage < $lastPage)
                <a href="{{ $pageUrl($currentPage + 1) }}"
                   class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-500 hover:bg-gray-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            @endif
        </div>
    </div>
    @endif

</div>

@push('scripts')
<script>
    function toggleDropdown(btn) {
        const menu = btn.nextElementSibling;
        const isOpen = !menu.classList.contains('hidden');

        // tutup semua dropdown yang terbuka
        document.querySelectorAll('.dropdown-menu').forEach(m => m.classList.add('hidden'));

        if (!isOpen) menu.classList.remove('hidden');
    }

    document.addEventListener('click', function (e) {
        if (!e.target.closest('[onclick="toggleDropdown(this)"]')) {
            document.querySelectorAll('.dropdown-menu').forEach(m => m.classList.add('hidden'));
        }
    });
</script>
@endpush

@endsection
