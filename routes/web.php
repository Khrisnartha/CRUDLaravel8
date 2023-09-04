<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan');

Route::get('/tambahkaryawan', [KaryawanController::class, 'tambahkaryawan'])->name('tambahkaryawan');
Route::post('/insertdata', [KaryawanController::class, 'insertdata'])->name('insertdata');

Route::get('/tampilkandata/{id}', [KaryawanController::class, 'tampilkandata'])->name('tampilkandata');
Route::post('/updatedata/{id}', [KaryawanController::class, 'updatedata'])->name('updatedata');


Route::get('/delete/{id}', [KaryawanController::class, 'delete'])->name('delete');


//export PDF
Route::get('/exportpdf', [KaryawanController::class, 'exportpdf'])->name('exportpdf');

//export Excel
Route::get('/exportexcel', [KaryawanController::class, 'exportexcel'])->name('exportexcel');


Route::post('/importexcel', [KaryawanController::class, 'importexcel'])->name('importexcel');