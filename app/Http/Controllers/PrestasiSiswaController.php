<?php

namespace App\Http\Controllers;

use App\Exports\PrestasiSiswaExport;
use App\Exports\PrestasiSiswaTemplate;
use App\Imports\PrestasiSiswaImport;
use App\Models\MasterJurusanSiswa;
use App\Models\MasterSiswa;
use App\Models\PrestasiSiswa;
use App\Models\TahunAjar;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel;

class PrestasiSiswaController extends Controller
{
    public function index()
    {
        return view('admin.data_nilai.prestasi.index');
    }

    public function listPrestasi(Request $request)
    {
        // Data/Function Dummy
        $columns = [
            0 => 'id',
            1 => 'tajar_id',
            2 => 'siswa_id',
            3 => 'jurusan_id',
            4 => 'ket_prestasi',
            5 => 'nilai',
        ];

        $start = $request->start;
        $limit = $request->length;
        $orderColumnIndex = $request->input('order.0.column');
        $orderColumn = isset($columns[$orderColumnIndex]) ? $columns [$orderColumnIndex] : 'id';
        $dir = $request->input('order.0.dir');
        $search = $request->input('search')['value'];
        $jurusanId = $request->input('jurusan_id');

        // Hitung Keseluruhan tanpa paginasi
        $totalData = PrestasiSiswa::count();

        // Query search and paginasi
        $query = PrestasiSiswa::with(['tajar','siswa','jurusan'])
            ->when($jurusanId && $jurusanId != '-1', function ($q) use ($jurusanId) {
                $q->whereHas('jurusan', function ($query) use ($jurusanId){
                    $query->where('jurusan_id', $jurusanId);
                });
            })
            ->when(empty($jurusanid) || $jurusanId == '-1', function ($q) {
            })  
            ->when($search, function ($query) use ($search) {
                $query->whereHas('tajar', function ($q) use ($search) {
                    $q->where('periode','LIKE','%'.$search.'%')
                    ->orWhere('semester','LIKE','%'.$search.'%');
                })
                ->orWhereHas('siswa', function ($q) use ($search) {
                    $q->where('name','LIKE','%'.$search.'%');
                })
                ->orWhereHas('jurusan', function ($q) use ($search) {
                    $q->where('name','LIKE','%'.$search.'%');
                })
                ->orWhere('ket_prestasi','LIKE','%'.$search.'%')
                ->orWhere('nilai','LIKE','%'.$search.'%');
            });

        // Hitung total filtered berdasarkan pencarian
        $totalFiltered = $query->count();

        // Ambil data prestasi sesuai paginasi dan pencarian
        $prestasi = $query->orderBy($orderColumn, $dir)
            ->skip($start)
            ->take($limit)
            ->get();

        $data = array();
        foreach ($prestasi as $p)
        {
            $item['id'] = $p->id;
            $item['id_siswa_nama'] = $p->siswa_id;
            $item['nama_siswa'] = $p->siswa->name ?? '';
            $item['ket_prestasi'] = $p->ket_prestasi;
            $item['id_jurusan_nama'] = $p->jurusan_id;
            $item['jurusan'] = $p->jurusan->name ?? '';
            $item['id_tajar_semester'] = $p->tajar_id;
            $item['semester'] = $p->tajar->semester ?? '';
            $item['id_tajar_periode'] = $p->tajar_id;
            $item['tahun_ajar'] = $p->tajar->periode ?? '';
            $item['nilai'] = $p->nilai;
            $data[] = $item; 
        }

        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalFiltered,
            'data' => $data,
        ], 200);
    }

    // public function listDetailPrestasi(Request $request)
    // {
    //     // Data / Function Dummy
    //     $columns = [
    //         0 => 'id',
    //         1 => 'nama_siswa',
    //         2 => 'ket_prestasi',
    //         3 => 'nilai',
    //         4 => 'jurusan',
    //         5 => 'semester',
    //         6 => 'tahun_ajar',
    //     ];

    //     $start = $request->start;
    //     $limit = $request->length;
    //     $orderColumn = $columns[$request->input('order.0.column')];
    //     $dir = $request->input('order.0.dir');
    //     $search = $request->input('search')['value'];

    //     // Hitung Keseluruhan
    //     $hitung = PrestasiSiswa::count();

    //     $prestasi = PrestasiSiswa::where(function ($q) use ($search) {
    //         if ($search != null)
    //         {
    //             return $q->where('tajar_id','LIKE','%'.$search.'%')->orWhere('siswa_id','LIKE','%'.$search.'%')->orWhere('jurusan_id','LIKE','%'.$search.'%')->orWhere('ket_prestasi',$search);
    //         }
    //     })->orderby($orderColumn, $dir)->skip($start)->take($limit)->get();

    //     $data = array();
    //     foreach ($prestasi as $p)
    //     {
    //         $item['id'] = $p->id;
    //         $item['nama_siswa'] = $p->siswa->name ?? '';
    //         $item['ket_prestasi'] = $p->ket_prestasi;
    //         $item['nilai'] = $p->nilai;
    //         $item['jurusan'] = $p->jurusan->name ?? '';
    //         $item['semester'] = $p->tajar->semester ?? '';
    //         $item['tahun_ajar'] = $p->tajar->periode ?? '';
    //         $data[] = $item;
    //     }

    //     return response()->json([
    //         'draw' => $request->draw,
    //         'recordsTotal' => $hitung,
    //         'recordsFiltered' => $hitung,
    //         'data' => $data,
    //     ], 200);
    // }

    public function updateData(Request $request, $id)
    {
        $find = PrestasiSiswa::where('id', $id)->first();

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
            $request->ket_prestasi != null ? $find->ket_prestasi = $request->ket_prestasi : true;
            $request->nilai != null ? $find->nilai = $this->getNilaiBasedOnPrestasi($request->ket_prestasi) : true; // Nilai Otomatis berdasarkan keterangan prestaasi (getNilai)
            $request->jurusan_id != null ? $find->jurusan_id = $request->jurusan_id : true;
            $request->tajar_id != null ? $find->tajar_id = $request->tajar_id : true;
            $request->tajar_id != null ? $find->tajar_id = $request->tajar_id : true;
            $find->save();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil melakukan update data nilai prestasi siswa',
            ], 201);
        }
    }

    public function deleteData($id)
    {
        $find = PrestasiSiswa::where('id', $id)->first();

        if (!$find)
        {
            return response()->json([
                'success' => false,
                'message' => 'Delete data gagal!, data tidak ditemukan',
            ], 400);
        }
        else
        {
            $hapus = PrestasiSiswa::where('id', $id)->delete();

            if ($hapus)
            {
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil menghapus data nilai prestasi siswa',
                ], 201);
            }
            else
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat menghapus data nilai prestasi siswa',
                ], 400);
            }
        }
    }

    private function getNilaiBasedOnPrestasi($ket_prestasi)
    {
        $nilaiMapping = [
            'Tingkat Internasional Juara 1' => 12,
            'Tingkat Internasional Juara 2' => 11,
            'Tingkat Internasional Juara 3' => 10,
            'Tingkat Nasional Juara 1' => 9,
            'Tingkat Nasional Juara 2' => 8,
            'Tingkat Nasional Juara 3' => 7,
            'Tingkat Provinsi Juara 1' => 6,
            'Tingkat Provinsi Juara 2' => 5,
            'Tingkat Provinsi Juara 3' => 4,
            'Tingkat Kabupaten/Kota Juara 1' => 3,
            'Tingkat Kabupaten/Kota Juara 2' => 2,
            'Tingkat Kabupaten/Kota Juara 3' => 1,
            'Tidak Ada' => 0,
        ];
        return $nilaiMapping[$ket_prestasi] ?? 0; // Nilai Default jika keterangan sikap tidak di temukan
    }

    public function getNilai(Request $request)
    {
        $ket_prestasi = $request->ket_prestasi;
        $nilai = $this->getNilaiBasedOnPrestasi($ket_prestasi);

        return response()->json([
            'nilai' => $nilai,
        ], 200);
    }
    
    public function supportTajar()
    {
        $tajar = TahunAjar::all();
        $data = array();
        foreach ($tajar as $t)
        {
            $item['id'] = $t->id;
            $item['name'] = $t->name;
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
            'data' => $data,
        ]);
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

    public function template(Request $request)
    {
        return Excel::download(new PrestasiSiswaTemplate($request->tajar), 'Template-Prestasi-Siswa.xlsx');
    }

    public function importData(Request $request)
    {
        // Validasi Data Import
        $request->validate([
            'excel' => 'required|mimes:xls,xlsx',
        ]);

        // Proses Import Data
        $file = $request->file('excel');
        $selectedTahunAjar = $request->input('selected_tahun_ajar');

        Excel::import(new PrestasiSiswaImport($selectedTahunAjar), $file);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil melakukan import prestasi siswa',
        ], 201);
    }

    public function exportData()
    {
        $prestasi = PrestasiSiswa::all();
        $data = array();
        foreach($prestasi as $p)
        {
            $item['id'] = $p->id;
            $item['nama_siswa'] = $p->siswa->name ?? '';
            $item['ket_prestasi'] = $p->ket_prestasi;
            $item['nilai'] = $p->nilai;
            $item['jurusan'] = $p->jurusan->name ?? '';
            $item['semester'] = $p->tajar->name ?? '';
            $item['tahun_ajar'] = $p->tajar->periode ?? '';
            $data[] = $item;
        }

        return Excel::download(new PrestasiSiswaExport($data), 'Data-Prestasi-Siswa.xlsx');
    }
    
}
