<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiatonicController extends Controller
{
    public function show($rootNote='C-nat')
    {
        return $rootNote;
    }
}
