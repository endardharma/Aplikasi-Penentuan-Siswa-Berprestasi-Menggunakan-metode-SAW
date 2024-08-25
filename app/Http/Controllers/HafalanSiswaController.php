<?php

namespace App\Http\Controllers;

use App\Exports\HafalanSiswaExport;
use App\Exports\HafalanSiswaTemplate;
use App\Exports\HafalanSiswaTemplateIis;
use App\Imports\HafalanSiswaImport;
use App\Models\HafalanSiswa;
use App\Models\MasterJurusanSiswa;
use App\Models\MasterSiswa;
use App\Models\TahunAjar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
            1 => 'tajar_id',
            2 => 'siswa_id',
            3 => 'jurusan_id',
            4 => 'ket_hafalan',
            5 => 'nilai',
        ];

        $start = $request->start;
        $limit = $request->length;
        $orderColumnIndex = $request->input('order.0.column');
        $orderColumn = isset($columns[$orderColumnIndex]) ? $columns [$orderColumnIndex] : 'id';
        $dir = $request->input('order.0.dir');
        $search = $request->input('search')['value'];
        $jurusanId = $request->input('jurusan_id');
        $kelasId = $request->input('kelas_id');

        // Hitung total keseluruhan data tanpa paginasi dan pencarian
        $totalData = MasterSiswa::count();

        // Query mendapatkan data rapor siswa berdasarkan pencarian dan paginasi
        $query = MasterSiswa::with(['tajar','jurusan'])
            ->when($jurusanId && $jurusanId != '-1', function ($q) use ($jurusanId) {
                $q->whereHas('jurusan', function ($query) use ($jurusanId){
                    $query->where('jurusan_id', $jurusanId);
                });
            })
            ->when(empty($jurusanid) || $jurusanId == '-1', function ($q) {
            })    
            ->when($search, function ($query) use ($search) {
                $query->whereHas('jurusan', function ($q) use ($search) {
                    $q->where('name','LIKE','%'.$search.'%');
                })
                ->orWhereHas('tajar', function ($q) use ($search) {
                    $q->where('periode','LIKE','%'.$search.'%')
                    ->orWhere('semester','LIKE','%'.$search.'%');
                });
            })
            ->when($kelasId, function ($q) use ($kelasId) {
                $q->where('kelas_id', $kelasId);
            });
        
        // Hitung total filtered sesuai dengan pencarian
        $totalFiltered = $query->count();

        // Ambil data rapor sesuai dengan paginasi dan urutan
        $hafalan = $query
            ->orderBy($orderColumn, $dir)
            ->skip($start)
            ->take($limit)
            ->get();

        $data = array();
        foreach($hafalan as $h)
        {
            $item['id'] = $h->id;
            $item['nama_siswa'] = $h->name ?? '';
            $item['jurusan'] = $h->jurusan->name ?? '';
            $item['semester'] = $h->tajar->semester ?? '';
            $item['tahun_ajar'] = $h->tajar->periode ?? '';
            $data[] = $item;
        }

        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalFiltered,
            'data' => $data,
        ], 200);
    }

    public function listDetailHafalan(Request $request)
    {
        $siswaId = $request->input('siswa_id');

        // Data Dummy
        $columns = [
            0 => 'id',
            1 => 'nama_siswa',
            2 => 'siswa_id',
            3 => 'ket_hafalan',
            4 => 'nilai',
        ];

        $start = $request->start;
        $limit = $request->length;
        $orderColumn = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search')['value'];

        // Hitung Keseluruhan
        $hitung = HafalanSiswa::where('siswa_id', $siswaId)->count();

        $hafalan = Hafalansiswa::with(['siswa', 'jurusan', 'tajar'])
            ->where('siswa_id', $siswaId)
            ->when($search, function ($query, $search) {
                return $query->where('ket_hafalan','LIKE','%'.$search.'%')
                        ->orWhere('nilai','LIKE','%'.$search.'%')
                        ->orWhere('jurusan_id','LIKE','%'.$search.'%')
                        ->orWhere('tajar_id','LIKE','%'.$search.'%');
            })
            ->orderBy($orderColumn, $dir)
            ->skip($start)
            ->take($limit)
            ->get();

        $data = array();
        foreach($hafalan as $h)
        {
            $item['id'] = $h->id;
            $item['id_siswa_nama'] = $h->siswa_id;
            $item['nama_siswa'] = $h->siswa->name ?? '';
            $item['ket_hafalan'] = $h->ket_hafalan;
            $item['nilai'] = $h->nilai;
            $item['id_jurusan_nama'] = $h->jurusan_id;
            $item['jurusan'] = $h->jurusan->name ?? '';
            $item['id_tajar_periode'] = $h->tajar_id;
            $item['tahun_ajar'] = $h->tajar->periode ?? '';
            $data[] = $item; 
        }

        return response()->json([
            'draw' => intval($request->draw),
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
            $item['semester'] = $t->semester;
            $item['periode'] = $t->periode;
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

    public function supportJurusan()
    {
        $jurusan = MasterJurusanSiswa::all();
        $data = array();

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

    public function tambahData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'siswa_id' => 'required',
            'ket_hafalan' => 'required',
            'nilai' => 'required',
            'jurusan_id' => 'required',
            'tajar_id' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        };

        $hafalan = new HafalanSiswa();
        $hafalan->siswa_id = $request->siswa_id;
        $hafalan->ket_hafalan = $request->ket_hafalan;
        $hafalan->nilai = $request->nilai;
        $hafalan->jurusan_id = $request->jurusan_id;
        $hafalan->tajar_id = $request->tajar_id;

        $hafalan->save();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menambahkan data nilai hafalan siswa',
        ], 201);
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
            $request->jurusan_id != null ? $find->jurusan_id = $request->jurusan_id : true;
            $request->tajar_id != null ? $find->tajar_id = $request->tajar_id : true;
            $find->save();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil melakukan update data nilai hafalan siswa',
            ], 201);
        }
    }

    public function deleteData($id)
    {
        $find = HafalanSiswa::find($id);

        if(!$find)
        {
            return response()->json([
                'success' => false,
                'message' => 'Hapus data gagal! data tidak ditemukan',
            ], 400);
        }
        else
        {
            $hapus = HafalanSiswa::where('siswa_id', $find->id)->delete();

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

    public function deleteDataDetail($id)
    {
        // $find = HafalanSiswa::find($id);
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
            // $hapus = HafalanSiswa::where('siswa_id', $find->id)->delete();
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

    public function templateMipa(Request $request)
    {
        return Excel::download(new HafalanSiswaTemplate($request->tajar), 'Template-Hafalan-Siswa-Mipa.xlsx');
    }

    public function templateIis(Request $request)
    {
        return Excel::download(new HafalanSiswaTemplateIis($request->tajar), 'Template-Hafalan-Siswa-Iis.xlsx');
    }

    public function importData(Request $request)
    {
        // validasi data import
        $request->validate([
            'excel' => 'required|mimes:xls,xlsx',
        ]);

        // proses import data
        $file = $request->file('excel');
        $selectedTahunAjar = $request->input('selected_tahun_ajar');
        $selectedJurusan = $request->input('selected_jurusan');

        Excel::import(new HafalanSiswaImport($selectedTahunAjar, $selectedJurusan), $file);

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
            $item['tahun_ajar'] = $h->tajar->periode ?? '';
            $data[] = $item;
        }
        return Excel::download(new HafalanSiswaExport($data), 'Export-Hafalan-Siswa.xlsx');
    }

}
