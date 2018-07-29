<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Evaluacion;
use App\Item;
use App\Categoria;

use App\Eval_item;

class Evaluacion_controller extends Controller
{
    public function store(Request $request){
		

        $random_hash = md5(uniqid(rand(), true));

		$evaluacion = Evaluacion::create($request->all() + ['confir_code' => $random_hash]); //mejorar        

        $items = Item::all();        

        foreach ($items as $item) {
            
            if($request->input('puntaje_' . $item->id) != null){

                Eval_item::create(array('evaluacion_id' => $evaluacion->id, 'item_id' => $item->id, 'puntaje' => $request->input('puntaje_' . $item->id), 'comentario' => $request->input('comentario_' . $item->id)));

            }
        }


        //return $request;
        return redirect('/empresa/' . $request->input('empresa_id'));
        
    }

    public function continuar_evaluacion(){

    	$categorias = Categoria::all();
    	$items = Item::all();
    	return view('empresa_evaluar', array('categorias' => $categorias, 'items' => $items));
    }    
}
