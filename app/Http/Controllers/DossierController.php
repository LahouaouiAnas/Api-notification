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
use Illuminate\Support\Facades\DB;

class DossierController extends Controller
{
    public function index()
    {
        $dossiers = Dossier::with('researcher', 'reminderLines', 'statue')->get();
        return response()->json($dossiers);
    }

    public function show(Dossier $dossier)
    {   
        if(isset($dossier->id))
        {
            $dossier2 = $dossier->load('researcher', 'reminderLines', 'statue');
            return response()->json($dossier2);
        }
        else
        {
            return response()->json([
                'message' => 'dossier nexistes pas'
            ]);
        }
        
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'ref' => 'required|string|max:20',
            'project_title' => 'required|string|max:191',
            'researcher_id' => 'required',
            'statue_id' => 'required',
            'date_de_depot' => 'nullable'
        ]);

        $dossier = Dossier::create([
            'ref' => $request->ref,
            'project_title' => $request->project_title,
            'date_de_depot' => $request->date_de_depot,
            'statue_id' => $request->statue_id,
            'researcher_id' => $request->researcher_id
        ]);

        if(!empty($request->date_de_depot)){
        $reminder_types = ReminderType::all();
        foreach($reminder_types as $reminder_type){
                $actif = 0;
                $date1 = Carbon::createFromFormat('Y-m-d', $dossier->date_de_depot);
                $date2 = Carbon::createFromFormat('Y-m-d', $dossier->date_de_depot);
                $date1 = $date1->addDays($reminder_type->number_of_days_notif1);
                $date2 = $date2->addDays($reminder_type->number_of_days_notif2);

            if($reminder_type->order == 1)
            {
                $actif = 1;
            }
                $reminderLine = ReminderLine::create([
                    'dossier_id' => $dossier->id,
                    'premiere_notif_date' => $date1,
                    'deuxieme_notif_date' => $date2,
                    'actif' => $actif,
                    'done' => 0,
                    'reminder_type_id' => $reminder_type->id
                ]);
            }
        }
        return response()->json($dossier);
    }

    public function update(Request $request, Dossier $dossier)
    {
        $this->validate($request,[
            
        ]);
        
        $dossier->update([
            'ref' => $request->ref,
            'project_title' => $request->project_title,
            'statue_id' => $request->statue_id,
            'researcher_id' => $request->researcher_id
        ]);
        if(!empty($dossier->date_de_depot)){
            if(!empty($request->date_de_depot)){
                $dossier->update([
                    'date_de_depot' => $request->date_de_depot
                ]);
                $reminder_lines = DB::table('reminder_lines')->where('dossier_id', $dossier->id)->get();
                foreach($reminder_lines as $row){
                    $reminder_line = ReminderLine::find($row->id);
                    $reminder_type = ReminderType::find($reminder_line->reminder_type_id);
                    $date1 = Carbon::createFromFormat('Y-m-d', $request->date_de_depot);
                    $date2 = Carbon::createFromFormat('Y-m-d', $request->date_de_depot);
                    $date1 = $date1->addDays($reminder_type->number_of_days_notif1);
                    $date2 = $date2->addDays($reminder_type->number_of_days_notif2);
                    $reminder_line->update([
                        'premiere_notif_date' => $date1,
                        'deuxieme_notif_date' => $date2
                    ]);
                }
            }
        }

        else{
            if(!empty($request->date_de_depot)){
                $dossier->update([
                    'date_de_depot' => $request->date_de_depot
                ]);
                $reminder_types = ReminderType::all();
                foreach($reminder_types as $reminder_type){

                    $actif = 0;
                    $date1 = Carbon::createFromFormat('Y-m-d', $dossier->date_de_depot);
                    $date2 = Carbon::createFromFormat('Y-m-d', $dossier->date_de_depot);
                    $date1 = $date1->addDays($reminder_type->number_of_days_notif1);
                    $date2 = $date2->addDays($reminder_type->number_of_days_notif2);
    
                if($reminder_type->order == 1)
                {
                    $actif = 1;
                }
                    $reminderLine = ReminderLine::create([
                        'dossier_id' => $dossier->id,
                        'premiere_notif_date' => $date1,
                        'deuxieme_notif_date' => $date2,
                        'actif' => $actif,
                        'done' => 0,
                        'reminder_type_id' => $reminder_type->id
                    ]);
                }
            }
        }   

        return response()->json($dossier);
    }

    public function destroy(Dossier $dossier)
    {
        $reminder_lines = ReminderLine::where('dossier_id', $dossier->id)->get();
        foreach($reminder_lines as $reminder_line){
            ReminderLine::find($reminder_line->id)->delete();
        }
        $dossier->delete();
        return response()->json([
            'message' => 'dossier deleted'
        ]);
    }

    public function switchReminder_line_type(Request $request)
    {
        ReminderLine::find($request->current_reminder_line_id)->update([
            'actif' => 0,
            'done' => 1
        ]);

        ReminderLine::find($request->next_reminder_line_id)->update([
            'actif' => 1
        ]);
        
        return response()->json([
            'message' => 'phase changed'
        ]);
    }

    public function arret($id){
        $dossier = Dossier::find($id);

        if($dossier->arret == 0){
            $dossier->arret = 1;
        }
        else{
            $dossier->arret = 0;
        }
        $dossier->save();

        return response()->json([
            'message' => 'dossier arreté'
        ]);
    } 
}
