<?php

namespace App\Http\Controllers;

use App\Models\MasterKriteria;
use App\Models\MasterSiswa;
use App\Models\NilaiPerangkingan;
use Illuminate\Http\Request;

class NilaiNormalisasiController extends Controller
{
    public function index()
    {
        return view('admin.penilaian.nilainormalisasi.index');
    }

    public function listNormalisasiMipa(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'tajar_id',
            2 => 'siswa_id',
            3 => 'kriteria_id',
            4 => 'nilai',
        ];
        
        $start = $request->start;
        $limit = $request->length;
        $orderColumnIndex = $request->input('order.0.column');
        $orderColumn = isset($columns[$orderColumnIndex]) ? $columns [$orderColumnIndex] : 'id';
        $dir = $request->input('order.0.dir');
        $search = $request->input('search')['value'];
    
        // Hitung total keseluruhan data tanpa paginasi dan pencarian
        $totalData = MasterSiswa::whereHas('kelas.jurusan', function ($query){
            $query->where('name', 'MIPA');
        })->count();
    
        // Query untuk mendapatkan nilai akhir dengan nama kriteria
        $query = MasterSiswa::with(['tajar','kelas.jurusan'])
            ->whereHas('kelas.jurusan', function ($query) {
                $query->where('name', 'MIPA');
            })   
            ->when($search, function ($query) use ($search) {
                $query->whereHas('jurusan', function ($q) use ($search) {
                    $q->where('name','LIKE','%'.$search.'%');
                })
                ->orWhereHas('tajar', function ($q) use ($search) {
                    $q->where('periode','LIKE','%'.$search.'%')
                    ->orWhere('semester','LIKE','%'.$search.'%');
                });
            });
    
        // Hitung total keseluruhan data sesuai dengan kriteria pencarian
        $totalFiltered = $query->count();
    
        // Pagination
        $siswaList = $query
        ->orderBy($orderColumn, $dir)
        ->skip($start)
        ->take($limit)
        ->get();
    
