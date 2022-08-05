<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function store(Request $req)
    {
        $req->validate([
            'reminder_line_id' => 'required',
            'path' => 'required'
        ]);
        
        $fileName = time().'_'.$req->path->getClientOriginalName();
        $path = $req->file('path')->storeAs('uploads', $fileName, 'public');
        
        $file = File::create([
            'reminder_line_id' =>$req->reminder_line_id,
            'name' => $fileName,
            'path' => $path
        ]);
        
        return response()->json([
            'message' => 'File uploaded'
        ]);
    }   
}





