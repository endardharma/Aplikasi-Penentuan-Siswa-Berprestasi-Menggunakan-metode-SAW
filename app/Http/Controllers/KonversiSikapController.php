<?php

namespace App\Http\Controllers;

use App\Models\KonversiSikap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KonversiSikapController extends Controller
{
    public function index()
    {
        return view('admin.data_kriteria.sikap.index');
    }

    public function listKonversiSikap(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'ket_sikap',
            2 => 'nilai_konversi',
        ];

        $totalBobotPercent = 0;
        $start = $request->start;
        $limit = $request->length;
        $orderColumn = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search')['value'];

        // Hitunga keseluruhan
        $hitung = KonversiSikap::count();
        $ketidakhadiran = KonversiSikap::where(function ($q) use ($search) {
            if($search != null)
            {
                return $q->where('ket_sikap','LIKE','%'.$search.'%')->orWhere('nilai_konversi','LIKE','%'.$search.'%');
            }
        })->orderby($orderColumn, $dir)->skip($start)->take($limit)->get();
        $data = array();
        foreach($ketidakhadiran as $k)
        {
            $item['id'] = $k->id;
            $item['ket_sikap'] = $k->ket_sikap;
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
            'ket_sikap' => 'required',
            'nilai_konversi' => 'required',
        ]);

        // response error validation
        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        };

        $presensi = new KonversiSikap();
        $presensi->ket_sikap = $request->ket_sikap;
        $presensi->nilai_konversi = $request->nilai_konversi;
        $presensi->save();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menambahkan data nilai konversi sikap siswa',
        ], 201);
    }

    public function updateData(Request $request, $id)
    {
        $find = KonversiSikap::where('id',$id)->first();

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
            $request->ket_sikap != null ? $find->ket_sikap = $request->ket_sikap : true;
            $request->nilai_konversi != null ? $find->nilai_konversi = $request->nilai_konversi : true;

            $find->save();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil melakukan update data nilai konversi sikap siswa',
            ], 201);
        }
    }

    public function deleteData($id)
    {
        $find = KonversiSikap::where('id',$id)->first();

        if(!$find)
        {
            return response()->json([
                'success' => false,
                'message' => 'Update data gagal!, data tidak ditemukan',
            ], 400);
        }
        else
        {
            $hapus = KonversiSikap::where('id',$id)->delete();

            if($hapus)
            {
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil menghapus data nilai konversi sikap siswa',
                ], 201);
            }
            else
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat menghapus data nilai konversi sikap siswa',
                ], 400);
            }
        }
    }

}
