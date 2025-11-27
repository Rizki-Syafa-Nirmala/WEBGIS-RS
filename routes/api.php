<?php
use App\Http\Controllers\RumahSakitController;

Route::get('/rumah-sakit', [RumahSakitController::class, 'index']);
