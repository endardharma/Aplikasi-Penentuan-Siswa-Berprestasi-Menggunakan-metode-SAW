<?php

namespace App\Http\Controllers;

use App\Exports\NilaiKeseluruhanExport;
use App\Models\HafalanSiswa;
use App\Models\KeterlambatanSiswa;
use App\Models\MasterKriteria;
use App\Models\MasterSiswa;
use App\Models\NilaiKeseluruhan;
use App\Models\PresensiSiswa;
use App\Models\PrestasiSiswa;
use App\Models\RaporSiswa;
use App\Models\SikapSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDO;

class NilaiKeseluruhanController extends Controller
{
    public function index()
    {
        return view('admin.penilaian.nilaikeseluruhan.index');
    }

    // public function listNilaiKeseluruhan(Request $request)
    // {
    //     // Data / function dummy
    //     $columns = [
    //         0 => 'id',
    //         1 => 'nama_siswa',
    //         2 => 'nama_kriteria',
    //         3 => 'nilai',
    //     ];

    //     $start = $request->start;
    //     $limit = $request->length;
    //     $orderColumn = $columns[$request->input('order.0.column')];
    //     $dir = $request->input('order.0.dir');
    //     $search = $request->input('search')['value'];

    //     // Hitung keseluruhan
    //     $hitung = NilaiKeseluruhan::count();

    //     $nilaiKeseluruhan = NilaiKeseluruhan::where(function ($q) use ($search) {
    //         if ($search != null)
    //         {
    //             return $q->where('tajar_id','LIKE','%'.$search.'%')->orWhere('jurusan_id','LIKE','%'.$search.'%')->orWhere('siswa_id','LIKE','%'.$search.'%')->orWhere('kriteria_id', $search);
    //         }
    //     })->orderby($orderColumn, $dir)->skip($start)->take($limit)->get();

    //     $data = array();
    //     foreach ($nilaiKeseluruhan as $n)
    //     {
    //         $item['id'] = $n->siswa->id ?? '';
    //         $item['nama_siswa'] = $n->siswa->name ?? '';
    //         $item['nama_kriteria'] = $n->kriteria->name ?? '';
    //         $item['nilai'] = $n->nilai;
    //         $data[] = $item;
    //     }


    //     return response()->json([
    //         'draw' => $request->draw,
    //         'recordsTotal' => $hitung,
    //         'recordsFiltered' => $hitung,
    //         'data' => $data,
    //     ], 200);
    // }

    // Query Builder + Eloquent ORM
    // public function listNilaiKeseluruhan(Request $request)
    // {
    //     // Data / function dummy
    //     $columns = [
    //         0 => 'id',
    //         1 => 'nama_siswa',
    //         2 => 'nama_kriteria',
    //         3 => 'nilai',
    //     ];

    //     $start = $request->start;
    //     $limit = $request->length;
    //     $orderColumn = $columns[$request->input('order.0.column')];
    //     $dir = $request->input('order.0.dir');
    //     $search = $request->input('search')['value'];

    //     // Hitung keseluruham
    //     $hitung = NilaiKeseluruhan::count();
        
    //     $nilai = NilaiKeseluruhan::where(function ($q) use ($search) {
    //         if ($search != null)
    //         {
    //             return $q->where('tajar_id','LIKE','%'.$search.'%')->orWhere('jurusan_id','LIKE','%'.$search.'%')->orWhere('siswa_id','LIKE','%'.$search.'%')->orWhere('kriteria_id', $search);
    //         }
    //     })->orderby($orderColumn, $dir)->skip($start)->take($limit)->get();

    //     // Hitung keseluruhan
    //     $nilaiKeseluruhan = DB::table('master_siswas as ms')
    //         ->crossJoin('master_kriterias as mk')
    //         ->leftJoin(DB::raw('(SELECT siswa_id, SUM(nilai) AS nilai FROM rapor_siswas GROUP BY siswa_id) AS rs'), function ($join) {
    //             $join->on('ms.id', '=', 'rs.siswa_id')
    //                 ->where('mk.name', '=', 'Nilai Raport');
    //         })
    //         ->leftJoin(DB::raw('(SELECT siswa_id, SUM(nilai) AS nilai FROM presensi_siswas GROUP BY siswa_id) AS ps'), function ($join) {
    //             $join->on('ms.id', '=', 'ps.siswa_id')
    //                 ->where('mk.name', '=', 'Presensi');
    //         })
    //         ->leftJoin(DB::raw('(SELECT siswa_id, SUM(nilai) AS nilai FROM sikap_siswas GROUP BY siswa_id) AS ss'), function ($join) {
    //             $join->on('ms.id', '=', 'ss.siswa_id')
    //                 ->where('mk.name', '=', 'Sikap');
    //         })
    //         ->leftJoin(DB::raw('(SELECT siswa_id, SUM(nilai) AS nilai FROM prestasi_siswas GROUP BY siswa_id) AS pres'), function ($join) {
    //             $join->on('ms.id', '=', 'pres.siswa_id')
    //                 ->where('mk.name', '=', 'Prestasi');
    //         })
    //         ->leftJoin(DB::raw('(SELECT siswa_id, SUM(nilai) AS nilai FROM keterlambatan_siswas GROUP BY siswa_id) AS ks'), function ($join) {
    //             $join->on('ms.id', '=', 'ks.siswa_id')
    //                 ->where('mk.name', '=', 'Keterlambatan Masuk Sekolah');
    //         })
    //         ->leftJoin(DB::raw('(SELECT siswa_id, SUM(nilai) AS nilai FROM hafalan_siswas GROUP BY siswa_id) AS hs'), function ($join) {
    //             $join->on('ms.id', '=', 'hs.siswa_id')
    //                 ->where('mk.name', '=', 'Hafalan Juz Al-Quran');
    //         })
    //         ->select(
    //             'ms.id',
    //             'ms.name AS nama_siswa',
    //             'mk.name AS nama_kriteria',
    //             DB::raw('COALESCE(rs.nilai, 0) + COALESCE(ps.nilai, 0) + COALESCE(ss.nilai, 0) + COALESCE(pres.nilai, 0) + COALESCE(ks.nilai, 0) + COALESCE(hs.nilai, 0) AS nilai_akhir')
    //         )
    //         ->orderBy('ms.id')
    //         ->orderBy('mk.id')
    //         ->skip($start)
    //         ->take($limit)
    //         ->get();

