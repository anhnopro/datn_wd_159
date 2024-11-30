<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordResetCode extends Mailable
{
    use Queueable, SerializesModels;

    public $confirmationCode;

    public function __construct($confirmationCode)
    {
        $this->confirmationCode = $confirmationCode;
    }

    public function build()
    {
        return $this->subject('Mã xác nhận thay đổi mật khẩu')
            ->view('emails.password_reset_code');
    }
}
