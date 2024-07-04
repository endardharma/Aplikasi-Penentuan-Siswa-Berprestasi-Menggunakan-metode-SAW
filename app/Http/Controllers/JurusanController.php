<?php

namespace App\Http\Controllers;

use App\Models\MasterJurusan;
use App\Models\MasterJurusanSiswa;
use App\Models\MasterSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JurusanController extends Controller
{
    public function index()
    {
        return view('admin.masterjurusan.index');
    }

    public function listJurusan()
    {
        $jurusan = MasterJurusan::all();
        $data = array();
        foreach($jurusan as $j)
        {
            $item['id'] = $j->id;
            $item['jurusan_id'] = $j->jurusan_id;
            $item['jurusan_name'] = $j->jurusan->name ?? '';
            $item['kode'] = $j->kode;
            $item['name'] = $j->name;
            $item['status'] = $j->is_active == 1 ? 'Aktif' : 'Non Aktif';
            $item['jumlah'] = $j->hitung();
            $item['is_active'] = $j->is_active;
            $data[] = $item;
        }

        return response()->json([
            'data' => $data,
        ],200);
    }

    public function addJurusan(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'jurusan_id' => 'required',
            'kode' => 'required',
            'name' => 'required',
            'is_active' => 'required',
        ]);

        //response error validation
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $kelas = new MasterJurusan();
        $kelas->jurusan_id = $request->jurusan_id;
        $kelas->kode = $request->kode;
        $kelas->name = $request->name;
        $kelas->is_active = $request->is_active;
        $kelas->save();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil membuat data jurusan baru',
        ],201);
    }

    public function update(Request $request,$id)
    {
        $find = MasterJurusan::where('id',$id)->first();
        if(!$find)
        {
            return response()->json([
                'success' => false,
                'message' => 'Update data gagal, data jurusan tidak ditemukan',
            ],400);
        }else{
            $find->jurusan_id = $request->jurusan_id;
            $find->kode = $request->kode;
            $find->name = $request->name;
            $find->is_active = $request->is_active;
            $find->save();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil melakukan update data jurusan',
            ],201);
        }
    }

    public function hapus($id)
    {
        // Cari data jurusan, apakah digunakan oleh siswa
        $find = MasterSiswa::where('jurusan_id',$id)->count();
        if($find > 0)
        {
            return response()->json([
                'success' => false,
                'message' => 'Gagal hapus data jurusan, terdapat siswa dalam master jurusan',
            ],400);
        }else{
            MasterJurusan::where('id',$id)->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menghapus data jurusan',
            ],201);
        }
    }

    public function supportJurusan()
    {
        $jurusan = MasterJurusanSiswa::all();
        $data = [];
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
}
