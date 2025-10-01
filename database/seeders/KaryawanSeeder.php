<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Karyawan;

class KaryawanSeeder extends Seeder
{
    public function run(): void
    {
        Karyawan::create([
            'nama' => 'Budi Santoso',
            'nik' => 'KRY001',
            'jabatan' => 'Staff IT',
            'alamat' => 'Jl. Merdeka No. 10',
        ]);

        Karyawan::create([
            'nama' => 'Siti Aminah',
            'nik' => 'KRY002',
            'jabatan' => 'HRD',
            'alamat' => 'Jl. Sudirman No. 25',
        ]);
    }
}