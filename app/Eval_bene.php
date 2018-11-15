<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Eval_bene extends Model
{
     protected $table = 'eval_benes';  
     protected $fillable = array('evaluacion_id', 'bene_id');

    public function getBeneByEvaluation($idEval){

        $results = array();

        $queries = DB::table('eval_benes')
            ->select('eval_benes.evaluacion_id as evaluacion_id', 'eval_benes.id as id', 'eval_benes.bene_id')
            ->where('eval_benes.evaluacion_id', '=', $idEval)
            ->get();

        return $queries;
    }
}
