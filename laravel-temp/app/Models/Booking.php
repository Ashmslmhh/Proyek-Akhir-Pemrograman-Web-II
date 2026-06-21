<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // Izinkan kolom-kolom ini diisi form
    protected $fillable = [
        'mahasiswa_id', 
        'dosen_id', 
        'tanggal', 
        'sesi_waktu', 
        'topik', 
        'catatan', 
        'status'
    ];

    // Relasi ke tabel dosen (User)
    public function dosen()
    {
        return $this->belongsTo(User::class, 'dosen_id');
    }
}