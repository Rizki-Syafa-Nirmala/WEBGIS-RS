<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;  // Import class Excel
use App\Imports\DataRSImport;


class DataRSImportController extends Controller
{
    public function import(Request $request)
    {
        // Validasi file
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        try {
            // Proses impor
            Excel::import(new DataRSImport, $request->file('file'));

            // Berhasil mengimpor data
            return redirect()->back()->with('success', 'Data berhasil diimpor!');
        } catch (\Exception $e) {
            // Jika ada error saat impor
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
