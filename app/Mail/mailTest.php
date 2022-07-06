<?php

namespace App\Mail;

use App\Models\ReminderLine;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class mailTest extends Mailable
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
        ->view('email')->with('notif_date');
    }
}
