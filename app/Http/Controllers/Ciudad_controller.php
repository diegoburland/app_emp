<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Ciudad;
use DB;

class Ciudad_controller extends Controller
{
    
    public function get_ciudad(Request $request){    	
        
        $results = array();
        
        $term = $request->input('term');
        
        $queries = DB::table('ciudades')
            ->join('departamentos', 'departamentos.id', '=', 'ciudades.departamento_id')
            ->select('ciudades.id', 'ciudades.nombre as c_nombre', 'departamentos.nombre as d_nombre')
            ->where('ciudades.nombre', 'LIKE', '%'.$term.'%')
            ->take(5)->get();

    
        //$queries = Ciudad::where('nombre', 'LIKE', '%'.$term.'%')->take(5)->get();
        
        foreach ($queries as $query)
        {
            $results[] = [ 'id' => $query->id, 'value' => ($query->c_nombre . ' (' . $query->d_nombre . ')') ];
        }        

        return response()->json($results);
    }

    
}
