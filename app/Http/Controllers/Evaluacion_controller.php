<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Evaluacion;
use App\Empresa;
use App\Item;
use App\User;
use App\Categoria;
use App\Ciudad;
use App\Benes;
use App\Mail\OcupasionEmail;

use Mail;
use DB;

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
                Log::info('-----------------entro 4 -------------');
                Eval_bene::create(array('evaluacion_id' => $evaluacion->id, 'bene_id' => $bene->id));

            }
        }

        $this->verificarStatusEvaluacion($evaluacion->id); 
        $this->verificarStatusContenido($evaluacion->id);
        //return $request;
        Log::info('----------------- redirect to gracias -------------');
        //return redirect()->action('Evaluacion_controller@gracias', ['id' => $evaluacion->id]);
        return redirect()->route('gracias', [$evaluacion->id]);
      
        //return redirect('/gracias?email='. $request->input('email') . '&empresa=' . $request->input('empresa_nombre'));
        
    }

    public function editar(Request $request){

      $empresa = new Empresa();
      $empresa = $empresa->find($request->empresa_id);
      $nombreEmpresa = $empresa->razon_social;

      if($request->rechazado == 'true'){
        $evaluacion = Evaluacion::find($request->id);
        $evaluacion->contenido = "RECHAZADO";
        $evaluacion->publicada = "NO";
        $evaluacion->save();
        try{
          $this->enviarEmail($evaluacion->contenido, $nombreEmpresa, $evaluacion->email);
        }catch (\Exception $e) {
            Log::info("---------------" . $e . "-------------------");
            Log::info($e->getMessage());
         }
      }
      else{
        $calificaciones = $request->calificaciones; 

        if($request->cambio == "true"){

          $eval = Evaluacion::find($request->id);
          $eval->contenido = 'COPIADA';
          $eval->save();
          $evaluacion = new Evaluacion();
          $evaluacion->empresa_id = $request->empresa_id;
          $evaluacion->ciudad_eval_id = $eval->ciudad_eval_id;
          $evaluacion->evalua = $eval->evalua;
          $evaluacion->posicion = $eval->posicion;
          $evaluacion->recomienda = $eval->recomienda;
          $evaluacion->beneficios = $eval->beneficios;
          $evaluacion->ip = $eval->ip;
          $evaluacion->estado = $eval->estado;
          $evaluacion->ies = $eval->ies;
          $evaluacion->email = $eval->email;
          $evaluacion->terminos = $eval->terminos;
          $evaluacion->ofrecer = $eval->ofrecer;
          $evaluacion->motivo = $request->motivo;
          $evaluacion->oferta = $eval->oferta;
          $evaluacion->confir_code = bin2hex(random_bytes(32));
          $evaluacion->departamento = $request->departamento;
          $evaluacion->titulo = $request->titulo;
          $evaluacion->salario = $request->salario;
          $evaluacion->trabajo_tiempo = $request->horas; 
          $evaluacion->mejoras = $request->mejoras;
          $evaluacion->like = $request->like;
          $evaluacion->no_like = $request->no_like;
          $evaluacion->id_padre = $eval->id;
          $evaluacion->contenido = 'EDITADO';
          $evaluacion->publicada = "SI";
          $evaluacion->save();

          for ($i=0; $i < count($calificaciones); $i++) { 
            $item = Eval_item::find($calificaciones[$i]['id']);
            $item->evaluacion_id = $evaluacion->id;
            $item->comentario = $calificaciones[$i]['comentario'];
            $item->save();
          }
          $beneficio = Eval_bene::where('evaluacion_id', '=', $request->id)->get();
          $bene = new Eval_bene();
          for ($i=0; $i < count($beneficio); $i++) { 
             $beneficio[$i]->evaluacion_id = $evaluacion->id;
             $bene = $beneficio[$i];
             $bene->save();
          }
          try{
            $this->enviarEmail($evaluacion->contenido, $nombreEmpresa, $evaluacion->email);
          }catch (\Exception $e) {
            Log::info("---------------" . $e . "-------------------");
            Log::info($e->getMessage());
         }

        }
        else{
          $evaluacion = Evaluacion::find($request->id);
          $evaluacion->contenido = "ACEPTADO";
          $evaluacion->publicada = "SI";
          $evaluacion->save();
          try{
            $this->enviarEmail($evaluacion->contenido, $nombreEmpresa, $evaluacion->email);
          }catch (\Exception $e) {
            Log::info("---------------" . $e . "-------------------");
            Log::info($e->getMessage());
         }
        }
      }

       return redirect('evaluacion_list');
        
    }

    public function list(){

      $eva = '';
      $pub = '';
      $conte = '';
      $sEmpresa = '';
      $sCorreo = '';
      $emp = '';
      $cor = '';
      $tr = '';
      $ins = ''; 

      /////////////////////////////////// CALCULO DE ESTADISTICAS //////////////////////////////////////
      $empresa = new Empresa();
      $empresaArr = Empresa::all()->toArray();
      $totalEmpresas = count($empresaArr);
      $totalPublicadas = 0;
      $totalEmpPorVerif = 0;
      $contenidoCont = 0;

      for ($i=0; $i < count($empresaArr); $i++) { 
        if($empresaArr[$i]['verificada'] == 'POR VERIFICAR' )
          $totalEmpPorVerif ++;
      }

      $evaluaciones = Evaluacion::all();
      $totalEvaluaciones = count($evaluaciones);
      for ($i=0; $i < $totalEvaluaciones; $i++) { 
            if($evaluaciones[$i]['publicada'] == 'SI'){
              $totalPublicadas ++;
            }  
            if($evaluaciones[$i]['contenido'] == 'POR VERIFICAR'){
              $contenidoCont ++;
            }  
        }

      ///////////////////////////////////////////////////////////////////////////////////////////////////

        $evaluacionArr = Evaluacion::where('contenido','<>', 'COPIADA')->orWhere('contenido','=', NULL)->paginate(50);
        $evaluacion = Evaluacion::where('contenido','<>', 'COPIADA')->orWhere('contenido','=', NULL)->paginate(50);

        for ($i=0; $i < count($evaluacionArr); $i++) { 
            $empresa = $empresa->find($evaluacionArr[$i]['empresa_id']);
            $evaluacion[$i]['empresa'] = $empresa->razon_social;
            $evaluacion[$i]['statusEmpresa'] = $empresa->verificada;
        }

        return view('evaluacion_list', compact('evaluacion', 'totalPublicadas', 'contenidoCont', 'totalEmpPorVerif', 'totalEvaluaciones', 'totalEmpresas', 'eva', 'pub', 'conte', 'sEmpresa', 'sCorreo', 'emp', 'cor', 'tr', 'ins'));
    }  

   public function filter_evaluacion(Request $request){

      $eva = $request['evaluacion'];
      $pub = $request['publicada'];
      $conte = $request['contenido'];
      $sEmpresa = $request['statusEmpresa'];
      $sCorreo = $request['statusCorreo'];
      $emp = $request['empresa'];
      $cor = $request['correo'];
      $tr = $request['trabajo'];
      $ins = $request['institucion'];
      
      /////////////////////////////////// CALCULO DE ESTADISTICAS //////////////////////////////////////
      $empresa = new Empresa();
      $empresaArr = Empresa::all()->toArray();
      $totalEmpresas = count($empresaArr);
      $totalPublicadas = 0;
      $totalEmpPorVerif = 0;
      $contenidoCont = 0;

      for ($i=0; $i < count($empresaArr); $i++) { 
        if($empresaArr[$i]['verificada'] == 'POR VERIFICAR' )
          $totalEmpPorVerif ++;
      }

      $evaluaciones = Evaluacion::all();
      $totalEvaluaciones = count($evaluaciones);
      for ($i=0; $i < $totalEvaluaciones; $i++) { 
            if($evaluaciones[$i]['publicada'] == 'SI'){
              $totalPublicadas ++;
            }  
            if($evaluaciones[$i]['contenido'] == 'POR VERIFICAR'){
              $contenidoCont ++;
            }  
        }

      ///////////////////////////////////////////////////////////////////////////////////////////////////
  
        $filter = $request->all();
        $where = [];
        foreach ($filter as $key => $value) {
            if(is_null($value) == true) {
                continue;
            } else {
                switch ($key) {
                    case 'evaluacion':
                        $where[] = "evaluaciones.estado = '" . $value . "'";
                        $eva = $value;
                        break;
                    case 'contenido':
                        $where[] = "evaluaciones.$key = '" . $value . "'";
                        break;
                    case 'publicada':
                        $where[] = "evaluaciones.$key = '" . $value . "'";
                        break;
                    case 'statusEmpresa':
                       $where[] = "empresas.verificada = '" . $value . "'";
                        break;
                   case 'statusCorreo':
                        $where[] = "evaluaciones.confirmed = '" . $value . "'";
                        break;
                    case 'empresa':
                        $where[] = "empresas.razon_social LIKE '%" . $value . "%'";
                        break;
                    case 'correo':
                        $where[] = "evaluaciones.email LIKE '%" . $value . "%'";
                        break;
                    case 'trabajo':
                        $where[] = "evaluaciones.evalua LIKE '%" . $value . "%'";
                        break;
                    case 'institucion':
                        $where[] = "evaluaciones.ies LIKE '%" . $value . "%'";
                        break;
                }
            }
        }

        $fullWhere = implode(" AND ", $where);

        if(empty($fullWhere)) {
            $evaluacion = DB::table('evaluaciones')
                  ->select('evaluaciones.*','empresas.razon_social as empresa', 'empresas.verificada as statusEmpresa')
                  ->join('empresas', 'evaluaciones.empresa_id', '=', 'empresas.id')
                  ->where('contenido','<>', 'COPIADA')->orWhere('contenido','=', NULL)
                  ->orderBy('created_at', 'ASC')
                  ->orderBy('evalua', 'ASC')
                  ->paginate(50);
        } else {
            $evaluacion = DB::table('evaluaciones')
                ->select('evaluaciones.*','empresas.razon_social as empresa', 'empresas.verificada as statusEmpresa')
                ->join('empresas', 'evaluaciones.empresa_id', '=', 'empresas.id')
                ->whereRaw(DB::raw($fullWhere))
                ->where('contenido','<>', 'COPIADA')->orWhere('contenido','=', NULL)
                ->orderBy('created_at', 'ASC')
                ->orderBy('evalua', 'ASC')
                ->paginate(50);
        }

        return view('evaluacion_list', compact('evaluacion', 'totalPublicadas', 'contenidoCont', 'totalEmpPorVerif', 'totalEvaluaciones', 'totalEmpresas', 'eva', 'pub', 'conte', 'sEmpresa', 'sCorreo', 'emp', 'cor', 'tr', 'ins'));
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

    public function enviarEmail($contenido, $empresa, $email){
      if($contenido == 'ACEPTADO'){
          $subject = 'Subida exitosa de tu evaluación en Vida and Work';
          $template = 'emails.verificacionEvaluacionAceptada';
          
          $data = ['subject' => $subject, 'template' => $template, 'contenido' => $contenido, 'empresa' => $empresa, 'correo' => $email];
      }
      else if($contenido == 'EDITADA'){
          $subject = 'Subida exitosa de tu evaluación en Vida and Work';
          $template = 'emails.verificacionEvaluacionEditada';
          
          $data = ['subject' => $subject, 'template' => $template, 'contenido' => $contenido, 'empresa' => $empresa, 'correo' => $email];
      }
      else if($contenido == 'RECHAZADA'){
          $subject = 'Fallo de la subida de tu evaluación en Vida and Work';
          $template = 'emails.verificacionEvaluacionRechazada';
          
          $data = ['subject' => $subject, 'template' => $template, 'contenido' => $contenido, 'empresa' => $empresa, 'correo' => $email];
      }

          

          Mail::to($email)->send(new OcupasionEmail($data));
    }

    public function verificarStatusEvaluacion($id){
        $eval = Evaluacion::find($id);
        $result = DB::table('evaluaciones')
                ->where('ip', $eval->ip)
                ->select(DB::raw('count(*) as ipCont'))
                ->first();

        if($result->ipCont > 4){
          $eval->estado = "POR CONTROLAR";
          $eval->save();
          return;
        }

        $result = DB::table('evaluaciones')
                ->where('email', $eval->email)
                ->select(DB::raw('count(*) as emailCont'))
                ->first();

        if($result->emailCont > 4){
          $eval->estado = "POR CONTROLAR";
          $eval->save();
          return;
        }

        $result = DB::table('evaluaciones')
                ->where('email', $eval->email)
                ->where('empresa_id', $eval->empresa_id)
                ->select(DB::raw('count(*) as contRep'))
                ->first();

        if($result->contRep > 2){
            $eval->estado = "INVALIDA";
            $eval->save();
            return;
        }

        $result = DB::table('evaluaciones')
                ->where('email', $eval->email)
                ->where('empresa_id', $eval->empresa_id)
                ->where('evalua', $eval->evalua)
                ->select(DB::raw('count(*) as contEvalua'))
                ->first();

        if($result->contEvalua > 0){
            $eval->estado = "INVALIDA";
            $eval->save();
            return;
        }

        if($eval->evalua == 'Trabajo Pasado'){
             $result = DB::table('evaluaciones')
                ->where('email', $eval->email)
                ->where('empresa_id', $eval->empresa_id)
                ->where('evalua', 'Trabajo Actual')
                ->select(DB::raw('count(*) as contEvalua'))
                ->first();

            if($result->contEvalua > 0){
                $eval->estado = "INVALIDA";
                $eval->save();
                return;
            }
        }
        else if($eval->evalua == 'Trabajo Actual'){
            $result = DB::table('evaluaciones')
                ->where('email', $eval->email)
                ->where('empresa_id', $eval->empresa_id)
                ->where('evalua', 'Trabajo Pasado')
                ->select(DB::raw('count(*) as contEvalua'))
                ->first();

            if($result->contEvalua > 0){
                $eval->estado = "INVALIDA";
                $eval->save();
                return;
            }
        }
    }


  public function verificarStatusContenido($id){
        $evaluacion = Evaluacion::find($id);
        $empresa = Empresa::find($evaluacion->empresa_id);
        if($empresa->verificada == "SIN REVISION" || $empresa->verificada == "NO"){
            $evaluacion->contenido = "SIN REVISION";
            $evaluacion->save();
            return;
        }
        if($empresa->verificada == "SI" && $evaluacion->confirmed == "SI"){
            $evaluacion->contenido = "SIN REVISION";
            $evaluacion->save();
            return;
        }
        if($empresa->verificada == "POR VERIFICAR" || $empresa->verificada == "ESPERANDO" || $empresa->verificada == "PENDIENTE"){
            $evaluacion->contenido = "ESPERANDO";
            $evaluacion->save();
            return;
        }
        
    }
  


    public function gracias($id){
      
        try{
          $evaluacion = Evaluacion::find($id);
          $empresa = Empresa::find($evaluacion->empresa_id);

          $user = User::where('email', $evaluacion->email)->get();

          if (!empty($user)) {
            $evaluacion->confirmed = "SI";
            $evaluacion->save();

            $subject = 'Hemos recibido tu evaluación | Vida and Work';
            $template = 'emails.evaluacionRegistrada';
            
            $data = ['subject' => $subject, 'template' => $template, 'email' => $evaluacion->email, 'empresa' => $empresa->razon_social];

            Log::info('-----------------entro gracias 3 -------------');
            Mail::to($evaluacion->email)->send(new OcupasionEmail($data));
            
          }
          else{

            $evaluacion->confirmed = "PENDIENTE";
            $evaluacion->save();
          
            Log::info('-----------------entro gracias 1 -------------');
            if ($evaluacion === null) {
               // eval doesn't exist
              return redirect()->action('Evaluacion_controller@continuar_evaluacion');            
            }
            
            if($evaluacion->confirmed == 'SI'){
              
              return redirect()->action('Evaluacion_controller@continuar_evaluacion');
            }
            
            Log::info('-----------------entro gracias 2 -------------');
            
            $subject = 'Confirma el correo de tu evaluación en Vida and Work';
            $template = 'emails.bienvenido';
            
            $data = ['subject' => $subject, 'template' => $template, 'email' => $evaluacion->email, 'empresa' => $empresa->razon_social, 'confir_code' => $evaluacion->confir_code];

            Log::info('-----------------entro gracias 3 -------------');
            Mail::to($evaluacion->email)->send(new OcupasionEmail($data));

            Log::info('-----------------entro gracias 6 -------------');
            return view('gracias', $data);
          }
        }catch (\Exception $e) {
          
          Log::info("---------------" . $e . "-------------------");
          Log::info($e->getMessage());
          return redirect()->action('Evaluacion_controller@continuar_evaluacion');
        }
                      
    }    
}