<?php

// The notification email sent to me when someone uses the contact form.

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class ContactMessageReceived extends Mailable
{
    public function __construct(public ContactMessage $contactMessage) {}

    // Reply-To is the visitor, so pressing "Reply" in my inbox answers them directly
    public function envelope(): Envelope
    {
        return new Envelope(
            replyTo: [new Address($this->contactMessage->email, $this->contactMessage->name)],
            subject: 'New portfolio message from '.$this->contactMessage->name,
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.contact-message-received');
    }
}
