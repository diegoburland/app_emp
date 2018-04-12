<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Ciudad extends Model
{
    protected $table = "ciudades";

    public function get_ciudad($term){

        //$term = $request->input('term');
        
        $results = array();

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

        return $results;
    }
}
