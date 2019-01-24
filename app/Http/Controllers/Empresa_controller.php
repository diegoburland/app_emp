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
use App\Benes;

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

    public function datos_empresa($id)
    {   

        $empresa = new Empresa();
        $empresa = $empresa->find($id);

        $beneficios = new Benes();
        $todos_beneficios = $beneficios->grupo_beneficio();
        $benes = $beneficios->get_beneficios_icons($id);
        $benes_grupo = $beneficios->get_beneficios_icons($id);
        $arrays_beneficio = $beneficios->in_array_beneficios($id);
        $arrayBeneficios = array();

        $arrayPosicionEmpleado = array();
        $arrayPosicionPracticante = array();

        $categorias = Categoria::all();
        $items = Item::all();

        $evaluacion = $empresa->get_score($id);
        $opiniones = $empresa->score_individual($id);
       

        foreach($benes_grupo as $key => $value){
            if($value->posicion == "Practicante" AND $value->tipo == 2){
                $arrayPosicionPracticante[] = $value->bene_id;
            }elseif($value->posicion == "Empleado" AND $value->tipo == 1){
                $arrayPosicionEmpleado[] = $value->bene_id;
            }

        }
        
        $cantidad_empleados = count($arrayPosicionEmpleado);
        $cantidad_practicantes = count($arrayPosicionPracticante);

        $lista_beneficios = $this->detalle_beneficios($arrayPosicionEmpleado, $todos_beneficios, 1);
        $lista_beneficios_practicante = $this->detalle_beneficios($arrayPosicionPracticante, $todos_beneficios, 2);
        // dd($lista_beneficios_practicante);
        foreach($arrays_beneficio as $key => $value){

            $arrayBeneficios[] = $value->bene_id;

        }
        
        ($empresa->total_empleados > 199)? $tamano_empresa = "Grande": $tamano_empresa = "Mediana";
        $total_puntaje = $this->totalPuntaje($evaluacion);
        $promedios = $this->empresas_sector($empresa->sector_economico);
        // dd($promedios);
        $evaluaciones = array();

        foreach ($promedios as $key => $promedio){
            $evaluaciones[] = $empresa->get_score($promedio->id);
        }
        $count = 0;
        $suma = 0;
        foreach($evaluaciones as $key => $eva){
            $suma += $this->totalPuntaje($eva);
            
            if($this->totalPuntaje($eva) > 0){
                $count ++;
            }
        }

        $evaluacion_empleados = $empresa->get_score_options($id, 'Empleado');
        $total_puntaje_empleados = $this->totalPuntaje($evaluacion_empleados);
        $evaluacion_practicantes = $empresa->get_score_options($id, 'Practicante');
        $total_puntaje_practicantes = $this->totalPuntaje($evaluacion_practicantes);
        $total_promedio = round($suma / $count , 1);
        $cantidad_evaluaciones = $this->cantidad_evaluaciones($id);
        $total_evaluaciones = $cantidad_evaluaciones * $count;
        $total_puntaje_fraccionado = $this->totalPuntajeFraccionado($evaluacion);
        $recomendacion = $this->recomendacion($id);
        $recomendacion_empleados = $this->recomendacion_tipo($id, 'Empleado');
        $recomendacion_practicantes = $this->recomendacion_tipo($id, 'Practicante');
        return view('single',  array(
            'empresa' => $empresa, 
            'categorias' => $categorias, 
            'items' => $evaluacion, 
            'total_puntaje' => $total_puntaje,
            'tamano_empresa' => $tamano_empresa,
            'total_promedio' => $total_promedio,
            'cantidad_evaluaciones' => $cantidad_evaluaciones,
            'total_evaluaciones' => $total_evaluaciones,
            'total_puntaje_fraccionado' => $total_puntaje_fraccionado,
            'recomendacion' => $recomendacion,
            'evaluacion_empleados' => $evaluacion_empleados,
            'evaluacion_practicantes' => $evaluacion_practicantes,
            'benes' => $benes,
            'total_puntaje_empleados' => $total_puntaje_empleados,
            'total_puntaje_practicantes' => $total_puntaje_practicantes,
            'recomendacion_empleados' => $recomendacion_empleados,
            'recomendacion_practicantes' => $recomendacion_practicantes,
            'arrayBeneficios' => $arrayBeneficios,
            'lista_beneficios' => $lista_beneficios,
            'lista_beneficios_practicante' => $lista_beneficios_practicante,
            'cantidad_empleados' => $cantidad_empleados,
            'cantidad_practicantes' => $cantidad_practicantes,
            'opiniones' => $opiniones
        )); 
    }

    private function detalle_beneficios($arrayPosicion, $todos_beneficios, $tipo){
        $contados = array_count_values($arrayPosicion);
        $todos = array();
        $otro = array();
        $apoyo = array();
        $bienestar = array();
        $financiero = array();
        foreach($todos_beneficios as $key => $value){
            if($value->grupo == 'otro' AND $value->tipo == $tipo){
                if(in_array($value->id, $arrayPosicion)){
                    $otro[] = array("nombre" => $value->nombre, "img"=> $value->url_img, "cantidad"=> $contados[$value->id]);
                }else{
                    $otro[] = array("nombre" => $value->nombre, "img" => $value->url_img, "cantidad" => "");
                }
            }elseif($value->grupo == 'apoyo' AND $value->tipo == $tipo){
                if(in_array($value->id, $arrayPosicion)){
                    $apoyo[] = array("nombre" => $value->nombre, "img"=> $value->url_img, "cantidad"=> $contados[$value->id]);
                }else{
                    $apoyo[] = array("nombre" => $value->nombre, "img" => $value->url_img, "cantidad" => "");
                }
            }elseif($value->grupo == 'bienestar' AND $value->tipo == $tipo){
                if(in_array($value->id, $arrayPosicion)){
                    $bienestar[] = array("nombre"=> $value->nombre, "img"=> $value->url_img, "cantidad"=> $contados[$value->id]);
                }else{
                    $bienestar[] = array("nombre" => $value->nombre, "img" => $value->url_img, "cantidad" => "");
                }
            }elseif($value->grupo == 'financiero' AND $value->tipo == $tipo){
                if(in_array($value->id, $arrayPosicion)){
                    $financiero[] = array("nombre"=> $value->nombre, "img"=> $value->url_img, "cantidad"=> $contados[$value->id]);
                }else{
                    $financiero[] = array("nombre" => $value->nombre, "img" => $value->url_img, "cantidad" => "");
                }
            }
        }

        $todos["otros"] = $otro;
        $todos["bienestar"] = $bienestar;
        $todos["apoyo"] = $apoyo;
        $todos["financiero"] = $financiero; 
        

        return $todos;
    }

    private function cantidad_evaluaciones($id){
        
        $results = array();
        $evaluaciones = DB::table('evaluaciones')->select('id')->where('empresa_id', '=', $id)->get();
        
        return count($evaluaciones);
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
        if($total != 0){
            $total_puntaje = round($total / $count, 2);
        }else{
            $total_puntaje = 0;
        }

        

        return $total_puntaje;

    }

    private function totalPuntajeSector($evaluacion){

        $total = 0;
        $count = 0;
        foreach ($evaluacion as $key => $value) {
            $total = $total + $value->promedio;
            $count = $count + 1;
        }
        if($total != 0){
            $total_puntaje = round($total / $count, 2);
        }else{
            $total_puntaje = 0;
        }

        

        return $total_puntaje;

    }

    private function recomendacion($id){
        $evaluaciones = DB::table('evaluaciones')->select('recomienda')->where('empresa_id', '=', $id)->get();
        if($evaluaciones != []){
            $count = 0;
            $yes = 0;
            
            foreach($evaluaciones as $key => $value){
                if($value != NULL){
                    $count++;
                    if($value == "Si"){
                        $yes ++;
                    }
                }
            }
            if($yes != 0){
                $procentaje = round((($yes / $count)* 1000)/100);
            }else{
                $porcentaje = 0;
            }
                $result  = $porcentaje;
        }

        return $result;
    }

    private function recomendacion_tipo($id, $tipo){
        $evaluaciones = DB::table('evaluaciones')->select('recomienda')->where('empresa_id', '=', $id)->where('posicion', '=', $tipo)->get();
        if($evaluaciones != []){
            $count = 0;
            $yes = 0;
            
            foreach($evaluaciones as $key => $value){
                if($value != NULL){
                    $count++;
                    if($value == "Si"){
                        $yes ++;
                    }
                }
            }
            if($yes != 0){
                $procentaje = round((($yes / $count)* 1000)/100);
            }else{
                $porcentaje = 0;
            }
                $result  = $porcentaje;
        }

        return $result;
    }

    private function totalPuntajeFraccionado($evaluacion){

        $total1 = 0;$count1 = 0;$total2 = 0;$count2 = 0;$total3 = 0;$count3 = 0;
        $total4 = 0;$count4 = 0;$total5 = 0;$count5 = 0;
        $fraccionados = array();
        foreach ($evaluacion as $key => $value) {
            if($value->promedio >= 0.1 && $value->promedio <= 1.4){
                $total1 = $total1 + $value->promedio;
                $count1 = $count1 + 1;
            }elseif($value->promedio >= 1.5 && $value->promedio <= 2.4){
                $total2 = $total2 + $value->promedio;
                $count2 = $count2 + 1;
            }elseif($value->promedio >= 2.5 && $value->promedio <= 3.4){
                $total3 = $total3 + $value->promedio;
                $count3 = $count3 + 1;
            }elseif($value->promedio >= 3.5 && $value->promedio <= 4.4){
                $total4 = $total4 + $value->promedio;
                $count4 = $count4 + 1;
            }elseif($value->promedio >= 4.5 && $value->promedio <= 5){
                $total5 = $total5 + $value->promedio;
                $count5 = $count5 + 1;
            }
            
        }

        if($total1 != 0){
            $fraccionados["uno"] = (round($total1 / $count1, 2) * 1000) /100;
        }else{
            $fraccionados["uno"] = 0;
        }
        if($total2 != 0){
            $fraccionados["dos"] = (round($total2 / $count2, 2) * 1000) /100;
        }else{
            $fraccionados["dos"] = 0;
        }
        if($total3 != 0){
            $fraccionados["tres"] = (round($total3 / $count3, 2) * 1000) /100;
        }else{
            $fraccionados["tres"] = 0;
        }
        if($total4 != 0){
            $fraccionados["cuatro"] = (round($total4 / $count4, 2) * 1000) /100;
        }else{
            $fraccionados["cuatro"] = 0;
        }
        if($total5 != 0){
            $fraccionados["cinco"] = (round($total5 / $count5, 2) * 1000) /100;
        }else{
            $fraccionados["cinco"] = 0;
        }

        
        

        return $fraccionados;

    }

    private function grupo_beneficios($datos, $tipo, $grupo){
        $results = array();
        foreach($datos as $key => $value){
            if($value->tipo == $tipo && $value->grupo == $grupo){
                $results[] = $value;
            }
        }

        return $results;
    }

    private function empresas_sector($sector){
        $results = array();
        $empresa = new Empresa();
        $results = DB::table('empresas')->select('id')->where('sector_economico', '=', $sector)->get();
        $promedios = array();
        foreach($results as $key => $value):
            $promedios[] = $empresa->get_score($value->id);
        endforeach;
        $array = array();
        foreach($promedios as $key => $value):
            $array[] = $this->totalPuntaje($value);
        endforeach;
        $total = 0;
        $count = 0;
        foreach($array as $key => $value):
            $count++;
            $total = $total + $value;
        endforeach;
        $promedioSector = array();
        $promedioSector['promedio'] = round($total / $count, 2);
        $promedioSector['numero_evaluaciones'] = $count; 

        return $promedioSector;
        
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
