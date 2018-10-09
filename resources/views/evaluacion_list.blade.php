@extends('layouts.master')

@section('title', 'Listado de evaluacion')

@section('head')
  <script type="text/javascript" src="/js/empresa/evaluacionList.js"></script>
  
  <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
  <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
  <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>

@endsection


@section('content')
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

Total evaluacion: {{$totalEvaluaciones}}

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
     Status eval:
     <div class="statusevaluacion"> </div>
     <p></p>
     Status correo:
     <div class="statuscorreo"> </div>
   </div>
  <div id="derecho">
      Status empresa:
     <div class="statusempresa"> </div>
     <p></p>
     Status contenido:
     <div class="statuscontenido"> </div>
     <p></p>
     Status publicacion:
     <div class="statuspublicacion"> </div>
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
            <th width="150">Tipo de trabajo</th>
            <th scope="col">Institucion Educativa</th>
            <th scope="col">Status de evaluación</th>
            <th scope="col">Status Correo</th>
            <th scope="col">Status Empresa</th>
            <th scope="col">Status Contenido</th>
            <th scope="col">Status Publicación</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($evaluacion as $eval)

            <tr>
              <td>{{$eval->id}}</td>
              <td><a target="_blank" href="{{URL::action('Evaluacion_controller@mostrar_evaluacion',$eval->id)}} ">
              <button class="btn btn-info"><i class="fa fa-check-circle"></i></button></a></td>
              <td>{{$eval->empresa}}</td>
              <td>{{$eval->email}}</td>
              <td>{{$eval->created_at->format('Y-m-d')}}</td>
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
              @if($eval->flag_empresa == 'SIN REVISION')
                 <td style="background: indianred;">{{$eval->flag_empresa}}</td>
              @endif
              @if($eval->flag_empresa == 'NO VERIFICADA')
                 <td style="background: indianred;">{{$eval->flag_empresa}}</td>
              @endif
              @if($eval->flag_empresa == 'SI')
                 <td style="background: lightgreen;">{{$eval->flag_empresa}}</td>
              @endif
              @if($eval->flag_empresa == 'ESPERANDO')
                 <td style="background: orange;">{{$eval->flag_empresa}}</td>
              @endif
              @if($eval->flag_empresa == 'POR VERIFICAR')
                 <td style="background: yellow;">{{$eval->flag_empresa}}</td>
              @endif
              @if($eval->flag_empresa == 'PENDIENTE')
                 <td style="background: #2350E3;">{{$eval->flag_empresa}}</td>
              @endif
              @if($eval->flag_empresa != 'SIN REVISION' && $eval->flag_empresa != 'NO VERIFICADA' && $eval->flag_empresa != 'SI' && $eval->flag_empresa != 'ESPERANDO' && $eval->flag_empresa != 'POR VERIFICAR' && $eval->flag_empresa != 'PENDIENTE')
                 <td>{{$eval->flag_empresa}}</td>
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
    <div style="margin-left: 31%;">
      {!! $evaluacion->render() !!}
    </div>


@endsection
