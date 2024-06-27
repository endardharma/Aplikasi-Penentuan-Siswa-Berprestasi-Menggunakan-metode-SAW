<?php

namespace App\Http\Controllers;

use App\Exports\NilaiPerangkinganExport;
use App\Exports\PerangkinganExport;
use App\Models\MasterKriteria;
use App\Models\MasterSiswa;
use App\Models\NilaiKeseluruhan;
use App\Models\NilaiPerangkingan;
use App\Models\Perangkingan;
use App\Models\TahunAjar;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class NilaiPerangkinganController extends Controller
{
    public function index()
    {
        return view('admin.penilaian.nilaiperangkingan.index');
    }

    // public function listPerangkingan(Request $request)
    // {
    //     // Data / function dummy
    //     $columns = [
    //         0 => 'id',
    //         1 => 'nama_siswa',
    //         2 => 'nilai',
    //         2 => 'jurusan',
    //         2 => 'semester',
    //         2 => 'tahun_ajar',
    //     ];

    //     $start = $request->start;
    //     $limit = $request->length;
    //     $orderColumn = $columns[$request->input('order.0.column')];
    //     $dir = $request->input('order.0.dir');
    //     $search = $request->input('search')['value'];

    //     // Hitung keseluruhan
    //     $hitung = Perangkingan::count();

    //     $perangkingan = Perangkingan::where(function ($q) use ($search) {
    //         if ($search != null)
    //         {
    //             return $q->where('tajar_id','LIKE','%'.$search.'%')->orWhere('jurusan_id','LIKE','%'.$search.'%')->orWhere('siswa_id','LIKE','%'.$search.'%');
    //         }
    //     })->orderby($orderColumn, $dir)->skip($start)->take($limit)->get();

    //     $data = array();
    //     foreach ($perangkingan as $n)
    //     {
    //         $item['id'] = $n->siswa->id ?? '';
    //         $item['nama_siswa'] = $n->siswa->name ?? '';
    //         $item['nilai'] = $n->nilai;
    //         $item['jurusan'] = $n->jurusan->name ?? '';
    //         $item['semester'] = $n->tajar->semester ?? '';
    //         $item['tahun_ajar'] = $n->tajar->tahun ?? '';
    //         $data[] = $item;
    //     }


    //     return response()->json([
    //         'draw' => $request->draw,
    //         'recordsTotal' => $hitung,
    //         'recordsFiltered' => $hitung,
    //         'data' => $data,
    //     ], 200);
    // }

    public function listNilaiPerangkingan(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'tajar_id',
            2 => 'siswa_id',
            2 => 'nilai_akhir',
            3 => 'jurusan_id',
            4 => 'tajar_id',
        ];

        $start = $request->start;
        $limit = $request->length;
        $orderColumnIndex = $columns[$request->input('order.0.column')];
        $orderColumn = isset($columns[$orderColumnIndex]) ? $columns[$orderColumnIndex] : 'id';
        $dir = $request->input('order.0.dir');
        $search = $request->input('search')['value'];

        // Hitung total keseluruhan data tanpa paginasi dan pencarian 
        $totalData = MasterSiswa::count();

        // Query untuk mendapatkan data siswa berdasarkan nilaiKeseluruhan
        $query = MasterSiswa::query()
        ->with(['nilaiKeseluruhan', 'jurusan', 'tajar'])
        ->when($search, function ($query) use ($search) {
            $query->where('name', 'LIKE', '%'.$search.'%')
                ->orWhereHas('jurusan', function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%'.$search.'%');
                })
                ->orWhereHas('tajar', function ($query) use ($search) {
                    $query->where('tahun', 'LIKE', '%'.$search.'%')
                        ->orWhere('semester', 'LIKE', '%'.$search.'%');
                });
        })
        ->orderby($orderColumn, $dir) // Ganti dengan kolom yang valid, misalnya 'id'
        ->skip($start)
        ->take($limit)
        ->get();

        // Hitung total keseluruhan data sesuai dengan pencarian
        $totalFiltered = $query->count();

        $normalisasi = [];

        $kriteria = MasterKriteria::all();
        $siswa = MasterSiswa::with('nilaiKeseluruhan')->get();

        foreach ($kriteria as $k)
        {
            $max = $siswa->max(function ($siswa) use ($k) { 
                $nilai = $siswa->nilaiKeseluruhan->where('kriteria_id', $k->id)->first();
                return $nilai ? $nilai->nilai : 0;
            });

            $min = $siswa->min(function ($siswa) use ($k) {
                $nilai = $siswa->nilaiKeseluruhan->where('kriteria_id', $k->id)->first();
                return $nilai ? $nilai->nilai : 0;
            });

            foreach ($siswa as $s)
            {
                $nilai = $s->nilaiKeseluruhan->where('kriteria_id', $k->id)->first();
                $nilaisemuakriteria = $nilai ? $nilai->nilai : 0;
                
                if ($k->attribute == 'Benefit')
                {
                    $normalisasi[$s->id][$k->id] = $max ? $nilaisemuakriteria / $max : 0;
                }
                else
                {
                    $normalisasi[$s->id][$k->id] = $nilaisemuakriteria ? $min / $nilaisemuakriteria : 0;
                }
            }
        }

        // dd($normalisasi)->toArray();

        // Hitung nilai akhir (hasil preferensi (V1) )
        $nilaiakhir = [];
        
        foreach ($siswa as $s)
        {
            $nilaiakhirsiswa = 0;
            foreach ($kriteria as $k)
            {
                $bobotkriteria = $k->bobot / 100;
                // $nilaiakhirsiswa += $normalisasi[$s->id][$k->id] * $k->bobot;
                $nilaiakhirsiswa += $normalisasi[$s->id][$k->id] * $bobotkriteria;
            }

            $nilaiakhir[$s->id] = $nilaiakhirsiswa;
        }

        $data = [];
        foreach ($siswa as $s)
        {
            $data[] = [
                'id' => $s->id,
                'nama_siswa' => $s->name,
                'nilai_akhir' => $nilaiakhir[$s->id],
                'jurusan' => $s->jurusan->name,
                'semester' => $s->tajar->semester,
                'tahun_ajar' => $s->tajar->tahun,
            ];

            NilaiPerangkingan::updateOrCreate(
                [
                    'siswa_id' => $s->id,
                    'tajar_id' => $s->tajar->id,
                    'jurusan_id' => $s->jurusan->id,
                ],
                [
                    'nilai_akhir' => $nilaiakhir[$s->id],
                ]
            );
        }

        // Mengurutkan data berdasarkan nilai_akhir
        usort($data, function ($a, $b){
            return $b['nilai_akhir'] <=> $a['nilai_akhir'];
        });

        // Pagination
        $paginationData = array_slice($data, $start, $limit);
        
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalFiltered,
            'data' => $paginationData,
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
            'data' => $data,
        ], 200);
    }

    public function exportData()
    {
        $rangking = NilaiPerangkingan::all();
        $data = array();

        foreach ($rangking as $r)
        {
            $item['id'] = $r->id;
            $item['nama_siswa'] = $r->siswa->name ?? '';
            $item['nilai_akhir'] = $r->nilai_akhir;
            $item['jurusan'] = $r->jurusan->name ?? '';
            $item['semester'] = $r->tajar->semester ?? '';
            $item['tahun_ajar'] = $r->tajar->tahun ?? '';
            $data[] = $item;
        }

        // dd($data)->toArray();

        return Excel::download(new NilaiPerangkinganExport($data), 'Data-Perangkingan.xlsx');
    }
}
