<?php

namespace App\Mail;

use App\Models\Ban;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReportApprovalMailer extends Mailable
{
    use Queueable, SerializesModels;

    public $ban;
    /**
     * Create a new message instance.
     */
    public function __construct(Ban $ban)
    {
        $this->ban = $ban;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Сообщение об одобрении отчета',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.report-approval-mailer',
            with: [
                'ban' => $this->ban,
            ],
        );
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
