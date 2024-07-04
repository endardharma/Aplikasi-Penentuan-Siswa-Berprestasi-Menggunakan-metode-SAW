<?php

namespace Database\Seeders;

use App\Models\MasterJurusanSiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterJurusanSiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'nama_jurusan' => 'MIPA',
                'created_at' => '2024-07-25 17:00:00',
                'updated_at' => '2024-07-25 17:00:00',
            ],

            [
                'id' => 2,
                'nama_jurusan' => 'IIS',
                'created_at' => '2024-07-25 17:00:00',
                'updated_at' => '2024-07-25 17:00:00',
            ],
        ];
        
        MasterJurusanSiswa::insert($data);
    }
}
