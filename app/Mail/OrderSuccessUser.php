<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderSuccessUser extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            // Tiêu đề email
            subject: 'Đơn hàng được đặt thành công',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.orderSuccessUser',
        );
    }


    public function attachments(): array
    {
        return [];
    }
}
