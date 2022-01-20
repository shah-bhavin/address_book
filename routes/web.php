<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddresseeController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\DietController;
use App\Http\Controllers\MappingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => 'auth'], function(){
    Route::get('view', [MappingController::class, 'view'])->name('view');
    Route::post('showData', [MappingController::class, 'showData'])->name('showData');
    Route::resource('addressees', AddresseeController::class);
    Route::resource('diseases', DiseaseController::class);
    Route::resource('diets', DietController::class);
    Route::resource('treatments', TreatmentController::class);
    Route::resource('mappings', MappingController::class);


    Route::get('export', [MappingController::class, 'export'])->name('export');
    Route::get('importExportView', [MappingController::class, 'importExportView']);
    Route::post('import', [MappingController::class, 'import'])->name('import');

    Route::get('naturopathy', [MappingController::class, 'naturopathy'])->name('naturopathy');

});


// Route::middleware(['auth:sanctum', 'verified'])->get('/naturopathy', function () {
//     return view('naturopathy');
// })->name('naturopathy');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/home', function () {
    return view('home');
})->name('home');
