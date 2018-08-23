<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eval_bene extends Model
{
     protected $table = 'eval_benes';
     protected $fillable = array('evaluacion_id', 'bene_id');
}
