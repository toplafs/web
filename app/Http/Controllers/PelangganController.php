<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = [
            ['nama' => 'Budi Darmawan', 'instansi' => 'PT. Maju Mundur',     'no_wa' => '081234567890', 'total_pesanan' => 12],
            ['nama' => 'Siti Aminah',   'instansi' => 'Dinas Pendidikan',    'no_wa' => '089876543210', 'total_pesanan' => 5],
            ['nama' => 'Andi Wijaya',   'instansi' => 'CV. Berkah Abadi',    'no_wa' => '085244332211', 'total_pesanan' => 8],
            ['nama' => 'Rina Kartika',  'instansi' => 'Universitas Terbuka', 'no_wa' => '081122334455', 'total_pesanan' => 3],
            ['nama' => 'Doni Saputra',  'instansi' => 'Freelance',           'no_wa' => '087766554433', 'total_pesanan' => 2],
        ];

        return view('pelanggan.index', compact('pelanggan'));
    }
}
