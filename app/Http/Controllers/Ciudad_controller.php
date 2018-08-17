<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Ciudad;

class Ciudad_controller extends Controller
{
    
    public function get_ciudad(Request $request){

    	$ciudad = new Ciudad();
    	$results = $ciudad->get_ciudad($request->input('term'));

        return response()->json($results);
    }

    
}
