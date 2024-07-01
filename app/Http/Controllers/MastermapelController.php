<?php

namespace App\Http\Controllers;

use App\Exports\TemplatemapelExport;
use App\Exports\MastermapelExport;
use App\Imports\MasterMapelImport;
use App\Models\MasterJurusan;
use App\Models\MasterMapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class MastermapelController extends Controller
{
    public function index()
    {
        $jurusans = MasterJurusan::all();
        return view('admin.mastermapel.index', compact('jurusans'));
    }

    public function listMapel(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'name',
            2 => 'kelompok',
            3 => 'type',
            4 => 'kelas',
        ];

        $start = $request->start;
        $limit = $request->length;
        $orderColumn = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search')['value'];
        $jurusanId = $request->input('jurusan_id');

        // Hitunga keseluruhan
        // $hitung = MasterMapel::count();

        // $masgu = MasterMapel::where(function ($q) use ($search) {
        //     if($search != null)
        //     {
        //         return $q->where('name','LIKE','%'.$search.'%')
        //             ->orWhere('kelompok','LIKE','%'.$search.'%')
        //             ->orWhere('type','LIKE','%'.$search.'%');
        //     }
        // })->orderby($orderColumn,$dir)
        //     ->skip($start)
        //     ->take($limit)->get();

        $query = MasterMapel::with('jurusan')
            ->when($jurusanId && $jurusanId != '-1', function ($q) use ($jurusanId){
                $q->where('jurusan_id', $jurusanId);
            })
            ->when(empty($jurusanId) || $jurusanId == '-1', function ($q){
            })
            ->when($search, function ($q) use ($search){
                $q->where(function ($query) use ($search) {
                    $query->where('name','LIKE',"%{$search}%")
                        ->orWhere('kelompok','LIKE',"%{$search}%")
                        ->orWhere('type','LIKE',"%{$search}%");
                });
            });
        
        $hitung = $query->count();

        $masgu = $query->orderby($orderColumn, $dir)
            ->skip($start)
            ->take($limit)
            ->get();
        
        $data = array();
        foreach($masgu as $m)
        {
            $item['id'] = $m->id;
            $item['id_kelas'] = $m->jurusan_id;
            $item['jurusan'] = $m->jurusan->jurusan ?? '';
            $item['name'] = $m->name;
            $item['kelompok'] = $m->kelompok;
            $item['type'] = $m->type;
            $data[] = $item;
        }

        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $hitung,
            'recordsFiltered' => $hitung,
            'data' => $data,
        ],200);
    }

    public function kelasSupport()
    {
        $kelas = MasterJurusan::all();
        $data = array();
        foreach($kelas as $k)
        {
            $item['id'] = $k->id;
            $item['kode'] = $k->kode;
            $item['name'] = $k->name;
            $item['jurusan'] = $k->jurusan;
            $data[] = $item;
        }

        return response()->json([
            'data' => $data,
        ],200);
    }

    public function addMapel(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'jurusan_id' => 'required',
            'name' => 'required',
            'kelompok' => 'required',
            'type' => 'required',
        ]);

        //response error validation
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $mapel = new MasterMapel();
        $mapel->jurusan_id = $request->jurusan_id;
        $mapel->name = $request->name;
        $mapel->kelompok = $request->kelompok;
        $mapel->type = $request->type;
        $mapel->save();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menyimpan data master mapel',
        ],201);
    }

    public function updateData(Request $request,$id)
    {
        $find = MasterMapel::where('id',$id)->first();
        
        if(!$find)
        {
            return response()->json([
                'success' => false,
                'message' => 'Update data gagal!, data tidak ditemukan',
            ],400);
        }else{
            $request->name != null ? $find->name = $request->name : true;   
            $request->kelompok != null ? $find->kelompok = $request->kelompok : true;
            $request->type != null ? $find->type = $request->type : true;
            $request->jurusan_id != null ? $find->jurusan_id = $request->jurusan_id : true;
            $find->save();

            // $find->name = $request->name;
            // $find->kelompok = $request->kelompok;
            // $find->type = $request->type;
            // $find->jurusan_id = $request->jurusan_id;
            // $find->save();
            return response()->json([
                'success' => true,
                'message' => 'Berhasil melakukan update data master mapel',
            ],201);
        }

    }

    public function deleteData($id)
    {
        $find = MasterMapel::where('id',$id)->first();
        if(!$find)
        {
            return response()->json([
                'success' => false,
                'message' => 'Update data gagal!, data tidak ditemukan',
            ],400);
        }else{
            $hapus = MasterMapel::where('id',$find->id)->delete();

            if($hapus)
            {
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil melakukan hapus data master mapel',
                ],201); 
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat menghapus data master mapel',
                ],400);
            }
        }
    }

    public function exportData()
    {
        $mapel = MasterMapel::all();
        $data = array();
        foreach($mapel as $m)
        {
            $item['id'] = $m->id;
            $item['kelas'] = $m->jurusan->jurusan ?? '';
            $item['name'] = $m->name;
            $item['kelompok'] = $m->kelompok;
            $item['type'] = $m->type;
            $data[] = $item;
        }   

        return Excel::download(new MastermapelExport($data), 'Master-Mapel-Export.xlsx');
    }

    public function template()
    {
        return Excel::download(new TemplatemapelExport(), 'Template-Master-Maoel.xlsx');
    }

    public function import(Request $request)
    {
        // Lakukan validasi data impor
        $request->validate([
            'excel' => 'required|mimes:xls,xlsx',
        ]);

        // Proses data impor
        $file = $request->file('excel');

        Excel::import(new MasterMapelImport, $file);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil melakukan import data master mapel'
        ],201);
    }
}
