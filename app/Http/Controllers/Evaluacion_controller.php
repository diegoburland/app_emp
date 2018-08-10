<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Evaluacion;
use App\Item;
use App\Categoria;
use App\Mail\TestEmail;

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

    public function continuar_evaluacion(){

    	$categorias = Categoria::all();
    	$items = Item::all();
    	return view('empresa_evaluar', array('categorias' => $categorias, 'items' => $items));
    }

    public function gracias($email, $empresa){
        //Request $request
      
        
        /*$data = ['message' => 'This is a test!'];

        Mail::to('jose1914luis@gmail.com')->send(new TestEmail($data));
        */
        return view('gracias', ['email' => $email, 'empresa' => $empresa]);
    }    
}
