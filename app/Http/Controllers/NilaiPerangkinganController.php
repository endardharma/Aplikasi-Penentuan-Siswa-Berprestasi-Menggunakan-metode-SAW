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

    // FIX
    // public function listNilaiPerangkinganMipa(Request $request)
    // {
    //     $columns = [
    //         0 => 'id',
    //         1 => 'siswa_id',
    //         2 => 'nilai_akhir',
    //         3 => 'jurusan_id',
    //         4 => 'tajar_id',
    //         5 => 'tajar_id',
    //     ];

    //     $start = $request->start;
    //     $limit = $request->length;
    //     $orderColumnIndex = $request->input('order.0.column');
    //     $orderColumn = isset($columns[$orderColumnIndex]) ? $columns[$orderColumnIndex] : 'id';
    //     $dir = $request->input('order.0.dir');
    //     $search = $request->input('search')['value'];

    //     // Hitung total data tanpa paginasi dan pencarian
    //     $totalData = NilaiPerangkingan::whereHas('siswa.kelas.jurusan', function ($query) {
    //         $query->where('name', 'MIPA');
    //     })->count();

    //     // Query mendapatkan data nilai perangkingan berdasarkan pencarian dan paginasi
    //     $query = NilaiPerangkingan::with(['siswa.kelas.jurusan','tajar'])
    //         ->whereHas('siswa.kelas.jurusan', function ($query) {
    //             $query->where('name', 'MIPA');
    //         })
    //         ->when($search, function ($query) use ($search) {
    //             $query->whereHas('siswa', function ($q) use ($search) {
    //                 $q->where('name','LIKE','%'.$search.'%');
    //             })
    //             ->orWhereHas('tajar', function ($q) use ($search) {
    //                 $q->where('periode','LIKE','%'.$search.'%')
    //                 ->orWhere('semester','LIKE','%'.$search.'%');
    //             })
    //             ->orWhereHas('jurusan', function ($q) use ($search) {
    //                 $q->where('name','LIKE','%'.$search.'%');
    //             })
    //             ->orWhere('nilai_akhir','LIKE','%'.$search.'%');
    //         });
        
    //     // Hitung total filtered sesuai dengan pencarian
    //     $totalFiltered = $query->count();

    //     // Ambil data nilai pernagkingan sesuai dengan paginasi dan urutan
    //     $nilaiPerangkingan = $query
    //         ->orderBy($orderColumn, $dir)
    //         ->skip($start)
    //         ->take($limit)
    //         ->get();

    //     $normalisasi = [];

    //     $kriteria = MasterKriteria::all();
    //     $siswa = MasterSiswa::with('nilaiKeseluruhan')->whereHas('kelas.jurusan', function ($query) {
    //         $query->where('name', 'MIPA');
    //     })->get();

    //     foreach ($kriteria as $k)
    //     {
    //         $max = $siswa->max(function ($siswa) use ($k) { 
    //             $nilai = $siswa->nilaiKeseluruhan->where('kriteria_id', $k->id)->first();
    //             return $nilai ? $nilai->nilai : 0;
    //         });

    //         $min = $siswa->min(function ($siswa) use ($k) {
    //             $nilai = $siswa->nilaiKeseluruhan->where('kriteria_id', $k->id)->first();
    //             return $nilai ? $nilai->nilai : 0;
    //         });

    //         foreach ($siswa as $s)
    //         {
    //             $nilai = $s->nilaiKeseluruhan->where('kriteria_id', $k->id)->first();
    //             $nilaisemuakriteria = $nilai ? $nilai->nilai : 0;
                
    //             if ($k->attribute == 'Benefit')
    //             {
    //                 $normalisasi[$s->id][$k->id] = $max ? $nilaisemuakriteria / $max : 0;
    //             }
    //             else
    //             {
    //                 $normalisasi[$s->id][$k->id] = $nilaisemuakriteria ? $min / $nilaisemuakriteria : 0;
    //             }
    //         }
    //     }

    //     // Hitung nilai akhir (hasil preferensi (V1) )
    //     $nilaiakhir = [];
        
    //     foreach ($siswa as $s)
    //     {
    //         $nilaiakhirsiswa = 0;
    //         foreach ($kriteria as $k)
    //         {
    //             $bobotkriteria = $k->bobot / 100;
    //             // $nilaiakhirsiswa += $normalisasi[$s->id][$k->id] * $k->bobot;
    //             $nilaiakhirsiswa += $normalisasi[$s->id][$k->id] * $bobotkriteria;
    //         }

    //         $nilaiakhir[$s->id] = $nilaiakhirsiswa;
    //     }

    //     // Simpan data secara otomatis
    //     foreach ($siswa as $siswa) {
    //         NilaiPerangkingan::updateOrCreate(
    //             [
    //                 'siswa_id' => $siswa->id,
    //                 'tajar_id' => $siswa->tajar->id,
    //                 'jurusan_id' => $siswa->kelas->jurusan_id,
    //             ],
    //             [
    //                 'nilai_akhir' => $nilaiakhir[$siswa->id] ?? 0,
    //             ]
    //         );
    //     }
    
    //     // Menyiapkan data untuk ditampilkan
    //     $data = [];
    //     foreach ($nilaiPerangkingan as $s) {
    //         $item = [
    //             'id' => $s->id,
    //             'nama_siswa' => $s->siswa->name,
    //             // 'nilai_akhir' => $nilaiakhir[$s->siswa->id] ?? 0,
    //             'nilai_akhir' => number_format($nilaiakhir[$s->siswa->id] ?? 0, 3), // mengambil 3 angka di belakang koma
    //             'jurusan' => $s->siswa->kelas->jurusan->name,
    //             'semester' => $s->tajar->semester,
    //             'tahun_ajar' => $s->tajar->periode,
    //         ];
    
    //         $data[] = $item;
    //     }
    
    //     // sortir data berdasarkan kolom yang diinginkan
    //     if (isset($columns[$orderColumnIndex])) {
    //         $orderColumn = $columns[$orderColumnIndex];

    //         usort($data, function ($a, $b) use ($orderColumn, $dir) {
    //             if ($dir === 'asc') {
    //                 // Urutkan dari yang terkecil ke yang terbesar
    //                 return $a[$orderColumn] <=> $b[$orderColumn];
    //             } else {
    //                 // Urutkan dari yang terbesar ke yang terkecil
    //                 return $b[$orderColumn] <=> $a[$orderColumn];
    //             }
    //         });
    //     }

    //     // Jika ingin mengurutkan berdasarkan nilai_akhir dari tertinggi ke terendah secara default
    //     usort($data, function ($a, $b) {
    //         return $b['nilai_akhir'] <=> $a['nilai_akhir'];
    //     });

    //     // Pagination
    //     $paginationData = array_slice($data, $start, $limit);
        
    //     return response()->json([
    //         'draw' => $request->draw,
    //         'recordsTotal' => $totalData,
    //         'recordsFiltered' => $totalFiltered,
    //         'data' => $paginationData,
    //     ], 200);
    // }

    // REVISI
    // public function listNilaiPerangkinganMipa(Request $request)
    // {
    //     $columns = [
    //         0 => 'id',
    //         1 => 'siswa_id',
    //         2 => 'nilai_akhir',
    //         3 => 'jurusan_id',
    //         4 => 'tajar_id',
    //     ];
    
    //     $start = $request->start;
    //     $limit = $request->length;
    //     $orderColumnIndex = $request->input('order.0.column');
    //     $orderColumn = isset($columns[$orderColumnIndex]) ? $columns[$orderColumnIndex] : 'id';
    //     $dir = $request->input('order.0.dir');
    //     $search = $request->input('search')['value'];
    //     $periode = $request->input('periode'); // Tambahkan parameter periode
    //     $tajarIdMipa = $request->input('tajar_id');
    
    //     // Hitung total data tanpa paginasi dan pencarian
    //     $totalData = NilaiPerangkingan::whereHas('siswa.kelas.jurusan', function ($query) {
    //         $query->where('name', 'MIPA');
    //     })
    //     ->whereHas('tajar', function ($query) use ($periode) {
    //         if ($periode) {
    //             $query->where('periode', $periode);
    //         }
    //     })
    //     ->count();
    
    //     // Query mendapatkan data nilai perangkingan berdasarkan pencarian, paginasi, dan periode
    //     $query = NilaiPerangkingan::with(['siswa.kelas.jurusan', 'tajar'])
    //         ->whereHas('siswa.kelas.jurusan', function ($query) {
    //             $query->where('name', 'MIPA');
    //         })
    //         ->whereHas('tajar', function ($query) use ($periode) {
    //             if ($periode) {
    //                 $query->where('periode', $periode);
    //             }
    //         })
    //         ->when($tajarIdMipa && $tajarIdMipa != '-1', function ($query) use ($tajarIdMipa) {
    //             $query->whereHas('siswa.kelas', function ($query) use ($tajarIdMipa) {
    //                 $query->where('jurusan_id', $tajarIdMipa);
    //             });
    //         })
    //         ->when(empty($tajarIdMipa) || $tajarIdMipa == '-1', function ($query) {
    //             // Jika tidak ada filter khusus saat $tajarId kosong atau '-1'
    //         })
    //         ->when($search, function ($query) use ($search) {
    //             $query->whereHas('siswa', function ($q) use ($search) {
    //                 $q->where('name', 'LIKE', '%' . $search . '%');
    //             })
    //             ->orWhereHas('tajar', function ($q) use ($search) {
    //                 $q->where('periode', 'LIKE', '%' . $search . '%')
    //                 ->orWhere('semester', 'LIKE', '%' . $search . '%');
    //             })
    //             ->orWhereHas('jurusan', function ($q) use ($search) {
    //                 $q->where('name', 'LIKE', '%' . $search . '%');
    //             })
    //             ->orWhere('nilai_akhir', 'LIKE', '%' . $search . '%');
    //         });
    
    //     // Hitung total filtered sesuai dengan pencarian
    //     $totalFiltered = $query->count();
    
    //     // Ambil data nilai perangkingan sesuai dengan paginasi dan urutan
    //     $nilaiPerangkingan = $query
    //         ->orderBy($orderColumn, $dir)
    //         ->skip($start)
    //         ->take($limit)
    //         ->get();
    
    //     $normalisasi = [];
    //     $kriteria = MasterKriteria::all();
    //     $siswa = MasterSiswa::with('nilaiKeseluruhan')
    //         ->whereHas('kelas.jurusan', function ($query) {
    //             $query->where('name', 'MIPA');
    //         })
    //         ->whereHas('tajar', function ($query) use ($periode) {
    //             if ($periode) {
    //                 $query->where('periode', $periode);
    //             }
    //         })
    //         ->get();
    
    //     foreach ($kriteria as $k)
    //     {
    //         $max = $siswa->max(function ($siswa) use ($k) {
    //             $nilai = $siswa->nilaiKeseluruhan->where('kriteria_id', $k->id)->first();
    //             return $nilai ? $nilai->nilai : 0;
    //         });
    
    //         $min = $siswa->min(function ($siswa) use ($k) {
    //             $nilai = $siswa->nilaiKeseluruhan->where('kriteria_id', $k->id)->first();
    //             return $nilai ? $nilai->nilai : 0;
    //         });
    
    //         foreach ($siswa as $s)
    //         {
    //             $nilai = $s->nilaiKeseluruhan->where('kriteria_id', $k->id)->first();
    //             $nilaisemuakriteria = $nilai ? $nilai->nilai : 0;
    
    //             if ($k->attribute == 'Benefit')
    //             {
    //                 $normalisasi[$s->id][$k->id] = $max ? $nilaisemuakriteria / $max : 0;
    //             }
    //             else
    //             {
    //                 $normalisasi[$s->id][$k->id] = $nilaisemuakriteria ? $min / $nilaisemuakriteria : 0;
    //             }
    //         }
    //     }
    
    //     // Hitung nilai akhir (hasil preferensi (V1))
    //     $nilaiakhir = [];
        
    //     foreach ($siswa as $s)
    //     {
    //         $nilaiakhirsiswa = 0;
    //         foreach ($kriteria as $k)
    //         {
    //             $bobotkriteria = $k->bobot / 100;
    //             $nilaiakhirsiswa += $normalisasi[$s->id][$k->id] * $bobotkriteria;
    //         }
    
    //         $nilaiakhir[$s->id] = $nilaiakhirsiswa;
    //     }
    
    //     // Simpan data secara otomatis
    //     foreach ($siswa as $siswa) {
    //         NilaiPerangkingan::updateOrCreate(
    //             [
    //                 'siswa_id' => $siswa->id,
    //                 'tajar_id' => $siswa->tajar->id,
    //                 'jurusan_id' => $siswa->kelas->jurusan_id,
    //             ],
    //             [
    //                 'nilai_akhir' => $nilaiakhir[$siswa->id] ?? 0,
    //             ]
    //         );
    //     }
    
    //     // Menyiapkan data untuk ditampilkan
    //     $data = [];
    //     foreach ($nilaiPerangkingan as $s) {
    //         $item = [
    //             'id' => $s->id,
    //             'nama_siswa' => $s->siswa->name,
    //             'nilai_akhir' => number_format($nilaiakhir[$s->siswa->id] ?? 0, 3), // mengambil 3 angka di belakang koma
    //             'jurusan' => $s->siswa->kelas->jurusan->name,
    //             'semester' => $s->tajar->semester,
    //             'tahun_ajar' => $s->tajar->periode,
    //         ];
    
    //         $data[] = $item;
    //     }
    
    //     // sortir data berdasarkan kolom yang diinginkan
    //     if (isset($columns[$orderColumnIndex])) {
    //         $orderColumn = $columns[$orderColumnIndex];
    
    //         usort($data, function ($a, $b) use ($orderColumn, $dir) {
    //             if ($dir === 'asc') {
    //                 // Urutkan dari yang terkecil ke yang terbesar
    //                 return $a[$orderColumn] <=> $b[$orderColumn];
    //             } else {
    //                 // Urutkan dari yang terbesar ke yang terkecil
    //                 return $b[$orderColumn] <=> $a[$orderColumn];
    //             }
    //         });
    //     }
    
    //     // Jika ingin mengurutkan berdasarkan nilai_akhir dari tertinggi ke terendah secara default
    //     usort($data, function ($a, $b) {
    //         return $b['nilai_akhir'] <=> $a['nilai_akhir'];
    //     });
    
    //     // Pagination
    //     $paginationData = array_slice($data, $start, $limit);
        
    //     return response()->json([
    //         'draw' => $request->draw,
    //         'recordsTotal' => $totalData,
    //         'recordsFiltered' => $totalFiltered,
    //         'data' => $paginationData,
    //     ], 200);
    // }

    public function listNilaiPerangkinganMipa(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'siswa_id',
            2 => 'nilai_akhir',
            3 => 'jurusan_id',
            4 => 'tajar_id',
        ];
    
        $start = $request->start;
        $limit = $request->length;
        $orderColumnIndex = $request->input('order.0.column');
        $orderColumn = isset($columns[$orderColumnIndex]) ? $columns[$orderColumnIndex] : 'id';
        $dir = $request->input('order.0.dir');
        $search = $request->input('search')['value'];
        $periode = $request->input('periode'); // Tambahkan parameter periode
        $tajarIdMipa = $request->input('tajar_id');
    
        // Hitung total data tanpa paginasi dan pencarian
        $totalData = NilaiPerangkingan::whereHas('siswa.kelas.jurusan', function ($query) {
            $query->where('name', 'MIPA');
        })
        ->whereHas('tajar', function ($query) use ($periode) {
            if ($periode) {
                $query->where('periode', $periode);
            }
        })
        ->count();
    
        // Query mendapatkan data nilai perangkingan berdasarkan pencarian, paginasi, dan periode
        $query = NilaiPerangkingan::with(['siswa.kelas.jurusan', 'tajar'])
            ->whereHas('siswa.kelas.jurusan', function ($query) {
                $query->where('name', 'MIPA');
            })
            ->whereHas('tajar', function ($query) use ($periode) {
                if ($periode) {
                    $query->where('periode', $periode);
                }
            })
            ->when($tajarIdMipa && $tajarIdMipa != '-1', function ($query) use ($tajarIdMipa) {
                $query->whereHas('siswa.kelas', function ($query) use ($tajarIdMipa) {
                    $query->where('jurusan_id', $tajarIdMipa);
                });
            })
            ->when(empty($tajarIdMipa) || $tajarIdMipa == '-1', function ($query) {
                // Tidak perlu filter khusus saat $tajarIdMipa kosong atau '-1'
            })
            ->when($search, function ($query) use ($search) {
                $query->whereHas('siswa', function ($q) use ($search) {
                    $q->where('name', 'LIKE', '%' . $search . '%');
                })
                ->orWhereHas('tajar', function ($q) use ($search) {
                    $q->where('periode', 'LIKE', '%' . $search . '%')
                      ->orWhere('semester', 'LIKE', '%' . $search . '%');
                })
                ->orWhereHas('siswa.kelas.jurusan', function ($q) use ($search) {
                    $q->where('name', 'LIKE', '%' . $search . '%');
                })
                ->orWhere('nilai_akhir', 'LIKE', '%' . $search . '%');
            });
    
        // Hitung total filtered sesuai dengan pencarian
        $totalFiltered = $query->count();
    
        // Ambil data nilai perangkingan sesuai dengan paginasi dan urutan
        $nilaiPerangkingan = $query
            ->orderBy($orderColumn, $dir)
            ->skip($start)
            ->take($limit)
            ->get();
    
        $normalisasi = [];
        $kriteria = MasterKriteria::all();
        $siswa = MasterSiswa::with('nilaiKeseluruhan')
            ->whereHas('kelas.jurusan', function ($query) {
                $query->where('name', 'MIPA');
            })
            ->whereHas('tajar', function ($query) use ($periode) {
                if ($periode) {
                    $query->where('periode', $periode);
                }
            })
            ->get();
    
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
    
        // Hitung nilai akhir (hasil preferensi (V1))
        $nilaiakhir = [];
        
        foreach ($siswa as $s)
        {
            $nilaiakhirsiswa = 0;
            foreach ($kriteria as $k)
            {
                $bobotkriteria = $k->bobot / 100;
                $nilaiakhirsiswa += $normalisasi[$s->id][$k->id] * $bobotkriteria;
            }
    
            $nilaiakhir[$s->id] = $nilaiakhirsiswa;
        }
    
        // Simpan data secara otomatis
        foreach ($siswa as $siswa) {
            NilaiPerangkingan::updateOrCreate(
                [
                    'siswa_id' => $siswa->id,
                    'tajar_id' => $siswa->tajar->id,
                    'jurusan_id' => $siswa->kelas->jurusan_id,
                ],
                [
                    'nilai_akhir' => $nilaiakhir[$siswa->id] ?? 0,
                ]
            );
        }
    
        // Menyiapkan data untuk ditampilkan
        $data = [];
        foreach ($nilaiPerangkingan as $s) {
            $item = [
                'id' => $s->id,
                'nama_siswa' => $s->siswa->name,
                'nilai_akhir' => number_format($nilaiakhir[$s->siswa->id] ?? 0, 3), // mengambil 3 angka di belakang koma
                'jurusan' => $s->siswa->kelas->jurusan->name,
                // 'semester' => $s->tajar->semester,
                'tahun_ajar' => $s->tajar->periode,
            ];
    
            $data[] = $item;
        }
    
        // Sortir data berdasarkan kolom yang diinginkan
        if (isset($columns[$orderColumnIndex])) {
            $orderColumn = $columns[$orderColumnIndex];
    
            usort($data, function ($a, $b) use ($orderColumn, $dir) {
                if ($dir === 'asc') {
                    return $a[$orderColumn] <=> $b[$orderColumn];
                } else {
                    return $b[$orderColumn] <=> $a[$orderColumn];
                }
            });
        }
    
        // Jika ingin mengurutkan berdasarkan nilai_akhir dari tertinggi ke terendah secara default
        usort($data, function ($a, $b) {
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
    
    

    // FIX
    // public function listNilaiPerangkinganIis(Request $request)
    // {
    //     $columns = [
    //         0 => 'id',
    //         1 => 'siswa_id',
    //         2 => 'nilai_akhir',
    //         3 => 'jurusan_id',
    //         4 => 'tajar_id',
    //         5 => 'tajar_id',
    //     ];

    //     $start = $request->start;
    //     $limit = $request->length;
    //     $orderColumnIndex = $request->input('order.0.column');
    //     $orderColumn = isset($columns[$orderColumnIndex]) ? $columns[$orderColumnIndex] : 'id';
    //     $dir = $request->input('order.0.dir');
    //     $search = $request->input('search')['value'];

    //     // Hitung total data tanpa paginasi dan pencarian
    //     $totalData = NilaiPerangkingan::whereHas('siswa.kelas.jurusan', function ($query) {
    //         $query->where('name', 'IIS');
    //     })->count();

    //     // Query mendapatkan data nilai perangkingan berdasarkan pencarian dan paginasi
    //     $query = NilaiPerangkingan::with(['siswa.kelas.jurusan','tajar'])
    //         ->whereHas('siswa.kelas.jurusan', function ($query) {
    //             $query->where('name', 'IIS');
    //         })
    //         ->when($search, function ($query) use ($search) {
    //             $query->whereHas('siswa', function ($q) use ($search) {
    //                 $q->where('name','LIKE','%'.$search.'%');
    //             })
    //             ->orWhereHas('tajar', function ($q) use ($search) {
    //                 $q->where('periode','LIKE','%'.$search.'%')
    //                 ->orWhere('semester','LIKE','%'.$search.'%');
    //             })
    //             ->orWhereHas('jurusan', function ($q) use ($search) {
    //                 $q->where('name','LIKE','%'.$search.'%');
    //             })
    //             ->orWhere('nilai_akhir','LIKE','%'.$search.'%');
    //         });
        
    //     // Hitung total filtered sesuai dengan pencarian
    //     $totalFiltered = $query->count();

    //     // Ambil data nilai pernagkingan sesuai dengan paginasi dan urutan
    //     $nilaiPerangkingan = $query
    //         ->orderBy($orderColumn, $dir)
    //         ->skip($start)
    //         ->take($limit)
    //         ->get();

    //     $normalisasi = [];

    //     $kriteria = MasterKriteria::all();
    //     // $siswa = MasterSiswa::with('nilaiKeseluruhan')->get();
    //     $siswa = MasterSiswa::with('nilaiKeseluruhan')
    //         ->whereHas('kelas.jurusan', function ($query) {
    //             $query->where('name', 'IIS');
    //         })->get();

    //     foreach ($kriteria as $k)
    //     {
    //         $max = $siswa->max(function ($siswa) use ($k) { 
    //             $nilai = $siswa->nilaiKeseluruhan->where('kriteria_id', $k->id)->first();
    //             return $nilai ? $nilai->nilai : 0;
    //         });

    //         $min = $siswa->min(function ($siswa) use ($k) {
    //             $nilai = $siswa->nilaiKeseluruhan->where('kriteria_id', $k->id)->first();
    //             return $nilai ? $nilai->nilai : 0;
    //         });

    //         foreach ($siswa as $s)
    //         {
    //             $nilai = $s->nilaiKeseluruhan->where('kriteria_id', $k->id)->first();
    //             $nilaisemuakriteria = $nilai ? $nilai->nilai : 0;
                
    //             if ($k->attribute == 'Benefit')
    //             {
    //                 $normalisasi[$s->id][$k->id] = $max ? $nilaisemuakriteria / $max : 0;
    //             }
    //             else
    //             {
    //                 $normalisasi[$s->id][$k->id] = $nilaisemuakriteria ? $min / $nilaisemuakriteria : 0;
    //             }
    //         }
    //     }

    //     // Hitung nilai akhir (hasil preferensi (V1) )
    //     $nilaiakhir = [];
        
    //     foreach ($siswa as $s)
    //     {
    //         $nilaiakhirsiswa = 0;
    //         foreach ($kriteria as $k)
    //         {
    //             $bobotkriteria = $k->bobot / 100;
    //             // $nilaiakhirsiswa += $normalisasi[$s->id][$k->id] * $k->bobot;
    //             $nilaiakhirsiswa += $normalisasi[$s->id][$k->id] * $bobotkriteria;
    //         }

    //         $nilaiakhir[$s->id] = $nilaiakhirsiswa;
    //     }

    //     foreach ($siswa as $siswa) {
    //         NilaiPerangkingan::updateOrCreate(
    //             [
    //                 'siswa_id' => $siswa->id,
    //                 'tajar_id' => $siswa->tajar->id,
    //                 'jurusan_id' => $siswa->kelas->jurusan_id,
    //             ],
    //             [
    //                 'nilai_akhir' => $nilaiakhir[$siswa->id] ?? 0,
    //             ]
    //         );
    //     }
    
    //     // Menyiapkan data untuk ditampilkan
    //     $data = [];
    //     foreach ($nilaiPerangkingan as $s) {
    //         $item = [
    //             'id' => $s->id,
    //             'nama_siswa' => $s->siswa->name,
    //             // 'nilai_akhir' => $nilaiakhir[$s->siswa->id] ?? 0,
    //             'nilai_akhir' => number_format($nilaiakhir[$s->siswa->id] ?? 0, 3), // mengambil 3 angka di belakang koma
    //             'jurusan' => $s->siswa->kelas->jurusan->name,
    //             'semester' => $s->tajar->semester,
    //             'tahun_ajar' => $s->tajar->periode,
    //         ];
    
    //         $data[] = $item;
    //     }
    
    //     // Mengurutkan data berdasarkan kolom yang diinginkan
    //     if (isset($columns[$orderColumnIndex])) {
    //         $orderColumn = $columns[$orderColumnIndex];

    //         usort($data, function ($a, $b) use ($orderColumn, $dir) {
    //             if ($dir === 'asc') {
    //                 // Urutkan dari yang terkecil ke yang terbesar
    //                 return $a[$orderColumn] <=> $b[$orderColumn];
    //             } else {
    //                 // Urutkan dari yang terbesar ke yang terkecil
    //                 return $b[$orderColumn] <=> $a[$orderColumn];
    //             }
    //         });
    //     }

    //     // Jika ingin mengurutkan berdasarkan nilai_akhir dari tertinggi ke terendah secara default
    //     usort($data, function ($a, $b) {
    //         return $b['nilai_akhir'] <=> $a['nilai_akhir'];
    //     });

    //     // Pagination
    //     $paginationData = array_slice($data, $start, $limit);
        
    //     return response()->json([
    //         'draw' => $request->draw,
    //         'recordsTotal' => $totalData,
    //         'recordsFiltered' => $totalFiltered,
    //         'data' => $paginationData,
    //     ], 200);
    // }
    
    // REVISI
    // public function listNilaiPerangkinganIis(Request $request)
    // {
    //     $columns = [
    //         0 => 'id',
    //         1 => 'siswa_id',
    //         2 => 'nilai_akhir',
    //         3 => 'jurusan_id',
    //         4 => 'tajar_id',
    //     ];
    
    //     $start = $request->start;
    //     $limit = $request->length;
    //     $orderColumnIndex = $request->input('order.0.column');
    //     $orderColumn = isset($columns[$orderColumnIndex]) ? $columns[$orderColumnIndex] : 'id';
    //     $dir = $request->input('order.0.dir');
    //     $search = $request->input('search')['value'];
    //     $periode = $request->input('periode'); // Tambahkan parameter periode
    //     $tajarIdIis = $request->input('tajar_id');
    
    //     // Hitung total data tanpa paginasi dan pencarian
    //     $totalData = NilaiPerangkingan::whereHas('siswa.kelas.jurusan', function ($query) {
    //         $query->where('name', 'IIS');
    //     })
    //     ->whereHas('tajar', function ($query) use ($periode) {
    //         if ($periode) {
    //             $query->where('periode', $periode);
    //         }
    //     })
    //     ->count();
    
    //     // Query mendapatkan data nilai perangkingan berdasarkan pencarian, paginasi, dan periode
    //     $query = NilaiPerangkingan::with(['siswa.kelas.jurusan', 'tajar'])
    //         ->whereHas('siswa.kelas.jurusan', function ($query) {
    //             $query->where('name', 'IIS');
    //         })
    //         ->whereHas('tajar', function ($query) use ($periode) {
    //             if ($periode) {
    //                 $query->where('periode', $periode);
    //             }
    //         })
    //         ->when($tajarIdIis && $tajarIdIis != '-1', function ($query) use ($tajarIdIis) {
    //             $query->whereHas('siswa.kelas', function ($query) use ($tajarIdIis) {
    //                 $query->where('jurusan_id', $tajarIdIis);
    //             });
    //         })
    //         ->when(empty($tajarIdIis) || $tajarIdIis == '-1', function ($query) {
    //             // Tidak perlu filter khusus saat $tajarIdIis kosong atau '-1'
    //         })
    //         ->when($search, function ($query) use ($search) {
    //             $query->whereHas('siswa', function ($q) use ($search) {
    //                 $q->where('name', 'LIKE', '%' . $search . '%');
    //             })
    //             ->orWhereHas('tajar', function ($q) use ($search) {
    //                 $q->where('periode', 'LIKE', '%' . $search . '%')
    //                   ->orWhere('semester', 'LIKE', '%' . $search . '%');
    //             })
    //             ->orWhereHas('siswa.kelas.jurusan', function ($q) use ($search) {
    //                 $q->where('name', 'LIKE', '%' . $search . '%');
    //             })
    //             ->orWhere('nilai_akhir', 'LIKE', '%' . $search . '%');
    //         });
    
    //     // Hitung total filtered sesuai dengan pencarian
    //     $totalFiltered = $query->count();
    
    //     // Ambil data nilai perangkingan sesuai dengan paginasi dan urutan
    //     $nilaiPerangkingan = $query
    //         ->orderBy($orderColumn, $dir)
    //         ->skip($start)
    //         ->take($limit)
    //         ->get();
    
    //     $normalisasi = [];
    //     $kriteria = MasterKriteria::all();
    //     $siswa = MasterSiswa::with('nilaiKeseluruhan')
    //         ->whereHas('kelas.jurusan', function ($query) {
    //             $query->where('name', 'IIS');
    //         })
    //         ->whereHas('tajar', function ($query) use ($periode) {
    //             if ($periode) {
    //                 $query->where('periode', $periode);
    //             }
    //         })
    //         ->get();
    
    //     foreach ($kriteria as $k)
    //     {
    //         $max = $siswa->max(function ($siswa) use ($k) {
    //             $nilai = $siswa->nilaiKeseluruhan->where('kriteria_id', $k->id)->first();
    //             return $nilai ? $nilai->nilai : 0;
    //         });
    
    //         $min = $siswa->min(function ($siswa) use ($k) {
    //             $nilai = $siswa->nilaiKeseluruhan->where('kriteria_id', $k->id)->first();
    //             return $nilai ? $nilai->nilai : 0;
    //         });
    
    //         foreach ($siswa as $s)
    //         {
    //             $nilai = $s->nilaiKeseluruhan->where('kriteria_id', $k->id)->first();
    //             $nilaisemuakriteria = $nilai ? $nilai->nilai : 0;
    
    //             if ($k->attribute == 'Benefit')
    //             {
    //                 $normalisasi[$s->id][$k->id] = $max ? $nilaisemuakriteria / $max : 0;
    //             }
    //             else
    //             {
    //                 $normalisasi[$s->id][$k->id] = $nilaisemuakriteria ? $min / $nilaisemuakriteria : 0;
    //             }
    //         }
    //     }
    
    //     // Hitung nilai akhir (hasil preferensi (V1))
    //     $nilaiakhir = [];
        
    //     foreach ($siswa as $s)
    //     {
    //         $nilaiakhirsiswa = 0;
    //         foreach ($kriteria as $k)
    //         {
    //             $bobotkriteria = $k->bobot / 100;
    //             $nilaiakhirsiswa += $normalisasi[$s->id][$k->id] * $bobotkriteria;
    //         }
    
    //         $nilaiakhir[$s->id] = $nilaiakhirsiswa;
    //     }
    
    //     // Simpan data secara otomatis
    //     foreach ($siswa as $siswa) {
    //         NilaiPerangkingan::updateOrCreate(
    //             [
    //                 'siswa_id' => $siswa->id,
    //                 'tajar_id' => $siswa->tajar->id,
    //                 'jurusan_id' => $siswa->kelas->jurusan_id,
    //             ],
    //             [
    //                 'nilai_akhir' => $nilaiakhir[$siswa->id] ?? 0,
    //             ]
    //         );
    //     }
    
    //     // Menyiapkan data untuk ditampilkan
    //     $data = [];
    //     foreach ($nilaiPerangkingan as $s) {
    //         $item = [
    //             'id' => $s->id,
    //             'nama_siswa' => $s->siswa->name,
    //             'nilai_akhir' => number_format($nilaiakhir[$s->siswa->id] ?? 0, 3), // mengambil 3 angka di belakang koma
    //             'jurusan' => $s->siswa->kelas->jurusan->name,
    //             'semester' => $s->tajar->semester,
    //             'tahun_ajar' => $s->tajar->periode,
    //         ];
    
    //         $data[] = $item;
    //     }
    
    //     // Sortir data berdasarkan kolom yang diinginkan
    //     if (isset($columns[$orderColumnIndex])) {
    //         $orderColumn = $columns[$orderColumnIndex];
    
    //         usort($data, function ($a, $b) use ($orderColumn, $dir) {
    //             if ($dir === 'asc') {
    //                 return $a[$orderColumn] <=> $b[$orderColumn];
    //             } else {
    //                 return $b[$orderColumn] <=> $a[$orderColumn];
    //             }
    //         });
    //     }
    
    //     // Jika ingin mengurutkan berdasarkan nilai_akhir dari tertinggi ke terendah secara default
    //     usort($data, function ($a, $b) {
    //         return $b['nilai_akhir'] <=> $a['nilai_akhir'];
    //     });

    //     // Pagination
    //     $paginationData = array_slice($data, $start, $limit);
        
    //     return response()->json([
    //         'draw' => $request->draw,
    //         'recordsTotal' => $totalData,
    //         'recordsFiltered' => $totalFiltered,
    //         'data' => $paginationData,
    //     ], 200);
    // }

    public function listNilaiPerangkinganIis(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'siswa_id',
            2 => 'nilai_akhir',
            3 => 'jurusan_id',
            4 => 'tajar_id',
        ];
    
        $start = $request->start;
        $limit = $request->length;
        $orderColumnIndex = $request->input('order.0.column');
        $orderColumn = isset($columns[$orderColumnIndex]) ? $columns[$orderColumnIndex] : 'id';
        $dir = $request->input('order.0.dir');
        $search = $request->input('search')['value'];
        $periode = $request->input('periode'); // Tambahkan parameter periode
        $tajarIdIis = $request->input('tajar_id');
    
        // Hitung total data tanpa paginasi dan pencarian
        $totalData = NilaiPerangkingan::whereHas('siswa.kelas.jurusan', function ($query) {
            $query->where('name', 'IIS');
        })
        ->whereHas('tajar', function ($query) use ($periode) {
            if ($periode) {
                $query->where('periode', $periode);
            }
        })
        ->count();
    
        // Query mendapatkan data nilai perangkingan berdasarkan pencarian, paginasi, dan periode
        $query = NilaiPerangkingan::with(['siswa.kelas.jurusan', 'tajar'])
            ->whereHas('siswa.kelas.jurusan', function ($query) {
                $query->where('name', 'IIS');
            })
            ->whereHas('tajar', function ($query) use ($periode) {
                if ($periode) {
                    $query->where('periode', $periode);
                }
            })
            ->when($tajarIdIis && $tajarIdIis != '-1', function ($query) use ($tajarIdIis) {
                $query->whereHas('siswa.kelas', function ($query) use ($tajarIdIis) {
                    $query->where('jurusan_id', $tajarIdIis);
                });
            })
            ->when(empty($tajarIdIis) || $tajarIdIis == '-1', function ($query) {
                // Tidak perlu filter khusus saat $tajarIdIis kosong atau '-1'
            })
            ->when($search, function ($query) use ($search) {
                $query->whereHas('siswa', function ($q) use ($search) {
                    $q->where('name', 'LIKE', '%' . $search . '%');
                })
                ->orWhereHas('tajar', function ($q) use ($search) {
                    $q->where('periode', 'LIKE', '%' . $search . '%')
                      ->orWhere('semester', 'LIKE', '%' . $search . '%');
                })
                ->orWhereHas('siswa.kelas.jurusan', function ($q) use ($search) {
                    $q->where('name', 'LIKE', '%' . $search . '%');
                })
                ->orWhere('nilai_akhir', 'LIKE', '%' . $search . '%');
            });
    
        // Hitung total filtered sesuai dengan pencarian
        $totalFiltered = $query->count();
    
        // Ambil data nilai perangkingan sesuai dengan paginasi dan urutan
        $nilaiPerangkingan = $query
            ->orderBy($orderColumn, $dir)
            ->skip($start)
            ->take($limit)
            ->get();
    
        $normalisasi = [];
        $kriteria = MasterKriteria::all();
        $siswa = MasterSiswa::with('nilaiKeseluruhan')
            ->whereHas('kelas.jurusan', function ($query) {
                $query->where('name', 'IIS');
            })
            ->whereHas('tajar', function ($query) use ($periode) {
                if ($periode) {
                    $query->where('periode', $periode);
                }
            })
            ->get();
    
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
    
        // Hitung nilai akhir (hasil preferensi (V1))
        $nilaiakhir = [];
        
        foreach ($siswa as $s)
        {
            $nilaiakhirsiswa = 0;
            foreach ($kriteria as $k)
            {
                $bobotkriteria = $k->bobot / 100;
                $nilaiakhirsiswa += $normalisasi[$s->id][$k->id] * $bobotkriteria;
            }
    
            $nilaiakhir[$s->id] = $nilaiakhirsiswa;
        }
    
        // Simpan data secara otomatis
        foreach ($siswa as $siswa) {
            NilaiPerangkingan::updateOrCreate(
                [
                    'siswa_id' => $siswa->id,
                    'tajar_id' => $siswa->tajar->id,
                    'jurusan_id' => $siswa->kelas->jurusan_id,
                ],
                [
                    'nilai_akhir' => $nilaiakhir[$siswa->id] ?? 0,
                ]
            );
        }
    
        // Menyiapkan data untuk ditampilkan
        $data = [];
        foreach ($nilaiPerangkingan as $s) {
            $item = [
                'id' => $s->id,
                'nama_siswa' => $s->siswa->name,
                'nilai_akhir' => number_format($nilaiakhir[$s->siswa->id] ?? 0, 3), // mengambil 3 angka di belakang koma
                'jurusan' => $s->siswa->kelas->jurusan->name,
                // 'semester' => $s->tajar->semester,
                'tahun_ajar' => $s->tajar->periode,
            ];
    
            $data[] = $item;
        }
    
        // Sortir data berdasarkan kolom yang diinginkan
        if (isset($columns[$orderColumnIndex])) {
            $orderColumn = $columns[$orderColumnIndex];
    
            usort($data, function ($a, $b) use ($orderColumn, $dir) {
                if ($dir === 'asc') {
                    return $a[$orderColumn] <=> $b[$orderColumn];
                } else {
                    return $b[$orderColumn] <=> $a[$orderColumn];
                }
            });
        }
    
        // Jika ingin mengurutkan berdasarkan nilai_akhir dari tertinggi ke terendah secara default
        usort($data, function ($a, $b) {
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

    public function supportTajarMipa()
    {
        $tajar = TahunAjar::all();
        $data = array();

        foreach ($tajar as $t)
        {
            $item['id'] = $t->id;
            $item['periode'] = $t->periode;
            $data[] = $item;
        }

        return response()->json([
            'data' => $data,
        ], 201);
    }

    public function supportTajarIis()
    {
        $tajar = TahunAjar::all();
        $data = array();

        foreach ($tajar as $t)
        {
            $item['id'] = $t->id;
            $item['periode'] = $t->periode;
            $data[] = $item;
        }

        return response()->json([
            'data' => $data,
        ], 201);
    }

    // public function exportData()
    // {
    //     $rangking = NilaiPerangkingan::all();
    //     $data = array();

    //     foreach ($rangking as $r)
    //     {
    //         $item['id'] = $r->id;
    //         $item['nama_siswa'] = $r->siswa->name ?? '';
    //         $item['nilai_akhir'] = $r->nilai_akhir;
    //         $item['jurusan'] = $r->jurusan->name ?? '';
    //         $item['tahun_ajar'] = $r->tajar->periode ?? '';
    //         $data[] = $item;
    //     }

    //     // dd($data)->toArray();

    //     return Excel::download(new NilaiPerangkinganExport($data), 'Data-Perangkingan.xlsx');
    // }

    public function exportDataMipa()
    {
        // Mengambil data NilaiPerangkingan hanya untuk jurusan Iis
        $rangking = NilaiPerangkingan::with(['siswa', 'jurusan', 'tajar'])
            ->whereHas('jurusan', function ($query) {
                $query->where('name', 'Iis');
            })
            ->get();

        // Urutkan data berdasarkan nilai_akhir dari tertinggi ke terendah
        $rangking = $rangking->sortByDesc('nilai_akhir');

        $data = array();

        foreach ($rangking as $r) {
            $item['id'] = $r->id;
            $item['nama_siswa'] = $r->siswa->name ?? '';
            $item['nilai_akhir'] = $r->nilai_akhir;
            $item['jurusan'] = $r->jurusan->name ?? '';
            $item['tahun_ajar'] = $r->tajar->periode ?? '';
            $data[] = $item;
        }

        return Excel::download(new NilaiPerangkinganExport($data), 'Data-Perangkingan-Mipa.xlsx');
    }

    public function exportDataIis()
    {
        // Mengambil data NilaiPerangkingan hanya untuk jurusan Iis
        $rangking = NilaiPerangkingan::with(['siswa', 'jurusan', 'tajar'])
            ->whereHas('jurusan', function ($query) {
                $query->where('name', 'IIS');
            })
            ->get();

        // Urutkan data berdasarkan nilai_akhir dari tertinggi ke terendah
        $rangking = $rangking->sortByDesc('nilai_akhir');

        $data = array();

        foreach ($rangking as $r) {
            $item['id'] = $r->id;
            $item['nama_siswa'] = $r->siswa->name ?? '';
            $item['nilai_akhir'] = $r->nilai_akhir;
            $item['jurusan'] = $r->jurusan->name ?? '';
            $item['tahun_ajar'] = $r->tajar->periode ?? '';
            $data[] = $item;
        }

        return Excel::download(new NilaiPerangkinganExport($data), 'Data-Perangkingan-Iis.xlsx');
    }

    
}
