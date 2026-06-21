<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'dosen_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'status'
    ];

    public function dosen()
    {
        return $this->belongsTo(
            User::class,
            'dosen_id'
        );
    }
}