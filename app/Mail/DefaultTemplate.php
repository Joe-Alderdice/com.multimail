<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Email;
use App\Contact;

class DefaultTemplate extends Mailable
{
    use Queueable, SerializesModels;
   public $email;
   public $contact;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Email $email, Contact $contact)
    {

        $this->email = $email;
        $this->contact = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $toBeReplaced = array("1" => "%first_name%", "2" => "%last_name%");
        $replacements = array("1" => $this->contact->first_name, "2" => $this->contact->last_name);
        $emailBody = nl2br(str_replace($toBeReplaced, $replacements, $this->email->body));
        $emailSubject = str_replace($toBeReplaced, $replacements, $this->email->subject);
        
        return $this->subject($emailSubject)
                    ->view('templates.default', compact('emailBody', 'emailSubject'));
    }
}
