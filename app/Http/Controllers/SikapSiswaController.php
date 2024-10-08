<?php

namespace App\Http\Controllers;

use App\Exports\SikapSiswaExport;
use App\Exports\SikapSiswaTemplate;
use App\Exports\SikapSiswaTemplateIis;
use App\Imports\SikapSiswaImport;
use App\Models\KonversiSikap;
use App\Models\MasterJurusanSiswa;
use App\Models\MasterSiswa;
use App\Models\SikapSiswa;
use App\Models\TahunAjar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class SikapSiswaController extends Controller
{
    public function index()
    {
        return view('admin.data_nilai.sikap.index');
    }

    public function listSikap(Request $request)
    {
        // Data/Function Dummy
        $columns = [
            0 => 'id',
            1 => 'tajar_id',
            2 => 'siswa_id',
            3 => 'jurusan_id',
            4 => 'konversi_sikap_id',
        ];

        $start = $request->start;
        $limit = $request->length;
        $orderColumnIndex = $request->input('order.0.column');
        $orderColumn = isset($columns[$orderColumnIndex]) ? $columns [$orderColumnIndex] : 'id';
        $dir = $request->input('order.0.dir');
        $search = $request->input('search')['value'];
        $jurusanId = $request->input('jurusan_id');

        // Hitung total keseluruhan data tanpa paginasi dan pencarian
        $totalData = SikapSiswa::count();

        // Query mendapatkan data sikap siswa berdasarkan pencarian dan paginasi
        $query = SikapSiswa::with(['tajar','siswa','jurusan', 'konversiSikap'])
            ->when($jurusanId && $jurusanId != '-1', function ($q) use ($jurusanId) {
                $q->whereHas('jurusan', function ($query) use ($jurusanId) {
                    $query->where('jurusan_id', $jurusanId);
                });
            })
            ->when(empty($jurusanId) || $jurusanId == '-1', function ($q) {
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

                ->orWhereHas('konversiSikap', function ($q) use ($search) {
                    $q->where('ket_sikap','LIKE','%'.$search.'%')
                    ->orWhere('nilai_konversi','LIKE','%'.$search.'%');
                });
                // ->orWhere('ket_sikap','LIKE','%'.$search.'%')
                // ->orWhere('nilai','LIKE','%'.$search.'%');
            });

        // Hitung totla filtered sesuai dengan pencarian
        $totalFiltered = $query->count();

        // Ambil data sikap siswa sesuai dengan paginasi dan urutan
        $sikap = $query
            ->orderBy($orderColumn, $dir)
            ->skip($start)
            ->take($limit)
            ->get();

        $data = array();
        foreach($sikap as $s)
        {
            $item['id'] = $s->id;
            $item['id_siswa_nama'] = $s->siswa_id;
            $item['nama_siswa'] = $s->siswa->name ?? '';

            $item['id_konversi_sikap_keterangan'] = $s->konversi_sikap_id;
            $item['ket_sikap'] = $s->konversiSikap->ket_sikap ?? '';

            $item['id_konversi_sikap_nilai'] = $s->konversi_sikap_id;
            $item['nilai'] = $s->konversiSikap->nilai_konversi ?? '' ;
            
            $item['id_jurusan_nama'] = $s->jurusan_id;
            $item['jurusan'] = $s->jurusan->name ?? '';

            $item['id_tajar_periode'] = $s->tajar_id;
            $item['tahun_ajar'] = $s->tajar->periode ?? '';
            $data[] = $item;
        }

        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalFiltered,
            'data' => $data,
        ], 200);
    }

    // public function listDetailSikap(Request $request)
    // {
    //     // Data/Function Dummy
    //     $columns = [
    //         0 => 'id',
    //         1 => 'nama_siswa',
    //         2 => 'ket_sikap',
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
    //     $hitung = SikapSiswa::count();

    //     $sikap = SikapSiswa::where(function($q) use ($search) {
    //         if($search != null)
    //         {
    //             return $q->where('tajar_id','LIKE','%'.$search.'%')->orWhere('jurusan_id','LIKE','%'.$search.'%')->orWhere('siswa_id','LIKE','%'.$search.'%')->orWhere('ket_sikap', $search);
    //         }
    //     })->orderby($orderColumn, $dir)->skip($start)->take($limit)->get();

    //     $data = array();
    //     foreach($sikap as $s)
    //     {
    //         $item['id'] = $s->id;
    //         $item['nama_siswa'] = $s->siswa->name ?? '';
    //         $item['ket_sikap'] = $s->ket_sikap;
    //         $item['nilai'] = $s->nilai;
    //         $item['jurusan'] = $s->siswa->name ?? '';
    //         $item['semester'] = $s->tajar->semester ?? '';
    //         $item['tahun_ajar'] = $s->tajar->periode ?? '';
    //         $data[] = $item;
    //     }

    //     return response()->json([
    //         'draw' => $request->draw,
    //         'recordsTotal' => $hitung,
    //         'recordsFIltered' => $hitung,
    //         'data' => $data,
    //     ], 200);
    // }

    public function tambahData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'siswa_id' => 'required',
            'konversi_sikap_id' => 'required',
            'jurusan_id' => 'required',
            'tajar_id' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        };

        $sikap = new SikapSiswa();
        $sikap->siswa_id = $request->siswa_id;

        // $sikap->ket_sikap = $request->ket_sikap;
        // $sikap->nilai = $this->getNilaiBasedOnSikap($request->ket_sikap);
        $sikap->konversi_sikap_id = $request->konversi_sikap_id;
        $sikap->jurusan_id = $request->jurusan_id;
        $sikap->tajar_id = $request->tajar_id;

        $sikap->save();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menambahkan data nilai sikap siswa',
        ], 201);
    }

    public function updateData(Request $request, $id)
    {
        $find = SikapSiswa::where('id', $id)->first();

        if (!$find)
        {
            return response()->json([
                'success' => false,
                'message' => 'Update data gagal!, data tidak ditemukan',
            ], 400);
        }
        else 
        {
            $request->siswa_id != null ? $find->siswa_id = $request->siswa_id : true;

            // $request->ket_sikap != null ? $find->ket_sikap = $request->ket_sikap : true;
            // $request->nilai != null ? $find->nilai = $this->getNilaiBasedOnSikap($request->ket_sikap) : true; // Nilai otomatis berdasarkan keterangan sikap
            
            $request->konversi_sikap_id != null ? $find->konversi_sikap_id = $request->konversi_sikap_id : true;
            $request->jurusan_id != null ? $find->jurusan_id = $request->jurusan_id : true;
            $request->tajar_id != null ? $find->tajar_id = $request->tajar_id : true;
            $find->save();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil melakukan update data nilai sikap siswa',
            ], 201);
        }
    }

    // private function getNilaiBasedOnSikap($ket_sikap)
    // {
    //     $nilaiMapping = [
    //         'Sangat Baik' => 5,
    //         'Baik' => 4,
    //         'Cukup' => 3,
    //         'Tidak Baik' => 2,
    //         'Sangat Tidak Baik' => 1,
    //     ];

    //     return $nilaiMapping[$ket_sikap] ?? 0; // Nilai default jika keterangan sikap tidak ditemukan
    // }
    
    // public function getNilai(Request $request)
    // {
    //     $ket_sikap = $request->ket_sikap;
    //     $nilai = $this->getNilaiBasedOnSikap($ket_sikap);

    //     return response()->json([
    //         'nilai' => $nilai
    //     ], 201);
    // }

    public function deleteData($id)
    {
        $find = SikapSiswa::where('id', $id)->first();

        if (!$find)
        {
            return response()->json([
                'success' => false,
                'message' => 'Update data gagal!, data tidak ditemukan',
            ], 400);
        }
        else
        {
            $hapus = SikapSiswa::where('id', $id)->delete();

            if ($hapus)
            {
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil menghapus data nilai sikap siswa',
                ], 201);
            }
            else
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat menghapus data nilai sikap siswa',
                ], 400);
            }
        }
    }
    
    public function supportTajar()
    {
        $tajar = TahunAjar::all();
        $data = array();
        foreach($tajar as $t)
        {
            $item['id'] = $t->id;
            $item['name'] = $t->name;
            $item['periode'] = $t->periode;
            $data[] = $item;
        }

        return response()->json([
            'data' => $data,
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

    public function supportKonversiSikap()
    {
        $jurusan = KonversiSikap::all();
        $data = array();

        foreach ($jurusan as $j)
        {
            $item['id'] = $j->id;
            $item['ket_sikap'] = $j->ket_sikap;
            $item['nilai_konversi'] = $j->nilai_konversi;
            $data[] = $item;
        }
        return response()->json([
            'data' => $data,
        ], 201);

    }

    public function templateMipa(Request $request)
    {
        return Excel::download(new SikapSiswaTemplate($request->tajar), 'Template-Sikap-Siswa-Mipa.xlsx');
    }

    public function templateIis(Request $request)
    {
        return Excel::download(new SikapSiswaTemplateIis($request->tajar), 'Template-Sikap-Siswa-Iis.xlsx');
    }

    public function importData(Request $request)
    {
        // Lakukan validasi data import
        $request->validate([
            'excel' => 'required|mimes:xls,xlsx',
        ]);

        // Proses Data import
        $file = $request->file('excel');
        $selectedTahunAjar = $request->input('selected_tahun_ajar');
        $selectedJurusan = $request->input('selected_jurusan');

        // Excel::import(new SikapSiswaImport($selectedTahunAjar, $selectedJurusan, function($ket_sikap){
        //     return $this->getNilaiBasedOnSikap($ket_sikap);
        // }), $file);

        Excel::import(new SikapSiswaImport($selectedTahunAjar, $selectedJurusan), $file);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil melakukan import sikap siswa',
        ], 201);
    }

    public function exportData()
    {
        $sikap = SikapSiswa::all();
        $data = array();

        foreach($sikap as $s)
        {
            $item['id'] = $s->id;
            $item['nama_siswa'] = $s->siswa->name ?? '';
            $item['ket_sikap'] = $s->konversiSikap->ket_sikap ?? '';
            $item['nilai'] = $s->konversiSikap->nilai_konversi ?? '';
            $item['jurusan'] = $s->jurusan->name ?? '';
            $item['tahun_ajar'] = $s->tajar->periode ?? '';
            $data[] = $item;
        }

        return excel::download(new SikapSiswaExport($data), 'Data-Sikap-Siswa.xlsx');
    }
}
