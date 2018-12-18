<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Evaluacion;
use App\User;
use App\Empresa;
use App\Mail\OcupasionEmail;
//use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Mail;

class User_controller extends Controller
{

  public function login(Request $request){
    
    $user = User::where('email', $request->input('email'))->first();
    if($user !== null){
      
      if($user->password == $request->input('password')){
        session(['tipo' => $user->tipo]);
        return redirect('/');
      }else{
        return redirect('login');
      }
    }else{
      return redirect('/');
    }
    
    
  }
  
  public function code($code){
    
    try{
        $evaluacion = Evaluacion::where('confir_code', $code)->first();
        if ($evaluacion === null) {

          return redirect('cuenta');          
        }
        
        if($evaluacion->confirmed == 'SI'){
            
          return redirect('cuenta');
        }

        $this->changeStatus($evaluacion->id);
        
        //return redirect()->action('Retro_controller@show');
        
        return redirect()->route('retro', ['id' => $evaluacion->id]);

        /*$empresa = Empresa::find($evaluacion->empresa_id);
        $pwd = str_random(8);

        //crear el usuario
        $subject = 'Subida exitosa de tu evaluación en VidaAndWork.com';
        $template = 'emails.cuenta';

        $data = ['subject' => $subject, 'template' => $template, 'name' => $evaluacion->email, 'email'=> $evaluacion->email, 'password' => $pwd, 'empresa' => $empresa->razon_social, 'tipo' => 'cliente'];


        $user = User::where('email', $evaluacion->email)->first();

        //mirar no esta lo creo
        if($user === null){

          //crearlo
          $user = User::create($data);

          if($user === null){

            return redirect()->action('Evaluacion_controller@continuar_evaluacion');
          }      
        }else{

          //ya publico 
          Log::info('-----------------entro code 5 -------------');
          return redirect('cuenta');
        }

        //enviar el correo
        //Mail::to($evaluacion->email)->send(new OcupasionEmail($data));

        //redireccionar
        Log::info('-----------------entro code finaliza -------------');
        return redirect('cuenta');*/
    } catch (Exception $ex) {

        Log::info('-----------------entro code finaliza con error -------------');
        Log::info($ex);
        return redirect('cuenta');
    }       
  }

  public function changeStatus($id){
        $evaluacion = Evaluacion::find($id);
        $evaluacion->confirmed = 'SI';
        $empresa = Empresa::find($evaluacion->empresa_id);

        if($empresa->verificada == "SI" && $evaluacion->confirmed == "SI"){
            $evaluacion->contenido = "POR VERIFICAR";
            $evaluacion->save();
}
        
    }
}
