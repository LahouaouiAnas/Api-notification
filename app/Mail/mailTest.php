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
    public $i;
    public $date_event;


    public function __construct( $reminder_line, $reminder_type, $date_event)
    {
        $this->reminder_line = $reminder_line;
        $this->reminder_type = $reminder_type;
        $this->date_event = $date_event;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('test@mail.com')
        ->view('email')->with('reminder_types');
    }
}