    //     $data = $nilaiKeseluruhan->map(function ($n) {
    //         return [
    //             'id' => $n->id,
    //             'nama_siswa' => $n->nama_siswa,
    //             'nama_kriteria' => $n->nama_kriteria,
    //             'nilai' => $n->nilai_akhir,
    //         ];
    //     });
        

    //     return response()->json([
    //         'draw' => $request->draw,
    //         'recordsTotal' => count($data),
    //         'recordsFiltered' => count($data),
    //         'data' => $data,
    //     ], 200);
    // }

    // Query Builder + Eloquent ORM 2
    // public function listNilaiKeseluruhan(Request $request)
    // {
    //     // Data / function dummy
    //     $columns = [
    //         0 => 'id',
    //         1 => 'nama_siswa',
    //         2 => 'nama_kriteria',
    //         3 => 'nilai',
    //     ];
    
    //     $start = $request->start;
    //     $limit = $request->length;
    //     $orderColumn = $columns[$request->input('order.0.column')];
    //     $dir = $request->input('order.0.dir');
    //     $search = $request->input('search')['value'];
    
    //     // Hitung total keseluruhan data tanpa paginasi dan pencarian
    //     $totalData = DB::table('master_siswas')->count();
    
    //     // Hitung total keseluruhan data sesuai dengan kriteria pencarian
    //     $totalFiltered = DB::table('master_siswas as ms')
    //         ->crossJoin('master_kriterias as mk')
    //         ->leftJoinSub('SELECT siswa_id, SUM(nilai) AS nilai FROM rapor_siswas GROUP BY siswa_id', 'rs', function ($join) {
    //             $join->on('ms.id', '=', 'rs.siswa_id')
    //                  ->where('mk.name', '=', 'Nilai Raport');
    //         })
    //         ->leftJoinSub('SELECT siswa_id, SUM(nilai) AS nilai FROM presensi_siswas GROUP BY siswa_id', 'ps', function ($join) {
    //             $join->on('ms.id', '=', 'ps.siswa_id')
    //                  ->where('mk.name', '=', 'Presensi');
    //         })
    //         ->leftJoinSub('SELECT siswa_id, SUM(nilai) AS nilai FROM sikap_siswas GROUP BY siswa_id', 'ss', function ($join) {
    //             $join->on('ms.id', '=', 'ss.siswa_id')
    //                  ->where('mk.name', '=', 'Sikap');
    //         })
    //         ->leftJoinSub('SELECT siswa_id, SUM(nilai) AS nilai FROM prestasi_siswas GROUP BY siswa_id', 'pres', function ($join) {
    //             $join->on('ms.id', '=', 'pres.siswa_id')
    //                  ->where('mk.name', '=', 'Prestasi');
    //         })
    //         ->leftJoinSub('SELECT siswa_id, SUM(nilai) AS nilai FROM keterlambatan_siswas GROUP BY siswa_id', 'ks', function ($join) {
    //             $join->on('ms.id', '=', 'ks.siswa_id')
    //                  ->where('mk.name', '=', 'Keterlambatan Masuk Sekolah');
    //         })
    //         ->leftJoinSub('SELECT siswa_id, SUM(nilai) AS nilai FROM hafalan_siswas GROUP BY siswa_id', 'hs', function ($join) {
    //             $join->on('ms.id', '=', 'hs.siswa_id')
    //                  ->where('mk.name', '=', 'Hafalan Juz Al-Quran');
    //         })
    //         ->when($search, function ($q) use ($search) {
    //             $q->where('ms.tajar_id', 'LIKE', "%{$search}%")
    //               ->orWhere('ms.jurusan_id', 'LIKE', "%{$search}%")
    //               ->orWhere('ms.siswa_id', 'LIKE', "%{$search}%")
    //               ->orWhere('ms.kriteria_id', 'LIKE', "%{$search}%");
    //         })
    //         ->count();
    
    //     // Data nilai keseluruhan
    //     $nilaiKeseluruhan = DB::table('master_siswas as ms')
    //         ->crossJoin('master_kriterias as mk')
    //         ->leftJoinSub('SELECT siswa_id, SUM(nilai) AS nilai FROM rapor_siswas GROUP BY siswa_id', 'rs', function ($join) {
    //             $join->on('ms.id', '=', 'rs.siswa_id')
    //                  ->where('mk.name', '=', 'Nilai Raport');
    //         })
    //         ->leftJoinSub('SELECT siswa_id, SUM(nilai) AS nilai FROM presensi_siswas GROUP BY siswa_id', 'ps', function ($join) {
    //             $join->on('ms.id', '=', 'ps.siswa_id')
    //                  ->where('mk.name', '=', 'Presensi');
    //         })
    //         ->leftJoinSub('SELECT siswa_id, SUM(nilai) AS nilai FROM sikap_siswas GROUP BY siswa_id', 'ss', function ($join) {
    //             $join->on('ms.id', '=', 'ss.siswa_id')
    //                  ->where('mk.name', '=', 'Sikap');
    //         })
    //         ->leftJoinSub('SELECT siswa_id, SUM(nilai) AS nilai FROM prestasi_siswas GROUP BY siswa_id', 'pres', function ($join) {
    //             $join->on('ms.id', '=', 'pres.siswa_id')
    //                  ->where('mk.name', '=', 'Prestasi');
    //         })
    //         ->leftJoinSub('SELECT siswa_id, SUM(nilai) AS nilai FROM keterlambatan_siswas GROUP BY siswa_id', 'ks', function ($join) {
    //             $join->on('ms.id', '=', 'ks.siswa_id')
    //                  ->where('mk.name', '=', 'Keterlambatan Masuk Sekolah');
    //         })
    //         ->leftJoinSub('SELECT siswa_id, SUM(nilai) AS nilai FROM hafalan_siswas GROUP BY siswa_id', 'hs', function ($join) {
    //             $join->on('ms.id', '=', 'hs.siswa_id')
    //                  ->where('mk.name', '=', 'Hafalan Juz Al-Quran');
    //         })
    //         ->select(
    //             'ms.id',
    //             'ms.name AS nama_siswa',
    //             'mk.name AS nama_kriteria',
    //             DB::raw('COALESCE(rs.nilai, 0) + COALESCE(ps.nilai, 0) + COALESCE(ss.nilai, 0) + COALESCE(pres.nilai, 0) + COALESCE(ks.nilai, 0) + COALESCE(hs.nilai, 0) AS nilai_akhir')
    //         )
    //         ->orderBy('ms.id')
    //         ->orderBy('mk.id')
    //         ->skip($start)
    //         ->take($limit)
    //         ->get();
    
