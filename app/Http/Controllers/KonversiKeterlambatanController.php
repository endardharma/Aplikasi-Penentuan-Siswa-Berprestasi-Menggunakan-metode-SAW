<?php

namespace App\Http\Controllers;

use App\Models\KonversiKeterlambatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KonversiKeterlambatanController extends Controller
{
    public function index()
    {
        return view('admin.data_kriteria.keterlambatan.index');
    }

    public function listKonversiKeterlambatan(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'jumlah_keterlambatan',
            2 => 'nilai_konversi',
        ];

        $totalBobotPercent = 0;
        $start = $request->start;
        $limit = $request->length;
        $orderColumn = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search')['value'];

        // Hitunga keseluruhan
        $hitung = KonversiKeterlambatan::count();
        $keterlambatan = KonversiKeterlambatan::where(function ($q) use ($search) {
            if($search != null)
            {
                return $q->where('jumlah_keterlambatan','LIKE','%'.$search.'%')->orWhere('nilai_konversi',$search);
            }
        })->orderby($orderColumn, $dir)->skip($start)->take($limit)->get();
        $data = array();
        foreach($keterlambatan as $k)
        {
            $item['id'] = $k->id;
            $item['jumlah_keterlambatan'] = $k->jumlah_keterlambatan;
            $item['nilai_konversi'] = $k->nilai_konversi;

            $data[] = $item;
        }

        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $hitung,
            'recordsFiltered' => $hitung,
            'data' => $data,
        ], 200);
    }

    public function tambahData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jumlah_keterlambatan' => 'required',
            'nilai_konversi' => 'required',
        ]);

        // response error validation
        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        };

        $keterlambatan = new KonversiKeterlambatan();
        $keterlambatan->jumlah_keterlambatan = $request->jumlah_keterlambatan;
        $keterlambatan->nilai_konversi = $request->nilai_konversi;
        $keterlambatan->save();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menambahkan data nilai konversi keterlambatan siswa',
        ], 201);
    }

    public function updateData(Request $request, $id)
    {
        $find = KonversiKeterlambatan::where('id',$id)->first();

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
            $request->jumlah_keterlambatan != null ? $find->jumlah_keterlambatan = $request->jumlah_keterlambatan : true;
            $request->nilai_konversi != null ? $find->nilai_konversi = $request->nilai_konversi : true;

            $find->save();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil melakukan update data nilai konversi keterlambatan siswa',
            ], 201);
        }
    }

    public function deleteData($id)
    {
        $find = KonversiKeterlambatan::where('id',$id)->first();

        if(!$find)
        {
            return response()->json([
                'success' => false,
                'message' => 'Update data gagal!, data tidak ditemukan',
            ], 400);
        }
        else
        {
            $hapus = KonversiKeterlambatan::where('id',$id)->delete();

            if($hapus)
            {
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil menghapus data nilai konversi keterlambatan siswa',
                ], 201);
            }
            else
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat menghapus data nilai konversi keterlambatan siswa',
                ], 400);
            }
        }
    }
}
