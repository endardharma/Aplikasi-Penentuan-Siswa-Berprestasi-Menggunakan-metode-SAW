<?php

namespace App\Http\Controllers;

use App\Exports\KeterlambatanSiswaExport;
use App\Exports\KeterlambatanSiswaTemplate;
use App\Exports\KeterlambatanSiswaTemplateIis;
use App\Imports\KeterlambatanSiswaImport;
use App\Models\KeterlambatanSiswa;
use App\Models\MasterJurusanSiswa;
use App\Models\MasterSiswa;
use App\Models\TahunAjar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel;

class KeterlambatanSiswaController extends Controller
{
    public function index()
    {
        return view('admin.data_nilai.keterlambatan.index');
    }

    public function listKeterlambatan(Request $request)
    {
        // Data/Funtion Dummy
        $columns = [
            0 => 'id',
            1 => 'tajar_id',
            2 => 'siswa_id',
            3 => 'jurusan_id',
            4 => 'jumlah_keterlambatan',
            5 => 'nilai',
        ];

        $start = $request->start;
        $limit = $request->length;
        $orderColumnIndex = $request->input('order.0.column');
        $orderColumn = isset($columns [$orderColumnIndex]) ? $columns [$orderColumnIndex] : 'id';
        $dir = $request->input('order.0.dir');
        $search = $request->input('search')['value'];
        $jurusanId = $request->input('jurusan_id');


        // Hitung total keterlambatan berdasarkan pencarian dan paginasi
        $totalData = KeterlambatanSiswa::count();

        // Query mendapatkan data keterlambatan berdasarkan pencarian dan paginasi
        $query = KeterlambatanSiswa::with(['tajar','siswa','jurusan'])
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
                ->orWhere('jumlah_keterlambatan','LIKE','%'.$search.'%')
                ->orWhere('nilai','LIKE','%'.$search.'%');
            });
        
        // Hitung total filtered sesuai dengan pencarian
        $totalFiltered = $query->count();

        // Ambil data keterlambatan sesuai dengan paginasi dan urutan
        $keterlambatan = $query->orderBy($orderColumn, $dir)
            ->skip($start)
            ->take($limit)
            ->get();

        $data = array();
        foreach($keterlambatan as $k)
        {
            $item['id'] = $k->id;
            $item['id_siswa_nama'] = $k->siswa_id;

            $item['nama_siswa'] = $k->siswa->name ?? '';
            $item['jumlah_keterlambatan'] = $k->jumlah_keterlambatan;
            
            $item['nilai'] = $k -> nilai;
            
            $item['id_jurusan_nama'] = $k->jurusan_id;
            $item['jurusan'] = $k->jurusan->name ?? '';
            
            $item['id_tajar_semester'] = $k->tajar_id;
            $item['semester'] = $k->tajar->semester ?? '';
            
            $item['id_tajar_periode'] = $k->tajar_id;
            $item['tahun_ajar'] = $k->tajar->periode ?? '';

            $data[] = $item;
        }

        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalFiltered,
            'data' => $data,
        ], 200);
    }

    // public function listDetailKeterlambatan(Request $request)
    // {
    //     // Data/Funtion Dummy
    //     $columns = [
    //         0 => 'id',
    //         1 => 'nama_siswa',
    //         2 => 'jumlah_keterlambatan',
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

    //     // HitungKeseluruhan
    //     $hitung = KeterlambatanSiswa::count();

    //     $keterlambatan = KeterlambatanSiswa::where(function ($q) use ($search) {
    //         if($search != null)
    //         {
    //             return $q->where('tajar_id','LIKE','%'.$search.'%')->orWhere('siswa_id','LIKE','%'.$search.'%')->orWhere('jurusan_id','LIKE','%'.$search.'%');
    //         }
    //     })->orderby($orderColumn, $dir)->skip($start)->take($limit)->get();

    //     $data = array();
    //     foreach($keterlambatan as $k)
    //     {
    //         $item['id'] = $k->id;
    //         $item['nama_siswa'] = $k->siswa->name ?? '';
    //         $item['jumlah_keterlambatan'] = $k->jumlah_keterlambatan;
    //         $item['nilai'] = $k -> nilai;
    //         $item['jurusan'] = $k->jurusan->name ?? '';
    //         $item['semester'] = $k->tajar->semester ?? '';
    //         $item['tahun_ajar'] = $k->tajar->periode ?? '';
    //         $data[] = $item;
    //     }

    //     return response()->json([
    //         'draw' => $request->draw,
    //         'recordsTotal' => $hitung,
    //         'recordsFiltered' => $hitung,
    //         'data' => $data,
    //     ], 200);
    // }

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
            'jumlah_keterlambatan' => 'required',
            'nilai' => 'required',
            'jurusan_id' => 'required',
            'tajar_id' => 'required',
        ]); 

        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        };

        $keterlambatan = new KeterlambatanSiswa();
        $keterlambatan->siswa_id = $request->siswa_id;
        $keterlambatan->jumlah_keterlambatan = $request->jumlah_keterlambatan;
        $keterlambatan->nilai = $this->getNilaiBasedOnKeterlambatan($request->jumlah_keterlambatan);
        $keterlambatan->jurusan_id = $request->jurusan_id;
        $keterlambatan->tajar_id = $request->tajar_id;
        $keterlambatan->save();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menambahkan data keterlambatan siswa',
        ], 201);
    }

    public function updateData(Request $request, $id)
    {
        $find = KeterlambatanSiswa::where('id', $id)->first();

        if(!$find)
        {
            return response()->json([
                'success' => false,
                'message' => 'Update data gagal!, data tidak ditemukan',
            ], 400);
        }
        else
        {
            $request->siswa_id != null ? $find->siswa_id = $request->siswa_id :  true;
            $request->jumlah_keterlambatan != null ? $find->jumlah_keterlambatan = $request->jumlah_keterlambatan : true;
            $request->nilai != null ? $find->nilai = $this->getNilaiBasedOnKeterlambatan($request->jumlah_keterlambatan) : true; // Nilai otomatis berdasarkan jumlah keterlambatan
            $request->jurusan_id != null ? $find->jurusan_id = $request->jurusan_id : true;
            $request->tajar_id != null ? $find->tajar_id = $request->tajar_id : true;
            $request->tajar_id != null ? $find->tajar_id = $request->tajar_id : true;
            $find->save();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil melakukan update data nilai keterlambatan siswa',
            ], 201);
        }
    }

    private function getNilaiBasedOnKeterlambatan($jumlah_keterlambatan)
    {
        $nilaiMapping = [
            '0 Kali' => 5,
            '1-2 Kali' => 4,
            '3-4 Kali' => 3,
            '5-6 Kali' => 2,
            '> 7 Kali' => 1,
        ];

        return $nilaiMapping[$jumlah_keterlambatan] ?? 0;
    }

    public function getNilai(Request $request)
    {
        $jumlah_keterlambatan = $request->jumlah_keterlambatan;
        $nilai = $this->getNilaiBasedOnKeterlambatan($jumlah_keterlambatan);

        return response()->json([
            'nilai' => $nilai
        ], 201);
    }

    public function deleteData($id)
    {
        $find = KeterlambatanSiswa::where('id', $id)->first();

        if(!$find)
        {
            return response()->json([
                'success' => false,
                'message' => 'Delete data gagal! data tidak ditemukan',
            ], 400);
        }
        else
        {
            $hapus = KeterlambatanSiswa::where('id', $id)->delete();

            if ($hapus)
            {
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil menghapus data nilai keterlambatan siswa',
                ], 201);
            }
            else
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat menghapus data nilai keterlambatan siswa',
                ], 400);
            }
        }
    }

    public function templateMipa(Request $request)
    {
        return Excel::download(new KeterlambatanSiswaTemplate($request->tajar), 'Template-Keterlambatan-Siswa-Mipa.xlsx');
    }
    
    public function templateIis(Request $request)
    {
        return Excel::download(new KeterlambatanSiswaTemplateIis($request->tajar), 'Template-Keterlambatan-Siswa-Iis.xlsx');
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
        $selectedJurusan = $request->input('selected_jurusan');
        
        Excel::import(new KeterlambatanSiswaImport($selectedTahunAjar, $selectedJurusan, function($jumlah_keterlambatan){
            return $this->getNilaiBasedOnKeterlambatan($jumlah_keterlambatan);
        }), $file);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil melakukan import keterlambatan siswa',
        ], 201);
    }

    public function exportData()
    {
        $keterlambatan = KeterlambatanSiswa::all();
        $data = array();
        foreach($keterlambatan as $k)
        {
            $item['id'] = $k->id;
            $item['nama_siswa'] = $k->siswa->name ?? '';
            $item['jumlah_keterlambatan'] = $k->jumlah_keterlambatan;
            $item['nilai'] = $k->nilai;
            $item['jurusan'] = $k->jurusan->name ?? '';
            $item['tahun_ajar'] = $k->tajar->periode ?? '';
            $data[] = $item;
        }

        return Excel::download(new KeterlambatanSiswaExport($data), 'Data-Keterlambatan-Siswa.xlsx');
    }
}
