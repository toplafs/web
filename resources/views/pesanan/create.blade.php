@extends('layouts.app')
@section('title', 'Tambah Pesanan')

@section('content')

{{-- Header --}}
<div class="flex items-start justify-between mb-8">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Tambah Pesanan</h1>
        <p class="text-gray-400 text-sm mt-1">Buat Invoice pesanan baru untuk pembeli setia Anda.</p>
    </div>
    <a href="{{ route('pesanan.index') }}"
       class="flex items-center gap-2 text-sm font-semibold text-gray-500 hover:text-gray-700 px-4 py-2.5 rounded-xl border border-gray-200 hover:bg-gray-50 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
        Batalkan
    </a>
</div>

<form action="{{ route('pesanan.store') }}" method="POST" id="form-pesanan">
@csrf

<div class="flex gap-6 items-start">

    {{-- ===== KOLOM KIRI ===== --}}
    <div class="w-[57%] flex flex-col gap-5 min-w-0">

        {{-- Order Date + Pilih Pembeli --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <div class="grid grid-cols-2 gap-5">

                {{-- Order Date --}}
                <div>
                    <label class="block text-[10px] font-semibold text-gray-400 tracking-widest uppercase mb-2">Order Date</label>
                    <div class="relative">
                        <input type="date" name="order_date"
                               class="w-full bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-xl pl-4 pr-10 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#1B7080]/30 cursor-pointer" />
                        <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Pilih Pembeli --}}
                <div>
                    <label class="block text-[10px] font-semibold text-gray-400 tracking-widest uppercase mb-2">Pilih Pembeli</label>
                    <div class="relative">
                        <input type="text" name="pembeli" placeholder="Cari Nama Pembeli..."
                               class="w-full bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-xl pl-4 pr-10 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#1B7080]/30" />
                        <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- Daftar Produk --}}
        <div class="bg-white h-full p-6 rounded-2xl border border-gray-100 shadow-sm overflow-hidden ">

            {{-- Produk header --}}
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <h2 class="text-sm font-bold text-gray-800">Daftar Produk</h2>
                <div class="flex items-center gap-2">
                    <span class="text-xs text-gray-400">Discount Global (%)</span>
                    <input type="number" name="discount_global" value="0" min="0" max="100"
                           class="w-14 text-center bg-gray-50 border border-gray-200 text-sm text-gray-700 rounded-lg py-1.5 focus:outline-none focus:ring-2 focus:ring-[#1B7080]/30" />
                </div>
            </div>

            {{-- Tabel produk --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm" id="tabel-produk">
                    <thead>
                        <tr class="text-[10px] font-semibold text-gray-400 tracking-wider uppercase border-b border-gray-100 bg-gray-50/50">
                            <th class="px-5 py-3 text-left w-[22%]">Nama Produk</th>
                            <th class="px-5 py-3 text-left w-[26%]">Variasi</th>
                            <th class="px-5 py-3 text-center w-[16%]">QTY</th>
                            <th class="px-5 py-3 text-right w-[18%]">Harga/Unit</th>
                            <th class="px-5 py-3 text-right w-[14%]">Total</th>
                            <th class="px-3 py-3 w-[4%]"></th>
                        </tr>
                    </thead>
                    <tbody id="produk-rows" class="divide-y divide-gray-50">

                        {{-- Row contoh --}}
                        <tr class="produk-row hover:bg-gray-50/60 transition-colors">
                            {{-- Nama Produk --}}
                            <td class="px-5 py-3">
                                <div class="relative">
                                    <input type="text" name="produk[0][nama]" placeholder="Masukkan nama produk..."
                                           class="w-full bg-gray-50 border border-gray-200 text-gray-700 text-xs rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#1B7080]/30" />
                                </div>
                                <input type="text" name="produk[0][kode]" placeholder="SKU"
                                       class="mt-1.5 w-full bg-transparent border-none text-[10px] text-gray-400 px-0 focus:outline-none" />
                            </td>

                            {{-- Variasi --}}
                            <td class="px-5 py-3">
                                <div class="flex gap-1.5 flex-wrap">
                                    <div class="relative">
                                        <select name="produk[0][ukuran]"
                                                class="appearance-none bg-gray-100 border-none text-gray-600 text-xs rounded-lg pl-3 pr-7 py-1.5 focus:outline-none focus:ring-2 focus:ring-[#1B7080]/30 cursor-pointer">
                                            <option>Ukuran L▾</option>
                                            <option>S</option>
                                            <option>M</option>
                                            <option>L</option>
                                            <option>XL</option>
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="relative">
                                        <select name="produk[0][warna]"
                                                class="appearance-none bg-gray-100 border-none text-gray-600 text-xs rounded-lg pl-3 pr-7 py-1.5 focus:outline-none focus:ring-2 focus:ring-[#1B7080]/30 cursor-pointer">
                                            <option>Hitam</option>
                                            <option>Putih</option>
                                            <option>Merah</option>
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            {{-- QTY --}}
                            <td class="px-5 py-3">
                                <div class="flex items-center justify-center gap-1">
                                    <button type="button" onclick="changeQty(this, -1)"
                                            class="w-6 h-6 rounded-md bg-gray-100 hover:bg-gray-200 text-gray-500 flex items-center justify-center text-sm font-bold transition-colors">−</button>
                                    <input type="number" name="produk[0][qty]" value="1" min="1"
                                           class="w-10 text-center bg-gray-50 border border-gray-200 text-gray-700 text-xs rounded-md py-1 focus:outline-none focus:ring-2 focus:ring-[#1B7080]/30 qty-input"
                                           onchange="recalcRow(this)" />
                                    <button type="button" onclick="changeQty(this, 1)"
                                            class="w-6 h-6 rounded-md bg-gray-100 hover:bg-gray-200 text-gray-500 flex items-center justify-center text-sm font-bold transition-colors">+</button>
                                </div>
                            </td>

                            {{-- Harga/Unit --}}
                            <td class="px-5 py-3">
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-3 flex items-center text-xs text-gray-400">Rp</span>
                                    <input type="number" name="produk[0][harga]" value="0" min="0"
                                           class="w-full bg-gray-50 border border-gray-200 text-gray-700 text-xs rounded-lg pl-8 pr-3 py-2 text-right focus:outline-none focus:ring-2 focus:ring-[#1B7080]/30 harga-input"
                                           onchange="recalcRow(this)" />
                                </div>
                            </td>

                            {{-- Total --}}
                            <td class="px-5 py-3 text-right">
                                <span class="text-xs font-semibold text-gray-700 row-total">Rp 0</span>
                                <input type="hidden" name="produk[0][total]" value="0" class="row-total-input" />
                            </td>

                            {{-- Hapus --}}
                            <td class="px-3 py-3 text-center">
                                <button type="button" onclick="hapusRow(this)"
                                        class="p-1 text-gray-300 hover:text-red-400 transition-colors rounded-lg hover:bg-red-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            {{-- Tambah Produk --}}
            <div class="py-4 border-t border-gray-50">
                <button type="button" onclick="tambahRow()"
                        class="flex items-center gap-2 text-[#1B7080] hover:text-[#155f6d] text-sm font-semibold transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Produk
                </button>
            </div>

            {{-- Ringkasan harga --}}
            <div class="px-6 py-5 border-t border-gray-100 bg-gray-50/40 space-y-4">
                <div class="flex items-center justify-between text-sm text-gray-500">
                    <span>Subtotal</span>
                    <span class="font-medium text-gray-700" id="summary-subtotal">Rp 0</span>
                </div>
                <div class="flex items-center justify-between text-sm text-gray-500">
                    <span>Potongan Harga</span>
                    <span class="font-medium text-red-500" id="summary-diskon">– Rp 0</span>
                </div>
                <div class="flex items-center justify-between text-base font-bold text-gray-800 pt-3 border-t border-gray-200">
                    <span>Total Harga</span>
                    <span class="text-[#1B7080]" id="summary-total">Rp 0</span>
                </div>
            </div>

        </div>

    </div>

    {{-- ===== KOLOM KANAN ===== --}}
    <div class="w-[40%] flex flex-col gap-5 mr-1">

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-5">

            <h2 class="text-xs font-bold text-gray-400 tracking-widest uppercase">Status & Logistik</h2>

            {{-- Status Pesanan --}}
            <div>
                <label class="block text-[10px] font-semibold text-gray-400 tracking-widest uppercase mb-2">Status Pesanan</label>
                <div class="relative">
                    <select name="status"
                            class="appearance-none w-full bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-xl pl-4 pr-9 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#1B7080]/30 cursor-pointer">
                        <option value="masuk">Pesanan Masuk</option>
                        <option value="diproses">Diproses</option>
                        <option value="dikirim">Dikirim</option>
                        <option value="selesai">Selesai</option>
                        <option value="dibatalkan">Dibatalkan</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Nama Ekspedisi --}}
            <div>
                <label class="block text-[10px] font-semibold text-gray-400 tracking-widest uppercase mb-2">Nama Ekspedisi</label>
                <div class="relative">
                    <select name="ekspedisi"
                            class="appearance-none w-full bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-xl pl-4 pr-9 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#1B7080]/30 cursor-pointer">
                        <option value="">Pilih Ekspedisi...</option>
                        <option value="jne">JNE</option>
                        <option value="jnt">J&T Express</option>
                        <option value="sicepat">SiCepat</option>
                        <option value="anteraja">Anteraja</option>
                        <option value="pos">Pos Indonesia</option>
                        <option value="tiki">TIKI</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Pengiriman Dibayar Oleh --}}
            <div>
                <label class="block text-[10px] font-semibold text-gray-400 tracking-widest uppercase mb-2">Pengiriman Dibayar Oleh</label>
                <div class="flex gap-2 flex-wrap" id="pembayar-group">
                    @foreach (['penjual' => 'Penjual', 'pembeli' => 'Pembeli', 'penerima' => 'Penerima'] as $val => $label)
                    <button type="button"
                            onclick="setPembayar('{{ $val }}')"
                            id="btn-pembayar-{{ $val }}"
                            class="pembayar-btn px-4 py-2 rounded-xl text-sm font-semibold border transition-colors
                                   {{ $val === 'penjual' ? 'bg-[#1B7080] text-white border-[#1B7080]' : 'bg-gray-50 text-gray-500 border-gray-200 hover:bg-gray-100' }}">
                        {{ $label }}
                    </button>
                    @endforeach
                    <input type="hidden" name="pembayar_ongkir" id="pembayar-value" value="penjual" />
                </div>
            </div>

            {{-- Biaya Ekspedisi --}}
            <div>
                <label class="block text-[10px] font-semibold text-gray-400 tracking-widest uppercase mb-2">Biaya Ekspedisi (Rp)</label>
                <input type="number" name="biaya_ekspedisi" value="0" min="0"
                       class="w-full bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#1B7080]/30" />
            </div>

            {{-- Bank Pengirim --}}
            <div>
                <label class="block text-[10px] font-semibold text-gray-400 tracking-widest uppercase mb-2">Bank Pengirim</label>
                <div class="relative">
                    <select name="bank_pengirim"
                            class="appearance-none w-full bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-xl pl-4 pr-9 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#1B7080]/30 cursor-pointer">
                        <option value="bca">BCA – 123456789 (TOPLA)▾</option>
                        <option value="bni">BNI – 987654321 (TOPLA)</option>
                        <option value="mandiri">Mandiri – 112233445 (TOPLA)</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Catatan Internal --}}
            <div>
                <label class="block text-[10px] font-semibold text-gray-400 tracking-widest uppercase mb-2">Catatan Internal</label>
                <textarea name="catatan_internal" rows="4"
                          placeholder="Tambahkan catatan khusus untuk pesanan ini..."
                          class="w-full bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#1B7080]/30 resize-none placeholder-gray-300"></textarea>
            </div>

        </div>

    </div>

