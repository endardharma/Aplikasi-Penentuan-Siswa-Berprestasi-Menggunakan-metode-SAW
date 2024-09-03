<?php

use App\Exports\PresensiSiswaTemplate;
use App\Http\Controllers\MastersiswaController;
use App\Http\Controllers\MasterguruController;
use App\Http\Controllers\AutentikasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HafalanSiswaController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KeterlambatanSiswaController;
use App\Http\Controllers\KonversiKeterlambatanController;
use App\Http\Controllers\KonversiKetidakhadiranController;
use App\Http\Controllers\KonversiPrestasiController;
use App\Http\Controllers\KonversiSikapController;
use App\Http\Controllers\MasterkriteriaController;
use App\Http\Controllers\MastermapelController;
use App\Http\Controllers\MastertajarController;
use App\Http\Controllers\NilaiKeseluruhanController;
use App\Http\Controllers\NilaiNormalisasiController;
use App\Http\Controllers\NilaiPerangkinganController;
use App\Http\Controllers\PresensiSiswaController;
use App\Http\Controllers\PrestasiSiswaController;
use App\Http\Controllers\RaporController;
use App\Http\Controllers\RaporSiswaController;
use App\Http\Controllers\SikapSiswaController;
use App\Models\KeterlambatanSiswa;
use App\Models\KonversiKetidakhadiran;
use App\Models\KonversiSikap;
use App\Models\MasterGuru;
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
        Route::get("/data-support/siswa", [DashboardController::class, 'jumlahSiswa']);
        Route::get("/data-support/guru", [DashboardController::class, 'jumlahGuru']);
        Route::get("data-support/user", [DashboardController::class, 'jumlahUser']);
        Route::get("/data-support/nilai-mipa", [DashboardController::class, 'nilaiTertinggiMipa']);
        Route::get("/data-support/nilai-iis", [DashboardController::class, 'nilaiTertinggiIis']);
        Route::get("/chart-data/{jurusan_id}", [DashboardController::class, 'getChartData']);
        Route::get("/data-support/jurusan", [DashboardController::class, 'supportJurusan']);
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
        Route::get("/data-support/jurusan", [JurusanController::class, 'supportJurusan']);
    });

    Route::prefix('master-siswa')->group(function() {
        Route::post("/list", [MastersiswaController::class, 'listSiswa']);
        Route::post("/tambah-data", [MastersiswaController::class, 'createUser']);
        Route::get("/data-support/kelas", [MastersiswaController::class, 'listKelas']);
        Route::get("/data-support/tajar", [MastersiswaController::class, 'listTajar']);
        Route::put("/update-data/{id}", [MastersiswaController::class, 'updateData']);
        Route::delete("/hapus-data/{id}", [MastersiswaController::class, 'hapus']);
        Route::get("/export-data/export-xls", [MastersiswaController::class, 'exportData']);
        Route::get("/export-data/download-template", [MastersiswaController::class, 'template']);
        Route::post("/import-data/import-xls", [MastersiswaController::class, 'import']);
    });

    Route::prefix('master-mapel')->group(function () {
        Route::post("/list", [MastermapelController::class, 'listMapel']);
        Route::get("/data-support/jurusan", [MastermapelController::class, 'jurusanSupport']);
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
        Route::post("/list", [MasterkriteriaController::class, 'dataKriteria']);
        Route::post("/tambah-data", [MasterkriteriaController::class, 'tambahKriteria']);
        Route::put("/update-data/{id}", [MasterkriteriaController::class, 'updateData']);
        Route::delete("/hapus-data/{id}", [MasterkriteriaController::class, 'hapusData']);
        Route::get("/data-support/tajar", [MasterkriteriaController::class, 'supportTajar']);
    });

    Route::prefix('data-kriteria')->group(function() {
        Route::prefix('konversi-presensi')->group(function() {
            Route::post("/list", [KonversiKetidakhadiranController::class, 'listKonversiKetidakhadiran']);
            Route::post("/tambah-data", [KonversiKetidakhadiranController::class, 'tambahData']);
            Route::put("/update-data/{id}", [KonversiKetidakhadiranController::class, 'updateData']);
            Route::delete("/hapus-data/{id}", [KonversiKetidakhadiranController::class, 'deleteData']);
        });
        Route::prefix('konversi-sikap')->group(function(){
            Route::post("/list", [KonversiSikapController::class, 'listKonversiSikap']);
            Route::post("/tambah-data", [KonversiSikapController::class, 'tambahData']);
            Route::put("/update-data/{id}", [KonversiSikapController::class, 'updateData']);
            Route::delete("/hapus-data/{id}", [KonversiSikapController::class, 'hapusData']);
        });
        Route::prefix('konversi-prestasi')->group(function(){
            Route::post("/list", [KonversiPrestasiController::class, 'listKonversiPrestasi']);
            Route::post("/tambah-data", [KonversiPrestasiController::class, 'tambahData']);
            Route::put("/update-data/{id}", [KonversiPrestasiController::class, 'updateData']);
            Route::delete("/hapus-data/{id}", [KonversiPrestasiController::class, 'hapusData']);
        });
        Route::prefix('konversi-keterlambatan')->group(function(){
            Route::post("/list", [KonversiKeterlambatanController::class, 'listKonversiKeterlambatan']);
            Route::post("/tambah-data", [KonversiKeterlambatanController::class, 'tambahData']);
            Route::put("/update-data/{id}", [KonversiKeterlambatanController::class, 'updateData']);
            Route::delete("/hapus-data/{id}", [KonversiKeterlambatanController::class, 'hapusData']);
        });
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
            Route::get("/export-data/download-template-mipa", [RaporSiswaController::class, 'templateMipa']);
            Route::get("/export-data/download-template-iis", [RaporSiswaController::class, 'templateIis']);
            Route::post("/tambah-data", [RaporSiswaController::class, 'tambahData']);
            Route::post("/import-data/import-xls", [RaporSiswaController::class, 'importData']);
            Route::put("/update-data/{id}", [RaporSiswaController::class, 'updateData']);
            Route::delete("/hapus-data/{id}", [RaporSiswaController::class, 'deleteData']);
            Route::delete("/hapus-data-detail/{id}", [RaporSiswaController::class, 'deleteDataDetail']);
        });

        Route::prefix('presensi-siswa')->group(function() {
            Route::get("/test", [PresensiSiswaController::class, 'testPresensi']); //Test API untuk template dan detail presensi
            Route::post("/list", [PresensiSiswaController::class, 'listPresensi']);
            Route::post("/list-detail", [PresensiSiswaController::class, 'listDetailPresensi']);
            Route::get("/data-support/tajar", [PresensiSiswaController::class, 'supportTajar']);
            Route::get("/data-support/jurusan", [PresensiSiswaController::class, 'supportJurusan']);
            Route::get("/data-support/konversi-ketidakhadiran", [PresensiSiswaController::class, 'supportKonversiKetidakhadiran']);
            Route::get("/export-data/download-template-mipa", [PresensiSiswaController::class, 'templateMipa']);
            Route::get("/export-data/download-template-iis", [PresensiSiswaController::class, 'templateIis']);
            Route::post("/import-data/import-xls", [PresensiSiswaController::class, 'importData']);
            Route::get("/export-data/export-xls", [PresensiSiswaController::class, 'exportData']);
            Route::get("/data-support/siswa", [PresensiSiswaController::class, 'supportSiswa']);
            Route::post("/tambah-data", [PresensiSiswaController::class, 'tambahData']);
            Route::put("/update-data/{id}", [PresensiSiswaController::class, 'updateData']);
            Route::delete("/hapus-data/{id}", [PresensiSiswaController::class, 'deleteData']);
            Route::post("/get-nilai", [PresensiSiswaController::class, 'getNilai']);
            Route::post("/get-nilai-ket_ketidakhadiran", [PresensiSiswaController::class, 'getNilaiKetKetidakhadiran']);
        });

        Route::prefix('sikap-siswa')->group(function() {
           Route::get("/data-support/tajar", [SikapSiswaController::class, 'supportTajar']);
           Route::get("/data-support/siswa", [SikapSiswaController::class, 'supportSiswa']);
           Route::get("/data-support/jurusan", [SikapSiswaController::class, 'supportJurusan']);
           Route::get("/data-support/konversi-sikap", [SikapSiswaController::class, 'supportKonversiSikap']);
           Route::post("/list", [SikapSiswaController::class, 'listSikap']); 
           Route::post("/list-detail", [SikapSiswaController::class, 'listDetailSikap']); 
           Route::get("/export-data/download-template-mipa", [SikapSiswaController::class, 'templateMipa']);
           Route::get("/export-data/download-template-iis", [SikapSiswaController::class, 'templateIis']);
           Route::post("/import-data/import-xls", [SikapSiswaController::class, 'importData']);
           Route::get("/export-data/export-xls", [SikapSiswaController::class, 'exportData']);
           Route::post("/tambah-data", [SikapSiswaController::class, 'tambahData']);
           Route::put("/update-data/{id}", [SikapSiswaController::class, 'updateData']);
           Route::delete("/hapus-data/{id}", [SikapSiswaController::class, 'deleteData']);
           Route::post("/get-nilai", [SikapSiswaController::class, 'getNilai']);
           
        });

        Route::prefix('prestasi-siswa')->group(function() {
            Route::get("/data-support/tajar", [PrestasiSiswaController::class, 'supportTajar']);
            Route::get("/data-support/siswa", [PrestasiSiswaController::class, 'supportSiswa']);
            Route::get("/data-support/jurusan", [PrestasiSiswaController::class, 'supportJurusan']);
            Route::get("/data-support/konversi-prestasi", [PrestasiSiswaController::class, 'supportKonversiPrestasi']);
            Route::post("list", [PrestasiSiswaController::class, 'listPrestasi']);
            Route::post("list-detail", [PrestasiSiswaController::class, 'listDetailPrestasi']);
            Route::get("/export-data/download-template-mipa", [PrestasiSiswaController::class, 'templateMipa']);
            Route::get("/export-data/download-template-iis", [PrestasiSiswaController::class, 'templateIis']);
            Route::post("/import-data/import-xls", [PrestasiSiswaController::class, 'importData']);
            Route::get("/export-data/export-xls", [PrestasiSiswaController::class, 'exportData']);
            Route::post("tambah-data", [PrestasiSiswaController::class, 'tambahData']);
            Route::put("/update-data/{id}", [PrestasiSiswaController::class, 'updateData']);
            Route::delete("/hapus-data/{id}", [PrestasiSiswaController::class, 'deleteData']);
            Route::post("/get-nilai", [PrestasiSiswaController::class, 'getNilai']);
        });

        Route::prefix('keterlambatan-siswa')->group(function() {
            Route::post("list", [KeterlambatanSiswaController::class, 'listKeterlambatan']);
            Route::post("list-detail", [KeterlambatanSiswaController::class, 'listDetailKeterlambatan']);
            Route::get("/data-support/tajar", [KeterlambatanSiswaController::class, 'supportTajar']);
            Route::get("/data-support/siswa", [KeterlambatanSiswaController::class, 'supportSiswa']);
            Route::get("/data-support/jurusan", [KeterlambatanSiswaController::class, 'supportJurusan']);
            Route::get("/data-support/konversi-keterlambatan", [KeterlambatanSiswaController::class, 'supportKonversiKeterlambatan']);
            Route::get("/export-data/download-template-mipa", [KeterlambatanSiswaController::class, 'templateMipa']);
            Route::get("/export-data/download-template-iis", [KeterlambatanSiswaController::class, 'templateIis']);
            Route::post("/import-data/import-xls", [KeterlambatanSiswaController::class, 'importData']);
            Route::get("/export-data/export-xls", [KeterlambatanSiswaController::class, 'exportData']);
            Route::post("/tambah-data", [KeterlambatanSiswaController::class, 'tambahData']);
            Route::put("/update-data/{id}", [KeterlambatanSiswaController::class, 'updateData']);
            Route::delete("/hapus-data/{id}", [KeterlambatanSiswaController::class, 'deleteData']);
            Route::post("/get-nilai", [KeterlambatanSiswaController::class, 'getNilai']);
        });

        Route::prefix('hafalan-siswa')->group(function() {
            Route::post("list", [HafalanSiswaController::class, 'listHafalan']);
            Route::post("list-detail", [HafalanSiswaController::class, 'listDetailHafalan']);
            Route::get("/data-support/tajar", [HafalanSiswaController::class, 'supportTajar']);
            Route::get("/data-support/siswa", [HafalanSiswaController::class, 'supportSiswa']);
            Route::get("/data-support/jurusan", [HafalanSiswaController::class, 'supportJurusan']);
            Route::get("/export-data/download-template-mipa", [HafalanSiswaController::class, 'templateMipa']);
            Route::get("/export-data/download-template-iis", [HafalanSiswaController::class, 'templateIis']);
            Route::get("/export-data/export-xls", [HafalanSiswaController::class, 'exportData']);
            Route::post("/import-data/import-xls", [HafalanSiswaController::class, 'importData']);
            Route::post("/tambah-data", [HafalanSiswaController::class, 'tambahData']);
            Route::put("/update-data/{id}", [HafalanSiswaController::class, 'updateData']);
            Route::delete("/hapus-data/{id}", [HafalanSiswaController::class, 'deleteData']);
            Route::delete("/hapus-data-detail/{id}", [HafalanSiswaController::class, 'deleteDataDetail']);
        });
    });

    Route::prefix('data-penilaian')->group(function(){
        Route::prefix('nilai-keseluruhan')->group(function(){
            Route::post("list", [NilaiKeseluruhanController::class, 'listNilaiKeseluruhan']);
            Route::post("list-detail", [NilaiKeseluruhanController::class, 'listDetailNilaiKeseluruhan']);
            Route::get("/export-data/export-xls", [NilaiKeseluruhanController::class, 'exportData']);
            Route::get("/data-support/jurusan", [NilaiKeseluruhanController::class, 'supportJurusan']);
            Route::get("/data-support/tajar", [NilaiKeseluruhanController::class, 'supportTajar']);
        });

        Route::prefix('nilai-normalisasi')->group(function() {
            Route::post('list-normalisasi-mipa', [NilaiNormalisasiController::class, 'listNormalisasiMipa']);
            Route::post('list-detail-normalisasi-mipa', [NilaiNormalisasiController::class, 'listDetailNormalisasiMipa']);
            Route::post('list-normalisasi-iis', [NilaiNormalisasiController::class, 'listNormalisasiIis']);
            Route::post('list-detail-normalisasi-iis', [NilaiNormalisasiController::class, 'listDetailNormalisasiIis']);
        });
        
        Route::prefix('nilai-perangkingan')->group(function(){
            Route::post("listMipa", [NilaiPerangkinganController::class, 'listNilaiPerangkinganMipa']);
            Route::post("listIis", [NilaiPerangkinganController::class, 'listNilaiPerangkinganIis']);
            Route::post("list-detail", [NilaiPerangkinganController::class, 'listDetailNilaiPerangkingan']);
            Route::get("/export-data/export-xls-mipa", [NilaiPerangkinganController::class, 'exportDataMipa']);
            Route::get("/export-data/export-xls-mipa/3-best", [NilaiPerangkinganController::class, 'exportDataMipa3Best']);
            Route::get("/export-data/export-xls-iis", [NilaiPerangkinganController::class, 'exportDataIis']);
            Route::get("/export-data/export-xls-iis/3-best", [NilaiPerangkinganController::class, 'exportDataIis3Best']);
            Route::get("/data-support/tajar-mipa", [NilaiPerangkinganController::class, 'supportTajarMipa']);
            Route::get("/data-support/tajar-iis", [NilaiPerangkinganController::class, 'supportTajarIis']);
        });
        
    });
});
