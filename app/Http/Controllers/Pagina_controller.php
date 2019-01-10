<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Busqueda;
use DB;
class Pagina_controller extends Controller{



    public function index(){
        return view('search');
    }

    
}

