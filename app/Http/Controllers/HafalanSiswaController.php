<?php

namespace App\Http\Controllers;

use App\Exports\HafalanSiswaExport;
use App\Exports\HafalanSiswaTemplate;
use App\Imports\HafalanSiswaImport;
use App\Models\HafalanSiswa;
use App\Models\MasterSiswa;
use App\Models\TahunAjar;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel;

class HafalanSiswaController extends Controller
{
    public function index()
    {
        return view('admin.data_nilai.hafalan.index');
    }

    public function listHafalan(Request $request)
    {
        // Data Dummy
        $columns = [
            0 => 'id',
            1 => 'nama_siswa',
            2 => 'ket_hafalan',
            3 => 'nilai',
        ];

        $start = $request->start;
        $limit = $request->length;
        $orderColumn = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search')['value'];

        // hitung keseluruhan
        $hitung = HafalanSiswa::count();

        $hafalan = HafalanSiswa::where(function ($q) use ($search){
            if($search != null)
            {
                return $q->where('tajar_id','LIKE','%'.$search.'%')->where('siswa_id','LIKE','%'.$search.'%')->where('jurusan_id','LIKE','%'.$search.'%')->where('ket_hafalan','LIKE','%'.$search.'%');
            }
        })->orderby($orderColumn, $dir)->skip($start)->take($limit)->get();

        $data = array();
        foreach($hafalan as $h)
        {
            $item['id'] = $h->id;
            $item['id_siswa_nama'] = $h->siswa_id;
            $item['nama_siswa'] = $h->siswa->name ?? '';
            $item['ket_hafalan'] = $h->ket_hafalan;
            $item['nilai'] = $h->nilai;
            $data[] = $item;
        }

        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $hitung,
            'recordsFiltered' => $hitung,
            'data' => $data,
        ], 200);
    }

    public function listDetailHafalan(Request $request)
    {
        // Data Dummy
        $columns = [
            0 => 'id',
            1 => 'nama_siswa',
            2 => 'ket_hafalan',
            3 => 'nilai',
            4 => 'jurusan',
            5 => 'semester',
            6 => 'tahun_ajar',
        ];

        $start = $request->start;
        $limit = $request->length;
        $orderColumn = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search')['value'];

        // Hitung Keseluruhan
        $hitung = HafalanSiswa::count();

        $hafalan = HafalanSiswa::where(function ($q) use ($search) {
            if($search != null)
            {
                return $q->where('tajar_id','LIKE','%'.$search.'%')->where('siswa_id','LIKE','%'.$search.'%')->where('jurusan_id','LIKE','%'.$search.'%')->where('ket_hafalan','LIKE','%'.$search.'%');
            }
        })->orderby($orderColumn, $dir)->skip($start)->take($limit)->get();

        $data = array();
        foreach($hafalan as $h)
        {
            $item['id'] = $h->id;
            $item['nama_siswa'] = $h->siswa->name ?? '';
            $item['ket_hafalan'] = $h->ket_hafalan;
            $item['nilai'] = $h->nilai;
            $item['jurusan'] = $h->jurusan->name ?? '';
            $item['semester'] = $h->tajar->semester ?? '';
            $item['tahun_ajar'] = $h->tajar->tahun ?? '';
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
            $data[] = $item;
        }

        return response()->json([
            'data' => $data
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
            'data' => $data
        ], 200);
    }

    public function updateData(Request $request, $id)
    {
        $find = HafalanSiswa::where('id', $id)->first();

        if(!$find)
        {
            return response()->json([
                'success' => false,
                'message' => 'Update data gagal! data tidak ditemukan',
            ], 400);
        }
        else
        {
            $request->siswa_id != null ? $find->siswa_id = $request->siswa_id : true;
            $request->ket_hafalan != null ? $find->ket_hafalan = $request->ket_hafalan : true;
            $request->nilai != null ? $find->nilai = $request->nilai : true;
            $find->save();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil melakukan update data nilai hafalan siswa',
            ], 201);
        }
    }

    public function deleteData($id)
    {
        $find = HafalanSiswa::where('id', $id)->first();

        if(!$find)
        {
            return response()->json([
                'success' => false,
                'message' => 'Hapus data gagal! data tidak ditemukan',
            ], 400);
        }
        else
        {
            $hapus = HafalanSiswa::where('id', $id)->delete();

            if($hapus)
            {
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil melakukan hapus data nilai hafalan siswa',
                ], 201);
            }
            else
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat menghapus data hafalan siswa',
                ], 400);
            }
        }
    }

    public function template(Request $request)
    {
        return Excel::download(new HafalanSiswaTemplate($request->tajar), 'Template-Hafalan-Siswa.xlsx');
    }

    public function importData(Request $request)
    {
        // validasi data import
        $request->validate([
            'excel' => 'required|mimes:xls,xlsx',
        ]);

        // proses import data
        $file = $request->file('excel');

        Excel::import(new HafalanSiswaImport, $file);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil melakukan import hafalan siswa',
        ], 201);
    }

    public function exportData(Request $request)
    {
        $hafalan = HafalanSiswa::all();
        $data = [];

        foreach ($hafalan as $h)
        {
            $item['id'] = $h->id;
            $item['nama_siswa'] = $h->siswa->name ?? '';
            $item['ket_hafalan'] = $h->ket_hafalan;
            $item['nilai'] = $h->nilai;
            $item['jurusan'] = $h->jurusan->name ?? '';
            $item['semester'] = $h->tajar->semester ?? '';
            $item['tahun_ajar'] = $h->tajar->tahun ?? '';
            $data[] = $item;
        }
        return Excel::download(new HafalanSiswaExport($data), 'Export-Hafalan-Siswa.xlsx');
    }

}