    //     $data = $nilaiKeseluruhan->map(function ($n) {
    //         return [
    //             'id' => $n->id,
    //             'nama_siswa' => $n->nama_siswa,
    //             'nama_kriteria' => $n->nama_kriteria,
    //             'nilai' => $n->nilai_akhir,
    //         ];
    //     });
        
    //     return response()->json([
    //         'draw' => $request->draw,
    //         'recordsTotal' => $totalData,
    //         'recordsFiltered' => $totalFiltered,
    //         'data' => $data,
    //     ], 200);
    // }
    
    // Query Builder + Eloquent ORM 3
    // public function listNilaiKeseluruhan(Request $request)
    // {
    //     // Data / function dummy
    //     $start = $request->start;
    //     $limit = $request->length;
    //     $search = $request->input('search')['value'];
    
    //     // Hitung total keseluruhan data tanpa paginasi dan pencarian
    //     $totalData = MasterSiswa::count();
    
    //     // Hitung total keseluruhan data sesuai dengan kriteria pencarian
    //     $totalFiltered = MasterSiswa::crossJoin('master_kriterias as mk')
    //         ->leftJoinSub(RaporSiswa::selectRaw('siswa_id, SUM(nilai) AS nilai')->groupBy('siswa_id'), 'rs', function ($join) {
    //             $join->on('master_siswas.id', '=', 'rs.siswa_id')
    //                 ->where('mk.name', '=', 'Nilai Raport');
    //         })
    //         ->leftJoinSub(PresensiSiswa::selectRaw('siswa_id, SUM(nilai) AS nilai')->groupBy('siswa_id'), 'ps', function ($join) {
    //             $join->on('master_siswas.id', '=', 'ps.siswa_id')
    //                 ->where('mk.name', '=', 'Presensi');
    //         })
    //         ->leftJoinSub(SikapSiswa::selectRaw('siswa_id, SUM(nilai) AS nilai')->groupBy('siswa_id'), 'ss', function ($join) {
    //             $join->on('master_siswas.id', '=', 'ss.siswa_id')
    //                 ->where('mk.name', '=', 'Sikap');
    //         })
    //         ->leftJoinSub(PrestasiSiswa::selectRaw('siswa_id, SUM(nilai) AS nilai')->groupBy('siswa_id'), 'pres', function ($join) {
    //             $join->on('master_siswas.id', '=', 'pres.siswa_id')
    //                 ->where('mk.name', '=', 'Prestasi');
    //         })
    //         ->leftJoinSub(KeterlambatanSiswa::selectRaw('siswa_id, SUM(nilai) AS nilai')->groupBy('siswa_id'), 'ks', function ($join) {
    //             $join->on('master_siswas.id', '=', 'ks.siswa_id')
    //                 ->where('mk.name', '=', 'Keterlambatan Masuk Sekolah');
    //         })
    //         ->leftJoinSub(HafalanSiswa::selectRaw('siswa_id, SUM(nilai) AS nilai')->groupBy('siswa_id'), 'hs', function ($join) {
    //             $join->on('master_siswas.id', '=', 'hs.siswa_id')
    //                 ->where('mk.name', '=', 'Hafalan Juz Al-Quran');
    //         })
    //         ->when($search, function ($q) use ($search) {
    //             $q->where('tajar_id', 'LIKE', "%{$search}%")
    //                 ->orWhere('jurusan_id', 'LIKE', "%{$search}%")
    //                 ->orWhere('siswa_id', 'LIKE', "%{$search}%")
    //                 ->orWhere('kriteria_id', 'LIKE', "%{$search}%");
    //         })
    //         ->count();
    
    //     // Data nilai keseluruhan
    //     $nilaiKeseluruhan = MasterSiswa::crossJoin('master_kriterias as mk')
    //         ->leftJoinSub(RaporSiswa::selectRaw('siswa_id, SUM(nilai) AS nilai')->groupBy('siswa_id'), 'rs', function ($join) {
    //             $join->on('master_siswas.id', '=', 'rs.siswa_id')
    //                 ->where('mk.name', '=', 'Nilai Raport');
    //         })
    //         ->leftJoinSub(PresensiSiswa::selectRaw('siswa_id, SUM(nilai) AS nilai')->groupBy('siswa_id'), 'ps', function ($join) {
    //             $join->on('master_siswas.id', '=', 'ps.siswa_id')
    //                 ->where('mk.name', '=', 'Presensi');
    //         })
    //         ->leftJoinSub(SikapSiswa::selectRaw('siswa_id, SUM(nilai) AS nilai')->groupBy('siswa_id'), 'ss', function ($join) {
    //             $join->on('master_siswas.id', '=', 'ss.siswa_id')
    //                 ->where('mk.name', '=', 'Sikap');
    //         })
    //         ->leftJoinSub(PrestasiSiswa::selectRaw('siswa_id, SUM(nilai) AS nilai')->groupBy('siswa_id'), 'pres', function ($join) {
    //             $join->on('master_siswas.id', '=', 'pres.siswa_id')
    //                 ->where('mk.name', '=', 'Prestasi');
    //         })
    //         ->leftJoinSub(KeterlambatanSiswa::selectRaw('siswa_id, SUM(nilai) AS nilai')->groupBy('siswa_id'), 'ks', function ($join) {
    //             $join->on('master_siswas.id', '=', 'ks.siswa_id')
    //                 ->where('mk.name', '=', 'Keterlambatan Masuk Sekolah');
    //         })
    //         ->leftJoinSub(HafalanSiswa::selectRaw('siswa_id, SUM(nilai) AS nilai')->groupBy('siswa_id'), 'hs', function ($join) {
    //             $join->on('master_siswas.id', '=', 'hs.siswa_id')
    //                 ->where('mk.name', '=', 'Hafalan Juz Al-Quran');
    //         })
    //         ->select(
    //             'master_siswas.id',
    //             'master_siswas.name AS nama_siswa',
    //             'mk.name AS nama_kriteria',
    //             DB::raw('COALESCE(rs.nilai, 0) + COALESCE(ps.nilai, 0) + COALESCE(ss.nilai, 0) + COALESCE(pres.nilai, 0) + COALESCE(ks.nilai, 0) + COALESCE(hs.nilai, 0) AS nilai_akhir')
    //         )
    //         ->orderBy('master_siswas.id')
    //         ->orderBy('mk.id')
    //         ->skip($start)
    //         ->take($limit)
    //         ->get();
    
