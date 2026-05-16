@extends('layouts.app')
@section('title', 'Edit Pelanggan')

@section('content')

{{-- Breadcrumb --}}
<div class="flex items-center gap-2 text-sm text-gray-400 mb-4">
    <a href="{{ route('pelanggan.index') }}" class="hover:text-gray-600 transition-colors">Daftar Pelanggan</a>
    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
    </svg>
    <span class="text-[#1B7080] font-medium">Edit Pelanggan</span>
</div>

{{-- Header --}}
<h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Pelanggan</h1>

<form action="{{ route('pelanggan.update', $pelanggan['id']) }}" method="POST">
@csrf
@method('PUT')

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 w-full space-y-5">

        {{-- Row 1: Nama & Instansi --}}
        <div class="grid grid-cols-2 gap-5">
            <div>
                <label class="block text-[10px] font-semibold text-gray-400 tracking-widest uppercase mb-2">Nama Pelanggan</label>
                <input type="text" name="nama" value="{{ $pelanggan['nama'] }}"
                       class="w-full bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#1B7080]/30" />
            </div>
            <div>
                <label class="block text-[10px] font-semibold text-gray-400 tracking-widest uppercase mb-2">Instansi</label>
                <input type="text" name="instansi" value="{{ $pelanggan['instansi'] }}"
                       class="w-full bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#1B7080]/30" />
            </div>
        </div>

        {{-- Row 2: No. WhatsApp --}}
        <div>
            <label class="block text-[10px] font-semibold text-gray-400 tracking-widest uppercase mb-2">No. WhatsApp</label>
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                </div>
                <input type="text" name="no_wa" value="{{ $pelanggan['no_wa'] }}"
                       class="w-full bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-xl pl-10 pr-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#1B7080]/30" />
            </div>
        </div>

        {{-- Row 3: Alamat Lengkap --}}
        <div>
            <label class="block text-[10px] font-semibold text-gray-400 tracking-widest uppercase mb-2">Alamat Lengkap</label>
            <textarea name="alamat" rows="3"
                      class="w-full bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#1B7080]/30 resize-none">{{ $pelanggan['alamat'] }}</textarea>
        </div>

        {{-- Row 4: Provinsi & Kabupaten/Kota --}}
        <div class="grid grid-cols-2 gap-5">
            <div>
                <label class="block text-[10px] font-semibold text-gray-400 tracking-widest uppercase mb-2">Provinsi</label>
                <select name="provinsi" id="select-provinsi" style="width:100%">
                    @foreach ($provinsi_list as $prov)
                        <option value="{{ $prov['id'] }}" {{ $prov['id'] == $pelanggan['provinsi_id'] ? 'selected' : '' }}>{{ $prov['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-[10px] font-semibold text-gray-400 tracking-widest uppercase mb-2">Kabupaten/Kota</label>
                <input type="text" name="kabupaten" value="{{ $pelanggan['kabupaten'] }}"
                       class="w-full bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#1B7080]/30" />
            </div>
        </div>

        {{-- Row 5: Kode Pos --}}
        <div class="w-1/2 pr-2.5">
            <label class="block text-[10px] font-semibold text-gray-400 tracking-widest uppercase mb-2">Kode Pos</label>
            <input type="text" name="kode_pos" value="{{ $pelanggan['kode_pos'] }}"
                   class="w-full bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#1B7080]/30" />
        </div>

        {{-- Divider --}}
        <div class="border-t border-gray-100"></div>

        {{-- Action Buttons --}}
        <div class="flex items-center gap-3">
            <button type="submit"
                    class="flex items-center gap-2 bg-[#1B7080] hover:bg-[#155f6d] text-white text-sm font-semibold px-6 py-3 rounded-xl transition-colors shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                </svg>
                Simpan Perubahan
            </button>
            <a href="{{ route('pelanggan.index') }}"
               class="flex items-center justify-center text-sm font-semibold text-gray-500 hover:text-gray-700 px-6 py-3 rounded-xl border border-gray-200 hover:bg-gray-50 transition-colors">
                Batalkan
            </a>
        </div>

    </div>

</form>

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container--default .select2-selection--single {
        background-color: rgb(249 250 251);
        border: 1px solid rgb(229 231 235);
        border-radius: 0.75rem;
        height: auto;
        padding: 0.5rem 2.5rem 0.5rem 1rem;
        transition: box-shadow 0.15s;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: rgb(55 65 81);
        font-size: 0.875rem;
        line-height: 1.5rem;
        padding: 0;
    }
    .select2-container--default .select2-selection--single .select2-selection__placeholder {
        color: rgb(209 213 219);
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 100%;
        top: 0;
        right: 0.75rem;
    }
    .select2-container--default.select2-container--open .select2-selection--single,
    .select2-container--default.select2-container--focus .select2-selection--single {
        border-color: rgb(27 112 128 / 0.5);
        box-shadow: 0 0 0 3px rgb(27 112 128 / 0.15);
        outline: none;
    }
    .select2-dropdown {
        background: white;
        border: 1px solid rgb(243 244 246);
        border-radius: 0.75rem;
        box-shadow: 0 10px 25px -5px rgb(0 0 0 / 0.1), 0 4px 10px -6px rgb(0 0 0 / 0.08);
        overflow: hidden;
        margin-top: 4px;
    }
    .select2-search--dropdown {
        padding: 0.5rem;
        border-bottom: 1px solid rgb(243 244 246);
    }
    .select2-container--default .select2-search--dropdown .select2-search__field {
        background-color: rgb(249 250 251);
        border: 1px solid rgb(229 231 235);
        border-radius: 0.5rem;
        font-size: 0.875rem;
        padding: 0.5rem 0.75rem;
        color: rgb(55 65 81);
    }
    .select2-container--default .select2-search--dropdown .select2-search__field:focus {
        outline: none;
        border-color: rgb(27 112 128 / 0.5);
        box-shadow: 0 0 0 2px rgb(27 112 128 / 0.15);
    }
    .select2-results__option {
        font-size: 0.875rem;
        color: rgb(55 65 81);
        padding: 0.5rem 1rem;
    }
    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: rgb(243 244 246);
        color: rgb(55 65 81);
    }
    .select2-container--default .select2-results__option[aria-selected=true] {
        background-color: rgb(27 112 128 / 0.08);
        color: rgb(27 112 128);
        font-weight: 500;
    }
    .select2-results__options { max-height: 220px; }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(function () {
        $('#select-provinsi').select2({
            allowClear: false,
            width: '100%',
            language: { searching: () => 'Mencari...' },
        });
    });
</script>
@endpush

@endsection
