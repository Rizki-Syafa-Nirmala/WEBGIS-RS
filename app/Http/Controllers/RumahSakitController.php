<?php

namespace App\Http\Controllers;

use App\Models\RumahSakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class RumahSakitController extends Controller
{
    // Mengambil semua data rumah sakit
    public function index()
    {
        // Ambil semua data rumah sakit dari database
                // Cek apakah data sudah ada di cache
        $rumahSakit = Cache::remember('rumah_sakit_data', 60, function () {
            return RumahSakit::select( 'nama_rs', 'latitude', 'longitude', 'amenity', 'alamat')->get();
        });

        // Passing the correct variable name to the view
        return view('peta', ['rumahsakits' => $rumahSakit]); // Corrected here
    }
}
