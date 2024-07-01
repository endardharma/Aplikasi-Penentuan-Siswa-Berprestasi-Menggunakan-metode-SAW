<?php

namespace App\Http\Controllers;

use App\Exports\RaporSiswaExport;
use App\Exports\RaporSiswaTemplate;
use App\Imports\RaporSiswaImport;
use App\Models\MasterJurusan;
use App\Models\MasterMapel;
use App\Models\MasterSiswa;
use App\Models\RaporSiswa;
use App\Models\TahunAjar;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use function PHPSTORM_META\map;

class RaporSiswaController extends Controller
{
    public function index()
    {
        return view('admin.data_nilai.rapor.index');
    }

    public function listRapor(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'tajar_id',
            2 => 'siswa_id',
            3 => 'jurusan_id',
        ];

        $start = $request->start;
        $limit = $request->length;
        $orderColumnIndex = $request->input('order.0.column');
        $orderColumn = isset($columns[$orderColumnIndex]) ? $columns [$orderColumnIndex] : 'id';
        $dir = $request->input('order.0.dir');
        $search = $request->input('search')['value'];

        // Hitung total keseluruhan data tanpa paginasi dan pencarian
        $totalData = MasterSiswa::count();

        // Query mendapatkan data rapor siswa berdasarkan pencarian dan paginasi
        $query = MasterSiswa::with(['tajar','jurusan'])
            ->when($search, function ($query) use ($search) {
                $query->whereHas('jurusan', function ($q) use ($search) {
                    $q->where('name','LIKE','%'.$search.'%');
                })
                ->orWhereHas('tajar', function ($q) use ($search) {
                    $q->where('periode','LIKE','%'.$search.'%')
                    ->orWhere('semester','LIKE','%'.$search.'%');
                });
                // ->orWhereHas('jurusan', function ($q) use ($search) {
                //     $q->where('name','LIKE','%'.$search.'%');
                // });
                // ->orWhere('nilai', 'LIKE', '%'.$search.'%');
            });
        
        // Hitung total filtered sesuai dengan pencarian
        $totalFiltered = $query->count();

        // Ambil data rapor sesuai dengan paginasi dan urutan
        $siswa = $query
            ->orderBy($orderColumn, $dir)
            ->skip($start)
            ->take($limit)
            ->get();
        
