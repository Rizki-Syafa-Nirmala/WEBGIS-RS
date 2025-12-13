<?php

namespace App\Http\Controllers;

use App\Models\RumahSakit;
use Illuminate\Http\Request; // Pastikan baris ini ada (sudah ada di kode kamu)
use Illuminate\Support\Facades\Cache;

class RumahSakitController extends Controller
{
    // Mengambil semua data rumah sakit (Untuk Peta)
    public function index()
    {
        $rumahSakit = Cache::remember('rumah_sakit_data', 60, function () {
            return RumahSakit::select('nama_rs', 'latitude', 'longitude', 'amenity', 'alamat')->get();
        });

        return view('peta', ['rumahsakits' => $rumahSakit]);
    }

    // Mengambil data untuk tabel lokasi dengan fitur Search
    public function datatable(Request $request) // 1. Tambahkan parameter Request
    {
        // 2. Mulai query builder, jangan langsung ->paginate()
        $query = RumahSakit::select('id', 'nama_rs', 'amenity', 'alamat');

        // 3. Cek apakah user sedang melakukan pencarian
        if ($request->has('search') && $request->search != '') {
            $keyword = $request->search;
            
            // Filter berdasarkan nama, alamat, atau amenity
            $query->where(function ($q) use ($keyword) {
                $q->where('nama_rs', 'LIKE', '%' . $keyword . '%')
                  ->orWhere('alamat', 'LIKE', '%' . $keyword . '%')
                  ->orWhere('amenity', 'LIKE', '%' . $keyword . '%');
            });
        }

        // 4. Lakukan pagination pada hasil query
        $rumahsakit = $query->paginate(7);

        // 5. Tambahkan 'appends' agar saat pindah halaman (page 2, 3, dst), kata kunci pencarian tidak hilang
        $rumahsakit->appends(['search' => $request->search]);

        return view('lokasi', compact('rumahsakit'));
    }
}