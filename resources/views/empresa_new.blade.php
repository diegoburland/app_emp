@extends('layouts.master')

@section('title', 'Crear Empresa')

@section('content')
<form method="POST" action="/crear_empresa">
	<h4>Empresa</h4>
	@method('POST')
    @csrf
  <div class="form-group row">
    <div class="col-sm-8">
      <input type="text" class="form-control" id="razon_social" name="razon_social" placeholder="Nombre de la Empresa" >
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-8">
      <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Ubicación">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-8">
      <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-8">
      <input type="text" class="form-control" id="tel" name="tel" placeholder="Telefono">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-8">
      <input type="email" class="form-control" id="email" name="email" placeholder="Email">
    </div>
  </div>
  <h4>Contacto</h4>
  <div class="form-group row">
    <div class="col-sm-8">
      <input type="text" class="form-control" id="nombres_contacto" name="nombres_contacto" placeholder="Nombres">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-8">
      <input type="text" class="form-control" id="apellidos_contacto" name="apellidos_contacto" placeholder="Apellidos">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-8">
      <input type="text" class="form-control" id="tel_contacto" name="tel_contacto" placeholder="Telefono">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-8">
      <input type="email" class="form-control" id="cel_contacto" name="cel_contacto" placeholder="Celular">
    </div>
  </div> 
   <div class="form-group row">
    <div class="col-sm-8">
      <input type="email" class="form-control" id="email_contacto" name="email_contacto" placeholder="Email">
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Crear Empresa</button>
</form>

@endsection
