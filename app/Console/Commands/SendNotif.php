<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Mail\mailTest;
use App\Models\ReminderLine;
use App\Models\ReminderType;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendNotif extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:notif';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $day = Carbon::now()->format('Y-m-d');
        $reminderLines = ReminderLine::where('premiere_notif_date','=', $day)->orWhere('deuxieme_notif_date','=', $day)->get();
        foreach ($reminderLines as $row){
            $reminder_line = ReminderLine::find($row->id);
            $reminder_type = ReminderType::find($reminder_line->reminder_type_id);
            $date = Carbon::createFromFormat('Y-m-d', $reminder_line->dossier->date_de_depot);
            $date_event = $date->addDays($reminder_type->number_of_days_event);
            if($reminder_line->dossier->arret == 'false'){
                        Mail::to('lahouaouianas2@gmail.com')->send(new mailTest($reminder_line, $reminder_type, $date_event));
            }
        }
    }
}