    //     $data = $nilaiKeseluruhan->map(function ($n) {
    //         return [
    //             'id' => $n->id,
    //             'nama_siswa' => $n->nama_siswa,
    //             'nama_kriteria' => $n->nama_kriteria,
    //             'nilai' => $n->nilai_akhir,
    //         ];
    //     });
    
    //     return response()->json([
    //         'draw' => $request->draw,
    //         'recordsTotal' => $totalData,
    //         'recordsFiltered' => $totalFiltered,
    //         'data' => $data,
    //     ], 200);
    // }

    // Query Builder + Eloquent ORM 4 di pakai
    // public function listNilaiKeseluruhan(Request $request)
    // {
    //     $start = $request->start;
    //     $limit = $request->length;
    //     $search = $request->input('search')['value'];
    
    //     // Hitung total keseluruhan data tanpa paginasi dan pencarian
    //     $totalData = MasterSiswa::count();
    
    //     // Query untuk mendapatkan nilai akhir
    //     $nilaiKeseluruhanQuery = MasterSiswa::crossJoin('master_kriterias as mk')
    //         ->leftJoinSub(DB::table('rapor_siswas')->selectRaw('siswa_id, SUM(nilai) AS nilai')->groupBy('siswa_id'), 'rs', function ($join) {
    //             $join->on('master_siswas.id', '=', 'rs.siswa_id')->where('mk.name', '=', 'Nilai Raport');
    //         })
    //         ->leftJoinSub(DB::table('presensi_siswas')->selectRaw('siswa_id, SUM(nilai) AS nilai')->groupBy('siswa_id'), 'ps', function ($join) {
    //             $join->on('master_siswas.id', '=', 'ps.siswa_id')->where('mk.name', '=', 'Presensi');
    //         })
    //         ->leftJoinSub(DB::table('sikap_siswas')->selectRaw('siswa_id, SUM(nilai) AS nilai')->groupBy('siswa_id'), 'ss', function ($join) {
    //             $join->on('master_siswas.id', '=', 'ss.siswa_id')->where('mk.name', '=', 'Sikap');
    //         })
    //         ->leftJoinSub(DB::table('prestasi_siswas')->selectRaw('siswa_id, SUM(nilai) AS nilai')->groupBy('siswa_id'), 'pres', function ($join) {
    //             $join->on('master_siswas.id', '=', 'pres.siswa_id')->where('mk.name', '=', 'Prestasi');
    //         })
    //         ->leftJoinSub(DB::table('keterlambatan_siswas')->selectRaw('siswa_id, SUM(nilai) AS nilai')->groupBy('siswa_id'), 'ks', function ($join) {
    //             $join->on('master_siswas.id', '=', 'ks.siswa_id')->where('mk.name', '=', 'Keterlambatan Masuk Sekolah');
    //         })
    //         ->leftJoinSub(DB::table('hafalan_siswas')->selectRaw('siswa_id, SUM(nilai) AS nilai')->groupBy('siswa_id'), 'hs', function ($join) {
    //             $join->on('master_siswas.id', '=', 'hs.siswa_id')->where('mk.name', '=', 'Hafalan Juz Al-Quran');
    //         })
    //         ->select(
    //             'master_siswas.id',
    //             'master_siswas.name AS nama_siswa',
    //             'mk.name AS nama_kriteria', // Menggunakan kolom nama_kriteria dari tabel master_kriterias
    //             DB::raw('COALESCE(rs.nilai, 0) + COALESCE(ps.nilai, 0) + COALESCE(ss.nilai, 0) + COALESCE(pres.nilai, 0) + COALESCE(ks.nilai, 0) + COALESCE(hs.nilai, 0) AS nilai_akhir')
    //         )
    //         ->when($search, function ($q) use ($search) {
    //             $q->where('master_siswas.tajar_id', 'LIKE', "%{$search}%")
    //                 ->orWhere('master_siswas.jurusan_id', 'LIKE', "%{$search}%")
    //                 ->orWhere('master_siswas.siswa_id', 'LIKE', "%{$search}%")
    //                 ->orWhere('master_siswas.kriteria_id', 'LIKE', "%{$search}%");
    //         })
    //         ->orderBy('master_siswas.id')
    //         ->orderBy('mk.id')
    //         ->skip($start)
    //         ->take($limit);
    
    //     // Hitung total keseluruhan data sesuai dengan kriteria pencarian
    //     $totalFiltered = $nilaiKeseluruhanQuery->count();
    
    //     // Dapatkan nilai akhir
    //     $nilaiKeseluruhan = $nilaiKeseluruhanQuery->get();
    
