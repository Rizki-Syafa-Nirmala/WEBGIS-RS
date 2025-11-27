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


        return new RumahSakit([
            'amenity'   => $row['amenity'],
            'nama_rs'   => $row['nama_rs'],
            'alamat'    => $row['alamat'],
            'latitude'  => $latitude,
            'longitude' => $longitude,
        ]);
    }
}
