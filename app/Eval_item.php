<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Eval_item extends Model
{
	protected $table = "eval_items";

    protected $fillable = array('evaluacion_id', 'item_id', 'puntaje', 'comentario');

    public function getItemByEvaluation($idEval){

        $results = array();

        $queries = DB::table('eval_items')
            ->select('eval_items.item_id as id', 'eval_items.puntaje as puntaje', 'eval_items.comentario as comentario')
            ->where('eval_items.evaluacion_id', '=', $idEval)
            ->get();

        return $queries;
    }
}
