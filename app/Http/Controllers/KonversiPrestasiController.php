<?php

namespace App\Http\Controllers;

use App\Models\KonversiPrestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KonversiPrestasiController extends Controller
{
    public function index()
    {
        return view('admin.data_kriteria.prestasi.index');
    }

    public function listKonversiPrestasi(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'ket_prestasi',
            2 => 'nilai_konversi',
        ];

        $totalBobotPercent = 0;
        $start = $request->start;
        $limit = $request->length;
        $orderColumn = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search')['value'];

        // Hitunga keseluruhan
        $hitung = KonversiPrestasi::count();
        $ketidakhadiran = KonversiPrestasi::where(function ($q) use ($search) {
            if($search != null)
            {
                return $q->where('ket_prestasi','LIKE','%'.$search.'%')->orWhere('nilai_konversi','LIKE','%'.$search.'%');
            }
        })->orderby($orderColumn, $dir)->skip($start)->take($limit)->get();
        $data = array();
        foreach($ketidakhadiran as $k)
        {
            $item['id'] = $k->id;
            $item['ket_prestasi'] = $k->ket_prestasi;
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
            'ket_prestasi' => 'required',
            'nilai_konversi' => 'required',
        ]);

        // response error validation
        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        };

        $presensi = new KonversiPrestasi();
        $presensi->ket_prestasi = $request->ket_prestasi;
        $presensi->nilai_konversi = $request->nilai_konversi;
        $presensi->save();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menambahkan data nilai konversi prestasi siswa',
        ], 201);
    }

    public function updateData(Request $request, $id)
    {
        $find = KonversiPrestasi::where('id',$id)->first();

        if(!$find)
        {
            return response()->json([
                'success' => false,
                'message' => 'Update data gagal!, data tidak ditemukan',
            ], 400);
        }
        else
        {
            $request->ket_prestasi != null ? $find->ket_prestasi = $request->ket_prestasi : true;
            $request->nilai_konversi != null ? $find->nilai_konversi = $request->nilai_konversi : true;

            $find->save();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil melakukan update data nilai konversi prestasi siswa',
            ], 201);
        }
    }

    public function deleteData($id)
    {
        $find = KonversiPrestasi::where('id',$id)->first();

        if(!$find)
        {
            return response()->json([
                'success' => false,
                'message' => 'Update data gagal!, data tidak ditemukan',
            ], 400);
        }
        else
        {
            $hapus = KonversiPrestasi::where('id',$id)->delete();

            if($hapus)
            {
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil menghapus data nilai konversi prestasi siswa',
                ], 201);
            }
            else
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat menghapus data nilai konversi prestasi siswa',
                ], 400);
            }
        }
    }

}