    //     $data = $nilaiKeseluruhan->map(function ($n) {
    //         return [
    //             'id' => $n->id,
    //             'nama_siswa' => $n->nama_siswa,
    //             'nama_kriteria' => $n->nama_kriteria,
    //             'nilai' => $n->nilai_akhir,
    //         ];
    //     });
    
    //     return response()->json([
    //         'draw' => $request->draw,
    //         'recordsTotal' => $totalData,
    //         'recordsFiltered' => $totalFiltered,
    //         'data' => $data,
    //     ], 200);
    // }
    
    // Query Builder 2
    // public function listNilaiKeseluruhan(Request $request)
    // {
    //     // Penentuan kolom untuk sorting
    //     $columns = [
    //         0 => 'id',
    //         1 => 'nama_siswa',
    //         2 => 'nama_kriteria',
    //         3 => 'nilai',
    //     ];

    //     // Mengambil parameter untuk pagination dan sorting
    //     $start = $request->start;
    //     $limit = $request->length;
    //     $orderColumn = $columns[$request->input('order.0.column')];
    //     $dir = $request->input('order.0.dir');
    //     $search = $request->input('search')['value'];

    //     // Query untuk menghitung total data
    //     $totalData = DB::table('master_siswas')->count();

    //     // Query untuk menghitung total data yang terfilter
    //     $queryFiltered = DB::table('master_siswas as ms')
    //         ->crossJoin('master_kriterias as mk')
    //         ->leftJoin(DB::raw('(SELECT siswa_id, SUM(nilai) AS nilai FROM rapor_siswas GROUP BY siswa_id) AS rs'), function ($join) {
    //             $join->on('ms.id', '=', 'rs.siswa_id')
    //                 ->where('mk.name', '=', 'Nilai Raport');
    //         })
    //         ->leftJoin(DB::raw('(SELECT siswa_id, SUM(nilai) AS nilai FROM presensi_siswas GROUP BY siswa_id) AS ps'), function ($join) {
    //             $join->on('ms.id', '=', 'ps.siswa_id')
    //                 ->where('mk.name', '=', 'Presensi');
    //         })
    //         ->leftJoin(DB::raw('(SELECT siswa_id, SUM(nilai) AS nilai FROM sikap_siswas GROUP BY siswa_id) AS ss'), function ($join) {
    //             $join->on('ms.id', '=', 'ss.siswa_id')
    //                 ->where('mk.name', '=', 'Sikap');
    //         })
    //         ->leftJoin(DB::raw('(SELECT siswa_id, SUM(nilai) AS nilai FROM prestasi_siswas GROUP BY siswa_id) AS pres'), function ($join) {
    //             $join->on('ms.id', '=', 'pres.siswa_id')
    //                 ->where('mk.name', '=', 'Prestasi');
    //         })
    //         ->leftJoin(DB::raw('(SELECT siswa_id, SUM(nilai) AS nilai FROM keterlambatan_siswas GROUP BY siswa_id) AS ks'), function ($join) {
    //             $join->on('ms.id', '=', 'ks.siswa_id')
    //                 ->where('mk.name', '=', 'Keterlambatan Masuk Sekolah');
    //         })
    //         ->leftJoin(DB::raw('(SELECT siswa_id, SUM(nilai) AS nilai FROM hafalan_siswas GROUP BY siswa_id) AS hs'), function ($join) {
    //             $join->on('ms.id', '=', 'hs.siswa_id')
    //                 ->where('mk.name', '=', 'Hafalan Juz Al-Quran');
    //         });

    //     if ($search) {
    //         $queryFiltered->where(function ($query) use ($search) {
    //             $query->where('ms.name', 'LIKE', "%{$search}%")
    //                 ->orWhere('mk.name', 'LIKE', "%{$search}%")
    //                 ->orWhere('rs.nilai', 'LIKE', "%{$search}%")
    //                 ->orWhere('ps.nilai', 'LIKE', "%{$search}%")
    //                 ->orWhere('ss.nilai', 'LIKE', "%{$search}%")
    //                 ->orWhere('pres.nilai', 'LIKE', "%{$search}%")
    //                 ->orWhere('ks.nilai', 'LIKE', "%{$search}%")
    //                 ->orWhere('hs.nilai', 'LIKE', "%{$search}%");
    //         });
    //     }

    //     $totalFiltered = $queryFiltered->count();

    //     // Query untuk mengambil data dengan filter, pagination, dan sorting
    //     $nilaiKeseluruhan = $queryFiltered
    //         ->select(
    //             'ms.id',
    //             'ms.name AS nama_siswa',
    //             'mk.name AS nama_kriteria',
    //             DB::raw('COALESCE(rs.nilai, 0) + COALESCE(ps.nilai, 0) + COALESCE(ss.nilai, 0) + COALESCE(pres.nilai, 0) + COALESCE(ks.nilai, 0) + COALESCE(hs.nilai, 0) AS nilai_akhir')
    //         )
    //         ->orderBy('ms.id')
    //     ->orderByRaw("FIELD(mk.name, 'Nilai Raport', 'Presensi', 'Sikap', 'Prestasi', 'Keterlambatan Masuk Sekolah', 'Hafalan Juz Al-Quran')")
    //     ->skip($start)
    //     ->take($limit)
    //     ->get();

    //     // Menyusun data untuk JSON response
    //     $data = $nilaiKeseluruhan->map(function ($n) {
    //         return [
    //             'id' => $n->id,
    //             'nama_siswa' => $n->nama_siswa,
    //             'nama_kriteria' => $n->nama_kriteria,
    //             'nilai' => $n->nilai_akhir,
    //         ];
    //     });

    //     // Mengembalikan JSON response
    //     return response()->json([
    //         'draw' => $request->draw,
    //         'recordsTotal' => $totalData,
    //         'recordsFiltered' => $totalFiltered,
    //         'data' => $data,
    //     ], 200);
    // }
        
    // public function listDetailNilaiKeseluruhan(Request $request)
    // {
    //     // Data / function dummy
    //     $columns = [
    //         0 => 'id',
    //         1 => 'nama_siswa',
    //         2 => 'total_nilai',
    //         3 => 'jurusan',
    //         4 => 'semester',
    //         5 => 'tahun_ajar',
    //     ];
        
