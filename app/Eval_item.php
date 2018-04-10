<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eval_item extends Model
{
    protected $fillable = array('evaluacion_id', 'item_id', 'puntaje');
}
