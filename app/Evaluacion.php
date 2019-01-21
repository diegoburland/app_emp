<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    protected $table = 'evaluaciones';
    protected $fillable = array('porque', 'motivo', 'contenido', 'publicada', 'ip', 'confirmed', 'empresa_id', 'evalua', 'trabajo_tiempo', 'posicion', 'departamento', 'titulo', 'comentarios', 'mejoras', 'like', 'no_like', 'recomienda', 'beneficios', 'email', 'salario', 'ofrecer', 'oferta', 'confir_code', 'ies', 'ciudad_eval_id', 'id_padre', 'job_id', 'salary');
  
    /*public function setConfirmedAttribute($confirmed)
    {
        $this->attributes['confirmed'] = $confirmed;
    }*/
    
    

}
