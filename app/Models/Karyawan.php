<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nik',
        'jabatan',
        'alamat',
    ];

    // Relasi: 1 karyawan punya banyak absensi
    public function absensis()
    {
        return $this->hasMany(Absensi::class);
    }
}
