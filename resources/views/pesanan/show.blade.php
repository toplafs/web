@extends('layouts.app')
@section('title', $pesanan['no'])

@section('content')

{{-- ===== HEADER ===== --}}
<div class="mb-6">
    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 mb-3">
        <span class="p-2 text-[10px] font-bold tracking-widest uppercase px-2.5 py-1 rounded-md bg-yellow-100 text-yellow-700">
            {{ $pesanan['status'] }}
        </span>
        <span class="text-sm text-gray-400">{{ $pesanan['no'] }}</span>
    </div>

    {{-- Title row --}}
    <div class="flex items-start justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">{{ $pesanan['nama'] }}</h1>
            <p class="text-sm text-gray-400 mt-1">Dipesan pada {{ $pesanan['dipesan_pada'] }}</p>
        </div>
        <div class="flex items-center gap-2 shrink-0">
            <button class="flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-200 text-sm font-semibold text-gray-500 hover:bg-gray-50 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Print
            </button>
            <button class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#1B7080] hover:bg-[#155f6d] text-white text-sm font-semibold transition-colors shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Edit Pesanan
            </button>
            <button class="flex items-center gap-2 px-4 py-2.5 rounded-xl border border-red-200 text-sm font-semibold text-red-500 hover:bg-red-50 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                Hapus
            </button>
        </div>
    </div>
</div>

