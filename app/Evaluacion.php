<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Evaluacion extends Model
{
    protected $table = 'evaluaciones';
<<<<<<< HEAD
    protected $fillable = array('porque', 'motivo', 'contenido', 'publicada', 'ip', 'confirmed', 'empresa_id', 'evalua', 'trabajo_tiempo', 'posicion', 'departamento', 'titulo', 'comentarios', 'mejoras', 'like', 'no_like', 'recomienda', 'beneficios', 'email', 'salario', 'ofrecer', 'oferta', 'confir_code', 'ies', 'ciudad_eval_id', 'id_padre');
  
    /*public function setConfirmedAttribute($confirmed)
    {
        $this->attributes['confirmed'] = $confirmed;
    }*/
=======
    protected $fillable = array('contenido', 'publicada', 'ip', 'confirmed', 'empresa_id', 'evalua', 'trabajo_tiempo', 'posicion', 'departamento', 'titulo', 'comentarios', 'mejoras', 'like', 'no_like', 'recomienda', 'beneficios', 'email', 'salario', 'ofrecer', 'oferta', 'confir_code', 'id_padre');
 
>>>>>>> ca4bbfce86e015424ae11dd9b420be1d89c17dab
}