    //     $start = $request->start;
    //     $limit = $request->length;
    //     $orderColumn = $columns[$request->input('order.0.column')];
    //     $dir = $request->input('order.0.dir');
    //     $search = $request->input('search')['value'];

    //     // Hitung keseluruham
    //     $hitung = NilaiKeseluruhan::count();
        
    //     $nilaiKeseluruhan = NilaiKeseluruhan::where(function ($q) use ($search) {
    //         if ($search != null)
    //         {
    //             return $q->where('tajar_id','LIKE','%'.$search.'%')->orWhere('jurusan_id','LIKE','%'.$search.'%')->orWhere('siswa_id','LIKE','%'.$search.'%')->orWhere('kriteria_id', $search);
    //         }
    //     })->orderby($orderColumn, $dir)->skip($start)->take($limit)->get();

    //     $data = array();
    //     foreach ($nilaiKeseluruhan as $n)
    //     {
    //         $item['id'] = $n->id;
    //         $item['nama_siswa'] = $n->siswa->name ?? '';
    //         $item['total_nilai'] = $n->total_nilai;
    //         $item['jurusan'] = $n->jurusan->name ?? '';
    //         $item['semester'] = $n->tajar->semester ?? '';
    //         $item['tahun_ajar'] = $n->tajar->tahun ?? '';
    //         $data[] = $item;
    //     }

    //     return response()->json([
    //         'draw' => $request->draw,
    //         'recordsTotal' => $hitung,
    //         'recordsFiltered' => $hitung,
    //         'data' => $data,
    //     ], 200);
    // }

    // public function listNilaiKeseluruhan(Request $request)
    // {
    //     // Penentuan kolom untuk sorting
    //     $columns = [
    //         0 => 'master_siswas.id',
    //         1 => 'master_kriterias.name',
    //         2 => 'nilai',
    //     ];

    //     // mengambil parameter untuk pagination dan sorting
    //     $start = $request->start;
    //     $limit = $request->length;
    //     $orderColumnIndex = $request->input('oder.0.column');
    //     $orderColumn = isset($columns[$orderColumnIndex]) ? $columns[$orderColumnIndex] : 'master_siswas.id';
    //     $dir = $request->input('order.0.dir', 'asc');
    //     $search = $request->input('search')['value'];

    //     // Query untuk menghitung total data
    //     $totalData = MasterSiswa::count();

    //     // Query untuk menghitung total data yang terfilter
    //     $queryFiltered = MasterSiswa::with(['rapor', 'presensi', 'sikap', 'prestasi', 'keterlambatan', 'hafalan', 'kriteria'])
    //         ->when($search, function ($query) use ($search) {
    //             $query->where('nama_siswa','LIKE', "%{$search}%");
    //         });
        
    //     // Mengambil total data yang terfilter
    //     $totalFiltered = $queryFiltered->count();
    // }

    // Eloquent ORM + tabel menyamping (saran konsep mas vincent)
    // public function listNilaiKeseluruhan(Request $request)
    // {
    //     $start = $request->start;
    //     $limit = $request->length;
    //     $search = $request->input('search')['value'];
    
    //     // Hitung total keseluruhan data tanpa paginasi dan pencarian
    //     $totalData = MasterSiswa::count();
    
    //     // Query untuk mendapatkan nilai akhir
    //     $query = MasterSiswa::with(['rapor', 'presensi', 'sikap', 'prestasi', 'keterlambatan', 'hafalan'])
    //         ->when($search, function ($query) use ($search) {
    //             $query->where('name', 'LIKE', "%{$search}%")
    //                 ->orWhereHas('jurusan', function ($q) use ($search) {
    //                     $q->where('name', 'LIKE', "%{$search}%");
    //                 })
    //                 ->orWhereHas('tajar', function ($q) use ($search) {
    //                     $q->where('tahun', 'LIKE', "%{$search}%")
    //                       ->orWhere('semester', 'LIKE', "%{$search}%");
    //                 });
    //         })
    //         ->orderBy('id');
    
    //     // Hitung total keseluruhan data sesuai dengan kriteria pencarian
    //     $totalFiltered = $query->count();
    
    //     // Pagination
    //     $siswaList = $query->skip($start)->take($limit)->get();
    
    //     $data = $siswaList->map(function ($siswa) {
    //         $totalNilai = $siswa->rapor->sum('nilai') +
    //                       $siswa->presensi->sum('nilai') +
    //                       $siswa->sikap->sum('nilai') +
    //                       $siswa->prestasi->sum('nilai') +
    //                       $siswa->keterlambatan->sum('nilai') +
    //                       $siswa->hafalan->sum('nilai');
    
    //         return [
    //             'id' => $siswa->id,
    //             'nama_siswa' => $siswa->name,
    //             'nilai_rapor' => $siswa->rapor->sum('nilai'),
    //             'nilai_presensi' => $siswa->presensi->sum('nilai'),
    //             'nilai_sikap' => $siswa->sikap->sum('nilai'),
    //             'nilai_prestasi' => $siswa->prestasi->sum('nilai'),
    //             'nilai_keterlambatan' => $siswa->keterlambatan->sum('nilai'),
    //             'nilai_hafalan' => $siswa->hafalan->sum('nilai'),
    //             'total_nilai' => $totalNilai,
    //         ];
    //     });
    
    //     return response()->json([
    //         'draw' => $request->draw,
    //         'recordsTotal' => $totalData,
    //         'recordsFiltered' => $totalFiltered,
    //         'data' => $data,
    //     ], 200);
    // }
    
