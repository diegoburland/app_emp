<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Evaluacion;
use App\Empresa;
use App\Item;
use App\Categoria;
use App\Ciudad;
use App\Benes;
use App\Mail\OcupasionEmail;

use Mail;

use App\Eval_item;
use App\Eval_bene;

use Illuminate\Support\Facades\Log;

class Evaluacion_controller extends Controller
{
    public function store(Request $request){
		

        $random_hash = bin2hex(random_bytes(32));
        //$random_hash
        $request->request->add(['confir_code' =>  $random_hash, 'ip' => $request->ip()]);
		    $evaluacion = Evaluacion::create($request->all()); //mejorar        

        $items = Item::all();
      
        

         //Log::info('-----------------entro 1 -------------');
        foreach ($items as $item) {
            
            if($request->input('puntaje_' . $item->id) != null){

                Eval_item::create(array('evaluacion_id' => $evaluacion->id, 'item_id' => $item->id, 'puntaje' => $request->input('puntaje_' . $item->id), 'comentario' => $request->input('comentario_' . $item->id)));

            }
        }
      
      
        $benes = Benes::all();
      
        //Log::info('-----------------entro 2 -------------');
        foreach ($benes as $bene) {
            //Log::info('-----------------entro 3 -------------');
            if($request->input('bene_' . $bene->id) != null && $request->input('bene_' . $bene->id) != ""){
                //Log::info('-----------------entro 4 -------------');
                Eval_bene::create(array('evaluacion_id' => $evaluacion->id, 'bene_id' => $bene->id));

            }
        }


        //return $request;
        //Log::info('-----------------entro 5 -------------');
        //return redirect()->action('Evaluacion_controller@gracias', ['id' => $evaluacion->id]);
        return redirect()->route('gracias', [$evaluacion->id]);
      
        //return redirect('/gracias?email='. $request->input('email') . '&empresa=' . $request->input('empresa_nombre'));
        
    }

    public function edit(Request $request){

        $evaluacion = Evaluacion::create($request->all()); //mejorar        

        $items = Item::all();
      
        

         //Log::info('-----------------entro 1 -------------');
        foreach ($items as $item) {
            
            if($request->input('puntaje_' . $item->id) != null){

                Eval_item::create(array('evaluacion_id' => $evaluacion->id, 'item_id' => $item->id, 'puntaje' => $request->input('puntaje_' . $item->id), 'comentario' => $request->input('comentario_' . $item->id)));

            }
        }
      
      
        $benes = Benes::all();
      
        //Log::info('-----------------entro 2 -------------');
        foreach ($benes as $bene) {
            //Log::info('-----------------entro 3 -------------');
            if($request->input('bene_' . $bene->id) != null && $request->input('bene_' . $bene->id) != ""){
                //Log::info('-----------------entro 4 -------------');
                Eval_bene::create(array('evaluacion_id' => $evaluacion->id, 'bene_id' => $bene->id));

            }
        }

        return redirect()->route('gracias', [$evaluacion->id]);
        
    }

    public function list(){


        $empresa = new Empresa();
        $empresaArr = Empresa::all()->toArray();
        $evaluacionArr = Evaluacion::all()->toArray();
        $evaluacion = Evaluacion::all();
        $cont = 0;
        $empCont = 0;
        $contenidoCont = 0;
        for ($i=0; $i < count($evaluacionArr); $i++) { 
            $empresa = $empresa->find($evaluacionArr[$i]['empresa_id']);
            $evaluacion[$i]['empresa'] = $empresa->razon_social;
            $evaluacion[$i]['statusEmpresa'] = $empresa->verificada;
            if($evaluacionArr[$i]['publicada'] == 'SI'){
              $cont ++;
            }  
            if($evaluacionArr[$i]['contenido'] == 'POR VERIFICAR'){
              $contenidoCont ++;
            }  
        }

        for ($i=0; $i < count($empresaArr); $i++) { 
          if($empresaArr[$i]['verificada'] == 'POR VERIFICAR' )
            $empCont ++;
        }

        

        return view('evaluacion_list', array('evaluaciones' => $evaluacion, 'totalPublicadas' => $cont, 'totalEvaluaciones' => count($evaluacionArr), 'totalEmpresas' => count($empresaArr), 'totalEmpPorVerif' => $empCont, 'contenidoCont' => $contenidoCont));
    }  

    public function continuar_evaluacion(){

      
    	$categorias = Categoria::all();
    	$items = Item::all();
      
      $benes = Benes::all();
      
    	return view('empresa_evaluar', array('categorias' => $categorias, 'items' => $items, 'benes'=>$benes));
    }

    public function mostrar_evaluacion($idEvaluacion){

      $evaluacion = Evaluacion::find($idEvaluacion);
      $empresa = Empresa::find($evaluacion->empresa_id);
      $empresa->ciudad = (Ciudad::find($empresa->ciudad_id))->nombre;

      $categorias = Categoria::all();
      $items = Item::all();
      $benes = Benes::all();

      $eval_item = new Eval_item();
      $eval_bene = new Eval_bene();

      $calificaciones = $eval_item->getItemByEvaluation($idEvaluacion);
      $beneficios = $eval_bene->getBeneByEvaluation($idEvaluacion);
      
      return view('empresa_editar', array('categorias' => $categorias, 'items' => $items, 'benes'=>$benes, 'evaluacion' => $evaluacion, 'empresa' => $empresa, 'calificaciones' => $calificaciones, 'beneficios' => $beneficios));
    }
  


    public function gracias($id){
      
        try{
          $evaluacion = Evaluacion::find($id);
      
          if ($evaluacion === null) {
             // eval doesn't exist
            return redirect()->action('Evaluacion_controller@continuar_evaluacion');            
          }
          
          if($evaluacion->confirmed == 'SI'){
            
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
