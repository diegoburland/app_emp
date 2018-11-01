@extends('layouts.master')

@section('title', 'Listado de evaluacion')
<div id="prueba">
@section('head')
  <script type="text/javascript" src="/js/empresa/evaluacionList.js"></script>
  
  <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
  <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>

@endsection
@section('content')

<meta id="csrf-token" content="{{ csrf_token() }}" />

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

Total de empresas por verificar: {{$totalEmpPorVerif}} 

      </font></td> 
   </tr> 
   <tr> 
      <td valign=top><font face="verdana, arial, helvetica" size=1>*</font></td> 
   <td><font face="verdana, arial, helvetica" size=2> 

Total contenido por verificar: {{$contenidoCont}} 

      </font></td> 
   </tr> 
   <tr> 
      <td valign=top><font face="verdana, arial, helvetica" size=1>*</font></td> 
      <td><font face="verdana, arial, helvetica" size=2> 

Total evaluacion publicadas: {{$totalPublicadas}}

      </font></td> 
   </tr> 
   <tr> 
      <td valign=top><font face="verdana, arial, helvetica" size=1>*</font></td> 
      <td><font face="verdana, arial, helvetica" size=2> 

Cantidad de empresas: {{$totalEmpresas}}

      </font></td> 
   </tr>
      <tr> 
      <td valign=top><font face="verdana, arial, helvetica" size=1>*</font></td> 
      <td><font face="verdana, arial, helvetica" size=2> 

Total evaluaciones: {{$totalEvaluaciones}}

      </font></td> 
   </tr>  
   </table> 

   </td> 
