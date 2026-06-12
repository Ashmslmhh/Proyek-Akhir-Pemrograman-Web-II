<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Schedule;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'mahasiswa_id',
        'schedule_id',
        'topik',
        'status'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(
            User::class,
            'mahasiswa_id'
        );
    }

    public function schedule()
    {
        return $this->belongsTo(
            Schedule::class
        );
    }
}