<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProdukController;

Route::get('/', fn() => redirect()->route('pesanan.index'));

Route::get('/test', [TestController::class, 'index']);

Route::get('/pesanan',   [PesananController::class,  'index'])->name('pesanan.index');
Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
Route::get('/produk',    [ProdukController::class,   'index'])->name('produk.index');
