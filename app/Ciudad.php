<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Ciudad extends Model
{
    protected $table = "ciudades";

    public function get_ciudad($term){

        
    }

    public function get_ciudadId($id){

        //$term = $request->input('term');
        
        $results = array();

        $queries = DB::table('ciudades')
            ->join('departamentos', 'departamentos.id', '=', 'ciudades.departamento_id')
            ->select('ciudades.id', 'ciudades.nombre as c_nombre', 'departamentos.nombre as d_nombre')
            ->where('ciudades.id', '=', $id)
            ->take(5)->get();

           

        return $queries[0]->c_nombre . ' (' . $queries[0]->d_nombre . ')';
    }
}
