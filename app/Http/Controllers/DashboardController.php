<?php

namespace App\Http\Controllers;

use App\Models\MasterGuru;
use App\Models\MasterJurusan;
use App\Models\MasterJurusanSiswa;
use App\Models\MasterSiswa;
use App\Models\NilaiPerangkingan;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index');
    }

    public function pageConstruction()
    {
        return view('admin.construction.index');
    }

    public function getProfile()
    {
        // Cek Role
        $find = Role::where('id',Auth::user()->role_id)->first();

        $data = [
            'id' => Auth::user()->id,
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'role_id' => Auth::user()->role_id,
            'role_name' => $find->name == null ? 'Nama Role Tidak Tersedia' : $find->name,
            'data' => $find,
        ];

        return response()->json($data, 200);
    }

    public function jumlahSiswa()
    {
        // Menghitung jumlah siswa
        $jumlahSiswa = MasterSiswa::count();

        // Mengembalikan respons JSON dengan jumlah siswa
        return response()->json([
            'jumlah_siswa' => $jumlahSiswa,
            'message' => 'Total siswa saat ini yaitu : '.$jumlahSiswa,
        ], 200);
    }

    public function jumlahGuru()
    {
        // Menghitung jumlah guru
        $jumlahGuru = MasterGuru::count();

        // Mengembalikkan response JSON dengan jumlah guru
        return response()->json([
            'jumlah_guru' => $jumlahGuru,
            'message' => 'Total guru saat ini yaitu : '.$jumlahGuru
        ], 200);
    }

    public function jumlahUser()
    {
        // Menghitung jumlah user
        $jumlahUser = User::count();

        return response()->json([
            'jumlah_user' => $jumlahUser,
            'message' => 'Total user saat ini yaitu : '.$jumlahUser
        ], 200);
    }

    public function nilaiTertinggi()
    {
        $find = NilaiPerangkingan::max('nilai_akhir');
        $findName = NilaiPerangkingan::where('nilai_akhir', $find)->first();

        $namaSiswa = $findName->siswa->name ?? '';

        return response()->json([
            'nama_siswa' => $namaSiswa,
            'nilai_tertinggi' => $find,
            'message' => 'Nilai tertinggi saat ini yaitu : '.$find
        ], 200);
    }

    // public function getChartData(Request $request)
    // {
    //     // Ambil data nilai perangkingan siswa dengan jurusan MIPA
    //     $data = NilaiPerangkingan::select('siswa_id', 'nilai_akhir')
    //                             ->whereHas('siswa.kelas', function ($query) {
    //                                 $query->whereHas('jurusan', function ($query) {
    //                                     $query->where('name', 'MIPA');
    //                                 });
    //                             })
    //                             ->orderBy('nilai_akhir', 'desc')
    //                             ->get();

    //     // Ambil nama siswa dari tabel master_siswa berdasarkan siswa_id
    //     $labels = [];
    //     foreach ($data as $item) {
    //         $siswa = MasterSiswa::find($item->siswa_id);
    //         if ($siswa) {
    //             $labels[] = $siswa->name;
    //         } else {
    //             $labels[] = 'Unknown';
    //         }
    //     }

    //     // Ambil nilai akhir dari setiap siswa untuk digunakan sebagai data chart
    //     $values = $data->pluck('nilai_akhir');

    //     // Format responsenya sesuai dengan yang diharapkan oleh Chart.js
    //     $response = [
    //         'labels' => $labels,
    //         'values' => $values,
    //     ];

    //     return response()->json($response);
    // }

    // public function getChartData()
    // {
    //     // Query untuk mengambil data NilaiPerangkingan
    //     $nilaiPerangkingan = NilaiPerangkingan::with('siswa')
    //         ->orderBy('nilai_akhir', 'desc') // Urutkan dari nilai tertinggi ke terendah
    //         ->get();

    //         $labels = $nilaiPerangkingan->map(function ($item) {
    //             return $item->siswa->name; // Mengambil nama siswa dari relasi
    //         });
        
    //         $values = $nilaiPerangkingan->pluck('nilai_akhir');
        
    //         $data = [
    //             'labels' => $labels,
    //             'values' => $values,
    //         ];
        
    //         return response()->json($data);
    // }

    public function getChartData($jurusan_id)
    {
        // Ambil data NilaiPerangkingan yang terhubung dengan MasterJurusanSiswa berdasarkan jurusan_id
        $nilaiPerangkingan = NilaiPerangkingan::whereHas('siswa.kelas.jurusan', function ($query) use ($jurusan_id) {
                $query->where('jurusan_id', $jurusan_id);
            })
            ->orderBy('nilai_akhir', 'desc') // Urutkan dari nilai tertinggi ke terendah
            ->with('siswa') // Load relasi siswa
            ->get();

        // Siapkan data yang akan dikirimkan sebagai JSON response
        $data = $nilaiPerangkingan->map(function ($item) {
            return [
                'name' => $item->siswa->name, // Nama siswa
                'nilai_akhir' => $item->nilai_akhir, // Nilai akhir siswa
            ];
        });

        return response()->json($data);
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
    
}
