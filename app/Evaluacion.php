<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Evaluacion extends Model
{
    protected $table = 'evaluaciones';
    protected $fillable = array('contenido', 'publicada', 'ip', 'confirmed', 'empresa_id', 'evalua', 'trabajo_tiempo', 'posicion', 'departamento', 'titulo', 'comentarios', 'mejoras', 'like', 'no_like', 'recomienda', 'beneficios', 'email', 'salario', 'ofrecer', 'oferta', 'confir_code', 'id_padre');
 

    public function updateEval($idEval, $titulo){

        $results = array();

        DB::table('evaluaciones')
            ->where('id', $idEval)
            ->update(['titulo' => $titulo]);

        return '1';

    }
}
