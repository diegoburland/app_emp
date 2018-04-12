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
		

		$evaluacion = Evaluacion::create($request->all()); //mejorar        

        $items = Item::all();        

        foreach ($items as $item) {
            
            if($request->input('item_' . $item->id) != null){

                Eval_item::create(array('evaluacion_id' => $evaluacion->id, 'item_id' => $item->id, 'puntaje' => $request->input('item_' . $item->id)));

            }
        }

		//Empresa::create(array('razon_social' =>$razon_social));
		//return 'empresa creada';
    	//use App\Empresa::create(array())
    	//return redirect('continuar_evaluacion');
    	//

        return redirect('/empresa/' . $request->input('empresa_id'));
        //return $evaluacion;//$request->input('empresa_id');
    }

    public function continuar_evaluacion(){

    	$categorias = Categoria::all();
    	$items = Item::all();
    	return view('empresa_evaluar', array('categorias' => $categorias, 'items' => $items));
    }    
}
