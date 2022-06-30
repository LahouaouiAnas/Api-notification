<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Dossier;
use App\Models\Researcher;
use Illuminate\Http\Request;

class DossierController extends Controller
{
    public function index()
    {
        $dossiers = Dossier::all();
        return response()->json($dossiers);
    }

    // public function dossierToArray($dossiers)
    // {
    //     foreach ($dossiers as $dossier) {
    //         $data['reference'] = $dossier->ref;
    //         $data['project_title'] = $dossier->project_title;
    //         $data['researcher_nom'] = $dossier->researcher->nom;
    //         $data['researcher_prenom'] = $dossier->researcher->prenom;
    //         $data['departement'] = $dossier->researcher->departement->nom;
    //         $data['date_de_depot'] = $dossier->date_de_depot;
    //         $data['statue'] = $dossier->statue;
    //     }
    //     return $data;
    // }

    public function show(Dossier $dossier)
    {
            // $data['reference'] = $dossier->ref;
            // $data['project_title'] = $dossier->project_title;
            // $data['researcher_nom'] = $dossier->researcher->nom;
            // $data['researcher_prenom'] = $dossier->researcher->prenom;
            // $data['departement'] = $dossier->researcher->departement->nom;
            // $data['date_de_depot'] = $dossier->date_de_depot;
            // $data['statue'] = $dossier->statue;

        return response()->json($dossier);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'ref' => 'required',
            'project_title' => 'required',
            'statue' => 'required',
            'date_de_depot' => 'required',
            'researcher_id' => 'required'
        ]);

        $dossier = Dossier::create([
            'ref' => $request->ref,
            'project_title' => $request->project_title,
            'statue' => $request->statue,
            'date_de_depot' => $request->date_de_depot,
            'researcher_id' => $request->researcher_id
        ]);
        
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

        return response()->json($dossier);
    }

    public function destroy(Dossier $dossier)
    {
        $dossier->delete();
        return response()->json([
            'message' => 'dossier deleted'
        ]);
    }
}
