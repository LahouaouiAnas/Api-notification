<?php

namespace App\Mail;

use App\Models\ReminderLine;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Mail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $reminder_line;


    public function __construct(ReminderLine $reminder_line)
    {
        $this->reminder_line = $reminder_line;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('test@mail.com')
        ->view('deuxieme-email')->with('remindertype');
    }
}
