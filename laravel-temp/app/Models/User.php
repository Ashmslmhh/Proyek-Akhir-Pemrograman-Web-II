<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Schedule;
use App\Models\Booking;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'nim', 'nip', 'prodi',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['initials'];

    public function schedules() { return $this->hasMany(Schedule::class, 'dosen_id'); }
    public function bookings() { return $this->hasMany(Booking::class, 'mahasiswa_id'); }

    /**
     * Get the user's initials.
     *
     * @return string
     */
    public function getInitialsAttribute()
    {
        $name = $this->name;
        // Hapus gelar depan
        $name = preg_replace('/^(Dr\.|Ir\.|Prof\.|Drs\.|H\.|Hj\.|Ns\.)\s*/i', '', $name);
        // Hapus gelar belakang (semua setelah koma)
        $name = trim(explode(',', $name)[0]);

        $words = explode(' ', $name);
        $initials = '';

        if (count($words) >= 2) {
            // Ambil huruf pertama dari dua kata pertama
            $initials = strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
        } elseif (count($words) == 1 && !empty($words[0])) {
            // Ambil dua huruf pertama jika hanya satu kata
            $initials = strtoupper(substr($words[0], 0, 2));
        } else {
            // Default jika nama kosong
            $initials = '??';
        }

        return $initials;
    }
}
