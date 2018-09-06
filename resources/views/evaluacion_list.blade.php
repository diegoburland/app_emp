@extends('layouts.master')

@section('title', 'Evaluaciones')

@section('head')
  <script type="text/javascript" src="/js/empresa/evaluacionList.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.css">
  <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.js"></script> 
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

Total evaluaciones publicadas: {{$totalPublicadas}}

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
<p>
  <h1> Listado de evaluaciones </h1>
<table id="listEvaluacion" class="display" style="width:100%">
       <thead>
          <tr>
            <th width="20">Id</th>
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
            @foreach ($evaluaciones as $evaluacion)

            <tr>
              <td>{{$evaluacion->id}}</td>
              <td>{{$evaluacion->empresa}}</td>
              <td>{{$evaluacion->email}}</td>
              <td>{{$evaluacion->created_at->format('Y-m-d')}}</td>
              <td>{{$evaluacion->ip}}</td>
              <td>{{$evaluacion->evalua}}</td>
              <td>{{$evaluacion->ies}}</td>
              <td>Normal</td>
              <td>{{$evaluacion->confirmed}}</td>
              <td>{{$evaluacion->statusEmpresa}}</td>
              <td>{{$evaluacion->contenido}}</td>
              <td>{{$evaluacion->publicada}}</td>
            </tr>
          @endforeach
          </tbody>
    </table>
</p>

@endsection
