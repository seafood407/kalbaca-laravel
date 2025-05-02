<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'umur',
        'berat_badan',
        'tinggi_badan',
        'jenis_kelamin',
        'suhu_tubuh',
        'intake',
        'output',
        'persentase_luka_bakar',
        'hasil_perhitungan',
    ];
}
