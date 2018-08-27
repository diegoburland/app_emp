<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Evaluacion;
use App\Empresa;
use App\Item;
use App\Categoria;
use App\Mail\OcupasionEmail;

use Mail;

use App\Eval_item;

class Evaluacion_controller extends Controller
{
    public function store(Request $request){
		

        $random_hash = bin2hex(random_bytes(32));

		    $evaluacion = Evaluacion::create($request->all() + ['confir_code' => $random_hash]); //mejorar        

        $items = Item::all();        

        foreach ($items as $item) {
            
            if($request->input('puntaje_' . $item->id) != null){

                Eval_item::create(array('evaluacion_id' => $evaluacion->id, 'item_id' => $item->id, 'puntaje' => $request->input('puntaje_' . $item->id), 'comentario' => $request->input('comentario_' . $item->id)));

            }
        }


        //return $request;
      
        return redirect()->action('Evaluacion_controller@gracias', ['email' => $request->input('email'), 'empresa' => $request->input('empresa_nombre')]);
      
        //return redirect('/gracias?email='. $request->input('email') . '&empresa=' . $request->input('empresa_nombre'));
        
    }

    public function list(){


        $empresa = new Empresa();
        $evaluacion = Evaluacion::all()->toArray();
        for ($i=0; $i < count($evaluacion); $i++) { 
            $empresa = $empresa->find($evaluacion[$i]['empresa_id']);
            $evaluacion[$i]['empresa'] = $empresa->razon_social;
          
        } 

        $results = array();

        $results[] = $evaluacion;


        return view('evaluacion_list', array('evaluaciones' => $results));
    }  

    public function continuar_evaluacion(){

    	$categorias = Categoria::all();
    	$items = Item::all();
    	return view('empresa_evaluar', array('categorias' => $categorias, 'items' => $items));
    }

    public function gracias($email, $empresa){
      
        //aca se deben validar varias cosas, solo debe enviar el id de la evaluacion
        //Request $request
      
        
        $data = ['message' => 'This is a test!'];

        Mail::to($email)->send(new OcupasionEmail($data));
        
        return view('gracias', ['email' => $email, 'empresa' => $empresa]);
    }    
}
