<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ContactMailer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $messageContent;
    public function __construct($messageContent)
    {
        //
        $this->messageContent = $messageContent;
    }

    // @return $this;
   
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $user = Auth::user();
        if ($user) {
            $contact = Contact::where('user_id', $user->id)->latest()->first();
            $subject = $contact ? $contact->subject : 'Default Subject';
        } else {
            $subject = 'Default Subject';
        }
        
        return new Envelope(
            subject: $subject,
        );
    }
    
    public function build()
    {
        return $this->view('mail.contact_mail')
                    ->with('messageContent', $this->messageContent);
    }
    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.contact_mail',
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
