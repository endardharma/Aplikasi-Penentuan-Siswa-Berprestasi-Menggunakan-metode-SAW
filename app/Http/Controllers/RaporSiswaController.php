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
            1 => 'nama_siswa',
            2 => 'nama_mapel',
            3 => 'kelompok',
            3 => 'type',
            4 => 'nilai',
        ];

        $start = $request->start;
        $limit = $request->length;
        $orderColumn = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search')['value'];

        // Hitunga keseluruhan
        $hitung = RaporSiswa::count();

        $rapor = RaporSiswa::where(function ($q) use ($search) {
            if($search != null)
            {
                return $q->where('tajar_id','LIKE','%'.$search.'%')->orWhere('siswa_id','LIKE','%'.$search.'%')->orWhere('jurusan_id','LIKE','%'.$search.'%')->orWhere('mapel_id','LIKE','%'.$search.'%');
            }
        })->orderby($orderColumn,$dir)->skip($start)->take($limit)->get();
        $data = array();
        foreach($rapor as $r)
        {
            $item['id'] = $r->id;

            $item['id_siswa_nama'] = $r->siswa_id;
            $item['nama_siswa'] = $r->siswa->name ?? '';

            $item['id_mapel_nama'] = $r->mapel_id;
            $item['nama_mapel'] = $r->mapel->name ?? '';

            $item['id_mapel_kelompok'] = $r->mapel_id;
            $item['kelompok'] = $r->mapel->kelompok ?? '';
            
            $item['id_mapel_type'] = $r->mapel_id;
            $item['type'] = $r->mapel->type ?? '';
            
            $item['nilai'] = $r->nilai;

            $data[] = $item;
        }
        
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $hitung,
            'recordsFiltered' => $hitung,
            'data' => $data,
        ],200);
    }

    public function listRaporDetail(Request $request)
    {
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

        // Hitunga keseluruhan
        $hitung = RaporSiswa::count();

        $rapor = RaporSiswa::where(function ($q) use ($search) {
            if($search != null)
            {
                return $q->where('tajar_id','LIKE','%'.$search.'%')->orWhere('siswa_id','LIKE','%'.$search.'%')->orWhere('jurusan_id','LIKE','%'.$search.'%')->orWhere('mapel_id','LIKE','%'.$search.'%');
            }
        })->orderby($orderColumn,$dir)->skip($start)->take($limit)->get();
        $data = array();
        foreach($rapor as $r)
        {
            $item['id'] = $r->id;

            $item['id_siswa_nama'] = $r->siswa_id;
            $item['nama_siswa'] = $r->siswa->name ?? '';

            $item['id_mapel_nama'] = $r->mapel_id;
            $item['nama_mapel'] = $r->mapel->name ?? '';

            $item['id_mapel_kelompok'] = $r->mapel_id;
            $item['kelompok'] = $r->mapel->kelompok ?? '';

            $item['id_mapel_type'] = $r->mapel_id;
            $item['type'] = $r->mapel->type ?? '';
            
            $item['nilai'] = $r->nilai;
            
            $item['id_jurusan_nama'] = $r->jurusan_id;
            $item['jurusan'] = $r->jurusan->name ?? '';

            $item['id_tajar_semester'] = $r->tajar_id;
            $item['semester'] = $r->tajar->semester ?? '';

            $item['id_tajar_tahun'] = $r->tajar_id;
            $item['tahun_ajar'] = $r->tajar->tahun ?? '';

            $data[] = $item;
        }

        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $hitung,
            'recordsFiltered' => $hitung,
            'data' => $data,
        ],200);
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
            $item['tahun_ajar'] = $r->tajar->tahun ?? '';
            $data[] = $item;
        }

        return Excel::download(new RaporSiswaExport($data), 'Export-Rapor-Siswa.xlsx');
    }
}
