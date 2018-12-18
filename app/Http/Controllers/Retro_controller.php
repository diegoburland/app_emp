<?php

namespace App\Http\Controllers;

use App\Classes\Calculator;
use App\Mail\OcupasionEmail;
use Mail;
use Illuminate\Support\Facades\Log;

class Retro_controller extends Controller
{
    public function show($id)
    {
        $calculator = new Calculator();
        $result =  $calculator->macth_result($id);
        
        
        $subject = 'Confirma tu correo y reciba tu diagnóstico laboral de Vida and Work';
        $template = 'emails.ouput';

        $data =  array_merge(['subject' => $subject, 'template' => $template], $result);
        
        Log::info('----retro mail----');
        Mail::to($data['email'])->send(new OcupasionEmail($data));
        return view('retro');
    }
}


