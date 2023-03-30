<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReportsEmail extends Mailable
{
    use Queueable, SerializesModels;


    public $msg;
    public $asunto;
    public $view;
    public $report;
    public $nameReport;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($asunto, $msg, $view, $report, $nameReport)
    {
        $this->msg = $msg;
        $this->asunto = $asunto;
        $this->view = $view;
        $this->report = $report;
        $this->nameReport = $nameReport;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: $this->asunto,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: $this->view,
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [
            Attachment::fromData(fn() => $this->report->get(), $this->nameReport)->withMime('application/pdf'),
        ];
    }
}
