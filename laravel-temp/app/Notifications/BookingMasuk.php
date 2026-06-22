<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BookingMasuk extends Notification
{
    use Queueable;

    protected $booking;

    // Menerima data booking yang baru dibuat
    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    // Menentukan media notifikasi (kita pakai database)
    public function via($notifiable)
    {
        return ['database'];
    }

    // Data yang akan disimpan ke dalam database dalam bentuk JSON
    public function toArray($notifiable)
    {
        return [
            'booking_id' => $this->booking->id,
            'mahasiswa_name' => $this->booking->mahasiswa->name ?? 'Mahasiswa',
            'topik' => $this->booking->topik,
            'pesan' => 'telah mengajukan jadwal bimbingan baru.',
        ];
    }
}