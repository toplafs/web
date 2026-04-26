@extends('layouts.app')
@section('title', 'Daftar Pesanan')

@section('content')

@php
    $pageUrl = fn($p) => route('pesanan.index', array_merge($filters, ['page' => $p]));

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
@endphp

{{-- Page header --}}
<div class="flex items-start justify-between mb-8">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Daftar Pesanan</h1>
        <p class="text-gray-400 text-sm mt-1">Kelola seluruh transaksi pelanggan Anda di sini.</p>
    </div>
    <button class="flex items-center gap-2 bg-[#1B7080] hover:bg-[#155f6d] text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition-colors shadow-sm">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
        Tambah Pesanan
    </button>
</div>

{{-- Stat cards — update sesuai filter tanggal & search --}}
<div class="grid grid-cols-3 gap-5 mb-8">
    <x-stat-card title="Pesanan Baru"  :value="number_format($stats['menunggu'])" badge-text="Menunggu"  badge-color="blue" />
    <x-stat-card title="Dalam Proses"  :value="number_format($stats['diproses'])" badge-text="Pending"   badge-color="yellow" />
    <x-stat-card title="Selesai"       :value="number_format($stats['selesai'])"  badge-text="Bulan Ini" badge-color="green" />
</div>

{{-- Filter + Tabel --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

    {{-- Filter bar --}}
    <form method="GET" action="{{ route('pesanan.index') }}" id="filter-form">
        <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100 flex-wrap">

            {{-- Status --}}
            <div class="relative">
                <select name="status"
                        onchange="document.getElementById('filter-form').submit()"
                        class="appearance-none bg-gray-50 border border-gray-200 text-gray-600 text-sm rounded-xl pl-4 pr-8 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#1B7080]/30 cursor-pointer">
                    <option value="semua" {{ ($filters['status'] ?? '') === 'semua' || empty($filters['status']) ? 'selected' : '' }}>Semua Status</option>
                    <option value="selesai"  {{ ($filters['status'] ?? '') === 'selesai'  ? 'selected' : '' }}>Selesai</option>
                    <option value="diproses" {{ ($filters['status'] ?? '') === 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="menunggu" {{ ($filters['status'] ?? '') === 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-2.5 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>

            {{-- Date range --}}
            <div class="flex items-center gap-2 bg-gray-50 border border-gray-200 rounded-xl px-3 py-2.5 text-sm text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <input type="date"
                       name="date_start"
                       value="{{ $filters['date_start'] ?? '' }}"
                       onchange="document.getElementById('filter-form').submit()"
                       class="bg-transparent border-none outline-none text-sm text-gray-600 cursor-pointer w-32" />
                <span class="text-gray-400">–</span>
                <input type="date"
                       name="date_end"
                       value="{{ $filters['date_end'] ?? '' }}"
                       onchange="document.getElementById('filter-form').submit()"
                       class="bg-transparent border-none outline-none text-sm text-gray-600 cursor-pointer w-32" />
            </div>

            {{-- Search --}}
            <div class="relative ml-auto">
                <div class="pointer-events-none absolute inset-y-0 left-3.5 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z" />
                    </svg>
                </div>
                <input type="text"
                       name="search"
                       value="{{ $filters['search'] ?? '' }}"
                       placeholder="Cari nomor pesanan atau nama..."
                       class="bg-gray-50 border border-gray-200 text-sm text-gray-700 rounded-xl pl-10 pr-10 py-2.5 w-72 focus:outline-none focus:ring-2 focus:ring-[#1B7080]/30" />
                @if (!empty($filters['search']))
                    <a href="{{ route('pesanan.index', array_diff_key($filters, ['search' => ''])) }}"
                       class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                @else
                    <button type="submit" class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                @endif
            </div>

        </div>
    </form>

    {{-- Tabel --}}
    @if ($pesanan->isEmpty())
        <div class="flex flex-col items-center justify-center py-20 text-gray-400 gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            <p class="text-sm font-medium">Tidak ada pesanan ditemukan</p>
            <a href="{{ route('pesanan.index') }}" class="text-xs text-[#1B7080] hover:underline">Reset filter</a>
        </div>
    @else
        <table class="w-full text-sm">
            <thead>
                <tr class="text-xs font-semibold text-gray-400 tracking-wider uppercase border-b border-gray-100">
                    <th class="px-6 py-4 text-left">No</th>
                    <th class="px-6 py-4 text-left">Tanggal</th>
                    <th class="px-6 py-4 text-left">Status</th>
                    <th class="px-6 py-4 text-left">Pelanggan</th>
                    <th class="px-6 py-4 text-left">Instansi</th>
                    <th class="px-6 py-4 text-left">No. WA</th>
                    <th class="px-6 py-4 text-right">Total Harga</th>
                    <th class="px-4 py-4"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach ($pesanan as $index => $item)
                <tr class="hover:bg-gray-50/70 transition-colors">
                    <td class="px-6 py-4 text-gray-400 font-medium">{{ str_pad($from + $index, 2, '0', STR_PAD_LEFT) }}</td>
                    <td class="px-6 py-4 text-gray-600 whitespace-nowrap">{{ $item['tanggal_display'] }}</td>
                    <td class="px-6 py-4"><x-status-badge :status="$item['status']" /></td>
                    <td class="px-6 py-4 font-semibold text-gray-800">{{ $item['pelanggan'] }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $item['instansi'] }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $item['no_wa'] }}</td>
                    <td class="px-6 py-4 text-right font-semibold text-gray-800 whitespace-nowrap">{{ $item['total'] }}</td>
                    <td class="px-4 py-4">
                        <button class="p-1.5 text-gray-300 hover:text-gray-500 transition-colors rounded-lg hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <circle cx="12" cy="5"  r="1.5" /><circle cx="12" cy="12" r="1.5" /><circle cx="12" cy="19" r="1.5" />
                            </svg>
                        </button>
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
            pesanan
        </p>
        <div class="flex items-center gap-1">
            {{-- Prev --}}
            @if ($currentPage > 1)
                <a href="{{ $pageUrl($currentPage - 1) }}"
                   class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-500 hover:bg-gray-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
            @endif

            @foreach ($pages as $page)
                @if ($page === '...')
                    <span class="w-8 h-8 flex items-center justify-center text-gray-400 text-sm">…</span>
                @else
                    <a href="{{ $pageUrl($page) }}"
                       class="w-8 h-8 rounded-lg flex items-center justify-center text-sm font-medium transition-colors
                              {{ $page === $currentPage
                                    ? 'bg-[#1B7080] text-white'
                                    : 'text-gray-500 hover:bg-gray-100' }}">
                        {{ $page }}
                    </a>
                @endif
            @endforeach

            {{-- Next --}}
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

@endsection
