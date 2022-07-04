<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Mail\mailTest;
use App\Models\ReminderLine;
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

        $reminderLines = ReminderLine::all();
        $day = Carbon::now()->format('Y-m-d');
        foreach ($reminderLines as $reminderLine){
            if($reminderLine->notif_date == $day)
            {
                Mail::to('lahouaouianas2@gmail.com')->send(new mailTest);
             return view('test');
            }
        }
    }
}

