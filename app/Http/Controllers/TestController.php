<?php

namespace App\Http\Controllers;

use App\Mail\mailTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{
    public function mailing()
    {
        Mail::to('user@gmail.com')->send(new mailTest);
        return view('test');
    }
}

