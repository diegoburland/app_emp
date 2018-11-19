<?php

namespace App\Http\Controllers;

use App\Classes\Calculator;

class Prueba_controller extends Controller
{
    public function show($id)
    {
        $calculator = new Calculator();
        return $calculator->macth_result(7);
        //return $calculator->average_vw();
    }
}


