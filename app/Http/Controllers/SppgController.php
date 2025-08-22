<?php

namespace App\Http\Controllers;

use App\Models\Sppg;
use Illuminate\Http\Request;

class SppgController extends Controller
{
    /**
     * API untuk mengembalikan semua data SPPG dalam bentuk JSON.
     */
    public function getAll()
    {
        return response()->json(Sppg::all());
    }

    /**
     * Halaman Data (tabel).
     * Menampilkan semua data SPPG dalam bentuk tabel dengan search ID SPPG.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $sppgs = Sppg::where('id_sppg', $search)->get();
        } else {
            $sppgs = Sppg::all();
        }

        return view('data', compact('sppgs'));
    }

    /**
     * Halaman Map.
     * Menampilkan data SPPG ke dalam peta Leaflet + cluster.
     */
    public function map()
    {
        $sppgs = Sppg::select('id_sppg', 'status_pengajuan', 'alamat', 'latitude', 'longitude')
                    ->whereNotNull('latitude')
                    ->whereNotNull('longitude')
                    ->get();

        return view('map', compact('sppgs'));
    }

    /**
     * Halaman Statistik.
     * Menghitung hanya jumlah SPPG Beroperasi dan Belum Beroperasi untuk chart.
     */
    public function statistik()
    {
        // Hitung jumlah SPPG untuk dua status saja
        $beroperasi = Sppg::where('status_pengajuan', 'Beroperasi')->count();
        $belum = Sppg::where('status_pengajuan', 'Belum Beroperasi')->count();

        // Daftar provinsi Indonesia
        $provinsiList = [
            'ACEH','SUMATERA UTARA','SUMATERA BARAT','RIAU','JAMBI','SUMATERA SELATAN','BENGKULU',
            'LAMPUNG','KEPULAUAN BANGKA BELITUNG','KEPULAUAN RIAU','DKI JAKARTA','JAWA BARAT',
            'JAWA TENGAH','DI YOGYAKARTA','JAWA TIMUR','BANTEN','BALI','NUSA TENGGARA BARAT',
            'NUSA TENGGARA TIMUR','KALIMANTAN BARAT','KALIMANTAN TENGAH','KALIMANTAN SELATAN',
            'KALIMANTAN TIMUR','KALIMANTAN UTARA','SULAWESI UTARA','SULAWESI TENGAH',
            'SULAWESI SELATAN','SULAWESI TENGGARA','GORONTALO','SULAWESI BARAT','MALUKU',
            'MALUKU UTARA','PAPUA','PAPUA BARAT','PAPUA BARAT DAYA','PAPUA TENGAH',
            'PAPUA PEGUNUNGAN','PAPUA SELATAN'
        ];

        $dataProvinsi = [];
        foreach ($provinsiList as $prov) {
            $count = Sppg::where('alamat', 'LIKE', '%' . $prov . '%')->count();
            if ($count > 0) {
                $dataProvinsi[] = [
                    'provinsi' => $prov,
                    'total' => $count
                ];
            }
        }

        return view('statistik', [
            'beroperasi' => $beroperasi,
            'belum' => $belum,
            'perProvinsi' => $dataProvinsi
        ]);
    }
}
