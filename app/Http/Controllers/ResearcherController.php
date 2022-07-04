<?php

namespace App\Http\Controllers;

use App\Models\Dossier;
use App\Models\Researcher;
use Illuminate\Http\Request;
use App\Http\Controllers\DossierController;

class ResearcherController extends Controller
{
    public function index()
    {
        $researchers = Researcher::all();
        return response()->json($researchers);
    }

    // public function showResearcher ($researchers)
    // {
    //     foreach ($researchers as $researcher){
    //         $data['nom'] = $researcher->departement->id;
    //     }
    //     return $data;
    // } 

    public function show(Researcher $researcher)
    {
        return response()->json($researcher);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'departement_id' => 'required'
        ]);

        $researcher = Researcher::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'departement_id' => $request->departement_id
        ]);

        return response()->json($researcher);
    }

    public function update(Request $request, Researcher $researcher)
    {
        $this->validate($request,[
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'departement_id' => 'required'
        ]);

        $researcher->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'departement_id' => $request->departement_id
        ]);

        return response()->json($researcher);
    }

    public function destroy(Researcher $researcher)
    {
        $dossiers = Dossier::where('researcher_id', $researcher->id);
        foreach ($dossiers as $dossier)
        {
            $dossierController = new DossierController;
            $dossierController->destroy();
        }
        $researcher->delete();
        return response()->json([
            'message' => 'researcher deleted'
        ]);
    }
}

