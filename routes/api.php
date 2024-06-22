<?php

use App\Exports\PresensiSiswaTemplate;
use App\Http\Controllers\MastersiswaController;
use App\Http\Controllers\MasterguruController;
use App\Http\Controllers\AutentikasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HafalanSiswaController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KeterlambatanSiswaController;
use App\Http\Controllers\MasterkriteriaController;
use App\Http\Controllers\MastermapelController;
use App\Http\Controllers\MastertajarController;
use App\Http\Controllers\NilaiKeseluruhanController;
use App\Http\Controllers\NilaiPerangkinganController;
use App\Http\Controllers\PresensiSiswaController;
use App\Http\Controllers\PrestasiSiswaController;
use App\Http\Controllers\RaporController;
use App\Http\Controllers\RaporSiswaController;
use App\Http\Controllers\SikapSiswaController;
use App\Models\KeterlambatanSiswa;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('autentikasi')->group(function () {
    Route::post("masuk", [AutentikasiController::class, 'loginCheck']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get("/home", [DashboardController::class, 'getProfile']);
    });

    Route::prefix('master-guru')->group(function () {
        Route::post("/list", [MasterguruController::class, 'listGuru']);
        Route::post("/tambah-data", [MasterguruController::class, 'addMaster']);
        Route::get("/data-support/role", [MasterguruController::class, 'supportRole']);
        Route::put("/update-data/{id}", [MasterguruController::class, 'updateGuru']);
        Route::delete("/hapus-data/{id}", [MasterguruController::class, 'hapus']);
        Route::get("/export-data", [MasterguruController::class, 'exportData']);
        Route::get("/download-template", [MasterguruController::class, 'template']);
        Route::post("/import-data", [MasterguruController::class, 'import']);
    });

    Route::prefix('master-jurusan')->group(function () {
        Route::get("/list", [JurusanController::class, 'listJurusan']);
        Route::post("/tambah-data", [JurusanController::class, 'addJurusan']);
        Route::put("/update-data/{id}", [JurusanController::class, 'update']);
        Route::delete("/hapus-data/{id}", [JurusanController::class, 'hapus']);
    });

    Route::prefix('master-siswa')->group(function() {
        Route::post("/list", [MastersiswaController::class, 'listSiswa']);
        Route::post("/tambah-data", [MastersiswaController::class, 'createUser']);
        Route::get("/data-support/jurusan", [MastersiswaController::class, 'listJurusan']);
        Route::get("/data-support/tajar", [MastersiswaController::class, 'listTajar']);
        Route::put("/update-data/{id}", [MastersiswaController::class, 'updateData']);
        Route::delete("/hapus-data/{id}", [MastersiswaController::class, 'hapus']);
        Route::get("/export-data/export-xls", [MastersiswaController::class, 'exportData']);
        Route::get("/export-data/download-template", [MastersiswaController::class, 'template']);
        Route::post("/import-data/import-xls", [MastersiswaController::class, 'import']);
    });

    Route::prefix('master-mapel')->group(function () {
        Route::post("/list", [MastermapelController::class, 'listMapel']);
        Route::get("/data-support/kelas", [MastermapelController::class, 'kelasSupport']);
        Route::post("/tambah-data", [MastermapelController::class, 'addMapel']);
        Route::put("/update-data/{id}", [MastermapelController::class, 'updateData']);
        Route::delete("/hapus-data/{id}", [MastermapelController::class, 'deleteData']);
        Route::get("/export-data/export-xls", [MastermapelController::class, 'exportData']);
        Route::get("/export-data/download-template", [MastermapelController::class, 'template']);
        Route::post("/import-data/import-xls", [MastermapelController::class, 'import']);
    });

    Route::prefix('master-tahun-ajar')->group(function () {
        Route::get("/list", [MastertajarController::class, 'listTajar']);
        Route::post("/tambah-data", [MastertajarController::class, 'tambahData']);
        Route::put("/update-data/{id}", [MastertajarController::class, 'updateData']);
        Route::delete("/hapus-data/{id}", [MastertajarController::class, 'hapus']);
    });

    Route::prefix('master-kriteria')->group(function() {
        Route::get("/list", [MasterkriteriaController::class, 'dataKriteria']);
        Route::post("/tambah-data", [MasterkriteriaController::class, 'tambahKriteria']);
        Route::put("/update-data/{id}", [MasterkriteriaController::class, 'updateData']);
        Route::delete("/hapus-data/{id}", [MasterkriteriaController::class, 'hapusData']);
    });

    Route::prefix('penilaian')->group(function() {
        
    });

    Route::prefix('data-nilai')->group(function () {
        Route::prefix('rapor-siswa')->group(function () {
            Route::get("/test", [RaporSiswaController::class, 'testRapor']); // Test Api untuk template dan detail rapor
            Route::post("/list", [RaporSiswaController::class, 'listRapor']);
            Route::post("/list-detail", [RaporSiswaController::class, 'listRaporDetail']);
            Route::get("/data-support/tajar", [RaporSiswaController::class, 'supportTajar']);
            Route::get("/data-support/mapel", [RaporSiswaController::class, 'supportMapel']);
            Route::get("/data-support/jurusan", [RaporSiswaController::class, 'supportJurusan']);
            Route::get("/data-support/siswa", [RaporSiswaController::class, 'supportSiswa']);
            Route::get("/export-data/export-xls", [RaporSiswaController::class, 'exportData']);
            Route::get("/export-data/download-template", [RaporSiswaController::class, 'template']);
            Route::post("/import-data/import-xls", [RaporSiswaController::class, 'importData']);
            Route::put("/update-data/{id}", [RaporSiswaController::class, 'updateData']);
            Route::delete("/hapus-data/{id}", [RaporSiswaController::class, 'deleteData']);
        });

        Route::prefix('presensi-siswa')->group(function() {
            Route::get("/test", [PresensiSiswaController::class, 'testPresensi']); //Test API untuk template dan detail presensi
            Route::post("/list", [PresensiSiswaController::class, 'listPresensi']);
            Route::post("/list-detail", [PresensiSiswaController::class, 'listDetailPresensi']);
            Route::get("/data-support/tajar", [PresensiSiswaController::class, 'supportTajar']);
            Route::get("/export-data/download-template", [PresensiSiswaController::class, 'template']);
            Route::post("/import-data/import-xls", [PresensiSiswaController::class, 'importData']);
            Route::get("/export-data/export-xls", [PresensiSiswaController::class, 'exportData']);
            Route::get("/data-support/siswa", [PresensiSiswaController::class, 'supportSiswa']);
            Route::put("/update-data/{id}", [PresensiSiswaController::class, 'updateData']);
            Route::delete("/hapus-data/{id}", [PresensiSiswaController::class, 'deleteData']);
            Route::post("/get-nilai", [PresensiSiswaController::class, 'getNilai']);
        });

        Route::prefix('sikap-siswa')->group(function() {
           Route::get("/data-support/tajar", [SikapSiswaController::class, 'supportTajar']);
           Route::post("/list", [SikapSiswaController::class, 'listSikap']); 
           Route::post("/list-detail", [SikapSiswaController::class, 'listDetailSikap']); 
           Route::get("/export-data/download-template", [SikapSiswaController::class, 'template']);
           Route::post("/import-data/import-xls", [SikapSiswaController::class, 'importData']);
           Route::get("/export-data/export-xls", [SikapSiswaController::class, 'exportData']);
           Route::get("/data-support/siswa", [SikapSiswaController::class, 'supportSiswa']);
           Route::put("/update-data/{id}", [SikapSiswaController::class, 'updateData']);
           Route::delete("/hapus-data/{id}", [SikapSiswaController::class, 'deleteData']);
           Route::post("/get-nilai", [SikapSiswaController::class, 'getNilai']);
           
        });

        Route::prefix('prestasi-siswa')->group(function() {
            Route::get("/data-support/tajar", [PrestasiSiswaController::class, 'supportTajar']);
            Route::get("/data-support/siswa", [PrestasiSiswaController::class, 'supportSiswa']);
            Route::post("list", [PrestasiSiswaController::class, 'listPrestasi']);
            Route::post("list-detail", [PrestasiSiswaController::class, 'listDetailPrestasi']);
            Route::get("/export-data/download-template", [PrestasiSiswaController::class, 'template']);
            Route::post("/import-data/import-xls", [PrestasiSiswaController::class, 'importData']);
            Route::get("/export-data/export-xls", [PrestasiSiswaController::class, 'exportData']);
            Route::put("/update-data/{id}", [PrestasiSiswaController::class, 'updateData']);
            Route::delete("/hapus-data/{id}", [PrestasiSiswaController::class, 'deleteData']);
            Route::post("/get-nilai", [PrestasiSiswaController::class, 'getNilai']);
        });


        Route::prefix('keterlambatan-siswa')->group(function() {
            Route::post("list", [KeterlambatanSiswaController::class, 'listKeterlambatan']);
            Route::post("list-detail", [KeterlambatanSiswaController::class, 'listDetailKeterlambatan']);
            Route::get("/data-support/tajar", [KeterlambatanSiswaController::class, 'supportTajar']);
            Route::get("/data-support/siswa", [KeterlambatanSiswaController::class, 'supportSiswa']);
            Route::get("/export-data/download-template", [KeterlambatanSiswaController::class, 'template']);
            Route::post("/import-data/import-xls", [KeterlambatanSiswaController::class, 'importData']);
            Route::get("/export-data/export-xls", [KeterlambatanSiswaController::class, 'exportData']);
            Route::put("/update-data/{id}", [KeterlambatanSiswaController::class, 'updateData']);
            Route::delete("/hapus-data/{id}", [KeterlambatanSiswaController::class, 'deleteData']);
            Route::post("/get-nilai", [KeterlambatanSiswaController::class, 'getNilai']);
        });

        Route::prefix('hafalan-siswa')->group(function() {
            Route::post("list", [HafalanSiswaController::class, 'listHafalan']);
            Route::post("list-detail", [HafalanSiswaController::class, 'listDetailHafalan']);
            Route::get("/data-support/tajar", [HafalanSiswaController::class, 'supportTajar']);
            Route::get("/data-support/siswa", [HafalanSiswaController::class, 'supportSiswa']);
            Route::get("/export-data/download-template", [HafalanSiswaController::class, 'template']);
            Route::get("/export-data/export-xls", [HafalanSiswaController::class, 'exportData']);
            Route::post("/import-data/import-xls", [HafalanSiswaController::class, 'importData']);
            Route::put("/update-data/{id}", [HafalanSiswaController::class, 'updateData']);
            Route::delete("/hapus-data/{id}", [HafalanSiswaController::class, 'deleteData']);
        });
    });

    Route::prefix('data-penilaian')->group(function(){
        Route::prefix('nilai-keseluruhan')->group(function(){
            Route::post("list", [NilaiKeseluruhanController::class, 'listNilaiKeseluruhan']);
            Route::post("list-detail", [NilaiKeseluruhanController::class, 'listDetailNilaiKeseluruhan']);
            Route::get("/export-data/export-xls", [NilaiKeseluruhanController::class, 'exportData']);
        });

        Route::prefix('nilai-perangkingan')->group(function(){
            Route::post("list", [NilaiPerangkinganController::class, 'listNilaiPerangkingan']);
            Route::post("list-detail", [NilaiPerangkinganController::class, 'listDetailNilaiPerangkingan']);
            Route::get("/export-data/export-xls", [NilaiPerangkinganController::class, 'exportData']);
        });
    });
});
