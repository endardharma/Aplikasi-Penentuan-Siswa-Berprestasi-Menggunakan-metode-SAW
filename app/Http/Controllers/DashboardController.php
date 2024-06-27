<?php

namespace App\Http\Controllers;

use App\Models\MasterGuru;
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

}
