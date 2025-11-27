<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RumahSakitController;
use App\Http\Controllers\DataRSImportController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('peta');
});

// Halaman form untuk mengunggah file
Route::get('/import', function () {
    return view('importexcel');
});


Route::post('/import-data-rs', [DataRSImportController::class, 'import']);

