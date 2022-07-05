<?php

namespace App\Http\Controllers;

use App\Models\ReminderLine;
use Illuminate\Http\Request;

class Reminder_linesController extends Controller
{
    public function index()
    {
        $reminder_lines = ReminderLine::with('dossier')->get();
        return response()->json($reminder_lines);
    }

    public function show(ReminderLine $reminder_line)
    {
        $reminder_line2 = $reminder_line->load('dossier');
        return response()->json($reminder_line2);
    }

    
}
