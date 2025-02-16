<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Job;

class JobPosted extends Mailable
{
    use Queueable, SerializesModels;

    // use here public $foo = 'bar' instance here if you want it to use in the view

    /**
     * Create a new message instance.
     */
    public function __construct(public Job $job)    // inject job instance from the JobController store. Use protected if you don't want it to pass the instance to the view.
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Job Posted',
            // from: '',    fill this up if you don't use the email specified in the .env file
            // replyTo: '',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.job-posted',
            // alternative way to pass a variable along with the $job injection in the construct method
            //with: [
            //    'foo' => 'bar'
            //]
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
