<?php

namespace App\Classes;

use DB;
use App\Evaluacion;

class Calculator {

    private static $AVG_1 = 4.4;
    private static $AVG_2 = 3.4;
    private static $AVG_3 = 2.4;

    public function total_dim_less_two($id){
        
        $dims = DB::table('evaluaciones')
                        ->join('eval_items', 'eval_items.evaluacion_id', '=', 'evaluaciones.id')
                        ->join('items', 'items.id', '=', 'eval_items.item_id')
                        ->select('items.nombre')
                        ->where([['eval_items.puntaje', '<=', 2],
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

    public function average_vw() {
        $avg = DB::table('evaluaciones')
                        ->join('eval_items', 'eval_items.evaluacion_id', '=', 'evaluaciones.id')
                        ->select(DB::raw('avg(eval_items.puntaje) as avg_vw'))
                        ->where('eval_items.puntaje', '>', 0)->first();
        return $avg->avg_vw;
    }

    public function macth_result($id_eval) {

        $file = file_get_contents(__DIR__ . "\output.json");
        $json = json_decode($file, true);
        $avg_vw = $this->average_vw();
        $evaluation = Evaluacion::find($id_eval);
        $avg_eval = $this->average_eval($id_eval);

        //get first resul 
        $string = "";
        if ($avg_eval < $avg_vw) {
            $string = str_replace("$1", $avg_eval, $json["case-1"]);
            $string = str_replace("$2", $avg_vw, $string);
        } else if ($avg_eval >= $avg_vw) {
            $string = str_replace("$1", $avg_eval, $json["case-2"]);
            $string = str_replace("$2", $avg_vw, $string);
        }

        //get interpretations
        if ($avg_eval >= self::$AVG_1) {
            $string = $string . $json["case-3"];
        } else if (self::$AVG_1 > $avg_eval && $avg_eval >= self::$AVG_2) {
            $string = $string . $json["case-4"];
        } else if (self::$AVG_2 > $avg_eval && $avg_eval >= self::$AVG_3) {
            $string = $string . $json["case-5"];
        }if (self::$AVG_3 > $avg_eval) {
            $string = $string . $json["case-6"];
        }
        
        $dims = $this->total_dim_less_two($id_eval);
        
        if(count($dims) > 0){
        
            $str_tem = "";
            foreach ($dims as $dim) {

                $str_tem = $str_tem . $dim->nombre . ", ";
            }
            $string = $string . $json["case-7"];
            $string = str_replace("$1", $str_tem, $string);
        }
        

        return $string;
    }

}
