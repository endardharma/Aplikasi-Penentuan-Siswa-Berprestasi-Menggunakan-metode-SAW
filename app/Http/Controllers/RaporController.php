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
use PDO;
use PhpParser\Node\Stmt\Foreach_;

class RaporController extends Controller
{
    public function testRapor()
    {
        // Fungsi Template Export dan detail rapor siswa
        $siswa = MasterSiswa::all();
   
        $data = array();
        foreach($siswa as $s)
        {
            foreach($s->jurusan->mapel as $m)
            {
                $find = TahunAjar::where('tahun',date('Y'))->first();
                if($find)
                {
                    $item['nama_siswa'] = $s->name;
                    $item['nama_mapel'] = $m->name;
                    $item['kelompok_mapel'] = $m->kelompok;
                    $item['type_mapel'] = $m->type;
                    $item['nilai'] = 80;
                    $item['jurusan'] = $s->jurusan->name ?? '';
                    $item['semester'] = $find->semester;
                    $item['tahun_ajar'] = $find->name;
                    $data[] = $item;
                }
            }
        }

        return response()->json([
            'data' => $data,
        ],200);
    }

    public function index()
    {
        return view('admin.data_nilai.rapor.index'); 
    }

    public function listRapor(Request $request)
    {
        // Data / function dummy
        $columns = [
            0 => 'id',
            1 => 'nama_siswa',
            2 => 'type',
            3 => 'nilai',
        ];

        $start = $request->start;
        $limit = $request->length;
        $orderColumn = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search')['value'];

        // // Hitunga keseluruhan
        // $hitung = MasterSiswa::count();

        // $siswa = MasterSiswa::where(function ($q) use ($search) {
        //     if($search != null)
        //     {
        //         return $q->where('nama_siswa','LIKE','%'.$search.'%');
        //     }
        // })->orderby($orderColumn, $dir)->skip($start)->take($limit)->get();
        // $data = array();

        // $rapor = RaporSiswa::all();
        // foreach($siswa as $s)
        // {
        //     foreach($s->jurusan->mapel as $m)
        //     {
        //         $item['id'] = $s->id;
        //         $item['nama_siswa'] = $s->name;
        //         $item['nama_mapel'] = $m->name;
        //         $item['type'] = $m->type;

        //         foreach($rapor as $r)
        //         {
        //             $item['nilai'] = $r->nilai;
        //         }

        //         $data[] = $item;
        //     }
        // }

        // Hitung keseluruhan
        $hitung = RaporSiswa::count();

        $rapor = RaporSiswa::where(function ($q) use ($search) {
            if($search != null)
            {
                return $q->where('tajar_id','LIKE','%'.$search.'%')->orWhere('mapel_id','LIKE','%'.$search.'%')->orwhere('siswa_id','LIKE','%'.$search.'%')->orWhere('nilai',$search);
            }
        })->orderby($orderColumn, $dir)->skip($start)->take($limit)->get();
        $data = array();
        // dd($rapor)->toArray();
        foreach($rapor as $r)
        {
            $item['id'] = $r->id;
            $item['nama_siswa'] = $r->siswa->name ?? '';
            $item['nama_mapel'] = $r->mapel->name ?? '';
            $item['type'] = $r->mapel->type ?? '';
            $item['nilai'] = $r->nilai;
            $data[] = $item;

        }
        // dd($data)->toArray();


        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $hitung,
            'recordsFiltered' => $hitung,
            'data' => $data,
        ], 200);
    }

    // public function listRaporDetail(Request $request)
    // {
    //     // Data / function Dummy
    //     $columns = [
    //         0 => 'id',
    //         1 => 'nama_siswa',
    //         2 => 'nama_mapel',
    //         3 => 'kelompok',
    //         4 => 'type',
    //         5 => 'nilai',
    //         6 => 'jurusan',
    //         7 => 'semester',
    //         8 => 'tahun_ajar',
    //     ];

    //     $start = $request->start;
    //     $limit = $request->length;
    //     $orderColumn = $columns[$request->input('order.0.column')];
    //     $dir = $request->input('order.0.dir');
    //     $search = $request->input('search')['value'];

    //     // Hitung keseluruhan
    //     $hitung = MasterSiswa::count();

    //     $siswa = MasterSiswa::where(function($q) use ($search) {
    //         if($search != null)
    //         {
    //             return $q->where('nama_siswa', 'LIKE', '%'.$search.'%');
    //         }
    //     })->orderby($orderColumn, $dir)->skip($start)->take($limit)->get();
        
    //     $tajar = TahunAjar::all();
    //     $data = array();
    //     foreach($siswa as $s)
    //     {
    //         foreach($s->jurusan->mapel as $m)
    //         {
    //             $item['id'] = $s->id;
    //             $item['nama_siswa'] = $s->name;
    //             $item['nama_mapel'] = $m->name;
    //             $item['kelompok'] = $m->kelompok;
    //             $item['type'] = $m->type;
    //             $item['nilai'] = 80;
    //             $item['jurusan'] = $s->jurusan->name;
                
    //             foreach($tajar as $t)
    //             {
    //                 $item['semester'] = $t->semester;
    //                 $item['tahun_ajar'] = $t->tahun;
    //                 // $data[] = $item;
    //             }

    //             $data[] = $item;
    //         }
    //     }
    // }

    public function listRaporDetail(Request $request)
    {
        // Data / function Dummy
        $columns = [
            0 => 'id',
            1 => 'nama_siswa',
            2 => 'nama_mapel',
            3 => 'kelompok',
            4 => 'type',
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

        // Hitung keseluruhan
        $hitung = RaporSiswa::count();

        $rapor = RaporSiswa::where(function ($q) use ($search) {
            if($search != null)
            {
                return $q->where('tajar_id','LIKE','%'.$search.'%')->orWhere('jurusan_id','LIKE','$'.$search.'%')->orWhere('mapel_id','LIKE','%'.$search.'%');
            }
        })->orderby($orderColumn,$dir)->skip($start)->take($limit)->get();
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
            $item['semester'] = $r->tajar->semester ?? '';
            $item['tahun_ajar'] = $r->tajar->tahun ?? '';
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
            $item['tahun'] = $t->tahun;
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

    public function exportData()
    {
        $rapor = RaporSiswa::all();
        $data = array();
        foreach($rapor as $r)
        {
            $item['id'] = $r->id;
            $item['tahun_ajar'] = $r->tajar->tahun ?? '';
            $item['nama_mapel'] = $r->mapel->name ?? '';
            $item['nama_siswa'] = $r->siswa->name ?? '';
            $item['jurusan'] = $r->jurusan->name ?? '';
            $item['nilai'] = $r->nilai;
            $data[] = $item;
        }

        return Excel::download(new RaporSiswaExport($data), 'Raport-Siswa-Export.xlsx');
    }
    
    public function template(Request $request)
    {
        return Excel::download(new RaporSiswaTemplate($request->tajar), 'Template-Raport-Siswa.xlsx');
    }

    public function importData(Request $request)
    {
        // Lakukan Validasi data import
        $request->validate([
            'excel' => 'required|mimes:xls,xlsx',
        ]);

        // Proses data import
        $file = $request->file('excel');

        Excel::import(new RaporSiswaImport, $file);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil melakukan import data raport siswa',
        ], 201);
    }

    public function updateData(Request $request, $id)
    {
        $find = RaporSiswa::where('id', $id)->first();
        if(!$find)
        {
            return response()->json([
                'success' => false,
                'message' => 'Update data gagal! Data raport siswa tidak ditemukan',
            ], 400);
        }else{
            $request->siswa_id_name != null ? $find->siswa_id_name = $request->siswa_id_name : true;
            $request->mapel_id_name != null ? $find->mapel_id_name = $request->mapel_id_name : true;
            $request->mapel_id_kelompok != null ? $find->mapel_id_kelompok = $request->mapel_id_kelompok : true;
            $request->mapel_id_type != null ? $find->mapel_id_type = $request->mapel_id_type : true;
            $request->nilai != null ? $find->nilai = $request->nilai : true;
            $request->jurusan_id_name != null ? $find->jurusan_id_name = $request->jurusan_id_name : true;
            $request->tajar_id_semester != null ? $find->tajar_id_semester = $request->tajar_id_semester : true;
            $request->tajar_id_tahun != null ? $find->tajar_id_tahun = $request->tajar_id_tahun : true;
            $find->save();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil melakukan update data rapor siswa',
            ], 201);
        }
    }
}