{{-- ===== BODY ===== --}}
<div class="flex gap-6 items-start">

    {{-- ===== KOLOM KIRI ===== --}}
    <div class="w-[57%] flex flex-col gap-5 min-w-0">

        {{-- Detail Item Pesanan --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <h2 class="text-sm font-bold text-gray-800">Detail Item Pesanan</h2>
                <span class="text-xs font-semibold text-gray-400">{{ count($pesanan['items']) }} Items</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-[10px] font-semibold text-gray-400 tracking-wider uppercase border-b border-gray-100 bg-gray-50/50">
                            <th class="px-6 py-3 text-left">Produk</th>
                            <th class="px-6 py-3 text-left">Varian</th>
                            <th class="px-6 py-3 text-right">Harga</th>
                            <th class="px-6 py-3 text-right">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach ($pesanan['items'] as $item)
                        <tr class="hover:bg-gray-50/60 transition-colors">
                            {{-- Produk --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-xl bg-gray-100 flex items-center justify-center shrink-0 overflow-hidden">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800 text-sm">{{ $item['nama'] }}</p>
                                        <p class="text-[11px] text-gray-400 mt-0.5">{{ $item['sku'] }}</p>
                                    </div>
                                </div>
                            </td>
                            {{-- Varian --}}
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-gray-100 text-xs font-medium text-gray-600">
                                    <span class="w-2 h-2 rounded-full {{ $item['varian'] === 'Hitam' ? 'bg-gray-800' : 'bg-gray-200 border border-gray-300' }}"></span>
                                    {{ $item['varian'] }}
                                </span>
                            </td>
                            {{-- Harga --}}
                            <td class="px-6 py-4 text-right font-medium text-gray-700">{{ $item['harga'] }}</td>
                            {{-- Jumlah --}}
                            <td class="px-6 py-4 text-right font-semibold text-gray-800">{{ $item['qty'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Logistik + Pembayaran --}}
        <div class="grid grid-cols-2 gap-5">

            {{-- Logistik Pengiriman --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="flex items-center gap-2 mb-5">
                    <div class="w-8 h-8 rounded-lg bg-[#1B7080]/10 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#1B7080]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h6a2 2 0 002-2V9a2 2 0 00-2-2H8zm0 0V5a2 2 0 012-2h2a2 2 0 012 2v2m-6 0h6M9 17h6" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold text-gray-800">Logistik Pengiriman</h3>
                </div>
                <div class="space-y-4">
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase tracking-wider mb-1">Ekspedisi</p>
                        <p class="text-sm font-bold text-gray-800">{{ $pesanan['logistik']['ekspedisi'] }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase tracking-wider mb-1">Nomor Resi</p>
                        <div class="flex items-center gap-2">
                            <p class="text-sm font-bold text-[#1B7080]">{{ $pesanan['logistik']['resi'] }}</p>
                            <button onclick="navigator.clipboard.writeText('{{ $pesanan['logistik']['resi'] }}')"
                                    class="p-1 text-gray-300 hover:text-gray-500 transition-colors rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 4h8a2 2 0 012 2v6a2 2 0 01-2 2H10a2 2 0 01-2-2v-6a2 2 0 012-2z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase tracking-wider mb-1">Total Berat</p>
                        <p class="text-sm font-bold text-gray-800">{{ $pesanan['logistik']['berat'] }}</p>
                    </div>
                </div>
            </div>

            {{-- Status Pembayaran --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="flex items-center gap-2 mb-5">
                    <div class="w-8 h-8 rounded-lg bg-[#1B7080]/10 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#1B7080]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold text-gray-800">Status Pembayaran</h3>
                </div>
                <div class="space-y-4">
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase tracking-wider mb-1">Metode</p>
                        <p class="text-sm font-bold text-gray-800">{{ $pesanan['pembayaran']['metode'] }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase tracking-wider mb-1">Atas Nama</p>
                        <p class="text-sm font-bold text-gray-800">{{ $pesanan['pembayaran']['atas_nama'] }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase tracking-wider mb-1">Verifikasi</p>
                        <span class="items-center gap-1.5 px-2.5 py-1 rounded-lg bg-green-100 text-xs font-bold text-green-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                            {{ $pesanan['pembayaran']['verifikasi'] }}
                        </span>
                    </div>
                </div>
            </div>

        </div>

    </div>

    {{-- ===== KOLOM KANAN ===== --}}
    <div class="w-[40%] flex flex-col gap-5 mr-1">

        {{-- Ringkasan Biaya --}}
        <div class="rounded-2xl bg-[#1B7080] p-6 text-white shadow-sm">
            <div class="flex items-center gap-2 mb-5">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white/70" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 11h.01M12 11h.01M15 11h.01M4 19h16a2 2 0 002-2V7a2 2 0 00-2-2H4a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <h3 class="text-sm font-bold text-white">Ringkasan Biaya</h3>
            </div>

            <div class="space-y-3 mb-5">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-white/70">Subtotal ({{ count($pesanan['items']) }} item)</span>
                    <span class="font-semibold">{{ $pesanan['ringkasan']['subtotal'] }}</span>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <span class="text-white/70">Ongkos Kirim</span>
                    <span class="font-semibold">{{ $pesanan['ringkasan']['ongkir'] }}</span>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <span class="text-red-300">Diskon Promo</span>
                    <span class="font-semibold text-red-300">{{ $pesanan['ringkasan']['diskon'] }}</span>
                </div>
            </div>

            <div class="border-t border-white/20 pt-4">
                <p class="text-[10px] font-semibold tracking-widest uppercase text-white/50 mb-1">Total Pesanan</p>
                <div class="flex items-end justify-between">
                    <p class="text-3xl font-bold leading-tight">{{ $pesanan['ringkasan']['total'] }}</p>
                    @if ($pesanan['ringkasan']['lunas'])
                    <span class="px-3 py-1 rounded-lg bg-white/20 text-xs font-bold tracking-widest">LUNAS</span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Informasi Pelanggan --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <p class="text-[10px] font-semibold text-gray-400 tracking-widest uppercase mb-4">Informasi Pelanggan</p>
            <div class="space-y-4">
                {{-- Instansi --}}
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center shrink-0 mt-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 mb-0.5">Instansi</p>
                        <p class="text-sm font-semibold text-gray-800">{{ $pesanan['pelanggan']['instansi'] }}</p>
                    </div>
                </div>
                {{-- WhatsApp --}}
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center shrink-0 mt-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 mb-0.5">WhatsApp</p>
                        <p class="text-sm font-semibold text-gray-800">{{ $pesanan['pelanggan']['wa'] }}</p>
                    </div>
                </div>
                {{-- Alamat --}}
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center shrink-0 mt-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 mb-0.5">Alamat Pengiriman</p>
                        <p class="text-sm font-semibold text-gray-800 leading-relaxed">{{ $pesanan['pelanggan']['alamat'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Catatan Pesanan --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <div class="flex items-center gap-2 mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                </svg>
                <p class="text-[10px] font-semibold text-gray-400 tracking-widest uppercase">Catatan Pesanan</p>
            </div>
            <p class="text-sm text-gray-600 leading-relaxed italic">"{{ $pesanan['catatan'] }}"</p>
        </div>

    </div>

</div>

{{-- ===== FOOTER ===== --}}
<div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-100">
    <a href="{{ route('pesanan.index') }}"
       class="flex items-center gap-2 text-sm text-gray-400 hover:text-gray-600 transition-colors font-medium">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali ke Daftar Pesanan
    </a>
    <p class="text-xs text-gray-400">Terakhir diperbarui: {{ $pesanan['diperbarui'] }}</p>
</div>

@endsection
