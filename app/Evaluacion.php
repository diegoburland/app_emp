<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    protected $table = 'evaluaciones';
    protected $fillable = array('empresa_id', 'evalua', 'trabajo_tiempo', 'posicion', 'departamento', 'titulo');    
}
