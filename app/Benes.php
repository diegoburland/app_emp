<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Benes extends Model
{
    protected $table = 'benes'; 


    public function get_beneficios_icons($id){

        $beneficios = DB::table('evaluaciones')
            ->join('eval_benes', 'eval_benes.evaluacion_id', '=', 'evaluaciones.id')
            ->join('benes', 'benes.id', '=', 'eval_benes.bene_id')
            ->select('benes.id', 'benes.tipo','benes.url_img','benes.nombre', 'evaluaciones.empresa_id','evaluaciones.posicion', 'eval_benes.bene_id', 'eval_benes.id', DB::raw('count(eval_benes.bene_id) as cantidad'))
            ->where('evaluaciones.empresa_id', '=', $id)
            ->groupBy('eval_benes.bene_id')->orderBy('cantidad','DESC')->take(8)->get();
       

        return $beneficios;
    }


    public function get_beneficios_group_type($id){
        $posiciones = DB::table('evaluaciones')
        ->join('eval_benes', 'eval_benes.evaluacion_id', '=', 'evaluaciones.id')
        ->select('evaluaciones.empresa_id','evaluaciones.posicion', 'eval_benes.bene_id', 'eval_benes.id')
        ->where('evaluaciones.empresa_id', '=', $id)->get();

        return $posiciones;
    }

    

    public function in_array_beneficios($id){
        $consulta_beneficios = DB::table('eval_benes')->select('bene_id')->where('evaluacion_id', '=', $id)->get();
        return $consulta_beneficios;
    }

    public function grupo_beneficio(){
        $grupo = DB::table('benes')
        ->where('grupo', '=', 'otro')
        ->orWhere('grupo', 'bienestar')
        ->orWhere('grupo', 'financiero')
        ->orWhere('grupo', 'apoyo')->get();

        return $grupo;
    }
    
}