        $data = array();
        foreach($siswa as $s)
        {
            $item['id'] = $s->id;

            // $item['id_siswa_nama'] = $s->siswa_id;
            $item['nama_siswa'] = $s->name ?? '';

            // $item['id_mapel_nama'] = $r->mapel_id;
            // $item['nama_mapel'] = $r->mapel->name ?? '';

            // $item['id_mapel_kelompok'] = $r->mapel_id;
            // $item['kelompok'] = $r->mapel->kelompok ?? '';
            
            // $item['id_mapel_type'] = $r->mapel_id;
            // $item['type'] = $r->mapel->type ?? '';
            
            // $item['nilai'] = $r->nilai;

            $item['id_jurusan_nama'] = $s->jurusan_id;
            $item['jurusan'] = $s->jurusan->jurusan ?? '';

            $item['id_tajar_semester'] = $s->tajar_id;
            $item['semester'] = $s->tajar->semester ?? '';

            $item['id_tajar_tahun'] = $s->tajar_id;
            $item['tahun_ajar'] = $s->tajar->periode ?? '';

            $data[] = $item;
        }
        
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalFiltered,
            'data' => $data,
        ],200);
    }

    // public function listRaporDetail(Request $request)
    // {

    //     $columns = [
    //         0 => 'id',
    //         1 => 'tajar_id',
    //         2 => 'siswa_id',
    //         3 => 'mapel_id',
    //     ];

    //     $start = $request->start;
    //     $limit = $request->length;
    //     $orderColumn = $columns[$request->input('order.0.column')];
    //     $dir = $request->input('order.0.dir');
    //     $search = $request->input('search')['value'];

    //     // Hitunga keseluruhan
    //     $hitung = RaporSiswa::count();

    //     $rapor = RaporSiswa::where(function ($q) use ($search) {
    //         if($search != null)
    //         {
    //             return $q->where('tajar_id','LIKE','%'.$search.'%')
    //                 ->orWhere('siswa_id','LIKE','%'.$search.'%')
    //                 ->orWhere('mapel_id','LIKE','%'.$search.'%');
    //         }
    //     })->orderby($orderColumn,$dir)->skip($start)->take($limit)->get();
    //     $data = array();
    //     foreach($rapor as $r)
    //     {
    //         $item['id'] = $r->id;

    //         $item['id_siswa_nama'] = $r->siswa_id;
    //         $item['nama_siswa'] = $r->siswa->name ?? '';

    //         $item['id_mapel_nama'] = $r->mapel_id;
    //         $item['nama_mapel'] = $r->mapel->name ?? '';

    //         $item['id_mapel_kelompok'] = $r->mapel_id;
    //         $item['kelompok'] = $r->mapel->kelompok ?? '';

    //         $item['id_mapel_type'] = $r->mapel_id;
    //         $item['type'] = $r->mapel->type ?? '';
            
    //         $item['nilai'] = $r->nilai;

    //         $data[] = $item;
    //     }

    //     return response()->json([
    //         'draw' => $request->draw,
    //         'recordsTotal' => $hitung,
    //         'recordsFiltered' => $hitung,
    //         'data' => $data,
    //     ],200);
    // }
    
    public function listRaporDetail(Request $request)
    {
        $siswaId = $request->input('siswa_id');
    
        $columns = [
            0 => 'id',
            1 => 'tajar_id',
            2 => 'siswa_id',
            3 => 'mapel_id',
        ];
    
        $start = $request->start;
        $limit = $request->length;
        $orderColumn = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search')['value'];
    
        // Hitung keseluruhan
        $hitung = RaporSiswa::where('siswa_id', $siswaId)->count();
    
        $rapor = RaporSiswa::with(['siswa', 'mapel'])
            ->where('siswa_id', $siswaId)
            ->when($search, function ($query, $search) {
                return $query->where('tajar_id', 'LIKE', '%'.$search.'%')
                                ->orWhere('mapel_id', 'LIKE', '%'.$search.'%');
            })
            ->orderby($orderColumn, $dir)
            ->skip($start)
            ->take($limit)
            ->get();

        $data = array();
        foreach ($rapor as $r) {
            $item = [
                'id' => $r->id,
                'id_siswa_nama' => $r->siswa_id,
                'nama_siswa' => $r->siswa->name ?? '',
                'id_mapel_nama' => $r->mapel_id,
                'nama_mapel' => $r->mapel->name ?? '',
                'id_mapel_kelompok' => $r->mapel_id,
                'kelompok' => $r->mapel->kelompok ?? '',
                'id_mapel_type' => $r->mapel_id,
                'type' => $r->mapel->type ?? '',
                'nilai' => $r->nilai,
            ];
            
            $data[] = $item;
        }
    
        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => $hitung,
            'recordsFiltered' => $hitung,
            'data' => $data,
        ]);
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
            $item['tahun_ajar'] = $t->tahun_ajar;
            $data[] = $item;
        }

        return response()->json([
            'data' => $data,
        ],200);
    }

    public function supportMapel()
    {
        $mapel = MasterMapel::all();
        $data = array();
        foreach($mapel as $m)
        {
            $item['id'] = $m->id;
            $item['name'] = $m->name;
            $item['kelompok'] = $m->kelompok;
            $item['type'] = $m->type;
            $data[] = $item;
        }

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function supportJurusan()
    {
        $jurusan = MasterJurusan::all();
        $data = array();
        foreach($jurusan as $j)
        {
            $item['id'] = $j->id;
            $item['name'] = $j->name;
            $data[] = $item;
        }

        return response()->json([
            'data' => $data,
        ], 200);
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
        ], 200);
    }

    public function template(Request $request)
    {
        return Excel::download(new RaporSiswaTemplate($request->tajar), 'Template-Rapor-Siswa.xlsx');
    }

    public function importData(Request $request)
    {
        // Lakukan validasi data impor
        $request->validate([
            'excel' => 'required|mimes:xls,xlsx',
        ]);

        // Proses data impor
        $file = $request->file('excel');

        Excel::import(new RaporSiswaImport, $file);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil melakukan import data master mapel'
        ],201);
    }

    public function updateData(Request $request, $id)
    {
        $find = RaporSiswa::where('id',$id)->first();

        if (!$find)
        {
            return response()->json([
                'success' => false,
                'message' => 'Update data gagal!, data tidak ditemukan',
            ], 400);
        } 
        else
        {
            $request->siswa_id != null ? $find->siswa_id = $request->siswa_id : true;
            $request->mapel_id != null ? $find->mapel_id = $request->mapel_id : true;
            $request->mapel_id != null ? $find->mapel_id = $request->mapel_id : true;
            $request->mapel_id != null ? $find->mapel_id = $request->mapel_id : true;
            $request->nilai != null ? $find->nilai = $request->nilai : true;
            $find->save();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil melakukan update data nilai rapor siswa',
            ], 201);
        }
    }

    public function deleteData($id)
    {
        $find = RaporSiswa::where('id',$id)->first();

        if (!$find)
        {
            return response()->json([
                'success' => false,
                'message' => 'Delete data gagal!, data tidak ditemukan',
            ], 400);
        }
        else
        {
            $hapus = RaporSiswa::where('id',$id)->delete();

            if ($hapus)
            {
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil menghapus data nilai rapor siswa',
                ], 201);
            }
            else
            { 
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat menghapus data nilai rapor siswa',
                ], 400);
            }
        }
    }
    
    public function exportData(Request $request)
    {
        $rapor = RaporSiswa::all();
        $data = array();
        foreach($rapor as $r)
        {
            $item['id'] = $r->id;
            $item['nama_siswa'] = $r->siswa->name ?? '';
            $item['nama_mapel'] = $r->mapel->name ?? '';
            $item['kelompok'] = $r->mapel->kelompok ?? '';
            $item['type'] = $r->mapel->type ?? '';
            $item['nilai'] = $r->nilai;
            $item['jurusan'] = $r->jurusan->name ?? '';
            $item['semester'] = $r->tajar->name ?? '';
            $item['tahun_ajar'] = $r->tajar->periode ?? '';
            $data[] = $item;
        }

        return Excel::download(new RaporSiswaExport($data), 'Export-Rapor-Siswa.xlsx');
    }
}
