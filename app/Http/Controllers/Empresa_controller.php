<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
//use Illuminate\Http\RedirectResponse;

use App\Empresa;
use App\Item;
use App\Categoria;


class Empresa_controller extends Controller
{
	    

    public function show($id)
    {
        $empresa = Empresa::find($id);
        $categorias = Categoria::all();
        $items = Item::all();
        return view('empresa',  array('empresa' => $empresa, 'categorias' => $categorias, 'items' => $items));
    }

    public function store(Request $request){
		

		Empresa::create($request->all());
		//Empresa::create(array('razon_social' =>$razon_social));
		//return 'empresa creada';
    	//use App\Empresa::create(array())
    	return redirect('empresa_list');
    }

    public function list(){

    	//$empresas = new Empresa();
    	return view('empresa_list', array('empresas' => Empresa::all()));
    }    

    public function get_empresa(Request $request){

        $term = $request->input('term');
        
        $results = array();
    
        $queries = Empresa::where('razon_social', 'LIKE', '%'.$term.'%')->take(5)->get();
        
        foreach ($queries as $query)
        {
            $results[] = [ 'id' => $query->id, 'value' => $query->razon_social ];
        }

        

        return response()->json($results);
    }

}
