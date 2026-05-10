<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PelangganController extends Controller
{
    private function provinsiList(): array
    {
        return [
            'Aceh', 'Bali', 'Banten', 'Bengkulu', 'DI Yogyakarta', 'DKI Jakarta',
            'Gorontalo', 'Jambi', 'Jawa Barat', 'Jawa Tengah', 'Jawa Timur',
            'Kalimantan Barat', 'Kalimantan Selatan', 'Kalimantan Tengah', 'Kalimantan Timur', 'Kalimantan Utara',
            'Kepulauan Bangka Belitung', 'Kepulauan Riau', 'Lampung', 'Maluku', 'Maluku Utara',
            'Nusa Tenggara Barat', 'Nusa Tenggara Timur', 'Papua', 'Papua Barat',
            'Riau', 'Sulawesi Barat', 'Sulawesi Selatan', 'Sulawesi Tengah', 'Sulawesi Tenggara', 'Sulawesi Utara',
            'Sumatera Barat', 'Sumatera Selatan', 'Sumatera Utara',
        ];
    }

    private function kabupatenMap(): array
    {
        return [
            'DKI Jakarta'    => ['Kota Jakarta Pusat', 'Kota Jakarta Utara', 'Kota Jakarta Barat', 'Kota Jakarta Selatan', 'Kota Jakarta Timur', 'Kab. Kepulauan Seribu'],
            'Jawa Barat'     => ['Kota Bandung', 'Kota Bekasi', 'Kota Bogor', 'Kota Cimahi', 'Kota Depok', 'Kota Cirebon', 'Kab. Bandung', 'Kab. Bekasi', 'Kab. Bogor', 'Kab. Cianjur', 'Kab. Garut', 'Kab. Indramayu', 'Kab. Karawang', 'Kab. Subang', 'Kab. Sukabumi', 'Kab. Tasikmalaya'],
            'Jawa Tengah'    => ['Kota Semarang', 'Kota Solo', 'Kota Magelang', 'Kota Pekalongan', 'Kota Salatiga', 'Kota Tegal', 'Kab. Banyumas', 'Kab. Cilacap', 'Kab. Demak', 'Kab. Klaten', 'Kab. Purwokerto', 'Kab. Semarang', 'Kab. Sukoharjo', 'Kab. Wonogiri'],
            'Jawa Timur'     => ['Kota Surabaya', 'Kota Malang', 'Kota Kediri', 'Kota Blitar', 'Kota Madiun', 'Kota Mojokerto', 'Kota Pasuruan', 'Kota Probolinggo', 'Kab. Gresik', 'Kab. Jember', 'Kab. Jombang', 'Kab. Lumajang', 'Kab. Malang', 'Kab. Sidoarjo', 'Kab. Tuban'],
            'DI Yogyakarta'  => ['Kota Yogyakarta', 'Kab. Bantul', 'Kab. Gunungkidul', 'Kab. Kulon Progo', 'Kab. Sleman'],
            'Banten'         => ['Kota Cilegon', 'Kota Serang', 'Kota Tangerang', 'Kota Tangerang Selatan', 'Kab. Lebak', 'Kab. Pandeglang', 'Kab. Serang', 'Kab. Tangerang'],
            'Bali'           => ['Kota Denpasar', 'Kab. Badung', 'Kab. Bangli', 'Kab. Buleleng', 'Kab. Gianyar', 'Kab. Jembrana', 'Kab. Karangasem', 'Kab. Klungkung', 'Kab. Tabanan'],
            'Sumatera Utara' => ['Kota Medan', 'Kota Binjai', 'Kota Pematangsiantar', 'Kota Sibolga', 'Kota Tanjungbalai', 'Kab. Deli Serdang', 'Kab. Karo', 'Kab. Langkat', 'Kab. Simalungun'],
            'Sumatera Barat' => ['Kota Padang', 'Kota Bukittinggi', 'Kota Payakumbuh', 'Kab. Agam', 'Kab. Lima Puluh Kota', 'Kab. Padang Pariaman', 'Kab. Pesisir Selatan', 'Kab. Solok'],
            'Riau'           => ['Kota Pekanbaru', 'Kota Dumai', 'Kab. Bengkalis', 'Kab. Indragiri Hilir', 'Kab. Kampar', 'Kab. Rokan Hilir', 'Kab. Siak'],
            'Lampung'        => ['Kota Bandar Lampung', 'Kota Metro', 'Kab. Lampung Selatan', 'Kab. Lampung Tengah', 'Kab. Lampung Utara', 'Kab. Pesawaran', 'Kab. Pringsewu', 'Kab. Tanggamus'],
            'Sulawesi Selatan' => ['Kota Makassar', 'Kota Parepare', 'Kota Palopo', 'Kab. Bone', 'Kab. Bulukumba', 'Kab. Gowa', 'Kab. Maros', 'Kab. Wajo'],
            'Kalimantan Timur' => ['Kota Samarinda', 'Kota Balikpapan', 'Kota Bontang', 'Kab. Berau', 'Kab. Kutai Kartanegara', 'Kab. Kutai Timur', 'Kab. Penajam Paser Utara'],
        ];
    }

    private function mockPelanggan(): array
    {
        return [
            ['id' => 1, 'nama' => 'Yusril Arinal',  'instansi' => 'PT ASTA BUMI CIPTA',  'no_wa' => '+62 896-5588-1506', 'total_pesanan' => 7,  'alamat' => 'Menara Cakrawala 9th Floor, North Wing Jl. M.H. Thamrin No.9 Unit 904, RT.2/RW.1, Kb. Sirih, Kec. Menteng', 'provinsi' => 'DKI Jakarta', 'kabupaten' => 'Kota Administrasi Jakarta Pusat', 'kode_pos' => '10340'],
            ['id' => 2, 'nama' => 'Budi Darmawan',  'instansi' => 'PT. Maju Mundur',      'no_wa' => '081234567890',      'total_pesanan' => 12, 'alamat' => 'Jl. Sudirman No.1, RT.1/RW.1, Karet Semanggi, Kec. Setiabudi', 'provinsi' => 'DKI Jakarta',      'kabupaten' => 'Kota Jakarta Selatan',            'kode_pos' => '12930'],
            ['id' => 3, 'nama' => 'Siti Aminah',    'instansi' => 'Dinas Pendidikan',     'no_wa' => '089876543210',      'total_pesanan' => 5,  'alamat' => 'Jl. Pahlawan No.10, Kel. Kauman, Kec. Semarang Tengah',         'provinsi' => 'Jawa Tengah',       'kabupaten' => 'Kota Semarang',                   'kode_pos' => '50241'],
            ['id' => 4, 'nama' => 'Andi Wijaya',    'instansi' => 'CV. Berkah Abadi',     'no_wa' => '085244332211',      'total_pesanan' => 8,  'alamat' => 'Jl. Gajah Mada No.5, Kel. Poncowinatan, Kec. Jetis',           'provinsi' => 'DI Yogyakarta',     'kabupaten' => 'Kota Yogyakarta',                 'kode_pos' => '55233'],
            ['id' => 5, 'nama' => 'Rina Kartika',   'instansi' => 'Universitas Terbuka',  'no_wa' => '081122334455',      'total_pesanan' => 3,  'alamat' => 'Jl. Cabe Raya No.1, Pondok Cabe Udik, Kec. Pamulang',          'provinsi' => 'Banten',            'kabupaten' => 'Kota Tangerang Selatan',           'kode_pos' => '15418'],
            ['id' => 6, 'nama' => 'Doni Saputra',   'instansi' => 'Freelance',             'no_wa' => '087766554433',      'total_pesanan' => 2,  'alamat' => 'Jl. Raya Darmo No.22, Kel. Darmo, Kec. Wonokromo',             'provinsi' => 'Jawa Timur',        'kabupaten' => 'Kota Surabaya',                   'kode_pos' => '60241'],
        ];
    }

    public function index()
    {
        $pelanggan = $this->mockPelanggan();
        return view('pelanggan.index', compact('pelanggan'));
    }

    public function create()
    {
        $provinsi_list = $this->provinsiList();
        $kabupaten_map = $this->kabupatenMap();

        return view('pelanggan.create', compact('provinsi_list', 'kabupaten_map'));
    }

    public function store(Request $request)
    {
        return redirect()->route('pelanggan.index');
    }

    public function edit($id)
    {
        $list      = $this->mockPelanggan();
        $pelanggan = collect($list)->firstWhere('id', (int) $id) ?? $list[0];

        $provinsi_list = $this->provinsiList();

        return view('pelanggan.edit', compact('pelanggan', 'provinsi_list'));
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('pelanggan.index');
    }
}
