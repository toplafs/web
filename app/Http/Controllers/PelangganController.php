<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\ProvinsiModel;
use App\Models\KabupatenModel;

class PelangganController extends Controller
{
    private function provinsiList(): array
    {
        return Cache::remember('provinsi_list', now()->addDay(), function () {
            return ProvinsiModel::orderBy('name')->get(['id', 'name'])->toArray();
        });
    }

    private function kabupatenMap(): array
    {
        return Cache::remember('kabupaten_list', now()->addDay(), function () {
            return KabupatenModel::orderBy('name')
                ->get(['id', 'prov_id', 'name'])
                ->groupBy('prov_id')
                ->map(fn($items) => $items->map(fn($k) => ['id' => $k->id, 'name' => $k->name])->values()->all())
                ->all();
        });
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

    public function index(Request $request)
    {
        $search  = $request->input('search', '');
        $perPage = 5;
        $page    = max(1, (int) $request->input('page', 1));

        $all = collect($this->mockPelanggan());

        if ($search) {
            $s   = strtolower($search);
            $all = $all->filter(fn($p) =>
                str_contains(strtolower($p['nama']),     $s) ||
                str_contains(strtolower($p['instansi']), $s) ||
                str_contains(strtolower($p['alamat']),   $s)
            );
        }

        $total       = $all->count();
        $lastPage    = max(1, (int) ceil($total / $perPage));
        $currentPage = min($page, $lastPage);

        $pelanggan = $all->values()->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $from = $total > 0 ? ($currentPage - 1) * $perPage + 1 : 0;
        $to   = min($currentPage * $perPage, $total);

        return view('pelanggan.index', compact(
            'pelanggan', 'total', 'from', 'to', 'currentPage', 'lastPage', 'search'
        ));
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
