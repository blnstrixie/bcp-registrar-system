<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Emailer extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;
    public $template;
    /**
     * Create a new message instance.
     */
    public function __construct($mailData, $template)
    {
        $this->mailData = $mailData;
        $this->subject($mailData['subject'] ?? '');
        $this->template = $template;
    }
    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->view($this->template);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
