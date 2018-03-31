<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Evaluacion;

class Evaluacion_controller extends Controller
{
    public function store(Request $request){
		

		Evaluacion::create($request->all());
		//Empresa::create(array('razon_social' =>$razon_social));
		//return 'empresa creada';
    	//use App\Empresa::create(array())
    	return redirect('empresa_list');
    }
}
