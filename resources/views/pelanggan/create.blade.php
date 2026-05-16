@extends('layouts.app')
@section('title', 'Tambah Pelanggan')

@section('content')

{{-- Breadcrumb --}}
<div class="flex items-center gap-2 text-sm text-gray-400 mb-4">
    <a href="{{ route('pelanggan.index') }}" class="hover:text-gray-600 transition-colors">Daftar Pelanggan</a>
    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
    </svg>
    <span class="text-[#1B7080] font-medium">Tambah Pelanggan Baru</span>
</div>

{{-- Header --}}
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Tambah Pelanggan</h1>
    <p class="text-gray-400 text-sm mt-1">Lengkapi informasi basis data pelanggan editorial TOPLA.</p>
</div>

<form action="{{ route('pelanggan.store') }}" method="POST">
@csrf

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 w-full space-y-5">

        {{-- Row 1: Nama & Instansi --}}
        <div class="grid grid-cols-2 gap-5">
            <div>
                <label class="block text-[10px] font-semibold text-gray-400 tracking-widest uppercase mb-2">Nama Pelanggan</label>
                <input type="text" name="nama" placeholder="Masukkan nama lengkap"
                       class="w-full bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#1B7080]/30 placeholder-gray-300" />
            </div>
            <div>
                <label class="block text-[10px] font-semibold text-gray-400 tracking-widest uppercase mb-2">Instansi</label>
                <input type="text" name="instansi" placeholder="Contoh: Universitas Gadjah Mada"
                       class="w-full bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#1B7080]/30 placeholder-gray-300" />
            </div>
        </div>

        {{-- Row 2: No. WhatsApp & Kode Pos --}}
        <div class="grid grid-cols-2 gap-5">
            <div>
                <label class="block text-[10px] font-semibold text-gray-400 tracking-widest uppercase mb-2">No. WhatsApp</label>
                <div class="flex items-center bg-gray-50 border border-gray-200 rounded-xl overflow-hidden focus-within:ring-2 focus-within:ring-[#1B7080]/30">
                    <span class="pl-4 pr-2 text-sm text-gray-400 shrink-0 select-none">+62</span>
                    <div class="w-px h-5 bg-gray-200 shrink-0"></div>
                    <input type="text" name="no_wa" placeholder="812-3456-7890"
                           class="flex-1 bg-transparent text-gray-700 text-sm px-3 py-2.5 focus:outline-none placeholder-gray-300" />
                </div>
            </div>
            <div>
                <label class="block text-[10px] font-semibold text-gray-400 tracking-widest uppercase mb-2">Kode Pos</label>
                <input type="text" name="kode_pos" placeholder="Masukkan 5 digit kode pos" maxlength="5"
                       class="w-full bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#1B7080]/30 placeholder-gray-300" />
            </div>
        </div>

        {{-- Row 3: Alamat Lengkap --}}
        <div>
            <label class="block text-[10px] font-semibold text-gray-400 tracking-widest uppercase mb-2">Alamat Lengkap</label>
            <textarea name="alamat" rows="4" placeholder="Nama jalan, nomor rumah, RT/RW, Kecamatan..."
                      class="w-full bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#1B7080]/30 resize-none placeholder-gray-300"></textarea>
        </div>

        {{-- Row 4: Provinsi & Kabupaten/Kota --}}
        <div class="grid grid-cols-2 gap-5">
            <div>
                <label class="block text-[10px] font-semibold text-gray-400 tracking-widest uppercase mb-2">Provinsi</label>
                <select name="provinsi" id="select-provinsi" style="width:100%">
                    <option value="" disabled selected>Pilih Provinsi</option>
                    @foreach ($provinsi_list as $prov)
                        <option value="{{ $prov['id'] }}">{{ $prov['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-[10px] font-semibold text-gray-400 tracking-widest uppercase mb-2">Kabupaten / Kota</label>
                <div class="relative">
                    <select name="kabupaten" id="select-kabupaten"
                            class="appearance-none w-full bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-xl pl-4 pr-9 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#1B7080]/30 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed"
                            disabled>
                        <option value="" disabled selected>Pilih Kabupaten/Kota</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Divider --}}
        <div class="border-t border-gray-100"></div>

        {{-- Action Buttons --}}
        <div class="flex items-center justify-between">
            <a href="{{ route('pelanggan.index') }}"
               class="text-sm font-semibold text-gray-500 hover:text-gray-700 transition-colors">
                Batalkan
            </a>
            <button type="submit"
                    class="flex items-center gap-2 bg-[#1B7080] hover:bg-[#155f6d] text-white text-sm font-semibold px-6 py-3 rounded-xl transition-colors shadow-sm">
                Simpan Pelanggan
            </button>
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
    const kabupatenData = @json($kabupaten_map);

    function updateKabupaten() {
        const prov   = $('#select-provinsi').val();
        const select = document.getElementById('select-kabupaten');
        const list   = kabupatenData[prov] || [];

        select.innerHTML = '<option value="" disabled selected>Pilih Kabupaten/Kota</option>';
        list.forEach(kab => {
            const opt = document.createElement('option');
            opt.value = kab.id;
            opt.textContent = kab.name;
            select.appendChild(opt);
        });
        select.disabled = list.length === 0;
    }

    $(function () {
        $('#select-provinsi').select2({
            placeholder: 'Pilih Provinsi',
            allowClear: false,
            width: '100%',
            language: { searching: () => 'Mencari...' },
        });

        $('#select-provinsi').on('change', updateKabupaten);
    });
</script>
@endpush

@endsection
