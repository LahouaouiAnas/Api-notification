<?php

namespace App\Http\Controllers;

use App\Models\Researcher;
use Illuminate\Http\Request;

class ResearcherController extends Controller
{
    public function index()
    {
        $researchers = Researcher::all();
        return response()->json($researchers);
    }


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
        $researcher->delete();
        return response()->json([
            'message' => 'researcher deleted'
        ]);
    }
}
