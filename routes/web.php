<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

Route::get('/admin', [AdminController::class, 'index'])->name('admin');

Route::get('/tambahDataAdmin', [AdminController::class, 'tambahDataAdmin'])->name('tambahDataAdmin');

Route::post('/insertDataAdmin', [AdminController::class, 'insertDataAdmin'])->name('insertDataAdmin');

Route::get('/tampilkanData/{id}', [AdminController::class, 'tampilkanData'])->name('tampilkanData');
Route::post('/updateData/{id}', [AdminController::class, 'updateData'])->name('updateData');

Route::get('/delete/{id}', [AdminController::class, 'delete'])->name('delete');

// Export PDF
Route::get('/exportpdf', [AdminController::class, 'exportpdf'])->name('exportpdf');

// Export Excel
Route::get('/exportexcel', [AdminController::class, 'exportexcel'])->name('exportexcel');

Route::post('/importexcel', [AdminController::class, 'importexcel'])->name('importexcel');