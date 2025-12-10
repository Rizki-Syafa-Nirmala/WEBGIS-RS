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
        $rumahSakit = Cache::remember('rumah_sakit_data', 60, function () {
            return RumahSakit::select( 'nama_rs', 'detail_dokter', 'fasilitas_unggulan', 'alamat', 'amenity', 'latitude', 'longitude')->get();
        });

        return view('peta', ['rumahsakits' => $rumahSakit]); 
    }

    public function datatable(){
        $rumahsakit = RumahSakit::select( 'id','nama_rs', 'amenity', 'alamat', 'fasilitas_unggulan', 'detail_dokter')->paginate(7);
        return view('lokasi', compact('rumahsakit'));
    }
}
