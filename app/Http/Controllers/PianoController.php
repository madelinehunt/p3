<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PianoController extends Controller
{
    public function show($rootNote='none')
    {
        return view('piano.show')->with(['rootNote' => $rootNote]);
    }
}
