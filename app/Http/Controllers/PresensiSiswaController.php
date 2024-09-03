<?php

namespace App\Http\Controllers;

use App\Exports\PresensiSiswaExport;
use App\Exports\PresensiSiswaTemplate;
use App\Exports\PresensiSiswaTemplateIis;
use App\Imports\PresensiSiswaImport;
use App\Models\KonversiKeterlambatan;
use App\Models\KonversiKetidakhadiran;
use App\Models\MasterJurusan;
use App\Models\MasterJurusanSiswa;
use App\Models\MasterSiswa;
use App\Models\PresensiSiswa;
use App\Models\TahunAjar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class PresensiSiswaController extends Controller
{
    public function testPresensi()
    {
        // Fungsi template export dan detail presensi siswa
        $siswa = MasterSiswa::all();
        $data = array();
        foreach($siswa as $s)
        {
            $find = TahunAjar::where('tahun', date('Y'))->first();
            if($find)
            {                
                $item['nama_siswa'] = $s->name;
                $item['ket_ketidakhadiran'] = 'Tidak Ada';
                $item['nilai'] = $s->nilai;
                $item['jurusan'] = $s->jurusan->name ?? '';
                $item['semester'] = $s->semester;
                $item['tahun_ajar'] = $s->tahun_ajar;
                $data[] = $item;
            }
        }

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function index()
    {
        return view('admin.data_nilai.presensi.index');
    }

    // public function listPresensi(Request $request)
    // {
    //     // Data / Function Dummy
    //     $columns = [
    //         0 => 'id',
    //         1 => 'nama_siswa',
    //         2 => 'ket_ketidakhadiran',
    //         3 => 'jumlah_hari',
    //         4 => 'nilai',
    //     ];

    //     $start = $request->start;
    //     $limit = $request->length;
    //     $orderColumn = $columns[$request->input('order.0.column')];
    //     $dir = $request->input('order.0.dir');
    //     $search = $request->input('search')['value'];

    //     // Hitung Keseluruhan
    //     $hitung = MasterSiswa::count();

    //     $siswa = MasterSiswa::where(function ($q) use ($search) {
    //         if($search != null)
    //         {
    //             return $q->where('name','LIKE','%'.$search.'%');
    //         }
    //     })->orderby($orderColumn, $dir)->skip($start)->take($limit)->get();
    //     $presensi = PresensiSiswa::all();
    //     $data = array();
    //     // dd($presensi)->toArray();
    //     foreach($siswa as $s)
    //     {
    //         $item['id'] = $s->id;
    //         $item['nama_siswa'] = $s->name;
    //         foreach($presensi as $p)
    //         {
    //             $item['ket_ketidakhadiran'] = $p->ket_ketidakhadiran;
    //             $item['jumlah_hari'] = $p->jumlah_hari;
    //             $item['nilai'] = $p->nilai;
    //         }
    //         $data[] = $item;
    //     }
        
    //     return response()->json([
    //         'draw' => $request->draw,
    //         'recordsTotal' => $hitung,
    //         'recordsFiltered' => $hitung,
    //         'data' => $data,
    //     ], 200);
    // }

    public function listPresensi(Request $request)
    {
        // Data / function dummy
        $columns = [
            0 => 'id',
            1 => 'tajar_id',
            2 => 'siswa_id',
            3 => 'jurusan_id',
            4 => 'konversi_ketidakhadiran_id',
            // 5 => 'jumlah_hari',
            // 6 => 'jumlah_hari_lainnya',
            5 => 'nilai',
        ];

        $start = $request->start;
        $limit = $request->length;
        $orderColumnIndex = $request->input('order.0.column');
        $orderColumn = isset($columns[$orderColumnIndex]) ? $columns [$orderColumnIndex] : 'id';
        $dir = $request->input('order.0.dir');
        $search = $request->input('search')['value'];
        $jurusanId = $request->input('jurusan_id');

        // Hitung total keseluruhan data tnapa paginasi dan pencarian
        $totalData = PresensiSiswa::count();
        
        // Query mendapatkan data presensi siswa berdasarkan pencarian dan paginasi
        $query = PresensiSiswa::with(['siswa','tajar','jurusan', 'konversiKetidakhadiran'])
            ->when($jurusanId && $jurusanId != '-1', function ($q) use ($jurusanId) {
                $q->whereHas('jurusan', function ($query) use ($jurusanId){
                    $query->where('jurusan_id', $jurusanId);
                });
            })
            ->when(empty($jurusanid) || $jurusanId == '-1', function ($q) {
            })    
            ->when($search, function ($query) use ($search) {
                $query->whereHas('siswa', function ($q) use ($search) {
                    $q->where('name','LIKE','%'.$search.'%');
                })
                ->orWhereHas('tajar', function ($q) use ($search) {
                    $q->where('periode','LIKE','%'.$search.'%')
                    ->orWhere('semester','LIKE','%'.$search.'%');
                })
                ->orWhereHas('jurusan', function ($q) use ($search) {
                    $q->where('name','LIKE','%'.$search.'%');
                })
                ->orWhereHas('konversiKetidakhadiran', function ($q) use ($search) {
                    $q->where('ket_ketidakhadiran','LIKE','%'.$search.'%')
                    ->orWhere('jumlah_hari','LIKE','%'.$search.'%')
                    ->orWhere('jumlah_hari_lainnya','LIKE','%'.$search.'%')
                    ->orWhere('nilai','LIKE','%'.$search.'%');

                });
                // ->orWhere('ket_ketidakhadiran','LIKE','%'.$search.'%')
                // ->orWhere('jumlah_hari','LIKE','%'.$search.'%')
                // ->orWhere('jumlah_hari_lainnya','LIKE','%'.$search.'%')
                // ->orWhere('nilai','LIKE','%'.$search.'%');
            });
        
        // Hitung total filtered sesuai dengan pencarian
        $totalFiltered = $query->count();

        // Ambil data presensi sesuai dengan paginasi dan urutan
        $presensi = $query
            ->orderBy($orderColumn, $dir)
            ->skip($start)
            ->take($limit)
            ->get();
        
        $data = array();
        // dd($presensi)->toArray();
        foreach($presensi as $p)
        {
            $item['id'] = $p->id;

            $item['id_siswa_nama'] = $p->siswa_id;
            $item['nama_siswa'] = $p->siswa->name ?? '';
            
            // $item['ket_ketidakhadiran'] = $p->ket_ketidakhadiran;
            // $item['jumlah_hari'] = $p->jumlah_hari;
            // $item['jumlah_hari_lainnya'] = $p->jumlah_hari_lainnya;
            // $item['nilai'] = $p->nilai;

            $item['id_konversi_ketidakhadiran_keterangan'] = $p->konversi_ketidakhadiran_id;
            $item['ket_ketidakhadiran'] = $p->konversiKetidakhadiran->ket_ketidakhadiran ?? '';

            $item['id_konversi_ketidakhadiran_jumlah_hari'] = $p->jumlah_hari;
            $item['jumlah_hari'] = $p->konversiKetidakhadiran->jumlah_hari ?? '';

            // $item['id_konversi_ketidakhadiran_jumlah_hari_lainnya'] = $p->jumlah_hari_lainnya;
            // $item['jumlah_hari_lainnya'] = $p->konversiKetidakhadiran->jumlah_hari_lainnya ?? '';

            $item['id_konversi_ketidakhadiran_nilai'] = $p->id_konversi_ketidakhadiran_keterangan;
            $item['nilai'] = $p->konversiKetidakhadiran->nilai_konversi ?? '';

            $item['id_jurusan_nama'] = $p->jurusan_id;
            $item['jurusan'] = $p->jurusan->name ?? '';

            $item['id_tajar_semester'] = $p->tajar_id;
            $item['semester'] = $p->tajar->semester ?? '';

            $item['id_tajar_periode'] = $p->tajar_id;
            $item['tahun_ajar'] = $p->tajar->periode ?? '';

            $data[] = $item;
            
        }
        // dd($data)->toArray();


        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalFiltered,
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
            $item['semester'] = $t->semester;
            $item['periode'] = $t->periode;
            $data[] = $item;
        }

        return response()->json([
            'data' => $data,
        ],200);
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
        ], 201);
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

    public function supportKonversiKetidakhadiran()
    {
        $konversi = KonversiKetidakhadiran::all();
        $data = array();

        foreach ($konversi as $k)
        {
            $item['id'] = $k->id;
            $item['ket_ketidakhadiran'] = $k->ket_ketidakhadiran;
            $item['jumlah_hari'] = $k->jumlah_hari;
            $item['nilai_konversi'] = $k->nilai_konversi;
            $data[] = $item;
        }

        return response()->json([
            'data' => $data,
        ], 201);
    }

    public function templateMipa(Request $request)
    {
        return Excel::download(new PresensiSiswaTemplate($request->tajar), 'Template-Presensi-Siswa-Mipa.xlsx');
    }

    public function templateIis(Request $request)
    {
        return Excel::download(new PresensiSiswaTemplateIis($request->tajar), 'Template-presensi-Siswa-Iis.xlsx');
    }

    public function importData(Request $request)
    {
        // Lakukan Validasi data import
        $request->validate([
            'excel' => 'required|mimes:xls,xlsx',
        ]);

        // Proses data import
        $file = $request->file('excel');

        $selectedTahunAjar = $request->input('selected_tahun_ajar');
        $selectedJurusan = $request->input('selected_jurusan');

        // Excel::import(new PresensiSiswaImport($selectedTahunAjar, $selectedJurusan, function($jumlah_hari, $ket_ketidakhadiran){
        //     return $this->getNilaiBasedOnJumlahHari($jumlah_hari, $ket_ketidakhadiran);
        // }), $file);

        Excel::import(new PresensiSiswaImport($selectedTahunAjar, $selectedJurusan), $file);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil melakukan import data presensi siswa'
        ], 201);
    }

    // public function tambahData(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'siswa_id' => 'required',
    //         'konversi_ketidakhadiran_id' => 'required',
    //         // 'jumlah_hari' => 'required_if:ket_ketidakhadiran,!=,Tidak Ada',
    //         // 'jumlah_hari_lainnya' => 'required_if:jumlah_hari,lainnya',
    //         'nilai' => 'required',
    //         'jurusan_id' => 'required',
    //         'tajar_id' => 'required',
    //     ]);

    //     // response error validation
    //     if ($validator->fails()){
    //         return response()->json($validator->errors(), 400);
    //     };

    //     $presensi = new PresensiSiswa();
    //     $presensi->siswa_id = $request->siswa_id;
    //     $presensi->konversi_ketidakhadiran_id = $request->konversi_ketidakhadiran_id;
    //     $presensi->nilai = $request->nilai;

    //     // if ($request->ket_ketidakhadiran === 'Tidak Ada') {
    //     //     $presensi->jumlah_hari = '0 Hari';
    //     //     $presensi->jumlah_hari_lainnya = '0 Hari';
    //     //     $presensi->nilai = $this->getNilaiBasedOnJumlahHari($request->jumlah_hari, $request->ket_ketidakhadiran);
    //     // } else {
    //     //     $presensi->jumlah_hari = $request->jumlah_hari;
    //     //     $presensi->nilai = $this->getNilaiBasedOnJumlahHari($request->jumlah_hari, $request->ket_ketidakhadiran);
            
    //     //     if ($request->jumlah_hari !== 'lainnya') {
    //     //         $presensi->jumlah_hari_lainnya = $request->jumlah_hari_lainnya;
    //     //         $presensi->nilai = $this->getNilaiBasedOnJumlahHari($request->jumlah_hari_lainnya, $request->ket_ketidakhadiran);
    //     //     }
    //     // }
        
    //     $presensi->jurusan_id = $request->jurusan_id;
    //     $presensi->tajar_id = $request->tajar_id;
    //     $presensi->save();

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Berhasil menambahkan data nilai ketidakhadiran siswa',
    //     ], 201);
    // }

    // REVISI
    // public function tambahData(Request $request)
    // {
    //     // Validasi input
    //     $validator = Validator::make($request->all(), [
    //         'siswa_id' => 'required',
    //         'konversi_ketidakhadiran_id' => 'required',
    //         // 'nilai' => 'required', // Ini mungkin tidak perlu jika nilai diatur berdasarkan keterangan
    //         'jurusan_id' => 'required',
    //         'tajar_id' => 'required',
    //     ]);

    //     // Tanggapan jika validasi gagal
    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 400);
    //     }

    //     $konversi = KonversiKetidakhadiran::where('ket_ketidakhadiran', $request->ket_ketidakhadiran)
    //     ->where('jumlah_hari', $request->jumlah_hari)
    //     ->first();

    //     if (!$konversi) {
    //         return response()->json(['error' => 'Data konversi ketidakhadiran tidak ditemukan'], 404);
    //     }

    //     $presensi = new PresensiSiswa();
    //     $presensi->siswa_id = $request->siswa_id;
    //     $presensi->konversi_ketidakhadiran_id = $konversi->id;
    //     // $presensi->nilai = $nilai; // Menggunakan nilai dari konversi
    //     $presensi->jurusan_id = $request->jurusan_id;
    //     $presensi->tajar_id = $request->tajar_id;
    //     $presensi->save();
        
        
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Berhasil menambahkan data nilai ketidakhadiran siswa',
    //     ], 201);
    // }

    // REVISI 2
    public function tambahData(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'siswa_id' => 'required',
            'ket_ketidakhadiran' => 'required', // Menambahkan validasi untuk ket_ketidakhadiran
            'jumlah_hari' => 'required', // Menambahkan validasi untuk jumlah_hari
            'jurusan_id' => 'required',
            'tajar_id' => 'required',
        ]);
    
        // Tanggapan jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
    
        // Mencari konversi_ketidakhadiran_id berdasarkan ket_ketidakhadiran dan jumlah_hari
        $konversi = KonversiKetidakhadiran::where('ket_ketidakhadiran', $request->ket_ketidakhadiran)
                                          ->where('jumlah_hari', $request->jumlah_hari)
                                          ->first();
    
        if (!$konversi) {
            return response()->json(['error' => 'Data konversi ketidakhadiran tidak ditemukan'], 404);
        }
    
        // Membuat data baru untuk PresensiSiswa
        $presensi = new PresensiSiswa();
        $presensi->siswa_id = $request->siswa_id;
        $presensi->konversi_ketidakhadiran_id = $konversi->id; // Menggunakan ID dari tabel konversi
        $presensi->jurusan_id = $request->jurusan_id;
        $presensi->tajar_id = $request->tajar_id;
        $presensi->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Berhasil menambahkan data presensi siswa',
        ], 201);
    }
    
    
    
    
    
    public function updateData(Request $request, $id)
    {
        $find = PresensiSiswa::where('id',$id)->first();

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
            $request->konversi_ketidakhadiran_id != null ? $find->konversi_ketidakhadiran_id = $request->konversi_ketidakhadiran_id : true;
            
            // if ($request->jumlah_hari === 'lainnya')
            // if ($request->ket_ketidakhadiran === 'Tidak Ada')
            // {
            //     $find->jumlah_hari = '0 Hari';
            //     $find->jumlah_hari_lainnya = '0 Hari';
            //     $request->nilai != null ? $find->nilai = $this->getNilaiBasedOnJumlahHari($request->jumlah_hari, $request->ket_ketidakhadiran) : true; // nilai otomatis berdasarkan jumlah hari
            // } else {
            //     $request->jumlah_hari != null ? $find->jumlah_hari = $request->jumlah_hari : true;
            //     $request->nilai != null ? $find->nilai = $this->getNilaiBasedOnJumlahHari($request->jumlah_hari, $request->ket_ketidakhadiran): true;

            //     if ($request->jumlah_hari !== 'lainnya') {
            //         $request->jumlah_hari_lainnya != null ? $find->jumlah_hari_lainnya = $request->jumlah_hari_lainnya : true;
            //         $request->nilai != null ? $find->nilai = $this->getNilaiBasedOnJumlahHari($request->jumlah_hari_lainnya, $request->ket_ketidakhadiran): true;
            //     }
            // }
            
            // $request->nilai != null ? $find->nilai = $request->nilai : true;
            $request->jurusan_id != null ? $find->jurusan_id = $request->jurusan_id : true;
            $request->tajar_id != null ? $find->tajar_id = $request->tajar_id : true;

            $find->save();
            // dd($find)->toArray();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil melakukan update data nilai presensi siswa',
            ], 201);
        }
    }

    public function getNilai(Request $request)
    {
        $jumlah_hari = $request->jumlah_hari;
        $ket_ketidakhadiran = $request->ket_ketidakhadiran;
        
        // $nilai = $this->getNilaiBasedOnJumlahHari($jumlah_hari);
        $nilai = $this->getNilaiBasedOnJumlahHari($jumlah_hari, $ket_ketidakhadiran);

        return response()->json([
            'nilai' => $nilai
        ], 200);
    }

    private function getNilaiBasedOnJumlahHari($jumlah_hari, $ket_ketidakhadiran)
    {
       $nilaiMapping = [
            'Tidak Ada' => 5,
            '0 Hari' => 5,
            '1 Hari' => 4,
            '2 Hari' => 3,
            '3 Hari' => 2,
            '4 Hari' => 1,
        ];

        if ($ket_ketidakhadiran === 'Tidak Ada')
        {
            return $nilaiMapping['Tidak Ada'];
        }

        return $nilaiMapping[$jumlah_hari] ?? 0; // Nilai default jika jumlah hari tidak ditemukan / jumlah hari melebihi 4 hari
    }

    public function deleteData($id)
    {
        $find = PresensiSiswa::where('id',$id)->first();

        if(!$find)
        {
            return response()->json([
                'success' => false,
                'message' => 'Update data gagal!, data tidak ditemukan',
            ], 400);
        }
        else
        {
            $hapus = PresensiSiswa::where('id',$id)->delete();

            if($hapus)
            {
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil menghapus data nilai presensi siswa',
                ], 201);
            }
            else
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat menghapus data nilai presensi siswa',
                ], 400);
            }
        }
    }

    public function exportData()
    {
        $presensi = PresensiSiswa::all();
        $data = array();
        foreach($presensi as $p)
        {
            $item['id'] = $p->id;
            $item['tahun_ajar'] = $p->tajar->periode ?? '';
            $item['jurusan'] = $p->jurusan->name ?? '';
            $item['nama_siswa'] = $p->siswa->name ?? '';
            $item['ket_ketidakhadiran'] = $p->konversiKetidakhadiran->ket_ketidakhadiran ?? '';
            $item['jumlah_hari'] = $p->konversiKetidakhadiran->jumlah_hari ?? '';
            $item['nilai'] = $p->konversiKetidakhadiran->nilai_konversi ?? '';
            $data[] = $item;
        }
        // dd($data)->toArray();
        return Excel::download(new PresensiSiswaExport($data), 'Data-Presensi-Siswa.xlsx');
    }

    // public function exportDataIis()
    // {
    //     $presensi = PresensiSiswa::all();
    //     $data = array();
    //     foreach($presensi as $p)
    //     {
    //         $item['id'] = $p->id;
    //         $item['tahun_ajar'] = $p->tajar->periode ?? '';
    //         $item['jurusan'] = $p->jurusan->name ?? '';
    //         $item['nama_siswa'] = $p->siswa->name ?? '';
    //         $item['ket_ketidakhadiran'] = $p->ket_ketidakhadiran;
    //         $item['jumlah_hari'] = $p->jumlah_hari;
    //         $item['nilai'] = $p->nilai;
    //         $data[] = $item;
    //     }
    //     // dd($data)->toArray();
    //     return Excel::download(new PresensiSiswaExport($data), 'Data-Presensi-Siswa-Iis.xlsx');
    // }
}
