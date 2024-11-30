<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    public function build()
    {
        $statusMessage = $this->booking->status === 'confirmed'
            ? 'đã được xác nhận'
            : 'đã bị từ chối';

        return $this->subject('Cập nhật trạng thái đặt phòng')
            ->view('emails.booking_confirmation')
            ->with([
                'roomName' => $this->booking->room->name,
                'status' => $statusMessage,
                'bookingDate' => $this->booking->booking_date,
            ]);
    }
}
