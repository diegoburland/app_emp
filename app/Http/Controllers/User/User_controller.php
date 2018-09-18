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
      
    $evaluacion = Evaluacion::where('confir_code', $code)->first();
    if ($evaluacion === null) {
      
      Log::info('-----------------entro 1 -------------');
      return redirect()->action('Evaluacion_controller@continuar_evaluacion');            
    }
    log::info('valor de confirmacion:' . $evaluacion->confirmed);
    if($evaluacion->confirmed == 'SI'){
      
      Log::info('-----------------entro 2 -------------');
      return redirect()->action('Evaluacion_controller@continuar_evaluacion');
    }
    
    //return $evaluacion;
    
    $evaluacion->confirmed = 'SI';
    $evaluacion->save();
    
    $empresa = Empresa::find($evaluacion->empresa_id);
    
    //$hashed_random_password = Hash::make(str_random(8));
    $pwd = str_random(8);
    
    //crear el usuario
    $subject = 'Subida exitosa de tu evaluación en ocupasion.com';
    $template = 'emails.cuenta';
    
    $data = ['subject' => $subject, 'template' => $template, 'name' => $evaluacion->email, 'email'=> $evaluacion->email, 'password' => $pwd, 'empresa' => $empresa->razon_social, 'tipo' => 'cliente'];
    
    
    $user = User::where('email', $evaluacion->email)->first();
    
    //mirar no esta lo creo
    if($user === null){
      
      //crearlo
      $user = User::create($data);
      
      //si falla volver
     Log::info('-----------------entro 3 -------------');
      if($user === null){
        
        Log::info('-----------------entro 4 -------------');
        $evaluacion->confirmed = false;
        $evaluacion->save();
        return redirect()->action('Evaluacion_controller@continuar_evaluacion');
      }      
    }else{
      
      //ya publico 
      Log::info('-----------------entro 5 -------------');
      return redirect('cuenta');
    }
       
    //enviar el correo
    Mail::to($evaluacion->email)->send(new OcupasionEmail($data));
    
    //redireccionar
    Log::info('-----------------entro finaliza -------------');
    return redirect('cuenta');
    
  }
}
