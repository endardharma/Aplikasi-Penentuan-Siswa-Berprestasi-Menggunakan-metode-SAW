<?php

namespace App\Http\Controllers;

use App\Models\TahunAjar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MastertajarController extends Controller
{
    public function index()
    {
        return view('admin.mastertajar.index');
    }

    public function listTajar()
    {
        $tajar = TahunAjar::all();
        $data = array();
        foreach($tajar as $t)
        {
            $item['id'] = $t->id;
            $item['kode'] = $t->kode;
            $item['name'] = $t->name;
            $item['tahun'] = $t->tahun;
            $item['kurikulum'] = $t->kurikulum;
            $data[] = $item;
        }

        return response()->json([
            'data' => $data,
        ],200);
    }

    public function tambahData(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'kode' => 'required',
            'name' => 'required',
            'tahun' => 'required',
            'kurikulum' => 'required',
        ]);

        //response error validation
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $tajar = new TahunAjar();
        $tajar->kode = $request->kode;
        $tajar->name = $request->name;
        $tajar->tahun = $request->tahun;
        $tajar->kurikulum = $request->kurikulum;
        $tajar->save();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menambahkan data tahun ajar baru',
        ],201);
    }

    public function updateData(Request $request,$id)
    {
        $find = TahunAjar::where('id',$id)->first();
        if(!$find)
        {
            return response()->json([
                'success' => false,
                'message' => 'Update data gagal, data tahun ajar tidak ditemukan',
            ],400);
        }else{
            $request->kode != null ? $find->kode = $request->kode : true;
            $request->name != null ? $find->name = $request->name : true;
            $request->tahun != null ? $find->tahun = $request->tahun : true;
            $request->kurikulum != null ? $find->kurikulum = $request->kurikulum : true;
            $find->save();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil update data tahun ajar',
            ],201);
        }
    }

    public function hapus($id)
    {
        $hapus = TahunAjar::where('id',$id)->delete();
        if(!$hapus)
        {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat proses hapus data tahun ajar',
            ],400);
        }else{
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menghapus data tahun ajar',
            ],201);
        }
    }
}
