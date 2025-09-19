<?php

namespace ContactForm\Mail;

use ContactForm\Models\ContactForm;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;

    public function __construct(ContactForm $contact)
    {
        $this->contact = $contact;
    }

    public function build()
    {
        return $this->subject('New Contact Form Submission')
            ->view('contactform::emails.new_contact')
            ->with(['contact' => $this->contact]);
    }
}
