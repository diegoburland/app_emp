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
        
        
        $avg_eval_string = "";
        $avg_eval_detail = "";
        if ($avg_eval < $avg_vw) {
            //$string1 = $string1 . str_replace("$1", $avg_eval, $json[ 1]);
            $avg_eval_string = str_replace("$2", $avg_vw, $json[ 1]);
            $avg_eval_detail = $json["1.1"];
        } else if ($avg_eval >= $avg_vw) {
            //$string1 = $string1 . str_replace("$1", $avg_eval, $json[ 2]);
            $avg_eval_string = str_replace("$2", $avg_vw, $json[ 2]);
            $avg_eval_detail = $json["2.1"];
        }

        //get interpretations
        $interpre_detail = "";
        if ($avg_eval >= self::$AVG_1) {
            $interpre_detail = $json[ 3];
        } else if (self::$AVG_1 > $avg_eval && $avg_eval >= self::$AVG_2) {
            $interpre_detail = $json[ 4];
        } else if (self::$AVG_2 > $avg_eval && $avg_eval >= self::$AVG_3) {
            $interpre_detail = $json[ 5];
        }if (self::$AVG_3 > $avg_eval) {
            $interpre_detail = $json[ 6];
        }
        
        $dims = $this->total_dim_less_two($id_eval);
        
        
        $dimen_detail = "";
        if(count($dims) > 0){
        
            $str_tem = "";
            foreach ($dims as $dim) {

                $str_tem = $str_tem . $dim->nombre . ", ";
            }
            
            $dimen_detail = str_replace("$1", $str_tem, $json[ 7]);
        }
        
        $total_bene = $this->total_bene_eval($id_eval);
        $avg_bene = round($this->average_bene_vw(),2);
        
        //benefy
        $bene_detail = "";
        if($total_bene < $avg_bene){
            $bene_detail = str_replace("$1", $avg_bene, $json[ 8]);
        }else{
            $bene_detail = str_replace("$1", $avg_bene, $json[ 9]);
        }
        
        //worked time
        $hours_detail = "";
        if($evaluation->trabajo_tiempo > 0){
            if($evaluation->trabajo_tiempo > self::$HOUR_1){

                $hours_detail = str_replace("$1", $evaluation->trabajo_tiempo, $json[ 10]);
                $more = $evaluation->trabajo_tiempo - self::$HOUR_1;
                $hours_detail = str_replace("$2", $more, $hours_detail);
            }else{
                $hours_detail = str_replace("$1", $evaluation->trabajo_tiempo, $json[ 11]);
                $less = self::$HOUR_1 - $evaluation->trabajo_tiempo;
                $hours_detail = str_replace("$2", $less, $hours_detail);
            }    
        }
        
       
        $result = array('avg_eval'=> $avg_eval, 
            'type' => $evaluation->evalua,
            'avg_eval_string' => $avg_eval_string,
            'avg_eval_detail' => $avg_eval_detail,
            'interpre_detail' => $interpre_detail, 
            'dimen_detail' =>$dimen_detail, 
            'bene_detail' =>$bene_detail, 
            'hours_detail' => $hours_detail);
        
        return $result;
    }

}