        $data = array();
        foreach($siswaList as $s)
        {
            $item['id'] = $s->id;

            $item['nama_siswa'] = $s->name ?? '';

            $item['jurusan'] = $s->kelas->jurusan->name ?? '';

            $item['semester'] = $s->tajar->semester ?? '';

            $item['tahun_ajar'] = $s->tajar->periode ?? '';

            $data[] = $item;
        }
        
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalFiltered,
            'data' => $data,
        ],200);
    }
    
    // public function listDetailNormalisasiMipa(Request $request)
    // {
    //     $siswaId = $request->input('siswa_id');
        
    //     $columns = [
    //         0 => 'id',
    //         1 => 'siswa_id',
    //         2 => 'nilai_normalisasi',
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
    //     $query = NilaiPerangkingan::with(['siswa.kelas.jurusan','tajar', 'siswa'])
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
        
    //     if ($siswaId) {
    //         $query->where('siswa_id', $siswaId);
    //     }

    //     // Hitung total filtered sesuai dengan pencarian
    //     $totalFiltered = $query->count();
    
    //     // Ambil data nilai pernagkingan sesuai dengan paginasi dan urutan
    //     $nilaiPerangkingan = $query
    //         ->orderBy($orderColumn, $dir)
    //         ->skip($start)
    //         ->take($limit)
    //         ->get();
    
    //     $kriteria = MasterKriteria::all();
    //     $siswa = MasterSiswa::with('nilaiKeseluruhan')->whereHas('kelas.jurusan', function ($query) {
    //         $query->where('name', 'MIPA');
    //     })->get();
    
    //     $normalisasi = [];
    
    //     foreach ($siswa as $s) {
    //         foreach ($s->nilaiKeseluruhan as $nilai) {
    //             $kriteria = MasterKriteria::find($nilai->kriteria_id);
    //             if (!$kriteria) continue; // Jika kriteria tidak ditemukan, lanjut ke iterasi selanjutnya
    
    //             $max = $siswa->max(function ($siswa) use ($kriteria) {
    //                 $nilai = $siswa->nilaiKeseluruhan->where('kriteria_id', $kriteria->id)->first();
    //                 return $nilai ? $nilai->nilai : 0;
    //             });
    
    //             $min = $siswa->min(function ($siswa) use ($kriteria) {
    //                 $nilai = $siswa->nilaiKeseluruhan->where('kriteria_id', $kriteria->id)->first();
    //                 return $nilai ? $nilai->nilai : 0;
    //             });
    
    //             $nilaiKriteria = $nilai->nilai;
    
    //             if ($kriteria->attribute == 'Benefit') {
    //                 $nilaiNormalisasi = $max ? $nilaiKriteria / $max : 0;
    //             } else {
    //                 $nilaiNormalisasi = $nilaiKriteria ? $min / $nilaiKriteria : 0;
    //             }
    
    //             $normalisasi[] = [
    //                 'id' => $s->id,
    //                 'nama_siswa' => $s->name,
    //                 'nilai_normalisasi' => $nilaiNormalisasi,
    //                 'kriteria' => [
    //                     'nama_kriteria' => $kriteria->name,
    //                     'nilai' => $nilaiKriteria,
    //                 ],
    //                 'nama_kriteria' => $kriteria->name,
    //             ];
    //         }
    //     }
    
    //     // Filter data berdasarkan pencarian
    //     if ($search) {
    //         $normalisasi = array_filter($normalisasi, function ($item) use ($search) {
    //             return stripos($item['nama_siswa'], $search) !== false ||
    //                 stripos($item['jurusan'], $search) !== false ||
    //                 stripos($item['semester'], $search) !== false ||
    //                 stripos($item['tahun_ajar'], $search) !== false;
    //         });
    //     }
    
    //     // Hitung total data setelah filtering
    //     $totalFiltered = count($normalisasi);
    
    //     // Urutkan data berdasarkan kolom yang dipilih
    //     usort($normalisasi, function ($a, $b) use ($orderColumn, $dir) {
    //         if ($dir === 'asc') {
    //             return $a[$orderColumn] <=> $b[$orderColumn];
    //         } else {
    //             return $b[$orderColumn] <=> $a[$orderColumn];
    //         }
    //     });
    
    //     // Paginasi data
    //     $paginationData = array_slice($normalisasi, $start, $limit);
    
    //     return response()->json([
    //         'draw' => $request->draw,
    //         // 'recordsTotal' => count($normalisasi),
    //         'recordsTotal' => $totalData,
    //         'recordsFiltered' => $totalFiltered,
    //         'data' => $paginationData,
    //     ], 200);
    // }

    // btn-detail-mipa sudah benar tapi data masih salah
    // public function listDetailNormalisasiMipa(Request $request)
    // {
    //     $siswaId = $request->input('siswa_id');
        
    //     $columns = [
    //         0 => 'id',
    //         1 => 'siswa_id',
    //         2 => 'nilai_normalisasi',
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
    
    //     $totalData = NilaiPerangkingan::whereHas('siswa.kelas.jurusan', function ($query) {
    //         $query->where('name', 'MIPA');
    //     })->count();

    //     $query = NilaiPerangkingan::with(['siswa.kelas.jurusan','tajar', 'siswa'])
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
    
    //     if ($siswaId) {
    //         $query->where('siswa_id', $siswaId);
    //     }
    
    //     $totalFiltered = $query->count();
    
    //     $nilaiPerangkingan = $query
    //         ->orderBy($orderColumn, $dir)
    //         ->skip($start)
    //         ->take($limit)
    //         ->get();
    
    //     $kriteria = MasterKriteria::all();
    //     $siswa = MasterSiswa::with('nilaiKeseluruhan')
    //         ->where('id', $siswaId)
    //         ->whereHas('kelas.jurusan', function ($query) {
    //             $query->where('name', 'MIPA');
    //         })->get();
    
    //     $normalisasi = [];
    
    //     foreach ($siswa as $s) {
    //         foreach ($s->nilaiKeseluruhan as $nilai) {
    //             $kriteria = MasterKriteria::find($nilai->kriteria_id);
    //             if (!$kriteria) continue; // Jika kriteria tidak ditemukan, lanjut ke iterasi selanjutnya
    
    //             $max = $siswa->max(function ($siswa) use ($kriteria) {
    //                 $nilai = $siswa->nilaiKeseluruhan->where('kriteria_id', $kriteria->id)->first();
    //                 return $nilai ? $nilai->nilai : 0;
    //             });
    
    //             $min = $siswa->min(function ($siswa) use ($kriteria) {
    //                 $nilai = $siswa->nilaiKeseluruhan->where('kriteria_id', $kriteria->id)->first();
    //                 return $nilai ? $nilai->nilai : 0;
    //             });
    
    //             $nilaiKriteria = $nilai->nilai;
    
    //             if ($kriteria->attribute == 'Benefit') {
    //                 $nilaiNormalisasi = $max ? $nilaiKriteria / $max : 0;
    //             } else {
    //                 $nilaiNormalisasi = $nilaiKriteria ? $min / $nilaiKriteria : 0;
    //             }
    
    //             $normalisasi[] = [
    //                 'id' => $s->id,
    //                 'nama_siswa' => $s->name,
    //                 'nilai_normalisasi' => $nilaiNormalisasi,
    //                 'nama_kriteria' => $kriteria->name,
    //             ];
    //         }
    //     }
    
    //     // Filter data berdasarkan pencarian
    //     if ($search) {
    //         $normalisasi = array_filter($normalisasi, function ($item) use ($search) {
    //             return stripos($item['nama_siswa'], $search) !== false ||
    //                 stripos($item['nama_kriteria'], $search) !== false;
    //         });
    //     }
    
    //     // Hitung total data setelah filtering
    //     $totalFiltered = count($normalisasi);
    
    //     // Urutkan data berdasarkan kolom yang dipilih
    //     usort($normalisasi, function ($a, $b) use ($orderColumn, $dir) {
    //         if ($dir === 'asc') {
    //             return $a[$orderColumn] <=> $b[$orderColumn];
    //         } else {
    //             return $b[$orderColumn] <=> $a[$orderColumn];
    //         }
    //     });
    
    //     // Paginasi data
    //     $paginationData = array_slice($normalisasi, $start, $limit);
    
    //     return response()->json([
    //         'draw' => $request->draw,
    //         'recordsTotal' => $totalData,
    //         'recordsFiltered' => $totalFiltered,
    //         'data' => $paginationData,
    //     ], 200);
    // }

    public function listDetailNormalisasiMipa(Request $request)
    {
        $siswaId = $request->input('siswa_id');
        
        $columns = [
            0 => 'id',
            1 => 'siswa_id',
            2 => 'nilai_normalisasi',
            3 => 'jurusan_id',
            4 => 'tajar_id',
            5 => 'tajar_id',
        ];
    
        $start = $request->start;
        $limit = $request->length;
        $orderColumnIndex = $request->input('order.0.column');
        $orderColumn = isset($columns[$orderColumnIndex]) ? $columns[$orderColumnIndex] : 'id';
        $dir = $request->input('order.0.dir');
        $search = $request->input('search')['value'];
    
        $totalData = NilaiPerangkingan::whereHas('siswa.kelas.jurusan', function ($query) {
            $query->where('name', 'MIPA');
        })->count();
    
        $query = NilaiPerangkingan::with(['siswa.kelas.jurusan','tajar', 'siswa'])
            ->whereHas('siswa.kelas.jurusan', function ($query) {
                $query->where('name', 'MIPA');
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
                ->orWhere('nilai_akhir','LIKE','%'.$search.'%');
            });
    
        if ($siswaId) {
            $query->where('siswa_id', $siswaId);
        }
    
        $totalFiltered = $query->count();
    
        $nilaiPerangkingan = $query
            ->orderBy($orderColumn, $dir)
            ->skip($start)
            ->take($limit)
            ->get();
    
        $kriteria = MasterKriteria::all();
        $siswa = MasterSiswa::with('nilaiKeseluruhan')
            ->where('id', $siswaId)
            ->whereHas('kelas.jurusan', function ($query) {
                $query->where('name', 'MIPA');
            })->get();
    
        // Ambil semua nilai siswa MIPA untuk normalisasi
        $nilaiSemuaMipa = MasterSiswa::with('nilaiKeseluruhan')
            ->whereHas('kelas.jurusan', function ($query) {
                $query->where('name', 'MIPA');
            })->get();
    
        $normalisasi = [];
    
        foreach ($siswa as $s) {
            foreach ($s->nilaiKeseluruhan as $nilai) {
                $kriteria = MasterKriteria::find($nilai->kriteria_id);
                if (!$kriteria) continue; // Jika kriteria tidak ditemukan, lanjut ke iterasi selanjutnya
    
                $max = $nilaiSemuaMipa->max(function ($siswa) use ($kriteria) {
                    $nilai = $siswa->nilaiKeseluruhan->where('kriteria_id', $kriteria->id)->first();
                    return $nilai ? $nilai->nilai : 0;
                });
    
                $min = $nilaiSemuaMipa->min(function ($siswa) use ($kriteria) {
                    $nilai = $siswa->nilaiKeseluruhan->where('kriteria_id', $kriteria->id)->first();
                    return $nilai ? $nilai->nilai : 0;
                });
    
                $nilaiKriteria = $nilai->nilai;
    
                if ($kriteria->attribute == 'Benefit') {
                    $nilaiNormalisasi = $max ? $nilaiKriteria / $max : 0;
                } else {
                    $nilaiNormalisasi = $nilaiKriteria ? $min / $nilaiKriteria : 0;
                }
    
                $normalisasi[] = [
                    'id' => $s->id,
                    'nama_siswa' => $s->name,
                    'nilai_normalisasi' => $nilaiNormalisasi,
                    'nama_kriteria' => $kriteria->name,
                ];
            }
        }
    
        // Filter data berdasarkan pencarian
        if ($search) {
            $normalisasi = array_filter($normalisasi, function ($item) use ($search) {
                return stripos($item['nama_siswa'], $search) !== false ||
                    stripos($item['nama_kriteria'], $search) !== false;
            });
        }
    
        // Hitung total data setelah filtering
        $totalFiltered = count($normalisasi);
    
        // Urutkan data berdasarkan kolom yang dipilih
        usort($normalisasi, function ($a, $b) use ($orderColumn, $dir) {
            if ($dir === 'asc') {
                return $a[$orderColumn] <=> $b[$orderColumn];
            } else {
                return $b[$orderColumn] <=> $a[$orderColumn];
            }
        });
    
        // Paginasi data
        $paginationData = array_slice($normalisasi, $start, $limit);
    
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalFiltered,
            'data' => $paginationData,
        ], 200);
    }

    public function listNormalisasiIis(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'tajar_id',
            2 => 'siswa_id',
            3 => 'kriteria_id',
            4 => 'nilai',
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
        $totalData = MasterSiswa::whereHas('kelas.jurusan', function ($query){
            $query->where('name', 'IIS');
        })->count();
    
        // Query untuk mendapatkan nilai akhir dengan nama kriteria
        $query = MasterSiswa::with(['tajar','kelas.jurusan'])
            ->whereHas('kelas.jurusan', function ($query) {
                $query->where('name', 'IIS');
            })
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
    
        // Hitung total keseluruhan data sesuai dengan kriteria pencarian
        $totalFiltered = $query->count();
    
        // Pagination
        $siswaList = $query
        ->orderBy($orderColumn, $dir)
        ->skip($start)
        ->take($limit)
        ->get();
    
        $data = array();
        foreach($siswaList as $s)
        {
            $item['id'] = $s->id;

            $item['nama_siswa'] = $s->name ?? '';

            $item['jurusan'] = $s->kelas->jurusan->name ?? '';

            $item['semester'] = $s->tajar->semester ?? '';

            $item['tahun_ajar'] = $s->tajar->periode ?? '';

            $data[] = $item;
        }
        
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalFiltered,
            'data' => $data,
        ],200);
    }
    
    public function listDetailNormalisasiIis(Request $request)
    {
        $siswaId = $request->input('siswa_id');
        
        $columns = [
            0 => 'id',
            1 => 'siswa_id',
            2 => 'nilai_normalisasi',
            3 => 'jurusan_id',
            4 => 'tajar_id',
            5 => 'tajar_id',
        ];
    
        $start = $request->start;
        $limit = $request->length;
        $orderColumnIndex = $request->input('order.0.column');
        $orderColumn = isset($columns[$orderColumnIndex]) ? $columns[$orderColumnIndex] : 'id';
        $dir = $request->input('order.0.dir');
        $search = $request->input('search')['value'];
    
        $totalData = NilaiPerangkingan::whereHas('siswa.kelas.jurusan', function ($query) {
            $query->where('name', 'IIS');
        })->count();
    
        $query = NilaiPerangkingan::with(['siswa.kelas.jurusan','tajar', 'siswa'])
            ->whereHas('siswa.kelas.jurusan', function ($query) {
                $query->where('name', 'IIS');
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
                ->orWhere('nilai_akhir','LIKE','%'.$search.'%');
            });
    
        if ($siswaId) {
            $query->where('siswa_id', $siswaId);
        }
    
        $totalFiltered = $query->count();
    
        $nilaiPerangkingan = $query
            ->orderBy($orderColumn, $dir)
            ->skip($start)
            ->take($limit)
            ->get();
    
        $kriteria = MasterKriteria::all();
        $siswa = MasterSiswa::with('nilaiKeseluruhan')
            ->where('id', $siswaId)
            ->whereHas('kelas.jurusan', function ($query) {
                $query->where('name', 'IIS');
            })->get();
    
        // Ambil semua nilai siswa IIS untuk normalisasi
        $nilaiSemuaIis = MasterSiswa::with('nilaiKeseluruhan')
            ->whereHas('kelas.jurusan', function ($query) {
                $query->where('name', 'IIS');
            })->get();
    
        $normalisasi = [];
    
        foreach ($siswa as $s) {
            foreach ($s->nilaiKeseluruhan as $nilai) {
                $kriteria = MasterKriteria::find($nilai->kriteria_id);
                if (!$kriteria) continue; // Jika kriteria tidak ditemukan, lanjut ke iterasi selanjutnya
    
                $max = $nilaiSemuaIis->max(function ($siswa) use ($kriteria) {
                    $nilai = $siswa->nilaiKeseluruhan->where('kriteria_id', $kriteria->id)->first();
                    return $nilai ? $nilai->nilai : 0;
                });
    
                $min = $nilaiSemuaIis->min(function ($siswa) use ($kriteria) {
                    $nilai = $siswa->nilaiKeseluruhan->where('kriteria_id', $kriteria->id)->first();
                    return $nilai ? $nilai->nilai : 0;
                });
    
                $nilaiKriteria = $nilai->nilai;
    
                if ($kriteria->attribute == 'Benefit') {
                    $nilaiNormalisasi = $max ? $nilaiKriteria / $max : 0;
                } else {
                    $nilaiNormalisasi = $nilaiKriteria ? $min / $nilaiKriteria : 0;
                }
    
                $normalisasi[] = [
                    'id' => $s->id,
                    'nama_siswa' => $s->name,
                    'nilai_normalisasi' => $nilaiNormalisasi,
                    'nama_kriteria' => $kriteria->name,
                ];
            }
        }
    
        // Filter data berdasarkan pencarian
        if ($search) {
            $normalisasi = array_filter($normalisasi, function ($item) use ($search) {
                return stripos($item['nama_siswa'], $search) !== false ||
                    stripos($item['nama_kriteria'], $search) !== false;
            });
        }
    
        // Hitung total data setelah filtering
        $totalFiltered = count($normalisasi);
    
        // Urutkan data berdasarkan kolom yang dipilih
        usort($normalisasi, function ($a, $b) use ($orderColumn, $dir) {
            if ($dir === 'asc') {
                return $a[$orderColumn] <=> $b[$orderColumn];
            } else {
                return $b[$orderColumn] <=> $a[$orderColumn];
            }
        });
    
        // Paginasi data
        $paginationData = array_slice($normalisasi, $start, $limit);
    
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalFiltered,
            'data' => $paginationData,
        ], 200);
    }
}
