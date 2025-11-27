<?php

namespace App\Http\Controllers;

use App\Models\RumahSakit;
use Illuminate\Http\Request;

class RumahSakitController extends Controller
{
    // Mengambil semua data rumah sakit
    public function index()
    {
        // Ambil semua data rumah sakit dari database
        $rumahSakit = RumahSakit::all();

        // Kembalikan data dalam format JSON
        return response()->json($rumahSakit);
    }
}
