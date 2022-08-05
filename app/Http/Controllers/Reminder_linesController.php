<?php

namespace App\Http\Controllers;

use App\Models\ReminderLine;
use App\Models\File;
use Illuminate\Http\Request;

class Reminder_linesController extends Controller
{
    public function index()
    {
        $reminder_lines = ReminderLine::with('dossier', 'files', 'remindertype')->get();
        return response()->json($reminder_lines);
    }

    public function show(ReminderLine $reminder_line)
    {
        $reminder_line2 = $reminder_line->load('dossier', 'files', 'remindertype');
        return response()->json($reminder_line2);
    }
}
