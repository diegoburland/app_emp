@extends('layouts.master')

@section('title', 'Evaluaciones')

@section('head')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="js/bootstrap-table-pagination.js"></script>
	<script src="js/pagination.js"></script>
  	<script type="text/javascript" src="/js/empresa/empresa.js"></script>
@endsection


@section('content')
<h4>Lista de evaluaciones</h4>
  <div class="table-responsive-xl">
  <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th>Empresa</th>
      <th scope="col">Correo</th>
      <th width="120">Fecha</th>
      <th scope="col">IP</th>
      <th width="150">Tipo de trabajo</th>
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
      <th scope="row">{{$evaluacion->id}}</th>
      <td>{{$evaluacion->empresa}}</td>
      <td>{{$evaluacion->email}}</td>
      <td>{{$evaluacion->created_at->format('Y-m-d')}}</td>
      <td> - </td>
      <td>{{$evaluacion->evalua}}</td>
      <td>Normal</td>
      <td>{{$evaluacion->empresa_id}}</td>
      <td>{{$evaluacion->empresa_id}}</td>
      <td>{{$evaluacion->empresa_id}}</td>
      <td>{{$evaluacion->empresa_id}}</td>
    </tr>
	@endforeach
  </tbody>
</table>
</div>

<div class="col-md-12 text-center">
<ul class="pagination pagination-lg pager" id="developer_page"></ul>
</div>

    <!--<a class="list-group-item list-group-item-action" href="/evaluacion/{{$evaluacion->id}}" >{{$evaluacion->departamento}},{{$evaluacion->id}}</a>-->

@endsection
