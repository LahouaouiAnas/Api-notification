<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    public function index()
    {
        $departements = Departement::all();
        return response()->json($departements);
    }

    // public function departementsToArray($departements)
    // {
    //     foreach ($departements as $departement) {
    //         $data['nom'] = $departement->nom;
    //     }
    //     return $data;
    // }

    public function show(Departement $departement)
    {
        return response()->json($departement);
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'nom' => 'required'
        ]);

        $departement = Departement::create([
            'nom' => $request->nom
        ]);
        return response()->json($departement);
    }

    public function update(Request $request, Departement $departement)
    {
        $this->validate($request,[
            'nom' => 'required'
        ]);

        $departement->update([
            'nom' => $request->nom
        ]);

        return response()->json($deaprtement);
    }

    
}
