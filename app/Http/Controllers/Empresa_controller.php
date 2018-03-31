<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Empresa;

class Empresa_controller extends Controller
{
	//var $empresas;

	/*public function __construct(){
		$this->empresas = Empresa::all(array('razon_social'));
	}

    public function index()
    {
         //return 'hello world from controller : )';
         return view('empresa',  array('name' => 'mandar datos'));
    }*/

    public function store(Request $request){
		

		Empresa::create($request->all());
		//Empresa::create(array('razon_social' =>$razon_social));
		//return 'empresa creada';
    	//use App\Empresa::create(array())
    	return $this->list();
    }

    public function list(){

    	//$empresas = new Empresa();
    	return view('empresa_list', array('empresas' => Empresa::all()));
    }


}
