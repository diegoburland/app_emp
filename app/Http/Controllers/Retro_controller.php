<?php

namespace App\Http\Controllers;

use App\Classes\Calculator;

class Retro_controller extends Controller
{
    public function show($id)
    {
        $calculator = new Calculator();
        $result =  $calculator->macth_result($id);
        //return $calculator->macth_result($id);
        return view('emails.ouput', $result);
    }
}


