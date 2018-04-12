@extends('layouts.master')

@section('title', 'Crear Empresa')


@section('head')
  <script type="text/javascript" src="/js/empresa/empresa.js"></script>
@endsection


@section('content')
<form id="form_empresa" @submit="checkForm" autocomplete='off' method="POST" action="/crear_empresa">
	<h4>Empresa</h4>
	@method('POST')
  @csrf

  <div class="form-group row">
    <div class="col-sm-8">
      <label for="">Nombre de la Empresa</label>
      <input type="text" class="form-control" id="razon_social" name="razon_social" placeholder="Nombre de la Empresa" >
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-8">
      <label for="">Ciudad</label>
      <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="Ciudad" autocomplete="off">
      <input type="hidden" name="ciudad_id" id="ciudad_id" value="">  
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-8">
    	<label for="">Sector económico</label>
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
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-8">
    	<label for="">Dirección</label>
      <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-8">
    	<label for="">Teléfono</label>
      <input type="text" class="form-control" id="tel" name="tel" placeholder="Teléfono">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-8">
    	<label for="">Email</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="Email">
    </div>
  </div>
  <h4>Contacto</h4>
  <div class="form-group row">
    <div class="col-sm-8">
    	<label for="">Nombres</label>
      <input type="text" class="form-control" id="nombres_contacto" name="nombres_contacto" placeholder="Nombres">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-8">
    	<label for="">Apellidos</label>
      <input type="text" class="form-control" id="apellidos_contacto" name="apellidos_contacto" placeholder="Apellidos">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-8">
    	<label for="">Teléfono</label>
      <input type="text" class="form-control" id="tel_contacto" name="tel_contacto" placeholder="Teléfono">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-8">
    	<label for="">Celular</label>
      <input type="email" class="form-control" id="cel_contacto" name="cel_contacto" placeholder="Celular">
    </div>
  </div> 
   <div class="form-group row">
    <div class="col-sm-8">
    	<label for="">Email</label>
      <input type="email" class="form-control" id="email_contacto" name="email_contacto" placeholder="Email">
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Crear Empresa</button>
</form>

@endsection
