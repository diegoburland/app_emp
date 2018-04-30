@extends('layouts.master')

@section('title', 'Buscar Empresa')

@section('head')
  <script type="text/javascript" src="/js/empresa/filtro.js"></script>
@endsection

@section('content')
<h4>Buscar Empresa</h4>
<form class="form-inline"  @submit="checkForm" autocomplete='off' method="POST" action="/filtrar_empresa">
	
	@method('POST')
  	@csrf

	<label class="sr-only" for="empresa">Name</label>  
	<input type="text" name="empresa" id="empresa" class="form-control" placeholder="Empresa" autocomplete="off">
	<input type="hidden" name="empresa_id" id="empresa_id" value="">

 	<label class="sr-only" for="sector_economico">Sector económico</label>
      <select class="form-control" id="sector_economico" name="sector_economico">
        <option></option>
        <option value="Administrativa y Financiera">
          Administrativa y Financiera
        </option>
        <option value="Archivo y Documentación">
          Archivo y Documentación
        </option>
        <option value="Auditoría, Contraloría e Interventoría">
          Auditoría, Contraloría e Interventoría
        </option>
        <option value="Calidad (aseguramiento, gestión y afines)">
          Calidad (aseguramiento, gestión y afines)
        </option>
        <option value="Comercial, Ventas y Telemercadeo">
          Comercial, Ventas y Telemercadeo
        </option>
        <option value="Comercio Exterior">
          Comercio Exterior
        </option>
        <option value="Compras e Inventarios">
          Compras e Inventarios
        </option>
        <option value="Construcción y Obra">
          Construcción y Obra
        </option>
        <option value="Docencia">
          Docencia
       </option>        
      </select> 

	<label class="sr-only" for="ciudad">Ciudad</label>
      <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="Ciudad" autocomplete="off">
      <input type="hidden" name="ciudad_id" id="ciudad_id" value="">  

  	<button type="submit" class="btn btn-primary">Buscar</button>
</form>

@if(isset($empresas))

<div class="row">
	

	@foreach ($empresas as $empresa)


		<div class="card text-white bg-dark m-3" style="max-width: 18rem;">
		  <div class="card-header"><a href="/empresa/{{$empresa->id}}">{{$empresa->razon_social}}</a></div>
		  <div class="card-body">
		    <h5 class="card-title">Puntaje: {{$empresa->total_puntaje}} </h5>
		    <p class="card-text">Una foto y algunas cosas sobre la empresa</p>
		  </div>
		</div>

	@endforeach

</div>	
@endif


@endsection