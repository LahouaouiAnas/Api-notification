<?php

namespace App\Http\Controllers;

use App\Models\Statue;
use Illuminate\Http\Request;

class StatueController extends Controller
{
    public function store(Request $request)
    {

        $this->validate($request,[
            'name' => 'required'
        ]);

        $statue = Statue::create([
            'name' => $request->name,
            'description' => $request->description
        ]);
        return response()->json($statue);
    }

    public function update(Request $request, Statue $statue)
    {
        $this->validate($request,[
            'nom' => 'required'
        ]);

        $statue->update([
            'nom' => $request->name,
            'description' => $request->description
        ]);

        return response()->json($statue);
        
    }
}
