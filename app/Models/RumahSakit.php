<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RumahSakit extends Model
{
    protected $fillable = [
    'nama_rs',
    'detail_dokter',
    'fasilitas_unggulan',
    'alamat',
    'amenity',
    'latitude',
    'longitude'
];

}
