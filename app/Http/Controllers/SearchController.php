<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Busqueda;
use DB;
class SearchController extends Controller{


    public function autocomplete(Request $request){

        $query = $request->get('term');
        $empresas = Busqueda::where('razon_social', 'LIKE', '%'.$query.'%')->take(5)->get();
        

        $data = array();

        foreach($empresas as $empresa){
            $data[] = array('value'=> $empresa->razon_social);

        }

        if(count($data)>0){
            return $data;
            console.log($data);
        }else{
            return ['value' => $query];
        }

            
    }

    public function index(){
        return view('search');
    }
}

