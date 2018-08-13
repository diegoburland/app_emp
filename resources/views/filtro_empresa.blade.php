@extends('layouts.master')

@section('title', 'Buscar Empresa')

@section('head')
  <!--script type="text/javascript" src="/js/empresa/filtro.js"></script-->
@endsection

@section('content')


<div class="row">
  

<div class="col-sm">
  


<form class="form-inline" autocomplete='off' method="POST" action="/filtrar_empresa">
	
	@method('POST')
  	@csrf

<div class="m-2">
  <div class="card" style="width: 18rem;">
    <div class="card-body">
      <h4 class="card-title">Buscar Empresas</h4>
      <h6 class="card-subtitle mb-2 text-muted"><small>Utiliza los filtros para encontrar la empresas</small></h6>
      
      <div class="form-group mt-3">
        <label for="empresa">Empresa</label>
        <input type="text" name="empresa" id="empresa" class="form-control" placeholder="Empresa" autocomplete="off">
        <input type="hidden" name="empresa_id" id="empresa_id" value="">
      </div>

      <div class="form-group mt-3">
        <label for="sector_economico">Sector económico</label>
        <select class="custom-select" style="width: 250px;" id="sector_economico" name="sector_economico">
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
      </div>

      <div class="form-group mt-3">

        <label for="ciudad">Ciudad</label>
        <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="Ciudad" autocomplete="off">
        <input type="hidden" name="ciudad_id" id="ciudad_id" value="">  

      </div>

      <div class="form-group mt-3">
        <label for="ciudad">Evaluaciones de:</label>
      </div>

      <div class="form-group mt-1">        
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="customCheck1">
          <label class="custom-control-label" for="customCheck1">Empreados</label>
        </div>
      </div>
      
      <div class="form-group mt-3">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="customCheck1">
          <label class="custom-control-label" for="customCheck1">Practicantes</label>
        </div>
      </div>

      <br>
      <button type="button" class="btn btn-primary">Buscar</button>
    </div>
  </div>
  
</div>



 	

</form>

</div>

<div class="col-sm">
  

@if(isset($empresas))

<div class="row">
	

	@foreach ($empresas as $empresa)

  <div class="card m-1" style="width: 18rem;">
    <img class="card-img-top" src="/img/download.svg" alt="Card image cap">
    <div class="card-body">
      <h4 class="card-title"><b><a href="/empresa/{{$empresa->id}}">{{$empresa->razon_social}}</a></b></h4>          

      <i class="fa fa-map-marker"></i> {{$empresa->ubicacion}}<br>
      <i class="fa fa-tag"></i> {{$empresa->sector_economico}}<br>
      

      <div class="d-flex bd-highlight">
        <div class="p-2 flex-fill bd-highlight"><i class="fa fa-eye"></i>1</div>
        <div class="p-2 flex-fill bd-highlight">
          <div class="star-rating" >
            <span class="fa fa-star-o" data-rating="1" ></span>
            <span class="fa fa-star-o" data-rating="2" ></span>
            <span class="fa fa-star-o" data-rating="3" ></span>
            <span class="fa fa-star-o" data-rating="4" ></span>
            <span class="fa fa-star-o" data-rating="5" ></span>
            <input type="hidden" name="puntaje" class="rating-value" value="0">
            <span class="badge badge-primary badge-pill">{{$empresa->total_puntaje}}</span>
            
          </div>
        </div>        
      </div>

      <div class="d-inline"></div>
      <div class="d-inline">

                    

      </div>
      

    </div>
  </div>

	@endforeach

</div>	
@endif

</div>

</div>

@endsection