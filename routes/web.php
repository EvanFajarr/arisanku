<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\PesertaController;
use App\Http\Controllers\backend\TabunganController;
use App\Http\Controllers\backend\KasController;
use App\Http\Controllers\backend\ArisanController;
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



// Route::post('/peserta/store', [PesertaController::class, 'store'])->name('peserta.store');
// Route::get('/peserta', [PesertaController::class, 'index'])->name('peserta.index');
// Route::delete('/peserta/{id}', [PesertaController::class, 'destroy'])->name('peserta.destroy');
// Route::put('/peserta/update/{id}', [PesertaController::class, 'update'])->name('peserta.update');


Route::resource('peserta', PesertaController::class);
Route::resource('tabungan', TabunganController::class);
Route::resource('kas', KasController::class);
//Route::delete('/tabungan/{id}/tarik-saldo', 'TabunganController@tarikSaldo')->name('tarik-saldo');

Route::delete('/tabungan/tarik-saldo/{id}', [TabunganController::class, 'tarikSaldo'])->name('tarik-saldo');


//Route::get('/tabungan/{id}/cetak-pdf', 'TabunganController@generatePDF')->name('tabungan.cetak-pdf');

 Route::get('/tabungan/cetak-pdf/{id}', [TabunganController::class, 'generatePDF'])->name('tabungan.cetak-pdf');

 Route::post('/kas/proses-pembayaran/{pesertaId}', [KasController::class, 'store'])->name('kas.proses-pembayaran');
 Route::post('/kas/export', [KasController::class, 'export'])->name('kas.export');
 Route::resource('arisan', ArisanController::class);


 Route::delete('/arisan/delete-peserta/{id}', [ArisanController::class, 'deletePeserta'])->name('arisan.deletePeserta');
 Route::post('/arisan/kocok/{arisanId}', [ArisanController::class, 'kocok'])->name('arisan.kocok');
