<?php

namespace App\Classes;

use DB;
use App\Evaluacion;

class Calculator {

    private static $AVG_1 = 4.4;
    private static $AVG_2 = 3.4;
    private static $AVG_3 = 2.4;
    private static $HOUR_1 = 44.6;

    public function total_dim_less_two($id){
        
        $dims = DB::table('evaluaciones')
                        ->join('eval_items', 'eval_items.evaluacion_id', '=', 'evaluaciones.id')
                        ->join('items', 'items.id', '=', 'eval_items.item_id')
                        ->select('items.nombre')
                        ->where([['eval_items.puntaje', '>', 0],['eval_items.puntaje', '<=', 2],
                                ['evaluaciones.id', '=', $id]])->get();
        return $dims;
    }

    public function average_eval($id) {

        $avg = DB::table('evaluaciones')
                        ->join('eval_items', 'eval_items.evaluacion_id', '=', 'evaluaciones.id')
                        ->select(DB::raw('avg(eval_items.puntaje) as avg_eval'))
                        ->where([['eval_items.puntaje', '>', 0],
                                ['evaluaciones.id', '=', $id]])->first();
        return $avg->avg_eval;
    }
    
    public function average_bene_vw(){
        
        $avg = DB::table('evaluaciones')
                        ->join('eval_benes', 'eval_benes.evaluacion_id', '=', 'evaluaciones.id')
                        ->select(DB::raw('count(*)/(select count(*) from evaluaciones) as avg_bene'))
                        ->first();
        return $avg->avg_bene;
    }
    
    public function total_bene_eval($id){
        
        $total = DB::table('evaluaciones')
                        ->join('eval_benes', 'eval_benes.evaluacion_id', '=', 'evaluaciones.id')
                        ->select(DB::raw('count(*) total_bene'))
                        ->where('evaluaciones.id', '=', $id)->first();
        return $total->total_bene;
    }

    public function average_vw() {
        $avg = DB::table('evaluaciones')
                        ->join('eval_items', 'eval_items.evaluacion_id', '=', 'evaluaciones.id')
                        ->select(DB::raw('avg(eval_items.puntaje) as avg_vw'))
                        ->where('eval_items.puntaje', '>', 0)->first();
        return $avg->avg_vw;
    }

    public function macth_result($id_eval) {

        $file = file_get_contents(__DIR__ . "/output.json");
        $json = json_decode($file, true);
        $avg_vw = round($this->average_vw(), 2);
        $evaluation = Evaluacion::find($id_eval);
        $avg_eval = round($this->average_eval($id_eval),2);

        
      
        if($evaluation->evalua == "Trabajo Actual"){
            
            $json = $json["current_job"];
        }else if($evaluation->evalua == "Trabajo Pasado"){
             $json = $json["past_job"];
        }else if($evaluation->evalua == "Práctica"){
             $json = $json["pratice_job"];
        }
        
        
        $string = "<h4>Promedio de evaluación subida en comparación con promedio de todas las evaluaciones subidas</h4>";
        if ($avg_eval < $avg_vw) {
            $string = $string . str_replace("$1", $avg_eval, $json[ 1]);
            $string = str_replace("$2", $avg_vw, $string);
        } else if ($avg_eval >= $avg_vw) {
            $string = $string . str_replace("$1", $avg_eval, $json[ 2]);
            $string = str_replace("$2", $avg_vw, $string);
        }

        //get interpretations
        $string = $string . "<h4>Interpretación del resultado</h4>";
        if ($avg_eval >= self::$AVG_1) {
            $string = $string . $json[ 3];
        } else if (self::$AVG_1 > $avg_eval && $avg_eval >= self::$AVG_2) {
            $string = $string . $json[ 4];
        } else if (self::$AVG_2 > $avg_eval && $avg_eval >= self::$AVG_3) {
            $string = $string . $json[ 5];
        }if (self::$AVG_3 > $avg_eval) {
            $string = $string . $json[ 6];
        }
        
        $dims = $this->total_dim_less_two($id_eval);
        
        if(count($dims) > 0){
        
            $str_tem = "";
            foreach ($dims as $dim) {

                $str_tem = $str_tem . $dim->nombre . ", ";
            }
            $string = $string . "<h4>Interpretación de dimensiones</h4>";
            $string = $string . str_replace("$1", $str_tem, $json[ 7]);
        }
        
        $total_bene = $this->total_bene_eval($id_eval);
        $avg_bene = round($this->average_bene_vw(),2);
        
        //benefy
        $string = $string . "<h4>Interpretación Beneficios </h4>";
        if($total_bene < $avg_bene){
            $string = $string . str_replace("$1", $avg_bene, $json[ 8]);
        }else{
            $string = $string . str_replace("$1", $avg_bene, $json[ 9]);
        }
        
        //worked time
        $string = $string . "<h4>Interpretación Horas Trabajadas por Semana</h4>";
        if($evaluation->trabajo_tiempo > 0){
            if($evaluation->trabajo_tiempo > self::$HOUR_1){

                $string = $string . str_replace("$1", $evaluation->trabajo_tiempo, $json[ 10]);
                $more = $evaluation->trabajo_tiempo - self::$HOUR_1;
                $string = str_replace("$2", $more, $string);
            }else{
                $string = $string . str_replace("$1", $evaluation->trabajo_tiempo, $json[ 11]);
                $less = self::$HOUR_1 - $evaluation->trabajo_tiempo;
                $string = str_replace("$2", $less, $string);
            }    
        }
        
       
        return $string;
    }

}
