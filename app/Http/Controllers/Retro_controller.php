<?php

namespace App\Http\Controllers;

use App\Classes\Calculator;

class Retro_controller extends Controller
{
    public function show($id)
    {
        //$calculator = new Calculator();
        //return $calculator->macth_result($id);
        //return $calculator->average_vw();
        
        return view('emails.output');
    }
}


