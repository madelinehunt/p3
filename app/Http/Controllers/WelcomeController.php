<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ianring\Score;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('piano.show')->with(['rootNote' => 'none']);
    }
}
