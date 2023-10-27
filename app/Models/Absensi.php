<?php

namespace App\Models;

use CodeIgniter\Model;

class Absensi extends Model
{
    protected $table = "absensi";
    protected $primaryKey = "id";
    protected $allowedFields = [
        'nama_lengkap',
        'email',
        'nim_nis',
        'instansi_pendidikan',
        'nama_instansi',
        'keterangan',
        'status',
        'lokasi',
        'foto_absen',
        'checkin_time',
        'checkout_time',
        'waktu_absen',
    ];
}