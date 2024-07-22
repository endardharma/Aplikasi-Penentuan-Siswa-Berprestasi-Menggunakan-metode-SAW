<?php

namespace App\Http\Controllers;

use App\Exports\PresensiSiswaExport;
use App\Exports\PresensiSiswaTemplate;
use App\Exports\PresensiSiswaTemplateIis;
use App\Imports\PresensiSiswaImport;
use App\Models\MasterJurusan;
use App\Models\MasterJurusanSiswa;
use App\Models\MasterSiswa;
use App\Models\PresensiSiswa;
use App\Models\TahunAjar;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PresensiSiswaController extends Controller
{
    public function testPresensi()
    {
        // Fungsi template export dan detail presensi siswa
        $siswa = MasterSiswa::all();
        $data = array();
        foreach($siswa as $s)
        {
            $find = TahunAjar::where('tahun', date('Y'))->first();
            if($find)
            {                
                $item['nama_siswa'] = $s->name;
                $item['ket_ketidakhadiran'] = 'Tidak Ada';
                $item['nilai'] = $s->nilai;
                $item['jurusan'] = $s->jurusan->name ?? '';
                $item['semester'] = $s->semester;
                $item['tahun_ajar'] = $s->tahun_ajar;
                $data[] = $item;
            }
        }

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function index()
    {
        return view('admin.data_nilai.presensi.index');
    }

    // public function listPresensi(Request $request)
    // {
    //     // Data / Function Dummy
    //     $columns = [
    //         0 => 'id',
    //         1 => 'nama_siswa',
    //         2 => 'ket_ketidakhadiran',
    //         3 => 'jumlah_hari',
    //         4 => 'nilai',
    //     ];

    //     $start = $request->start;
    //     $limit = $request->length;
    //     $orderColumn = $columns[$request->input('order.0.column')];
    //     $dir = $request->input('order.0.dir');
    //     $search = $request->input('search')['value'];

    //     // Hitung Keseluruhan
    //     $hitung = MasterSiswa::count();

    //     $siswa = MasterSiswa::where(function ($q) use ($search) {
    //         if($search != null)
    //         {
    //             return $q->where('name','LIKE','%'.$search.'%');
    //         }
    //     })->orderby($orderColumn, $dir)->skip($start)->take($limit)->get();
    //     $presensi = PresensiSiswa::all();
    //     $data = array();
    //     // dd($presensi)->toArray();
    //     foreach($siswa as $s)
    //     {
    //         $item['id'] = $s->id;
    //         $item['nama_siswa'] = $s->name;
    //         foreach($presensi as $p)
    //         {
    //             $item['ket_ketidakhadiran'] = $p->ket_ketidakhadiran;
    //             $item['jumlah_hari'] = $p->jumlah_hari;
    //             $item['nilai'] = $p->nilai;
    //         }
    //         $data[] = $item;
    //     }
        
    //     return response()->json([
    //         'draw' => $request->draw,
    //         'recordsTotal' => $hitung,
    //         'recordsFiltered' => $hitung,
    //         'data' => $data,
    //     ], 200);
    // }

    // public function listDetailPresensi (Request $request)
    // {
    //     // Data / Function Dummy
    //     $columns = [
    //         0 => 'id',
    //         1 => 'nama_siswa',
    //         2 => 'ket_ketidakhadiran',
    //         3 => 'jumlah_hari',
    //         4 => 'nilai',
    //         5 => 'jurusan',
    //         6 => 'semester',
    //         7 => 'tahun_ajar',
    //     ];

    //     $start = $request->start;
    //     $limit = $request->length;
    //     $orderColumn = $columns[$request->input('order.0.column')];
    //     $dir = $request->input('order.0.dir');
    //     $search = $request->input('search')['value'];

    //     // Hitung Keseluruhan
    //     $hitung = MasterSiswa::count();
        
    //     $siswa = MasterSiswa::where(function($q) use ($search) {
    //         if($search != null)
    //         {
    //             return $q-> where('name', 'LIKE', '%'.$search.'%');
    //         }
    //     })->orderby($orderColumn, $dir)->skip($start)->take($limit)->get();

    //     $tajar = TahunAjar::all();
    //     $presensi = PresensiSiswa::all();
    //     $data = array();
    //     foreach($siswa as $s)
    //     {
            
    //         foreach($presensi as $p)
    //         {
    //             foreach($tajar as $t)
    //             {
    //                 $item['id'] = $s->id;
    //                 $item['nama_siswa'] = $s->name;
    //                 $item['ket_ketidakhadiran'] = $p->ket_ketidakhadiran;
    //                 $item['jumlah_hari'] = $p->jumlah_hari;
    //                 $item['nilai'] = $p->nilai;
    //                 $item['jurusan'] = $s->jurusan->name;
    //                 $item['semester'] = $t->semester;
    //                 $item['tahun_ajar'] = $t->tahun;
    //             }
    //         }
    //         $data[] = $item;
    //     }

    //     return response()->json([
    //         'draw' => $request->draw,
    //         'recordsTotal' => $hitung,
    //         'recordsFiltered' => $hitung,
    //         'data' => $data,
    //     ], 200);
    // }

    public function listPresensi(Request $request)
    {
        // Data / function dummy
        $columns = [
            0 => 'id',
            1 => 'tajar_id',
            2 => 'siswa_id',
            3 => 'jurusan_id',
            4 => 'ket_ketidakhadiran',
            5 => 'jumlah_hari',
            6 => 'jumlah_hari_lainnya',
            7 => 'nilai',
        ];

        $start = $request->start;
        $limit = $request->length;
        $orderColumnIndex = $request->input('order.0.column');
        $orderColumn = isset($columns[$orderColumnIndex]) ? $columns [$orderColumnIndex] : 'id';
        $dir = $request->input('order.0.dir');
        $search = $request->input('search')['value'];
        $jurusanId = $request->input('jurusan_id');

        // Hitung total keseluruhan data tnapa paginasi dan pencarian
        $totalData = PresensiSiswa::count();
        
        // Query mendapatkan data presensi siswa berdasarkan pencarian dan paginasi
        $query = PresensiSiswa::with(['siswa','tajar','jurusan'])
            ->when($jurusanId && $jurusanId != '-1', function ($q) use ($jurusanId) {
                $q->whereHas('jurusan', function ($query) use ($jurusanId){
                    $query->where('jurusan_id', $jurusanId);
                });
            })
            ->when(empty($jurusanid) || $jurusanId == '-1', function ($q) {
            })    
            ->when($search, function ($query) use ($search) {
                $query->whereHas('siswa', function ($q) use ($search) {
                    $q->where('name','LIKE','%'.$search.'%');
                })
                ->orWhereHas('tajar', function ($q) use ($search) {
                    $q->where('periode','LIKE','%'.$search.'%')
                    ->orWhere('semester','LIKE','%'.$search.'%');
                })
                ->orWhereHas('jurusan', function ($q) use ($search) {
                    $q->where('name','LIKE','%'.$search.'%');
                })
                ->orWhere('ket_ketidakhadiran','LIKE','%'.$search.'%')
                ->orWhere('jumlah_hari','LIKE','%'.$search.'%')
                ->orWhere('jumlah_hari_lainnya','LIKE','%'.$search.'%')
                ->orWhere('nilai','LIKE','%'.$search.'%');
            });
        
        // Hitung total filtered sesuai dengan pencarian
        $totalFiltered = $query->count();

        // Ambil data presensi sesuai dengan paginasi dan urutan
        $presensi = $query
            ->orderBy($orderColumn, $dir)
            ->skip($start)
            ->take($limit)
            ->get();
        
        $data = array();
        // dd($presensi)->toArray();
        foreach($presensi as $p)
        {
            $item['id'] = $p->id;

            $item['id_siswa_nama'] = $p->siswa_id;
            $item['nama_siswa'] = $p->siswa->name ?? '';
            
            $item['ket_ketidakhadiran'] = $p->ket_ketidakhadiran;
            $item['jumlah_hari'] = $p->jumlah_hari;
            $item['jumlah_hari_lainnya'] = $p->jumlah_hari_lainnya;
            $item['nilai'] = $p->nilai;

            $item['id_jurusan_nama'] = $p->jurusan_id;
            $item['jurusan'] = $p->jurusan->name ?? '';

            $item['id_tajar_semester'] = $p->tajar_id;
            $item['semester'] = $p->tajar->semester ?? '';

            $item['id_tajar_periode'] = $p->tajar_id;
            $item['tahun_ajar'] = $p->tajar->periode ?? '';

            $data[] = $item;
            
        }
        // dd($data)->toArray();


        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalFiltered,
            'data' => $data,
        ], 200);
    }
    
    public function listDetailPresensi(Request $request)
    {
        // Data / function Dummy
        $columns = [
            0 => 'id',
            1 => 'nama_siswa',
            2 => 'ket_ketidakhadiran',
            3 => 'jumlah_hari',
            4 => 'jumlah_hari_lainnya',
            5 => 'nilai',
            6 => 'jurusan',
            7 => 'semester',
            8 => 'tahun_ajar',
        ];

        $start = $request->start;
        $limit = $request->length;
        $orderColumn = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search')['value'];

        // hitung keseluruhan
        $hitung = PresensiSiswa::count();

        $presensi = PresensiSiswa::where(function ($q) use ($search) {
            if($search != null)
            {
                return $q->where('tajar_id','LIKE','%'.$search.'%')->orWhere('siswa_id','LIKE','%'.$search.'%')->orWhere('jurusan_id','LIKE','%'.$search.'%')->orWhere('ket_ketidakhadiran','LIKE','%'.$search.'%')->orWhere('nilai',$search);
            }
        })->orderby($orderColumn,$dir)->skip($start)->take($limit)->get();
        $data = array();

        foreach($presensi as $p)
        {
            $item['id'] = $p->id;

            $item['id_siswa_nama'] = $p->siswa_id;
            $item['nama_siswa'] = $p->siswa->name ?? '';
            
            // $item['ket_ketidakhadiran'] = $p->ket_ketidakhadiran;
            // $item['jumlah_hari'] = $p->jumlah_hari;
            // $item['jumlah_hari_lainnya'] = $p->jumlah_hari_lainnya;
            // $item['nilai'] = $p->nilai;
            $item['jurusan'] = $p->jurusan->name ?? '';
            $item['semester'] = $p->tajar->semester ?? '';
            $item['tahun_ajar'] = $p->tajar->periode ?? '';
            $data[] = $item;
        }
        
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $hitung,
            'recordsFiltered' => $hitung,
            'data' => $data,
        ], 200);
        
    }

    public function supportTajar()
    {
        $tajar = TahunAjar::all();
        $data = array();
        foreach($tajar as $t)
        {
            $item['id'] = $t->id;
            $item['name'] = $t->name;
            $item['semester'] = $t->semester;
            $item['periode'] = $t->periode;
            $data[] = $item;
        }

        return response()->json([
            'data' => $data,
        ],200);
    }

    public function supportSiswa()
    {
        $siswa = MasterSiswa::all();
        $data = array();

        foreach($siswa as $s)
        {
            $item['id'] = $s->id;
            $item['name'] = $s->name;
            $data[] = $item;
        }

        return response()->json([
            'data' => $data,
        ], 201);
    }

    public function supportJurusan()
    {
        $jurusan = MasterJurusanSiswa::all();
        $data = array();

        foreach ($jurusan as $j)
        {
            $item['id'] = $j->id;
            $item['name'] = $j->name;
            $data[] = $item;
        }

        return response()->json([
            'data' => $data,
        ], 201);
    }

    public function templateMipa(Request $request)
    {
        return Excel::download(new PresensiSiswaTemplate($request->tajar), 'Template-Presensi-Siswa-Mipa.xlsx');
    }

    public function templateIis(Request $request)
    {
        return Excel::download(new PresensiSiswaTemplateIis($request->tajar), 'Template-presensi-Siswa-Iis.xlsx');
    }

    public function importData(Request $request)
    {
        // Lakukan Validasi data import
        $request->validate([
            'excel' => 'required|mimes:xls,xlsx',
        ]);

        // Proses data import
        $file = $request->file('excel');
        $selectedTahunAjar = $request->input('selected_tahun_ajar');
        $selectedJurusan = $request->input('selected_jurusan');

        Excel::import(new PresensiSiswaImport($selectedTahunAjar, $selectedJurusan), $file);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil melakukan import data presensi siswa'
        ], 201);
    }

    public function updateData(Request $request, $id)
    {
        $find = PresensiSiswa::where('id',$id)->first();

        if(!$find)
        {
            return response()->json([
                'success' => false,
                'message' => 'Update data gagal!, data tidak ditemukan',
            ], 400);
        }
        else
        {
            $request->siswa_id != null ? $find->siswa_id = $request->siswa_id : true;
            $request->ket_ketidakhadiran != null ? $find->ket_ketidakhadiran = $request->ket_ketidakhadiran : true;
            $request->jumlah_hari != null ? $find->jumlah_hari = $request->jumlah_hari : true;
            
            // $request->nilai != null ? $find->nilai = $this->getNilaiBasedOnJumlahHari($request->jumlah_hari) : true; // nilai otomatis berdasarkan jumlah hari
            
            if ($request->jumlah_hari !== 'lainnya')
            {
                $request->jumlah_hari != null ? $find->jumlah_hari = $request->jumlah_hari : true;
                $request->nilai != null ? $find->nilai = $this->getNilaiBasedOnJumlahHari($request->jumlah_hari) : true; // nilai otomatis berdasarkan jumlah hari
            }
            else
            {
                $request->jumlah_hari_lainnya != null ? $find->jumlah_hari_lainnya = $request->jumlah_hari_lainnya : true;
                $request->nilai != null ? $find->nilai = $this->getNilaiBasedOnJumlahHari($request->jumlah_hari_lainnya) : true; // nilai otomatis berdasarkan jumlah hari
            }
     
            $request->jurusan_id != null ? $find->jurusan_id = $request->jurusan_id : true;
            $request->tajar_id != null ? $find->tajar_id = $request->tajar_id : true;
            $request->tajar_id != null ? $find->tajar_id = $request->tajar_id : true;

            $find->save();
            // dd($find)->toArray();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil melakukan update data nilai presensi siswa',
            ], 201);
        }
    }

    public function getNilai(Request $request)
    {
        $jumlah_hari = $request->jumlah_hari;
        
        $nilai = $this->getNilaiBasedOnJumlahHari($jumlah_hari);

        return response()->json(['nilai' => $nilai], 200);
    }

    private function getNilaiBasedOnJumlahHari($jumlah_hari)
    {
        $nilaiMapping = [
            '0 Hari' => 5,
            '1 Hari' => 4,
            '2 Hari' => 3,
            '3 Hari' => 2,
            '4 Hari' => 1,
        ];

        return $nilaiMapping[$jumlah_hari] ?? 0; // Nilai default jika jumlah hari tidak ditemukan / jumlah hari melebihi 4 hari
    }

    public function deleteData($id)
    {
        $find = PresensiSiswa::where('id',$id)->first();

        if(!$find)
        {
            return response()->json([
                'success' => false,
                'message' => 'Update data gagal!, data tidak ditemukan',
            ], 400);
        }
        else
        {
            $hapus = PresensiSiswa::where('id',$id)->delete();

            if($hapus)
            {
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil menghapus data nilai presensi siswa',
                ], 201);
            }
            else
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat menghapus data nilai presensi siswa',
                ], 400);
            }
        }
    }

    public function exportData()
    {
        $presensi = PresensiSiswa::all();
        $data = array();
        foreach($presensi as $p)
        {
            $item['id'] = $p->id;
            $item['tahun_ajar'] = $p->tajar->periode ?? '';
            $item['jurusan'] = $p->jurusan->name ?? '';
            $item['nama_siswa'] = $p->siswa->name ?? '';
            $item['ket_ketidakhadiran'] = $p->ket_ketidakhadiran;
            $item['jumlah_hari'] = $p->jumlah_hari;
            $item['nilai'] = $p->nilai;
            $data[] = $item;
        }
        // dd($data)->toArray();
        return Excel::download(new PresensiSiswaExport($data), 'Data-Presensi-Siswa.xlsx');
    }
}
