<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BookingStatusChanged extends Notification
{
    use Queueable;

    protected $booking;
    protected $status;

    public function __construct($booking, $status)
    {
        $this->booking = $booking;
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        $pesan = match($this->status) {
            'Disetujui' => 'Booking bimbingan telah disetujui oleh dosen',
            'Ditolak' => 'Booking bimbingan tidak disetujui oleh dosen',
            default => 'Status booking berubah',
        };

        return [
            'booking_id' => $this->booking->id,
            'topik' => $this->booking->topik,
            'pesan' => $pesan,
            'status' => $this->status,
        ];
    }
}
