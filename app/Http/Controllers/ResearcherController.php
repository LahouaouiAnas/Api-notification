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
        $researchers = Researcher::with('departement')->get();
       return  response()->json($researchers);
    }

    public function show(Researcher $researcher)
    {
        $researcher2 = $researcher->load('departement');
        return response()->json($researcher2);
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
            $dossierController->destroy($dossier);
        }
        $researcher->delete();
        return response()->json([
            'message' => 'researcher deleted'
        ]);
    }
}