    // Eloquent ORM Di Pakai
    public function listNilaiKeseluruhan(Request $request)
    {
        $start = $request->start;
        $limit = $request->length;
        $search = $request->input('search')['value'];
    
        // Hitung total keseluruhan data tanpa paginasi dan pencarian
        $totalData = MasterSiswa::count();
    
        // Query untuk mendapatkan nilai akhir dengan nama kriteria
        $query = MasterSiswa::with(['rapor', 'presensi', 'sikap', 'prestasi', 'keterlambatan', 'hafalan'])
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhereHas('jurusan', function ($q) use ($search) {
                        $q->where('name', 'LIKE', "%{$search}%");
                    })
                    ->orWhereHas('tajar', function ($q) use ($search) {
                        $q->where('tahun', 'LIKE', "%{$search}%")
                          ->orWhere('semester', 'LIKE', "%{$search}%");
                    });
            })
            ->orderBy('id');
    
        // Hitung total keseluruhan data sesuai dengan kriteria pencarian
        $totalFiltered = $query->count();
    
        // Pagination
        $siswaList = $query->skip($start)->take($limit)->get();
    
        $data = $siswaList->flatMap(function ($siswa) {
            $nilaiKriteria = [];
    
            // Ambil nama kriteria dari tabel master_kriterias
            $kriteria = MasterKriteria::pluck('name', 'id');
    
            foreach ($kriteria as $namaKriteria) {
                // Ambil nilai dari tabel nilai yang sesuai dengan kriteria
                $nilai = 0;
    
                switch ($namaKriteria) {
                    case 'Nilai Raport':
                        $nilai = $siswa->rapor->average('nilai');
                        break;
                    case 'Presensi':
                        $nilai = $siswa->presensi->sum('nilai');
                        break;
                    case 'Sikap':
                        $nilai = $siswa->sikap->sum('nilai');
                        break;
                    case 'Prestasi':
                        $nilai = $siswa->prestasi->sum('nilai');
                        break;
                    case 'Keterlambatan Masuk Sekolah':
                        $nilai = $siswa->keterlambatan->sum('nilai');
                        break;
                    case 'Hafalan Juz Al-Quran':
                        $nilai = $siswa->hafalan->sum('nilai');
                        break;
                    // Tambahkan case lain jika ada kriteria tambahan
                }
    
                $nilaiKriteria[] = [
                    'id' => $siswa->id,
                    'nama_siswa' => $siswa->name,
                    'nama_kriteria' => $namaKriteria,
                    'nilai' => $nilai,
                ];

                // NilaiKeseluruhan::updateOrCreate([
                //     'siswa_id' => $siswa->id,
                //     'nama_kriteria' => $namaKriteria,
                //     // 'kriteria_id' => $siswa->kriteria->id,
                // ], [
                //     'nama_siswa' => $siswa->name,
                //     'nilai' => $nilai,
                // ]);
            }
    
            return $nilaiKriteria;
        });
    
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalFiltered,
            'data' => $data,
        ], 200);
    }
    
    // Query builder + eloquent
    // public function listDetailNilaiKeseluruhan(Request $request)
    // {
    //     $start = $request->start;
    //     $limit = $request->length;
    //     $search = $request->input('search')['value'];

    //     // Hitung total keseluruhan data tanpa paginasi dan pencarian
    //     $totalData = MasterSiswa::count();

    //     // Query mendapatkan nilai akhir
    //     $nilaiKeseluruhanQuery = MasterSiswa::query()
    //         ->leftJoin('master_kelas', 'master_siswas.jurusan_id', '=', 'master_kelas.id')
    //         ->leftJoin('tahun_ajars', 'master_siswas.tajar_id', '=', 'tahun_ajars.id')
    //         ->select(
    //             'master_siswas.id',
    //             'master_siswas.name AS nama_siswa',
    //             'master_kelas.name AS jurusan',
    //             'tahun_ajars.semester AS semester',
    //             'tahun_ajars.tahun AS tahun_ajar',
    //             // DB::raw('
    //             //     SUM(rapor_siswas.nilai) + 
    //             //     SUM(presensi_siswas.nilai) + 
    //             //     SUM(sikap_siswas.nilai) + 
    //             //     SUM(prestasi_siswas.nilai) + 
    //             //     SUM(keterlambatan_siswas.nilai) + 
    //             //     SUM(hafalan_siswas.nilai) AS total_nilai
    //             //     ')
    //         )
    //         ->when($search, function ($q) use ($search) {
    //             $q->where('master_siswas.tajar_id', 'LIKE', "%{$search}%")
    //             ->orWhere('master_siswas.jurusan_id', 'LIKE', "%{$search}%")
    //             ->orWhere('master_siswas.siswa_id', 'LIKE', "%{$search}%")
    //             ->orWhere('master_siswas.kriteria_id', 'LIKE', "%{$search}%");
    //         })
    //         ->orderBy('master_siswas.id')
    //         ->skip($start)
    //         ->take($limit);

    //     // Hitung total keseluruhan data sesuai dengan kriteria pencarian
    //     $totalFiltered = $nilaiKeseluruhanQuery->count();
            
    //     // Dapatkan nilai akhir
    //     $nilaiKeseluruhan = $nilaiKeseluruhanQuery->get();

    //     $data = $nilaiKeseluruhan->map(function ($n) {
    //         return [
    //             'id' => $n->id,
    //             'nama_siswa' => $n->nama_siswa,
    //             'total_nilai' => $n->total_nilai,
    //             'jurusan' => $n->jurusan,
    //             'semester' => $n->semester,
    //             'tahun_ajar' => $n->tahun_ajar,
    //         ];
    //     });

    //     return response()->json([
    //         'draw' => $request->draw,
    //         'recordsTotal' => $totalData,
    //         'recordsFiltered' => $totalFiltered,
    //         'data' => $data,
    //     ], 200);

    //     // dd($data)->toArray();
    // }

    //Eloquent ORM
    // public function listDetailNilaiKeseluruhan(Request $request)
    // {
    //     // Penentuan kolom untuk sorting
    //     $columns = [
    //         0 => 'master_siswas.id',
    //         1 => 'master_siswas.nama_siswa',
    //         2 => 'total_nilai',
    //         3 => 'master_kelas.jurusan',
    //         4 => 'tahun_ajars.semester',
    //         5 => 'tahun_ajars.tahun',
    //     ];
    
    //     // Mengambil parameter untuk pagination dan sorting
    //     $start = $request->start;
    //     $limit = $request->length;
    //     $orderColumnIndex = $request->input('order.0.column');
    //     $orderColumn = isset($columns[$orderColumnIndex]) ? $columns[$orderColumnIndex] : 'master_siswas.id';
    //     $dir = $request->input('order.0.dir', 'asc');
    //     // $search = $request->input('search.value', '');
    //     $search = $request->input('search')['value'];
    
    //     // Query untuk menghitung total data
    //     $totalData = MasterSiswa::count();
    
    //     // Query untuk menghitung total data yang terfilter
    //     $queryFiltered = MasterSiswa::with(['rapor', 'presensi', 'sikap', 'prestasi', 'keterlambatan', 'hafalan', 'jurusan', 'tajar'])
    //         ->when($search, function ($query) use ($search) {
    //             $query->where('nama_siswa', 'LIKE', "%{$search}%");
    //         });
    
    //     // Mengambil total data yang terfilter
    //     $totalFiltered = $queryFiltered->count();
    
    //     // Pagination dan sorting
    //     $siswaList = $queryFiltered
    //         ->orderBy($orderColumn, $dir)
    //         ->skip($start)
    //         ->take($limit)
    //         ->get();
    
    //     // Menyusun data untuk JSON response
    //     $data = $siswaList->map(function ($siswa) {
    //         $totalNilai = $siswa->rapor->sum('nilai') +
    //                       $siswa->presensi->sum('nilai') +
    //                       $siswa->sikap->sum('nilai') +
    //                       $siswa->prestasi->sum('nilai') +
    //                       $siswa->keterlambatan->sum('nilai') +
    //                       $siswa->hafalan->sum('nilai');
    
    //         return [
    //             'id' => $siswa->id,
    //             'nama_siswa' => $siswa->name,
    //             'total_nilai' => $totalNilai,
    //             'jurusan' => $siswa->jurusan->name,
    //             'semester' => $siswa->tajar->semester,
    //             'tahun_ajar' => $siswa->tajar->tahun,
    //         ];

    //     });
    
    //     // Mengembalikan JSON response
    //     return response()->json([
    //         'draw' => $request->draw,
    //         'recordsTotal' => $totalData,
    //         'recordsFiltered' => $totalFiltered,
    //         'data' => $data,
    //     ], 200);
    // }

    // Eloquent ORM 2 Di Pakai
    public function listDetailNilaiKeseluruhan(Request $request)
    {
        $start = $request->start;
        $limit = $request->length;
        $search = $request->input('search')['value'];

        // Hitung total keseluruhan data tanpa paginasi dan pencarian
        $totalData = MasterSiswa::count();

        // Query untuk mendapatkan nilai akhir dengan nama kriteria
        $query = MasterSiswa::with(['rapor', 'presensi', 'sikap', 'prestasi', 'keterlambatan', 'hafalan'])
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhereHas('jurusan', function ($q) use ($search) {
                        $q->where('name', 'LIKE', "%{$search}%");
                    })
                    ->orWhereHas('tajar', function ($q) use ($search) {
                        $q->where('tahun', 'LIKE', "%{$search}%")
                            ->orWhere('semester', 'LIKE', "%{$search}%");
                    });
            })
            ->orderBy('id');

        // Hitung total keseluruhan data sesuai dengan kriteria pencarian
        $totalFiltered = $query->count();

        // Pagination
        $siswaList = $query->skip($start)->take($limit)->get();

        $data = $siswaList->flatMap(function ($siswa) {
            $nilaiKriteria = [];

            // Ambil nama dan id kriteria dari table master_kriterias
            $kriteria = MasterKriteria::pluck('id', 'name');

            foreach ($kriteria as $namaKriteria => $kriteriaId) {
                // Ambil nilai dari tabel nilai yang sesuai dengan kriteria
                $nilai = 0;

                switch ($namaKriteria)
                {
                    case 'Nilai Raport':
                        $nilai = $siswa->rapor->average('nilai');
                        break;
                    case 'Presensi':
                        $nilai = $siswa->presensi->sum('nilai');
                        break;
                    case 'Sikap':
                        $nilai = $siswa->sikap->sum('nilai');
                        break;
                    case 'Prestasi':
                        $nilai = $siswa->prestasi->sum('nilai');
                        break;
                    case 'Keterlambatan Masuk Sekolah':
                        $nilai = $siswa->keterlambatan->sum('nilai');
                        break;
                    case 'Hafalan Juz Al-Quran':
                        $nilai = $siswa->hafalan->sum('nilai');
                        break;
                }

                $nilaiKriteria[] = [
                    'id' => $siswa->id,
                    'nama_siswa' => $siswa->name,
                    'nama_kriteria' => $namaKriteria,
                    'nilai' => $nilai,
                    'jurusan' => $siswa->jurusan->name,
                    'semester' => $siswa->tajar->semester,
                    'tahun_ajar' => $siswa->tajar->tahun,
                ];

                NilaiKeseluruhan::updateOrCreate(
                    [
                        'siswa_id' => $siswa->id,
                        'tajar_id' => $siswa->tajar->id,
                        'jurusan_id' => $siswa->jurusan->id,
                        'kriteria_id' => $kriteriaId,
                    ],
                    [
                        'nilai' => $nilai,
                    ]
                );
            }
            return $nilaiKriteria;
        });

        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalFiltered,
            'data' => $data,
        ], 200);
    }
    
    public function exportData()
    {
        $nilai = NilaiKeseluruhan::all();
        $data = array();

        foreach ($nilai as $n)
        {
            $item['id'] = $n->id;
            $item['nama_siswa'] = $n->siswa->name ?? '';
            $item['nama_kriteria'] = $n->kriteria->name ?? '';
            $item['nilai'] = $n->nilai;
            $item['jurusan'] = $n->jurusan->name ?? '';
            $item['semester'] = $n->tajar->semester ?? '';
            $item['tahun_ajar'] = $n->tajar->tahun ?? '';
            $data[] = $item;
        }

        return Excel::download(new NilaiKeseluruhanExport($data), 'Data-Nilai-Keseluruhan.xlsx');
    }
}
