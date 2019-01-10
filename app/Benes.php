<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Benes extends Model
{
    protected $table = 'benes'; 


    public function get_beneficios($id){
    	
        
        $results = array();

        $beneficios = DB::table('evaluaciones')
            ->join('eval_benes', 'eval_benes.evaluacion_id', '=', 'evaluaciones.id')
            ->join('benes', 'benes.id', '=', 'eval_benes.bene_id')
            ->select('benes.id', 'benes.url_img','benes.nombre', DB::raw('count(eval_benes.bene_id) as cantidad'))
            ->where('eval_benes.evaluacion_id', '=', $id)
            ->groupBy('eval_benes.bene_id')->orderBy('cantidad','DESC')->take(8)->get();
       

        return $beneficios;
    }

}
