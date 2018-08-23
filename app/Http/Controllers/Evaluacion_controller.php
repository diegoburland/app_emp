<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Evaluacion;
use App\Item;
use App\Categoria;
use App\Benes;
use App\Empresa;
use App\Mail\OcupasionEmail;

use Mail;

use App\Eval_item;

class Evaluacion_controller extends Controller
{
    public function store(Request $request){
		

        $random_hash = bin2hex(random_bytes(32));
        //$random_hash
        $request->request->add(['confir_code' =>  $random_hash]);
		    $evaluacion = Evaluacion::create($request->all()); //mejorar        

        $items = Item::all();        

        foreach ($items as $item) {
            
            if($request->input('puntaje_' . $item->id) != null){

                Eval_item::create(array('evaluacion_id' => $evaluacion->id, 'item_id' => $item->id, 'puntaje' => $request->input('puntaje_' . $item->id), 'comentario' => $request->input('comentario_' . $item->id)));

            }
        }


        //return $request;
      
        return redirect()->action('Evaluacion_controller@gracias', ['id' => $evaluacion->id]);
      
        //return redirect('/gracias?email='. $request->input('email') . '&empresa=' . $request->input('empresa_nombre'));
        
    }

    public function continuar_evaluacion(){

      
    	$categorias = Categoria::all();
    	$items = Item::all();
      
      $benes = Benes::all();
      
    	return view('empresa_evaluar', array('categorias' => $categorias, 'items' => $items, 'benes'=>$benes));
    }
  


    public function gracias($id){
      
        try{
          $evaluacion = Evaluacion::find($id);
      
          if ($evaluacion === null) {
             // eval doesn't exist
            return redirect()->action('Evaluacion_controller@continuar_evaluacion');            
          }
          
          if($evaluacion->confirmed){
            
            return redirect()->action('Evaluacion_controller@continuar_evaluacion');
          }
            
          $empresa = Empresa::find($evaluacion->empresa_id);
          
          $subject = 'Verificación de tu evaluación en ocupasion.com';
          $template = 'emails.bienvenido';
          
          $data = ['subject' => $subject, 'template' => $template, 'email' => $evaluacion->email, 'empresa' => $empresa->razon_social, 'confir_code' => $evaluacion->confir_code];

          Mail::to($evaluacion->email)->send(new OcupasionEmail($data));

          return view('gracias', $data);
          
        }catch (\Exception $e) {
          
          return redirect()->action('Evaluacion_controller@continuar_evaluacion');
        }
                      
    }    
}
