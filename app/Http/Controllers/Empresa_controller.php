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
        $empresa = new Empresa();
        $empresa = $empresa->find($id);
        $categorias = Categoria::all();
        $items = Item::all();
        $evaluacion = $empresa->get_score($id);

        /*$total = 0;
        $count = 0;
        foreach ($evaluacion as $key => $value) {
            $total = $total + $value->promedio;
            $count = $count + 1;
        }*/
        $total_puntaje = $this->totalPuntaje($evaluacion); //round($total / $count, 2);

        return view('empresa',  array('empresa' => $empresa, 'categorias' => $categorias, 'items' => $evaluacion, 'total_puntaje' => $total_puntaje));
    }

    private function totalPuntaje($evaluacion){

        $total = 0;
        $count = 0;
        foreach ($evaluacion as $key => $value) {
            $total = $total + $value->promedio;
            $count = $count + 1;
        }
        $total_puntaje = round($total / $count, 2);

        return $total_puntaje;

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

    public function filtrar(Request $request){
        

        $empresa = $request->input('empresa');
        $sector_economico = $request->input('sector_economico');
        
        $results = array();
    
        $dominio = [['razon_social', 'LIKE', '%'.$empresa.'%']];
        if ($sector_economico != null) {
            $dominio = [['razon_social', 'LIKE', '%'.$empresa.'%'], ['sector_economico', '=', $sector_economico]];
        }

        $empresa = new Empresa();

        $queries = $empresa::where($dominio)->get();

        $results = array();

        foreach ($queries as $query)            
        {
                                            
            $total_puntaje = $this->totalPuntaje($empresa->get_score($query->id));
            $query['total_puntaje'] = $total_puntaje;

            $results[] = $query;
        }

        
        
      

        return view('filtro_empresa',  array('empresas' =>$results));
                
    }
}
