<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Evaluacion;
use App\Item;
use App\Categoria;

class Evaluacion_controller extends Controller
{
    public function store(Request $request){
		

		$evaluacion = Evaluacion::create($request->all());
		//Empresa::create(array('razon_social' =>$razon_social));
		//return 'empresa creada';
    	//use App\Empresa::create(array())
    	return redirect('continuar_evaluacion/'. $evaluacion->id);
    	//
    }

    public function continuar_evaluacion(){

    	$categorias = Categoria::all();
    	$items = Item::all();
    	return view('empresa_evaluar', array('categorias' => $categorias, 'items' => $items));
    }    
}
