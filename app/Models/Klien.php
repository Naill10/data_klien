<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klien extends Model
{
    use HasFactory;

    protected $table = 'klien'; // ← ini yang penting!

protected $fillable = [
    'user_id',
    'nama_klien',
    'nama_perusahaan',
    'email',
    'no_telpon',
    'alamat',
    'status',
    'tanggal_kerjasama',
    'catatan',
    'kategori', 
];
}