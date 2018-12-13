<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
//use Illuminate\Http\RedirectResponse;

use App\Empresa;
use App\Item;
use App\Categoria;
use App\Ciudad;
use App\Evaluacion;

use DB;


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

    private function get_ubicacion($id){

        $ciudad = new Ciudad();

        return $ciudad->get_ciudadId($id);
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

    public function save_empresa(Request $request){

        $empresa = Empresa::where('razon_social', $request->input('razon_social'))->orWhere('nicknames', $request->input('razon_social'))->first();
         if (!empty($empresa)) {
             return $empresa->id;
         }
        return Empresa::create($request->all())->id;
    }

    public function store(Request $request){
		

		Empresa::create($request->all());
		//Empresa::create(array('razon_social' =>$razon_social));
		//return 'empresa creada';
    	//use App\Empresa::create(array())
    	return redirect('empresa_list');
    }

    public function getSectoresEconomicos(){

        $arrResponse = [];

        try {
            $arrData = DB::table('empresas')
                    ->select('sector_economico as sector')
                    ->groupBy('sector_economico')
                    ->get();

        } catch (\Exception $e) {
            $arrResponse['status'] = 'error';
            $arrResponse['message'] = $e->getMessage();
            return $arrResponse;
        }

        $arrResponse['status'] = 'success';
        $arrResponse['data'] = $arrData;

        return $arrResponse;

    }

    public function getClasificacion(){

        $arrResponse = [];

        try {
            $arrData = DB::table('empresas')
                    ->select('clasificacion')
                    ->groupBy('clasificacion')
                    ->where('clasificacion', '<>', '')
                    ->get();

        } catch (\Exception $e) {
            $arrResponse['status'] = 'error';
            $arrResponse['message'] = $e->getMessage();
            return $arrResponse;
        }

        $arrResponse['status'] = 'success';
        $arrResponse['data'] = $arrData;

        return $arrResponse;

    }

    public function list(){

        $emp = '';
        $nom = '';
        $sEmpresa = '';
        $clasf = '';
        $sector = '';
        $pr = '';
        $temp = '';
        $texe = '';
        $tpra = '';
        $teva = '';

        /////////////////////////////////// CALCULO DE ESTADISTICAS //////////////////////////////////////
        $empresa = new Empresa();
        $totalVerificadas = 0;
        $totalPorVerif = 0;
        $totalPendientes = 0;
        $totalNuevas = 0;
        $totalEsperando = 0;
        $totalSinRevision = 0;
        $totalGrandes = 0;
        $totalMedianas= 0;
        $totalPequeñas = 0;
        $totalStartUp = 0;


        $empresas = Empresa::all();

        for ($i = 0; $i < count($empresas); $i++) {
            if ($empresas[$i]['verificada'] == 'SI')
                $totalVerificadas ++;
            if ($empresas[$i]['verificada'] == 'POR VERIFICAR')
                $totalPorVerif ++;
            if ($empresas[$i]['verificada'] == 'PENDIENTE')
                $totalPendientes ++;
            if ($empresas[$i]['verificada'] == 'NUEVA')
                $totalNuevas ++;
            if ($empresas[$i]['verificada'] == 'ESPERANDO')
                $totalEsperando ++;
            if ($empresas[$i]['verificada'] == 'SIN REVISION')
                $totalSinRevision ++;
            if ($empresas[$i]['clasificacion'] == 'Grande')
                $totalGrandes ++;
            if ($empresas[$i]['clasificacion'] == 'Mediana')
                $totalMedianas ++;
            if ($empresas[$i]['clasificacion'] == 'Pequeña')
                $totalPequeñas ++;
            if ($empresas[$i]['clasificacion'] == 'Start-Up')
                $totalStartUp ++;
        }

        $resultados = count($empresas); 

        ///////////////////////////////////////////////////////////////////////////////////////////////////
        $empresa = Empresa::paginate(50);
        $evaluaciones = Evaluacion::all();

       for ($i = 0; $i < count($empresa); $i++) {

            $result = DB::table('evaluaciones', 'empresas')
                ->select(DB::raw('count(*) as cantidad'))
                ->where('evaluaciones.empresa_id', '=', $empresa[$i]['id'])
                ->first();
            $empresa[$i]['totalEval'] = $result->cantidad;

            $result = DB::table('evaluaciones', 'empresas')
                ->select(DB::raw('count(*) as empleados'))
                ->where('evaluaciones.empresa_id', '=', $empresa[$i]['id'])
                ->where('evaluaciones.evalua', '=', 'Trabajo Actual')
                ->first();
            $empresa[$i]['totalEmpleados'] = $result->empleados;

            $result = DB::table('evaluaciones', 'empresas')
                ->select(DB::raw('count(*) as empleados'))
                ->where('evaluaciones.empresa_id', '=', $empresa[$i]['id'])
                ->where('evaluaciones.evalua', '=', 'Trabajo Pasado')
                ->first();
            $empresa[$i]['totalExEmpleados'] = $result->empleados;

            $result = DB::table('evaluaciones', 'empresas')
                ->select(DB::raw('count(*) as empleados'))
                ->where('evaluaciones.empresa_id', '=', $empresa[$i]['id'])
                ->where('evaluaciones.evalua', '=', 'Practica')
                ->first();
            $empresa[$i]['totalPracticantes'] = $result->empleados;

            $empresa[$i]['promedio'] = ($empresa[$i]['totalEval']/count($evaluaciones));
       
        } 

        return view('empresa_list', compact('empresa', 'totalVerificadas', 'totalPorVerif', 'totalPendientes','totalNuevas', 'totalEsperando', 'totalSinRevision', 'totalGrandes', 'totalMedianas', 'totalPequeñas', 'totalStartUp', 'nom', 'sEmpresa', 'clasf', 'emp', 'sector', 'pr', 'temp', 'texe', 'tpra', 'teva', 'resultados'));
    }

    public function filter_empresa(Request $request) {

        $emp = $request['empr'];
        $nom = $request['nombre'];
        $sEmpresa = $request['statusEmpresa'];
        $clasf = $request['clasificacion'];
        $sector = $request['sector_economico']; 
        $pr = $request['promedio'];
        $teva = $request['totaleval'];
        $temp = $request['totalemple'];
        $texe = $request['totalexemple'];
        $tpra = $request['totalpracticas'];

        /////////////////////////////////// CALCULO DE ESTADISTICAS //////////////////////////////////////
       
        $empresa = new Empresa();
        $totalVerificadas = 0;
        $totalPorVerif = 0;
        $totalPendientes = 0;
        $totalNuevas = 0;
        $totalEsperando = 0;
        $totalSinRevision = 0;
        $totalGrandes = 0;
        $totalMedianas= 0;
        $totalPequeñas = 0;
        $totalStartUp = 0;

        $empresas = Empresa::all();

        for ($i = 0; $i < count($empresas); $i++) {
            if ($empresas[$i]['verificada'] == 'SI')
                $totalVerificadas ++;
            if ($empresas[$i]['verificada'] == 'POR VERIFICAR')
                $totalPorVerif ++;
            if ($empresas[$i]['verificada'] == 'PENDIENTE')
                $totalPendientes ++;
            if ($empresas[$i]['verificada'] == 'NUEVA')
                $totalNuevas ++;
            if ($empresas[$i]['verificada'] == 'ESPERANDO')
                $totalEsperando ++;
            if ($empresas[$i]['verificada'] == 'SIN REVISION')
                $totalSinRevision ++;
            if ($empresas[$i]['clasificacion'] == 'Grande')
                $totalGrandes ++;
            if ($empresas[$i]['clasificacion'] == 'Mediana')
                $totalMedianas ++;
            if ($empresas[$i]['clasificacion'] == 'Pequeña')
                $totalPequeñas ++;
            if ($empresas[$i]['clasificacion'] == 'Start-Up')
                $totalStartUp ++;
        }

        $resultados = count($empresas);

        ///////////////////////////////////////////////////////////////////////////////////////////////////

        $filter = $request->all();
        $where = [];
        $order = [];
        foreach ($filter as $key => $value) {
            if (is_null($value) == true) {
                continue;
            } else {
                switch ($key) {
                    case 'empr':
                        $where[] = "empresas.razon_social LIKE '%" . $value . "%'";
                        $emp = $value;
                        break;
                    case 'nombre':
                        $where[] = "empresas.nicknames LIKE '%" . $value . "%'";
                        break;
                    case 'clasificacion':
                        $where[] = "empresas.clasificacion = '" . $value . "'";
                        break;
                    case 'statusEmpresa':
                        $where[] = "empresas.verificada = '" . $value . "'";
                        break;
                    case 'sector_economico':
                        $where[] = "empresas.sector_economico = '" . $value . "'";
                        break;
                    case 'promedio':
                        $order[] = "promedio " .$value."";
                        break;
                    case 'totaleval':
                        $order[] = "totaleval " .$value."";
                        break;
                    case 'totalemple':
                        $order[] = "totalEmpleados " .$value."";
                        break;
                    case 'totalexemple':
                        $order[] = "totalExEmpleados " .$value."";
                        break;
                    case 'totalpracticas':
                        $order[] = "totalPracticantes " .$value."";
                        break;
                }
            }
        }

        $fullWhere = implode(" AND ", $where);
        $fullOrder = implode(", ", $order);

        if (empty($fullWhere) && empty($fullOrder)) {
            $empresa = DB::table('empresas')
                    ->select(DB::raw('empresas.*, 
                        (select count(1) from evaluaciones where evaluaciones.evalua = "Trabajo Actual" and evaluaciones.empresa_id = empresas.id) as totalEmpleados, 
                        (select count(1) from evaluaciones where evaluaciones.evalua = "Trabajo Pasado" and evaluaciones.empresa_id = empresas.id) as totalExEmpleados, 
                        (select count(1) from evaluaciones where evaluaciones.evalua = "Practica" and evaluaciones.empresa_id = empresas.id) as totalPracticantes, 
                        (select count(1) from evaluaciones where evaluaciones.empresa_id = empresas.id) as totalEval,
                        ((select count(1) from evaluaciones where evaluaciones.empresa_id = empresas.id)/(select count(1) from evaluaciones)) as promedio'))
                    ->groupBy('empresas.id')
                    ->orderBy('created_at', 'ASC')
                    ->paginate(50);

            $result = DB::table('empresas')
                ->select(DB::raw('count(*) as cantidad'))
                ->first();

        } else if(empty($fullWhere) && !empty($fullOrder)){
            $empresa = DB::table('empresas')
                    ->select(DB::raw('empresas.*, 
                        (select count(1) from evaluaciones where evaluaciones.evalua = "Trabajo Actual" and evaluaciones.empresa_id = empresas.id) as totalEmpleados, 
                        (select count(1) from evaluaciones where evaluaciones.evalua = "Trabajo Pasado" and evaluaciones.empresa_id = empresas.id) as totalExEmpleados, 
                        (select count(1) from evaluaciones where evaluaciones.evalua = "Practica" and evaluaciones.empresa_id = empresas.id) as totalPracticantes, 
                        (select count(1) from evaluaciones where evaluaciones.empresa_id = empresas.id) as totalEval,
                        ((select count(1) from evaluaciones where evaluaciones.empresa_id = empresas.id)/(select count(1) from evaluaciones)) as promedio'))
                    ->groupBy('empresas.id')
                    ->orderBy('created_at', 'ASC')
                    ->orderByRaw(DB::raw($fullOrder))
                    ->paginate(50);

            $result = DB::table('empresas')
                ->select(DB::raw('count(*) as cantidad'))
                ->first();
        }
        else if(!empty($fullWhere) && empty($fullOrder)){
            $empresa = DB::table('empresas')
                    ->select(DB::raw('empresas.*, 
                        (select count(1) from evaluaciones where evaluaciones.evalua = "Trabajo Actual" and evaluaciones.empresa_id = empresas.id) as totalEmpleados, 
                        (select count(1) from evaluaciones where evaluaciones.evalua = "Trabajo Pasado" and evaluaciones.empresa_id = empresas.id) as totalExEmpleados, 
                        (select count(1) from evaluaciones where evaluaciones.evalua = "Practica" and evaluaciones.empresa_id = empresas.id) as totalPracticantes, 
                        (select count(1) from evaluaciones where evaluaciones.empresa_id = empresas.id) as totalEval,
                        ((select count(1) from evaluaciones where evaluaciones.empresa_id = empresas.id)/(select count(1) from evaluaciones)) as promedio'))
                    ->whereRaw(DB::raw($fullWhere))
                    ->groupBy('empresas.id')
                    ->orderBy('created_at', 'ASC')
                    ->paginate(50);

            $result = DB::table('empresas')
                ->select(DB::raw('count(*) as cantidad'))
                ->whereRaw(DB::raw($fullWhere))
                ->first();
        }
        else{
            $empresa = DB::table('empresas')
                    ->select(DB::raw('empresas.*, 
                        (select count(1) from evaluaciones where evaluaciones.evalua = "Trabajo Actual" and evaluaciones.empresa_id = empresas.id) as totalEmpleados, 
                        (select count(1) from evaluaciones where evaluaciones.evalua = "Trabajo Pasado" and evaluaciones.empresa_id = empresas.id) as totalExEmpleados, 
                        (select count(1) from evaluaciones where evaluaciones.evalua = "Practica" and evaluaciones.empresa_id = empresas.id) as totalPracticantes, 
                        (select count(1) from evaluaciones where evaluaciones.empresa_id = empresas.id) as totalEval,
                        ((select count(1) from evaluaciones where evaluaciones.empresa_id = empresas.id)/(select count(1) from evaluaciones)) as promedio'))
                    ->whereRaw(DB::raw($fullWhere))
                    ->groupBy('empresas.id')
                    ->orderBy('created_at', 'ASC')
                    ->orderByRaw(DB::raw($fullOrder))
                    ->paginate(50);

            $result = DB::table('empresas')
                ->select(DB::raw('count(*) as cantidad'))
                ->whereRaw(DB::raw($fullWhere))
                ->first();
        }

        $resultados = $result->cantidad;

       return view('empresa_list', compact('empresa', 'totalVerificadas', 'totalPorVerif', 'totalPendientes','totalNuevas', 'totalEsperando', 'totalSinRevision', 'totalGrandes', 'totalMedianas', 'totalPequeñas', 'totalStartUp', 'nom', 'sEmpresa', 'clasf', 'emp', 'sector', 'pr', 'temp', 'texe', 'tpra', 'teva', 'resultados'));
    }

    public function mostrar_empresa($idEmpresa) {

        $evaluacion = Evaluacion::find($idEmpresa);
        $empresa = Empresa::find($evaluacion->empresa_id);
        $empresa->ciudad = (Ciudad::find($empresa->ciudad_id))->nombre;

        $categorias = Categoria::all();
        $items = Item::all();
        $benes = Benes::all();

        $eval_item = new Eval_item();
        $eval_bene = new Eval_bene();

        $calificaciones = $eval_item->getItemByEvaluation($idEmpresa);
        $beneficios = $eval_bene->getBeneByEvaluation($idEmpresa);

        return view('empresa_editar', array('categorias' => $categorias, 'items' => $items, 'benes' => $benes, 'evaluacion' => $evaluacion, 'empresa' => $empresa, 'calificaciones' => $calificaciones, 'beneficios' => $beneficios));
    }

    public function get_empresa(Request $request){

        $term = $request->input('term');
        
        $results = array();
            
        $queries1 = Empresa::select('id','nicknames', 'razon_social')->where('nicknames', 'LIKE', '%'.$term.'%')->take(5)->get();
        $queries2 = Empresa::select('id','nicknames', 'razon_social')->where('razon_social', 'LIKE', '%'.$term.'%')->take(5)->get();
        
        $queries = $queries1->merge($queries2);
        //$queries = $empresa->get_nombre($term);
        foreach ($queries as $query)
        {
            $results[] = [ 'id' => $query->id, 'value' => ((($query->nicknames != null)?strtoupper($query->nicknames) . " - ":"") . $query->razon_social) ];
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
                   
            $ubicacion = $this->get_ubicacion($query->id);
            $query['ubicacion'] = $ubicacion;
            $total_puntaje = $this->totalPuntaje($empresa->get_score($query->id));
            $query['total_puntaje'] = $total_puntaje;

            $results[] = $query;

        }   

        return view('filtro_empresa',  array('empresas' =>$results));
                
    }
}
