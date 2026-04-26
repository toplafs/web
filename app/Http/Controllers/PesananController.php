<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PesananController extends Controller
{
    private function allPesanan(): Collection
    {
        return collect([
            ['no' => 'PSN-001', 'tanggal' => '2023-10-12', 'tanggal_display' => '12 Okt 2023', 'status' => 'SELESAI',  'pelanggan' => 'Budi Darmawan',   'instansi' => 'PT. Maju Mundur',      'no_wa' => '081234567890', 'total' => 'Rp 12.500.000'],
            ['no' => 'PSN-002', 'tanggal' => '2023-10-12', 'tanggal_display' => '12 Okt 2023', 'status' => 'DIPROSES', 'pelanggan' => 'Siti Aminah',     'instansi' => 'Dinas Pendidikan',     'no_wa' => '089876543210', 'total' => 'Rp 4.200.000'],
            ['no' => 'PSN-003', 'tanggal' => '2023-10-11', 'tanggal_display' => '11 Okt 2023', 'status' => 'MENUNGGU', 'pelanggan' => 'Andi Wijaya',     'instansi' => 'CV. Berkah Abadi',     'no_wa' => '085244332211', 'total' => 'Rp 8.950.000'],
            ['no' => 'PSN-004', 'tanggal' => '2023-10-10', 'tanggal_display' => '10 Okt 2023', 'status' => 'SELESAI',  'pelanggan' => 'Rina Kartika',    'instansi' => 'Universitas Terbuka',  'no_wa' => '081122334455', 'total' => 'Rp 2.100.000'],
            ['no' => 'PSN-005', 'tanggal' => '2023-10-10', 'tanggal_display' => '10 Okt 2023', 'status' => 'SELESAI',  'pelanggan' => 'Doni Saputra',    'instansi' => 'Freelance',            'no_wa' => '087766554433', 'total' => 'Rp 500.000'],
            ['no' => 'PSN-006', 'tanggal' => '2023-10-09', 'tanggal_display' => '09 Okt 2023', 'status' => 'DIPROSES', 'pelanggan' => 'Mega Lestari',    'instansi' => 'PT. Sejahtera Baru',   'no_wa' => '082233445566', 'total' => 'Rp 6.750.000'],
            ['no' => 'PSN-007', 'tanggal' => '2023-10-09', 'tanggal_display' => '09 Okt 2023', 'status' => 'SELESAI',  'pelanggan' => 'Hendra Susilo',   'instansi' => 'Kemendag RI',          'no_wa' => '081398765432', 'total' => 'Rp 18.000.000'],
            ['no' => 'PSN-008', 'tanggal' => '2023-10-08', 'tanggal_display' => '08 Okt 2023', 'status' => 'MENUNGGU', 'pelanggan' => 'Dewi Rahayu',     'instansi' => 'PT. Karya Mandiri',    'no_wa' => '085312345678', 'total' => 'Rp 3.400.000'],
            ['no' => 'PSN-009', 'tanggal' => '2023-10-08', 'tanggal_display' => '08 Okt 2023', 'status' => 'SELESAI',  'pelanggan' => 'Fajar Nugroho',   'instansi' => 'BUMN Persero',         'no_wa' => '089654321098', 'total' => 'Rp 9.800.000'],
            ['no' => 'PSN-010', 'tanggal' => '2023-10-07', 'tanggal_display' => '07 Okt 2023', 'status' => 'DIPROSES', 'pelanggan' => 'Indah Permata',   'instansi' => 'Yayasan Bakti',        'no_wa' => '081567890123', 'total' => 'Rp 1.250.000'],
            ['no' => 'PSN-011', 'tanggal' => '2023-10-07', 'tanggal_display' => '07 Okt 2023', 'status' => 'SELESAI',  'pelanggan' => 'Wahyu Santoso',   'instansi' => 'PT. Global Tech',      'no_wa' => '087890123456', 'total' => 'Rp 22.500.000'],
            ['no' => 'PSN-012', 'tanggal' => '2023-10-06', 'tanggal_display' => '06 Okt 2023', 'status' => 'MENUNGGU', 'pelanggan' => 'Nila Sari',       'instansi' => 'Koperasi Maju',        'no_wa' => '082345678901', 'total' => 'Rp 780.000'],
            ['no' => 'PSN-013', 'tanggal' => '2023-10-06', 'tanggal_display' => '06 Okt 2023', 'status' => 'SELESAI',  'pelanggan' => 'Agus Pratama',    'instansi' => 'PT. Abadi Jaya',       'no_wa' => '085678901234', 'total' => 'Rp 5.600.000'],
            ['no' => 'PSN-014', 'tanggal' => '2023-10-05', 'tanggal_display' => '05 Okt 2023', 'status' => 'DIPROSES', 'pelanggan' => 'Ratna Dewi',      'instansi' => 'Dinas Kesehatan',      'no_wa' => '081234098765', 'total' => 'Rp 14.200.000'],
            ['no' => 'PSN-015', 'tanggal' => '2023-10-05', 'tanggal_display' => '05 Okt 2023', 'status' => 'SELESAI',  'pelanggan' => 'Rudi Hartono',    'instansi' => 'CV. Mitra Usaha',      'no_wa' => '089012345678', 'total' => 'Rp 3.100.000'],
            ['no' => 'PSN-016', 'tanggal' => '2023-10-04', 'tanggal_display' => '04 Okt 2023', 'status' => 'MENUNGGU', 'pelanggan' => 'Sari Bulan',      'instansi' => 'PT. Cahaya Nusantara', 'no_wa' => '082109876543', 'total' => 'Rp 7.450.000'],
            ['no' => 'PSN-017', 'tanggal' => '2023-10-04', 'tanggal_display' => '04 Okt 2023', 'status' => 'SELESAI',  'pelanggan' => 'Bambang Wibowo',  'instansi' => 'PT. Surya Abadi',      'no_wa' => '085209876543', 'total' => 'Rp 11.300.000'],
            ['no' => 'PSN-018', 'tanggal' => '2023-10-03', 'tanggal_display' => '03 Okt 2023', 'status' => 'DIPROSES', 'pelanggan' => 'Citra Anggraeni', 'instansi' => 'Universitas Negeri',   'no_wa' => '081309876543', 'total' => 'Rp 2.850.000'],
            ['no' => 'PSN-019', 'tanggal' => '2023-10-02', 'tanggal_display' => '02 Okt 2023', 'status' => 'SELESAI',  'pelanggan' => 'Dian Kusuma',     'instansi' => 'Bank Rakyat',          'no_wa' => '087609876543', 'total' => 'Rp 33.000.000'],
            ['no' => 'PSN-020', 'tanggal' => '2023-10-01', 'tanggal_display' => '01 Okt 2023', 'status' => 'SELESAI',  'pelanggan' => 'Eko Purnomo',     'instansi' => 'CV. Harapan Bangsa',   'no_wa' => '082609876543', 'total' => 'Rp 1.900.000'],
        ]);
    }

    public function index(Request $request)
    {
        // Step 1: apply search + date filter (base untuk hitung stat cards)
        $base = $this->allPesanan();

        if ($request->filled('search')) {
            $q = strtolower($request->search);
            $base = $base->filter(fn($p) =>
                str_contains(strtolower($p['pelanggan']), $q) ||
                str_contains(strtolower($p['no']), $q)
            );
        }

        if ($request->filled('date_start')) {
            $base = $base->filter(fn($p) => $p['tanggal'] >= $request->date_start);
        }

        if ($request->filled('date_end')) {
            $base = $base->filter(fn($p) => $p['tanggal'] <= $request->date_end);
        }

        // Step 2: hitung stat cards dari base (sebelum filter status)
        $stats = [
            'menunggu' => $base->where('status', 'MENUNGGU')->count(),
            'diproses' => $base->where('status', 'DIPROSES')->count(),
            'selesai'  => $base->where('status', 'SELESAI')->count(),
        ];

        // Step 3: apply status filter
        $filtered = $base;
        if ($request->filled('status') && $request->status !== 'semua') {
            $filtered = $filtered->filter(fn($p) => $p['status'] === strtoupper($request->status));
        }

        // Step 4: paginate
        $perPage     = 7;
        $currentPage = max(1, (int) $request->get('page', 1));
        $total       = $filtered->count();
        $lastPage    = max(1, (int) ceil($total / $perPage));
        $currentPage = min($currentPage, $lastPage);

        $pesanan = $filtered->values()->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $from = $total > 0 ? ($currentPage - 1) * $perPage + 1 : 0;
        $to   = min($currentPage * $perPage, $total);

        return view('pesanan.index', [
            'pesanan'     => $pesanan,
            'stats'       => $stats,
            'total'       => $total,
            'from'        => $from,
            'to'          => $to,
            'currentPage' => $currentPage,
            'lastPage'    => $lastPage,
            'filters'     => $request->only(['status', 'date_start', 'date_end', 'search']),
        ]);
    }
}