</tr> 
</table>

  <h1> Listado de evaluacion </h1>
  <hr>
  <h5> Filtros de búsqueda </h5>
  <div id="izquierdo">
    Empresa:
    <div class="empresa"> </div>
    <p></p>
    Correo:
    <div class="correo"> </div>
    <p></p>
    Tipo de trabajo:
    <div class="trabajo"> </div>
 </div>
 <div id="center">
      Institución:
     <div class="institucion"> </div>
     <p></p>
     Estado evaluacion:
     <div class="statusevaluacion"> </div>
     <p></p>
     Correo verificado:
     <div class="statuscorreo"> </div>
  </div>
  <div id="derecho">
      Estado empresa:
     <div class="statusempresa"> </div>
     <p></p>
     Contenido:
     <div class="statuscontenido"> </div>
     <p></p>
     Publicada:
     <div class="statuspublicacion"> </div>
  </div>
  <div id="btnbuscar">
    <button class="btn btn-warning btn-xs" style="width: 422%;" onclick="actionFilter()">
        Buscar
    </button>
  </div>

  <table id="listEvaluacion" class="display" style="width:100%">
       <thead>
          <tr>
            <th width="10">Id</th>
            <th><i class="fa fa-check"></i></th>
            <th>Empresa</th>
            <th>Correo</th>
            <th width="150">Fecha</th>
            <th scope="col">IP</th>
            <th width="150">Evaluó su</th>
            <th scope="col">Institucion Educativa</th>
            <th scope="col">Estado evaluación</th>
            <th scope="col">Correo verificado</th>
            <th scope="col">Estado empresa</th>
            <th scope="col">Contenido</th>
            <th scope="col">Publicada</th>
          </tr>
        </thead>
        <tbody>

            @foreach ($evaluacion as $eval)

            <tr>
              <td>{{$eval->id}}</td>
              <td><a target="_blank" href="{{URL::action('Evaluacion_controller@mostrar_evaluacion',$eval->id)}} ">
              <button class="btn btn-info"><i class="fa fa-check-circle"></i></button></a></td>
              <td>{{$eval->empresa}}</td>
              @if( strlen($eval->email) >= 25)
                 <td style="font-size: 9px;">{{$eval->email}}</td>
              @endif
              @if( strlen($eval->email) < 25)
                 <td>{{$eval->email}}</td>
              @endif
              <td>{{ Carbon\Carbon::parse($eval->created_at)->format('Y-m-d') }}</td> 
              <td>{{$eval->ip}}</td>
              <td>{{$eval->evalua}}</td>
              <td>{{$eval->ies}}</td>
              @if($eval->estado == 'INVALIDA')
                 <td style="background: indianred;">{{$eval->estado}}</td>
              @endif
              @if($eval->estado == 'NORMAL')
                 <td style="background: lightgreen;">{{$eval->estado}}</td>
              @endif
              @if($eval->estado == 'POR CONTROLAR')
                 <td style="background: yellow;">{{$eval->estado}}</td>
              @endif
              @if($eval->estado != 'INVALIDA' && $eval->estado != 'NORMAL' && $eval->estado != 'POR CONTROLAR')
                 <td>{{$eval->estado}}</td>
              @endif
              @if($eval->confirmed == 'NO')
                <td style="background: indianred;">{{$eval->confirmed}}</td>
              @endif
              @if($eval->confirmed == 'SI')
                 <td style="background: lightgreen;">{{$eval->confirmed}}</td>
              @endif
              @if($eval->confirmed == 'PENDIENTE')
                 <td style="background: #2350E3;">{{$eval->confirmed}}</td>
              @endif
              @if($eval->confirmed != 'SI' && $eval->confirmed != 'NO' && $eval->confirmed != 'PENDIENTE')
                 <td>{{$eval->confirmed}}</td>
              @endif
              @if($eval->statusEmpresa == 'SIN REVISION')
                 <td style="background: indianred;">{{$eval->statusEmpresa}}</td>
              @endif
              @if($eval->statusEmpresa == 'NO VERIFICADA')
                 <td style="background: indianred;">{{$eval->statusEmpresa}}</td>
              @endif
              @if($eval->statusEmpresa == 'SI')
                 <td style="background: lightgreen;">{{$eval->statusEmpresa}}</td>
              @endif
              @if($eval->statusEmpresa == 'ESPERANDO')
                 <td style="background: orange;">{{$eval->statusEmpresa}}</td>
              @endif
              @if($eval->statusEmpresa == 'POR VERIFICAR')
                 <td style="background: yellow;">{{$eval->statusEmpresa}}</td>
              @endif
              @if($eval->statusEmpresa == 'PENDIENTE')
                 <td style="background: #2350E3;">{{$eval->statusEmpresa}}</td>
              @endif
              @if($eval->statusEmpresa != 'SIN REVISION' && $eval->statusEmpresa != 'NO VERIFICADA' && $eval->statusEmpresa != 'SI' && $eval->statusEmpresa != 'ESPERANDO' && $eval->statusEmpresa != 'POR VERIFICAR' && $eval->statusEmpresa != 'PENDIENTE')
                 <td>{{$eval->statusEmpresa}}</td>
              @endif
              @if($eval->contenido == 'SIN REVISION')
                 <td style="background: indianred;">{{$eval->contenido}}</td>
              @endif
              @if($eval->contenido == 'RECHAZADO')
                 <td style="background: indianred;">{{$eval->contenido}}</td>
              @endif
              @if($eval->contenido == 'POR VERIFICAR')
                 <td style="background: yellow;">{{$eval->contenido}}</td>
              @endif
              @if($eval->contenido == 'ACEPTADO')
                 <td style="background: lightgreen;">{{$eval->contenido}}</td>
              @endif
              @if($eval->contenido == 'EDITADO')
                 <td style="background: lightgreen;">{{$eval->contenido}}</td>
              @endif
              @if($eval->contenido == 'ESPERANDO')
                 <td style="background: orange;">{{$eval->contenido}}</td>
              @endif
              @if($eval->contenido != 'SIN REVISION' && $eval->contenido != 'ESPERANDO' && $eval->contenido != 'EDITADO' 
              && $eval->contenido != 'ACEPTADO' && $eval->contenido != 'POR VERIFICAR' && $eval->contenido != 'RECHAZADO')
                 <td>{{$eval->contenido}}</td>
              @endif
              @if($eval->publicada == 'NO')
                 <td style="background: indianred;">{{$eval->publicada}}</td>
              @endif
              @if($eval->publicada == 'SI')
                 <td style="background: lightgreen;">{{$eval->publicada}}</td>
              @endif
              @if($eval->publicada != 'NO' && $eval->publicada != 'SI')
                 <td>{{$eval->publicada}}</td>
              @endif
            </tr>
          @endforeach
          </tbody>
    </table>



    <div style="margin-left: 25%; margin-top: 1%;">
      {!! $evaluacion->appends(['evaluacion' => $eva, 'publicada' => $pub, 'contenido' => $conte, 'statusEmpresa' => $sEmpresa, 'statusCorreo' =>$sCorreo, 'empresa' => $emp, 'correo' => $cor, 'trabajo' =>$tr, 'institucion' => $ins])->render() !!}
    </div>
</div>


@endsection
