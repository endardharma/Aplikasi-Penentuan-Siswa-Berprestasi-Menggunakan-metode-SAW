<?php

namespace App\Http\Controllers;

use App\Exports\SikapSiswaExport;
use App\Exports\SikapSiswaTemplate;
use App\Imports\SikapSiswaImport;
use App\Models\MasterSiswa;
use App\Models\SikapSiswa;
use App\Models\TahunAjar;
use Illuminate\Http\Request;
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
            4 => 'ket_sikap',
            5 => 'nilai',
        ];

        $start = $request->start;
        $limit = $request->length;
        $orderColumnIndex = $request->input('order.0.column');
        $orderColumn = isset($columns[$orderColumnIndex]) ? $columns [$orderColumnIndex] : 'id';
        $dir = $request->input('order.0.dir');
        $search = $request->input('search')['value'];

        // Hitung total keseluruhan data tanpa paginasi dan pencarian
        $totalData = SikapSiswa::count();

        // Query mendapatkan data sikap siswa berdasarkan pencarian dan paginasi
        $query = SikapSiswa::with(['tajar','siswa','jurusan'])
            ->when($search, function ($query) use ($search) {
                $query->whereHas('tajar', function ($q) use ($search) {
                    $q->where('tahun','LIKE','%'.$search.'%')
                    ->orWhere('semester','LIKE','%'.$search.'%');
                })
                ->orWhereHas('siswa', function ($q) use ($search) {
                    $q->where('name','LIKE','%'.$search.'%');
                })
                ->orWhereHas('jurusan', function ($q) use ($search) {
                    $q->where('name','LIKE','%'.$search.'%');
                })
                ->orWhere('ket_sikap','LIKE','%'.$search.'%')
                ->orWhere('nilai','LIKE','%'.$search.'%');
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
            $item['ket_sikap'] = $s->ket_sikap;
            $item['nilai'] = $s->nilai;
            $data[] = $item;
        }

        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalFiltered,
            'data' => $data,
        ], 200);
    }

    public function listDetailSikap(Request $request)
    {
        // Data/Function Dummy
        $columns = [
            0 => 'id',
            1 => 'nama_siswa',
            2 => 'ket_sikap',
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
        $hitung = SikapSiswa::count();

        $sikap = SikapSiswa::where(function($q) use ($search) {
            if($search != null)
            {
                return $q->where('tajar_id','LIKE','%'.$search.'%')->orWhere('jurusan_id','LIKE','%'.$search.'%')->orWhere('siswa_id','LIKE','%'.$search.'%')->orWhere('ket_sikap', $search);
            }
        })->orderby($orderColumn, $dir)->skip($start)->take($limit)->get();

        $data = array();
        foreach($sikap as $s)
        {
            $item['id'] = $s->id;
            $item['nama_siswa'] = $s->siswa->name ?? '';
            $item['ket_sikap'] = $s->ket_sikap;
            $item['nilai'] = $s->nilai;
            $item['jurusan'] = $s->siswa->name ?? '';
            $item['semester'] = $s->tajar->semester ?? '';
            $item['tahun_ajar'] = $s->tajar->tahun ?? '';
            $data[] = $item;
        }

        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $hitung,
            'recordsFIltered' => $hitung,
            'data' => $data,
        ], 200);
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
            $request->ket_sikap != null ? $find->ket_sikap = $request->ket_sikap : true;
            $request->nilai != null ? $find->nilai = $this->getNilaiBasedOnSikap($request->ket_sikap) : true; // Nilai otomatis berdasarkan keterangan sikap
            $find->save();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil melakukan update data nilai sikap siswa',
            ], 201);
        }
    }

    private function getNilaiBasedOnSikap($ket_sikap)
    {
        $nilaiMapping = [
            'Sangat Baik' => 5,
            'Baik' => 4,
            'Cukup' => 3,
            'Tidak Baik' => 2,
            'Sangat Tidak Baik' => 1,
        ];

        return $nilaiMapping[$ket_sikap] ?? 0; // Nilai default jika keterangan sikap tidak ditemukan
    }
    
    public function getNilai(Request $request)
    {
        $ket_sikap = $request->ket_sikap;
        $nilai = $this->getNilaiBasedOnSikap($ket_sikap);

        return response()->json([
            'nilai' => $nilai
        ], 201);
    }

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

    public function template(Request $request)
    {
        return Excel::download(new SikapSiswaTemplate($request->tajar), 'Template-Sikap-Siswa.xlsx');
    }

    public function importData(Request $request)
    {
        // Lakukan validasi data import
        $request->validate([
            'excel' => 'required|mimes:xls,xlsx',
        ]);

        // Proses Data import
        $file = $request->file('excel');

        Excel::import(new SikapSiswaImport, $file);

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
            $item['ket_sikap'] = $s->ket_sikap;
            $item['nilai'] = $s->nilai;
            $item['jurusan'] = $s->jurusan->name ?? '';
            $item['semester'] = $s->tajar->semester ?? '';
            $item['tahun_ajar'] = $s->tajar->tahun ?? '';
            $data[] = $item;
        }

        return excel::download(new SikapSiswaExport($data), 'Data-Sikap-Siswa.xlsx');
    }
}
