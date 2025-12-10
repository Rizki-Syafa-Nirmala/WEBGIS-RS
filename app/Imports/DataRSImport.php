<?php

namespace App\Imports;

use App\Models\RumahSakit;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataRSImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        // Pastikan latitude dan longitude tidak kosong
        $latitude = !empty($row['latitude']) ? $row['latitude'] : 0;
        $longitude = !empty($row['longitude']) ? $row['longitude'] : 0;

        // Periksa jika 'nama_rs' kosong
        if (empty($row['nama_rs'])) {
            \Log::warning('Nama Rumah Sakit kosong pada baris:', $row);
            return null;  // Skip baris ini jika nama_rs kosong
        }
        
            $detail_dokter = !empty($row['detail_dokter']) ? $row['detail_dokter'] : 'Tidak ada data';
            $fasilitas_unggulan = !empty($row['fasilitas_unggulan']) ? $row['fasilitas_unggulan'] : 'Tidak ada data';

        return new RumahSakit([
            'nama_rs'          => $row['nama_rs'],
            'detail_dokter'    => $detail_dokter, 
            'fasilitas_unggulan'=> $fasilitas_unggulan, 
            'alamat'           => $row['alamat'],
            'amenity'          => $row['amenity'],
            'latitude'         => $latitude,
            'longitude'        => $longitude,
        ]);
    }
}
