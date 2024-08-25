<?php

namespace App\Http\Controllers;

use App\Models\MasterKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MasterkriteriaController extends Controller
{
    public function index()
    {
        return view('admin.masterkriteria.index');
    }

    // public function dataKriteria()
    // {
    //     $kriteria = MasterKriteria::all();
    //     $data = array();
    //     $totalBobotPercent = 0;
        
    //     foreach($kriteria as $k)
    //     {
    //         $item['id'] = $k->id;
    //         $item['kode'] = $k->kode;
    //         $item['name'] = $k->name;
    //         $item['atribut'] = $k->attribute;
    //         $item['bobot_percent'] = $k->bobot.' %';
    //         $item['bobot'] = $k->bobot;
    //         $item['kurikulum'] = $k->kurikulum;

    //         // $totalBobotPercent += $k->bobot;
            
    //         $data[] = $item;
    //     }

    //     // $warning = '';
    //     // if ($totalBobotPercent > 100)
    //     // {
    //     //     $warning = 'Peringatan: Total bobot tidak boleh lebih dari 100%. Total saat ini adalah ' . $totalBobotPercent . '%';
    //     // }

    //     return response()->json([
    //         'data' => $data,
    //         // 'warning' => $warning,
    //     ],200);
    // }

    public function dataKriteria(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'kode',
            2 => 'name',
            3 => 'attribute',
            4 => 'bobot',
            5 => 'bobot_percent',
            6 => 'kurikulum',
        ];

        $totalBobotPercent = 0;
        $start = $request->start;
        $limit = $request->length;
        $orderColumn = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search')['value'];

        // Hitunga keseluruhan
        $hitung = MasterKriteria::count();
        $kriteria = MasterKriteria::where(function ($q) use ($search) {
            if($search != null)
            {
                return $q->where('kode','LIKE','%'.$search.'%')->orWhere('name','LIKE','%'.$search.'%')->orwhere('attribute','LIKE','%'.$search.'%')->orWhere('bobot',$search);
            }
        })->orderby($orderColumn, $dir)->skip($start)->take($limit)->get();
        $data = array();
        foreach($kriteria as $k)
        {
            $item['id'] = $k->id;
            $item['kode'] = $k->kode;
            $item['name'] = $k->name;
            $item['atribut'] = $k->attribute;
            $item['bobot_percent'] = $k->bobot.' %';
            $item['bobot'] = $k->bobot;
            $item['kurikulum'] = $k->kurikulum;
            $totalBobotPercent += $k->bobot;

            $data[] = $item;
        }

        $warning = '';
        if ($totalBobotPercent > 100)
        {
            $warning = 'Peringatan: Total bobot tidak boleh lebih dari 100%. Total bobot saat ini adalah ' . $totalBobotPercent . '%';
        }

        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $hitung,
            'recordsFiltered' => $hitung,
            'warning' => $warning,
            'data' => $data,
        ], 200);
    }

    public function tambahKriteria(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'kode' => 'required',
            'name' => 'required',
            'atribut' => 'required',
            'bobot' => 'required',
            'kurikulum' => 'required',
        ]);

        //response error validation
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $kriteria = new MasterKriteria();
        $kriteria->kode = $request->kode;
        $kriteria->name = $request->name;
        $kriteria->attribute = $request->atribut;
        $kriteria->bobot = $request->bobot;
        $kriteria->kurikulum = $request->kurikulum;
        $kriteria->save();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menambahkan data kriteria baru',
        ],201);
    }

    public function updateData(Request $request,$id)
    {
        $find = MasterKriteria::where('id',$id)->first();
        if(!$find)
        {
            return response()->json([
                'success' => false,
                'message' => 'Update data kriteria gagal, data tidak ditemukan',
            ],400);
        }else{
            $request->kode != null ? $find->kode = $request->kode : true;
            $request->name != null ? $find->name = $request->name : true;
            $request->atribut != null ? $find->attribute = $request->atribut : true;
            $request->bobot != null ? $find->bobot = $request->bobot : true;
            $request->kurikulum != null ? $find->kurikulum = $request->kurikulum : true;
            $find->save();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil update data kriteria',
            ],201);
        }
    }

    public function hapusData($id)
    {
        $hapus = MasterKriteria::where('id',$id)->delete();
        if($hapus)
        {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil hapus data kriteria',
            ],201);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat hapus data kriteria',
            ],400);
        }
    }
}
