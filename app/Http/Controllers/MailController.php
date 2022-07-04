<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class mailing extends Controller
{
    public function mailing()
    {
        Mail::to('user@gmail.com')->send(new Mail());
        return view('test');
    }
}
