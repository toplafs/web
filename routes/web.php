<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProdukController;

Route::get('/', fn() => redirect()->route('pesanan.index'));

Route::get('/test', [TestController::class, 'index']);

//pesanan
Route::get('/pesanan',          [PesananController::class,  'index'])->name('pesanan.index');
Route::get('/pesanan/create',   [PesananController::class,  'create'])->name('pesanan.create');
Route::post('/pesanan',         [PesananController::class,  'store'])->name('pesanan.store');
Route::get('/pesanan/{id}',     [PesananController::class,  'show'])->name('pesanan.show');

Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
