<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Log;

use DB;

class Empresa extends Model
{
    
    protected $fillable = array('razon_social', 'sector_economico', 'ciudad_id', 'direccion', 'tel', 'email', 'nombres_contacto', 'apellidos_contacto', 'tel_contacto', 'cel_contacto', 'email_contacto', 'verificada');

    public function ciudad()
    {
        return $this->belongsTo('App\Ciudad');
    }

    public function get_score($id){
    	
        
        $results = array();

        $evaluaciones = DB::table('evaluaciones')
            ->join('eval_items', 'eval_items.evaluacion_id', '=', 'evaluaciones.id')
            ->join('items', 'items.id', '=', 'eval_items.item_id')
            ->select('items.id', 'items.nombre', 'items.categoria_id', 
            DB::raw('round((sum(eval_items.puntaje)/count(items.id)), 2 ) as promedio'))
            ->where('evaluaciones.empresa_id', '=', $id)->where('evaluaciones.posicion', '=', 'Practicante')->orWhere('evaluaciones.posicion','Empleado')
            ->groupBy('items.id')->get();
       

        // dd($evaluaciones);
        return $evaluaciones;
    } 

    // public function get_score($id){
    	
        
    //     $results = array();

    //     $evaluaciones = DB::table('evaluaciones')
    //         ->join('eval_items', 'eval_items.evaluacion_id', '=', 'evaluaciones.id')
    //         ->join('items', 'items.id', '=', 'eval_items.item_id')
    //         ->select('items.id', 'items.nombre', 'items.categoria_id', 
    //         DB::raw('round((sum(eval_items.puntaje)/count(items.id)), 2 ) as promedio'))
    //         ->where('evaluaciones.empresa_id', '=', $id)
    //         ->groupBy('items.id')->get();
       


    //     return $evaluaciones;
    // } 

    public function score_individual($id){
        $evaluaciones = DB::table('evaluaciones')
            ->select('evaluaciones.id as main')
            ->where('evaluaciones.empresa_id', '=', $id)
            ->groupBy('evaluaciones.id')->inRandomOrder()->take(4)->get();
        $array = array();
        
        foreach($evaluaciones as $key => $value):
            $eval_items = DB::table('eval_items')
            ->join('evaluaciones', 'evaluaciones.id', '=', 'eval_items.evaluacion_id')
            ->join('items', 'items.id', '=', 'eval_items.item_id')
            ->select('evaluaciones.id','evaluaciones.titulo','evaluaciones.mejoras','evaluaciones.motivo', 'evaluaciones.porque','evaluaciones.comentarios','evaluaciones.titulo','evaluaciones.recomienda','evaluaciones.si_valiosa','evaluaciones.no_valiosa','evaluaciones.created_at as date','eval_items.puntaje', 'eval_items.comentario','items.categoria_id as categoriaID','items.nombre as nombre_categoria', 'evaluaciones.departamento', 'evaluaciones.like as pro', 'evaluaciones.no_like as contra',
            'evaluaciones.evalua')
            ->where('eval_items.evaluacion_id', '=', $value->main)->whereIn('items.categoria_id', [1,2])
            ->get();
            $eval_items[] = $this->get_iconos_individuales($value->main);
            $array[] = $eval_items; 
            // dd($value->main);
        endforeach;

        return $array;

    }

    public function get_score_options($id, $tipo){
        $results = array();
        
        $evaluaciones = DB::table('evaluaciones')
            ->join('eval_items', 'eval_items.evaluacion_id', '=', 'evaluaciones.id')
            ->join('items', 'items.id', '=', 'eval_items.item_id')
            ->select('items.id', 'items.nombre', 'items.categoria_id', 'items.descripcion',DB::raw('round((sum(eval_items.puntaje)/count(items.id)), 2 ) as promedio'), DB::raw('count(items.id) as cantidad'))
            ->where('evaluaciones.empresa_id', '=', $id)->where('evaluaciones.posicion', '=', $tipo)
            ->groupBy('items.id')->get();
       

        return $evaluaciones;
        
    }

    public function get_iconos_individuales($id){
        $iconos = DB::table('eval_benes')
        ->join('benes', 'benes.id', '=', 'eval_benes.bene_id')
        ->select('benes.nombre', 'benes.url_img')
        ->where('eval_benes.evaluacion_id','=', $id)->get();

        return $iconos;
    }
    
    
    public function get_nombre($term){
        
        $result = DB::select("select id, razon_social, nicknames from empresas where nicknames like '%:term%' union select id, razon_social, nicknames from empresas where razon_social like '%:term%' limit 5", ['term'=>$term]);
        
        Log::info($result);
        return $result;
    }
}
