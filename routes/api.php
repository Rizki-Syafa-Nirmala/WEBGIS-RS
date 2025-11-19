use App\Http\Controllers\Api\RumahSakitController;

Route::get('/rumah-sakit', [RumahSakitController::class, 'index']);
