<?php

namespace App\Http\Controllers;

use auth;
use Carbon\Carbon;
use App\Models\Event;
use App\Models\Dossier;
use App\Models\Researcher;
use App\Models\ReminderLine;
use App\Models\ReminderType;
use Illuminate\Http\Request;

class DossierController extends Controller
{
    public function index()
    {
            $dossiers = Dossier::all();
       
        return response()->json($dossiers);
    }


    public function show(Dossier $dossier)
    {
        return response()->json($dossier);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'ref' => 'required',
            'project_title' => 'required',
            'statue' => 'required',
            'researcher_id' => 'required'
        ]);

        $dossier = Dossier::create([
            'ref' => $request->ref,
            'project_title' => $request->project_title,
            'statue' => $request->statue,
            'date_de_depot' => $request->date_de_depot,
            'researcher_id' => $request->researcher_id
        ]);

        $reminder_types = ReminderType::all();
        foreach($reminder_types as $reminder_type){
            $date = Carbon::createFromFormat('Y-m-d', $dossier->date_de_depot);
            $date = $date->addDays($reminder_type->number_of_days);

            $reminderLine = ReminderLine::create([
                'dossier_id' => $dossier->id,
                'notif_date' => $date,
                'reminder_type_id' => $reminder_type->id,
            ]);
        }
        
        
        return response()->json($dossier);
    }

    public function update(Request $request, Dossier $dossier)
    {
        // $this->validate($request,[
            
        // ]);

        $dossier->update([
            'ref' => $request->ref,
            'project_title' => $request->project_title,
            'statue' => $request->statue,
            'date_de_depot' => $request->date_de_depot,
            'researcher_id' => $request->researcher_id
        ]);

        $reminder_lines = ReminderLine::where('dossier_id', $dossier->id );
        $date = Carbon::createFromFormat('Y-m-d', $dossier->date_de_depot);
        foreach($reminder_lines as $reminder_line){
            $date_de_notif = $date->addDays($reminder_line->remindertype->number_of_days);
            
            $reminder_line->update([
                'notif_date' => $date_de_notif
            ]);
        }

        return response()->json($dossier);
    }

    public function destroy(Dossier $dossier)
    {
        $reminderLine = ReminderLine::where('dossier_id', $dossier->id);
        $reminderLine->delete();
        $dossier->delete();
        return response()->json([
            'message' => 'dossier deleted'
        ]);
    }
}
