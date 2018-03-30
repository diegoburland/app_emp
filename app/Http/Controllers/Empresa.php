<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Empresa

class Empresa extends Controller
{
	var $empresas;

	public function __construct(){
		$this->empresas = Empresa::all(array('razon_social'));
	}

    public function index()
    {
         //return 'hello world from controller : )';
         return view('empresa',  array('name' => 'mandar datos'));
    }
}
