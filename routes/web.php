<?php

use App\Http\Controllers\MastersiswaController;
use App\Http\Controllers\MasterguruController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AutentikasiController;
use App\Http\Controllers\HafalanSiswaController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KeterlambatanSiswaController;
use App\Http\Controllers\MasterkriteriaController;
use App\Http\Controllers\MastermapelController;
use App\Http\Controllers\MastertajarController;
use App\Http\Controllers\NilaiKeseluruhanController;
use App\Http\Controllers\NilaiNormalisasiController;
use App\Http\Controllers\NilaiPerangkinganController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PresensiSiswaController;
use App\Http\Controllers\PrestasiSiswaController;
use App\Http\Controllers\RaporController;
use App\Http\Controllers\SikapSiswaController;
use Illuminate\Support\Facades\Route;

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
    return view('login');
});

Route::get('/otentikasi/login',[AutentikasiController::class, 'loginView'])->name('login');
Route::get('/aplikasi/dashboard',[DashboardController::class, 'index'])->name('dashboard');
Route::get('/aplikasi/comingsoon-page',[DashboardController::class, 'pageConstruction'])->name('comingsoon');

Route::get('/aplikasi/master-guru',[MasterguruController::class, 'index'])->name('masterguru');
Route::get('/aplikasi/master-siswa',[MastersiswaController::class, 'index'])->name('mastersiswa');
Route::get('/aplikasi/master-jurusan',[JurusanController::class, 'index'])->name('masterjurusan');
Route::get('/aplikasi/master-mapel',[MastermapelController::class, 'index'])->name('masterpelajaran');
Route::get('/aplikasi/master-tajar',[MastertajarController::class, 'index'])->name('mastertajar');
Route::get('/aplikasi/master-kriteria',[MasterkriteriaController::class, 'index'])->name('masterkriteria');

Route::get('/aplikasi/data-nilai/rapor',[RaporController::class, 'index'])->name('data_nilai.rapor');
Route::get('/aplikasi/data-nilai/presensi', [PresensiSiswaController::class, 'index'])->name('data_nilai.presensi');
Route::get('/aplikasi/data-nilai/sikap', [SikapSiswaController::class, 'index'])->name('data_nilai.sikap');
Route::get('/aplikasi/data-nilai/prestasi', [PrestasiSiswaController::class, 'index'])->name('data_nilai.prestasi');
Route::get('/aplikasi/data-nilai/keterlambatan', [KeterlambatanSiswaController::class, 'index'])->name('data_nilai.keterlambatan');
Route::get('/aplikasi/data-nilai/hafalan', [HafalanSiswaController::class, 'index'])->name('data_nilai.hafalan');

Route::get('/aplikasi/data-penilaian/nilai-keseluruhan', [NilaiKeseluruhanController::class, 'index'])->name('penilaian.nilaikeseluruhan');
Route::get('/aplikasi/data-penilaian/nilai-perangkingan', [NilaiPerangkinganController::class, 'index'])->name('penilaian.nilaiperangkingan');
Route::get('/aplikasi/data-penilaian/nilai-normalisasi', [NilaiNormalisasiController::class, 'index'])->name('penilaian.nilainormalisasi');