@extends('layouts.master')

@section('title', 'Listado de empresas')

<div id="prueba">
@section('head')
  <script type="text/javascript" src="/js/empresa/empresaList.js"></script>
  
  <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
  <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
  <style>
      td{
          font-size: 12px;
      }
      table.dataTable thead th, table.dataTable thead td {
      padding: 0px 0px !important; 
      }
  </style>

@endsection
@section('content')
@if(session('tipo') == 'admin')
 
<meta id="csrf-token" content="{{ csrf_token() }}" />
<div id="btnbuscaremp">
	<button class="btn btn-warning btn-xs" onclick="newCompany()" style="margin-left: 147%;">
        Crear empresa
    </button>
</div>
<p>
<table width="100%" cellspacing="1" cellpadding="3" border="0" bgcolor="#80A93E"> 
<tr> 
   <td bgcolor="#FBB046"><font size=3 face="verdana, arial, helvetica"><b>Estadísticas generales</b></font></td> 
</tr> 
<tr> 
   <td bgcolor="#F5ECB9"> 

<table width="95%" cellspacing="1" cellpadding="1" border="0" align="center"> 
<tr> 
   <td valign=top><font face="verdana, arial, helvetica" size=1>*</font></td> 
   <td><font face="verdana, arial, helvetica" size=2> 
		Total empresas verificadas: {{$totalVerificadas}} 
      </font></td> 
</tr> 
   <tr> 
      <td valign=top><font face="verdana, arial, helvetica" size=1>*</font></td> 
   <td><font face="verdana, arial, helvetica" size=2> 

Total empresas por verificar: {{$totalPorVerif}} 

      </font></td> 
   </tr> 
   <tr> 
      <td valign=top><font face="verdana, arial, helvetica" size=1>*</font></td> 
      <td><font face="verdana, arial, helvetica" size=2> 

Total empresas esperando: {{$totalEsperando}}

      </font></td> 
   </tr> 
   <tr> 
      <td valign=top><font face="verdana, arial, helvetica" size=1>*</font></td> 
      <td><font face="verdana, arial, helvetica" size=2> 

Total empresas pendientes: {{$totalPendientes}}

      </font></td> 
   </tr> 
     <tr> 
      <td valign=top><font face="verdana, arial, helvetica" size=1>*</font></td> 
      <td><font face="verdana, arial, helvetica" size=2> 

Total empresas sin revision: {{$totalNuevas}}

      </font></td> 
   </tr> 
    <tr> 
      <td valign=top><font face="verdana, arial, helvetica" size=1>*</font></td> 
      <td><font face="verdana, arial, helvetica" size=2> 

Total empresas nuevas: {{$totalNuevas}}

      </font></td> 
   </tr>  
   </table> 

   </td> 

   <td bgcolor="#F5ECB9"> 

<table width="95%" cellspacing="1" cellpadding="1" border="0" align="center"> 
<tr> 
   <td valign=top><font face="verdana, arial, helvetica" size=1>*</font></td> 
   <td><font face="verdana, arial, helvetica" size=2> 
		Total empresas grandes: {{$totalGrandes}} 
      </font></td> 
</tr> 
   <tr> 
      <td valign=top><font face="verdana, arial, helvetica" size=1>*</font></td> 
   <td><font face="verdana, arial, helvetica" size=2> 

Total empresas medianas: {{$totalMedianas}} 

      </font></td> 
   </tr> 
   <tr> 
      <td valign=top><font face="verdana, arial, helvetica" size=1>*</font></td> 
      <td><font face="verdana, arial, helvetica" size=2> 

Total empresas pequeñas: {{$totalPequeñas}}

      </font></td> 
   </tr> 
   <tr> 
      <td valign=top><font face="verdana, arial, helvetica" size=1>*</font></td> 
      <td><font face="verdana, arial, helvetica" size=2> 

Total empresas start-Up: {{$totalStartUp}}

      </font></td> 
   </tr>  
   </table> 

   </td> 
</tr> 

</table> 

  <h1> Listado de empresas </h1>
  <span id="contador" style="text-align: right;"><h5> Resultados: {{$resultados}} </h5></center></span>
  <hr>
  <h5> Filtros de búsqueda </h5>
  <div id="izquierdo">
    Razón social:
    <div class="empresa"> </div>
    <p></p>
    Nombre:
    <div class="nombre"> </div>
    <p></p>
    Estado Empresa:
    <div class="statusEmpresa"> </div> 
    
 </div>
 <div id="centerEmp">
    Clasificación:
    <div class="clasificacion"> </div>
    <p></p>
     Sector económico:
    <div class="sector"> </div>
    <p></p>
    Promedio:
    <div class="promedio"> </div>
  </div>
  <div id="derechoEmp">
     Total evaluaciones:
     <div class="totaleval"> </div>
     <p></p>
      Total evaluaciones empleados:
     <div class="totalemple"> </div>
     <p></p>
     Total evaluaciones ex empleados:
     <div class="totalexemple"> </div>
     <p></p>  
    Total evaluaciones practicante:
    <div class="totalpracticas"> </div>
  </div>
  <div id="btnbuscaremp">
    <button class="btn btn-warning btn-xs" style="width: 422%;" onclick="actionFilter()">
        Buscar
    </button>
  </div>

  <table id="listEmpresa" class="display" style="width:100%">
       <thead>
          <tr>
            <th width="10">Id</th>
            <th><i class="fa fa-check"></i></th>
            <th scope="col">Razón social</th>
            <th scope="col">Nombre</th>
            <th width="150">Total evaluaciones</th>
            <th scope="col">Empleados</th>
            <th width="150">Ex empleados</th>
            <th scope="col">Prácticantes</th>
            <th scope="col">Estado empresa</th>
            <th scope="col">Promedio</th>
            <th scope="col">Clasificación</th>
            <th scope="col">Sector Economico</th>
          </tr>
        </thead>
        <tbody>

            @foreach ($empresa as $emp)

            <tr>
              <td>{{$emp->id}}</td>
              <td><a target="_blank" >
              <button class="btn btn-info"><i class="fa fa-check-circle"></i></button></a></td>
              <td style="font-size: 11px;">{{$emp->razon_social}}</td>
			  <td style="font-size: 11px;">{{$emp->nicknames}}</td>
              <td style="font-size: 12px;">{{$emp->totalEval}}</td>
              <td style="font-size: 12px;">{{$emp->totalEmpleados}}</td>
              <td>{{$emp->totalExEmpleados}}</td>
              <td>{{$emp->totalPracticantes}}</td>
              @if($emp->verificada == 'SI')
                 <td>VERIFICADA</td>
               @else
               <td>{{$emp->verificada}}</td>
              @endif
   			  <td>{{$emp->promedio}}</td>
   			  <td>{{$emp->clasificacion}}</td>
   			  <td>{{$emp->sector_economico}}</td>
            </tr>
          @endforeach
          </tbody>
    </table>
    <div style="margin-left: 40%; margin-top: 1%;">
      {!! $empresa->appends(['empresa' => $emp, 'sector_economico' => $sector, 'clasificacion' => $clasf, 'statusEmpresa' => $sEmpresa, 'totaleval' =>$teva, 'nombre' => $nom, 'totalemple' => $temp, 'promedio' =>$pr, 'totalexemple' => $texe, 'totalpracticas' => $tpra])->render() !!}
    </div>
</div>
@else
<div style="text-align: center; margin-top: 14%;">
     <h1> ¡Esta página sólo es visible con permisos de administrador! </h1> 
     <img src="/img/advertencia.png" width="180px">
</div>
@endif
@endsection
