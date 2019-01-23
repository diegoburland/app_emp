<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Departamento;
use DB;
class Home_controller extends Controller{



    public function index(){
        $departamentos = DB::table('Departamentos')->select('nombre', 'id')->get();
        // dd($departamentos);
        return view('search', compact('departamentos'));
    }

    
}

