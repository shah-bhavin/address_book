<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddresseeController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\DietController;
use App\Http\Controllers\RxController;

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


// Route::get('/', function () {
//     return view('addressee.index');
// });

Route::resource('addressees', AddresseeController::class);
Route::resource('diseases', DiseaseController::class);
Route::resource('diets', DietsController::class);
Route::resource('treatments', TreatmentController::class);
Route::resource('diets', DietController::class);
Route::resource('rxs', RxController::class);


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/home', function () {
    return view('home');
})->name('home');
