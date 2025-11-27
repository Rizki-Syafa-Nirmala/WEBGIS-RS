<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RumahSakit extends Model
{
    protected $fillable = [
    'nama_rs',
    'amenity',
    'alamat',
    'latitude',
    'longitude'
];

}
