<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RepUserContact extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;
    public $message;

    public function __construct($contact, $message)
    {
        $this->contact = $contact;
        $this->message = $message;
    }


    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Phản hồi từ Legoloft'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.contactReply', // Đường dẫn view
            with: [
                'contact' => $this->contact,
                'messageK' => $this->message,
            ] // Truyền dữ liệu tới view
        );
    }
    public function attachments(): array
    {
        return [];
    }
}
