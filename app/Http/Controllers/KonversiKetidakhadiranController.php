<?php

namespace App\Http\Controllers;

use App\Models\KonversiKetidakhadiran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KonversiKetidakhadiranController extends Controller
{
    public function index()
    {
        return view('admin.data_kriteria.presensi.index');
    }

    public function listKonversiKetidakhadiran(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'ket_ketidakhadiran',
            2 => 'jumlah_hari',
            3 => 'nilai_konversi',
        ];

        $totalBobotPercent = 0;
        $start = $request->start;
        $limit = $request->length;
        $orderColumn = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search')['value'];

        // Hitunga keseluruhan
        $hitung = KonversiKetidakhadiran::count();
        $ketidakhadiran = KonversiKetidakhadiran::where(function ($q) use ($search) {
            if($search != null)
            {
                return $q->where('ket_ketidakhadiran','LIKE','%'.$search.'%')->orWhere('jumlah_hari','LIKE','%'.$search.'%')->orWhere('nilai_konversi',$search);
            }
        })->orderby($orderColumn, $dir)->skip($start)->take($limit)->get();
        $data = array();
        foreach($ketidakhadiran as $k)
        {
            $item['id'] = $k->id;
            $item['ket_ketidakhadiran'] = $k->ket_ketidakhadiran;
            $item['jumlah_hari'] = $k->jumlah_hari;
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
            'ket_ketidakhadiran' => 'required',
            'jumlah_hari' => 'required_if:ket_ketidakhadiran,!=,Tidak Ada',
            'nilai_konversi' => 'required',
        ]);

        // response error validation
        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        };

        $presensi = new KonversiKetidakhadiran();
        $presensi->ket_ketidakhadiran = $request->ket_ketidakhadiran;
        $presensi->jumlah_hari = $request->jumlah_hari;
        $presensi->nilai_konversi = $request->nilai_konversi;
        $presensi->save();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menambahkan data nilai konversi ketidakhadiran siswa',
        ], 201);
    }

    public function updateData(Request $request, $id)
    {
        $find = KonversiKetidakhadiran::where('id',$id)->first();

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
            $request->ket_ketidakhadiran != null ? $find->ket_ketidakhadiran = $request->ket_ketidakhadiran : true;
            $request->jumlah_hari != null ? $find->jumlah_hari = $request->jumlah_hari : true;
            $request->nilai_konversi != null ? $find->nilai_konversi = $request->nilai_konversi : true;

            $find->save();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil melakukan update data nilai konversi presensi siswa',
            ], 201);
        }
    }

    public function deleteData($id)
    {
        $find = KonversiKetidakhadiran::where('id',$id)->first();

        if(!$find)
        {
            return response()->json([
                'success' => false,
                'message' => 'Update data gagal!, data tidak ditemukan',
            ], 400);
        }
        else
        {
            $hapus = KonversiKetidakhadiran::where('id',$id)->delete();

            if($hapus)
            {
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil menghapus data nilai konversi presensi siswa',
                ], 201);
            }
            else
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat menghapus data nilai konversi presensi siswa',
                ], 400);
            }
        }
    }

    
}
