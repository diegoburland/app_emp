<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Evaluacion;
use App\User;
use App\Empresa;
use App\Mail\OcupasionEmail;
use Illuminate\Support\Facades\Hash;
use Mail;

class User_controller extends Controller
{

  public function code($code){
      
    $evaluacion = Evaluacion::where('confir_code', $code)->first();
    if ($evaluacion === null) {
           // eval doesn't exist
      return redirect()->action('Evaluacion_controller@continuar_evaluacion');            
    }
    /*if($evaluacion->confirmed){

      return redirect()->action('Evaluacion_controller@continuar_evaluacion');
    }*/
    
    //return $evaluacion;
    
    $evaluacion->confirmed = true;
    $evaluacion->save();
    
    $empresa = Empresa::find($evaluacion->empresa_id);
    
    $hashed_random_password = Hash::make(str_random(8));
    
    //crear el usuario
    $subject = 'Subida exitosa de tu evaluación en ocupasion.com';
    $template = 'emails.cuenta';
    
    $data = ['subject' => $subject, 'template' => $template, 'name' => $evaluacion->email, 'email'=> $evaluacion->email, 'password' => $hashed_random_password, 'empresa' => $empresa->razon_social];
    $user = User::create($data);
    
    //falla la creacion
    if($user === null){
      $evaluacion->confirmed = false;
      $evaluacion->save();
      return redirect()->action('Evaluacion_controller@continuar_evaluacion');
    }
       
    //enviar el correo
    Mail::to($evaluacion->email)->send(new OcupasionEmail($data));
    
    //redireccionar
    return view('cuenta', $data);
    
  }
}
