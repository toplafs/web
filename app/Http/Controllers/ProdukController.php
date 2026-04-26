<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = [
            ['nama' => 'Buku Tulis A5',      'kategori' => 'Alat Tulis',   'harga' => 'Rp 5.000',    'stok' => 240],
            ['nama' => 'Pulpen Hitam',        'kategori' => 'Alat Tulis',   'harga' => 'Rp 3.500',    'stok' => 500],
            ['nama' => 'Kertas HVS A4',       'kategori' => 'Kertas',       'harga' => 'Rp 45.000',   'stok' => 120],
            ['nama' => 'Map Plastik',         'kategori' => 'Arsip',        'harga' => 'Rp 8.000',    'stok' => 80],
            ['nama' => 'Tinta Printer Black', 'kategori' => 'Tinta',        'harga' => 'Rp 125.000',  'stok' => 35],
        ];

        return view('produk.index', compact('produk'));
    }
}