</div>

{{-- ===== FOOTER ===== --}}
<div class="flex items-center justify-between mt-6 py-4 border-t border-gray-100">
    <div class="flex items-center gap-2 text-xs text-gray-400">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0 text-[#1B7080]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 110 20A10 10 0 0112 2z" />
        </svg>
        Pastikan semua data produk dan biaya pengiriman sudah sesuai sebelum menyimpan.
    </div>
    <button type="submit"
            class="flex items-center gap-2 bg-[#1B7080] hover:bg-[#155f6d] text-white text-sm font-semibold px-6 py-3 rounded-xl transition-colors shadow-sm">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16v2a2 2 0 01-2 2H5a2 2 0 01-2-2v-2M12 4v12m0 0l-3-3m3 3l3-3" />
        </svg>
        Simpan Pesanan
    </button>
</div>

</form>

{{-- ===== SCRIPT ===== --}}
<script>
    let rowIndex = 1;

    function formatRp(val) {
        return 'Rp ' + Number(val).toLocaleString('id-ID');
    }

    function recalcRow(el) {
        const row   = el.closest('tr');
        const qty   = parseFloat(row.querySelector('.qty-input').value) || 0;
        const harga = parseFloat(row.querySelector('.harga-input').value) || 0;
        const total = qty * harga;
        row.querySelector('.row-total').textContent       = formatRp(total);
        row.querySelector('.row-total-input').value       = total;
        recalcSummary();
    }

    function changeQty(btn, delta) {
        const row   = btn.closest('tr');
        const input = row.querySelector('.qty-input');
        input.value = Math.max(1, (parseInt(input.value) || 1) + delta);
        recalcRow(input);
    }

    function recalcSummary() {
        const diskonPct  = parseFloat(document.querySelector('[name="discount_global"]').value) || 0;
        let subtotal = 0;
        document.querySelectorAll('.row-total-input').forEach(inp => {
            subtotal += parseFloat(inp.value) || 0;
        });
        const diskon = subtotal * (diskonPct / 100);
        const total  = subtotal - diskon;
        document.getElementById('summary-subtotal').textContent = formatRp(subtotal);
        document.getElementById('summary-diskon').textContent   = '– ' + formatRp(diskon);
        document.getElementById('summary-total').textContent    = formatRp(total);
    }

    document.querySelector('[name="discount_global"]').addEventListener('input', recalcSummary);

    function hapusRow(btn) {
        const rows = document.querySelectorAll('#produk-rows .produk-row');
        if (rows.length <= 1) return;
        btn.closest('tr').remove();
        recalcSummary();
    }

    function tambahRow() {
        const i   = rowIndex++;
        const tr  = document.createElement('tr');
        tr.className = 'produk-row hover:bg-gray-50/60 transition-colors';
        tr.innerHTML = `
            <td class="px-5 py-3">
                <input type="text" name="produk[${i}][nama]" placeholder="Masukkan nama produk..."
                       class="w-full bg-gray-50 border border-gray-200 text-gray-700 text-xs rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#1B7080]/30" />
                <input type="text" name="produk[${i}][kode]" placeholder="SKU"
                       class="mt-1.5 w-full bg-transparent border-none text-[10px] text-gray-400 px-0 focus:outline-none" />
            </td>
            <td class="px-5 py-3">
                <div class="flex gap-1.5 flex-wrap">
                    <div class="relative">
                        <select name="produk[${i}][ukuran]"
                                class="appearance-none bg-gray-100 border-none text-gray-600 text-xs rounded-lg pl-3 pr-7 py-1.5 focus:outline-none focus:ring-2 focus:ring-[#1B7080]/30 cursor-pointer">
                            <option>Ukuran L▾</option><option>S</option><option>M</option><option>L</option><option>XL</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                    <div class="relative">
                        <select name="produk[${i}][warna]"
                                class="appearance-none bg-gray-100 border-none text-gray-600 text-xs rounded-lg pl-3 pr-7 py-1.5 focus:outline-none focus:ring-2 focus:ring-[#1B7080]/30 cursor-pointer">
                            <option>Hitam</option><option>Putih</option><option>Merah</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                </div>
            </td>
            <td class="px-5 py-3">
                <div class="flex items-center justify-center gap-1">
                    <button type="button" onclick="changeQty(this,-1)" class="w-6 h-6 rounded-md bg-gray-100 hover:bg-gray-200 text-gray-500 flex items-center justify-center text-sm font-bold transition-colors">−</button>
                    <input type="number" name="produk[${i}][qty]" value="1" min="1"
                           class="w-10 text-center bg-gray-50 border border-gray-200 text-gray-700 text-xs rounded-md py-1 focus:outline-none focus:ring-2 focus:ring-[#1B7080]/30 qty-input"
                           onchange="recalcRow(this)" />
                    <button type="button" onclick="changeQty(this,1)" class="w-6 h-6 rounded-md bg-gray-100 hover:bg-gray-200 text-gray-500 flex items-center justify-center text-sm font-bold transition-colors">+</button>
                </div>
            </td>
            <td class="px-5 py-3">
                <div class="relative">
                    <span class="absolute inset-y-0 left-3 flex items-center text-xs text-gray-400">Rp</span>
                    <input type="number" name="produk[${i}][harga]" value="0" min="0"
                           class="w-full bg-gray-50 border border-gray-200 text-gray-700 text-xs rounded-lg pl-8 pr-3 py-2 text-right focus:outline-none focus:ring-2 focus:ring-[#1B7080]/30 harga-input"
                           onchange="recalcRow(this)" />
                </div>
            </td>
            <td class="px-5 py-3 text-right">
                <span class="text-xs font-semibold text-gray-700 row-total">Rp 0</span>
                <input type="hidden" name="produk[${i}][total]" value="0" class="row-total-input" />
            </td>
            <td class="px-3 py-3 text-center">
                <button type="button" onclick="hapusRow(this)" class="p-1 text-gray-300 hover:text-red-400 transition-colors rounded-lg hover:bg-red-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </td>
        `;
        document.getElementById('produk-rows').appendChild(tr);
    }

    function setPembayar(val) {
        document.getElementById('pembayar-value').value = val;
        document.querySelectorAll('.pembayar-btn').forEach(btn => {
            const active = btn.id === 'btn-pembayar-' + val;
            btn.className = btn.className
                .replace(/bg-\[#1B7080\] text-white border-\[#1B7080\]/g, '')
                .replace(/bg-gray-50 text-gray-500 border-gray-200 hover:bg-gray-100/g, '')
                .trim();
            btn.className += active
                ? ' bg-[#1B7080] text-white border-[#1B7080]'
                : ' bg-gray-50 text-gray-500 border-gray-200 hover:bg-gray-100';
        });
    }
</script>

@endsection
