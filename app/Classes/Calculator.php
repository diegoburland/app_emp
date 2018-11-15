<?php

namespace App\Classes;

use DB;

class Calculator
{
    public function average_eval(){
        
    }
    
    private function average_vw(){
        $avg = DB::table('evaluaciones')
            ->join('eval_items', 'eval_items.evaluacion_id', '=', 'evaluaciones.id')
            ->select(DB::raw('avg(eval_items.puntaje) as promedio'))
            ->where('eval_items.puntaje', '>', 0)->first();
        return $avg->promedio;
    }
    
    public function macth_result($avg_eval){
        
        $file = file_get_contents(__DIR__ . "\output.json");
        $json = json_decode($file, true);
        $avg_vw = $this->average_vw();
        
        $string="";
        switch ($avg_eval) {
            case $avg_eval>$avg_vw:

                $string = $avg_eval .">" . $avg_vw;
                break;

            default:
                break;
        }
        
        
        //$string = $json["case-1"];
        /*foreach($json as $i => $v)
        {
            $string = $string. $i;
            $string = $string. $v;
        }*/
         
        return $string;
    }
    
    
}

