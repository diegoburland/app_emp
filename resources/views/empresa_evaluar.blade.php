@extends('layouts.master')

@section('title', 'Evaluar Empresa')


@section('content')

<form id="form_evaluar_empresa" method="POST" action="/crear_evaluacion">
	<input type="hidden" name="empresa_id" value="{{$empresa_id}}">
	<h4>Evaluar Empresa</h4>
	@method('POST')
    @csrf

  <div class="form-group row">
    <div class="col-sm-4">
      <label for="">Evalúo mi</label>
      <select name="evalua" class="form-control">
      	<option value=""></option>
      	<option value="Trabajo Actual">Trabajo Actual</option>
      	<option value="Trabajo Pasado">Trabajo Pasado</option>
      	<option value="Práctica">Práctica</option>
      	<option value="Otro">Otro</option>
      </select>
    </div>
  </div>

  <div class="form-group row">
    <div class="col-sm-8">
      <label for="">Elegir Posición</label>
      <select name="posicion" class="form-control">
      	<option value=""></option>
      	<option value="Empleado/Obrero">Empleado/Obrero</option>
      	<option value="Gerente/Directivo">Gerente/Directivo</option>
      	<option value="Contrato a tiempo parcial">Contrato a tiempo parcial</option>
      	<option value="Estudiante">Estudiante</option>
      	<option value="Otro">Otro</option>
      </select>
    </div>
  </div>
  
  <div class="form-group row">
    <div class="col-sm-8">
      <label for="">Departamento de la Empresa</label>
      <select name="departamento" class="form-control">
      	<option value=""></option>
      	<option value="(Administración/Organización">(Administración/Organización</option>
      	<option value="Compras/Proveedores">Compras/Proveedores</option>
      	<option value="Diseño">Diseño</option>
      	<option value="Finanzas/Controlling">Finanzas/Controlling</option>
      	<option value="Investigación/Desarrollo">Investigación/Desarrollo</option>
      	<option value="Gerencia">Gerencia</option>
      	<option value="TI">TI</option>
      	<option value="Logística/gestión de existencias">Logística/gestión de existencias</option>
      	<option value="Mercadeo/Gerencia de Productos">Mercadeo/Gerencia de Productos</option>
      	<option value="Comunicación/Relaciones públicos">Comunicación/Relaciones públicos</option>
      	<option value="Personal/formación + educación continua">Personal/formación + educación continua</option>
      	<option value="Producción">Producción</option>
      	<option value="Derecho/Impuesto">Derecho/Impuesto</option>
      	<option value="distribución/venta">distribución/ventas</option>
      	<option value="Otro">Otro</option>
      </select>
    </div>
  </div>
  
  <div class="form-group row">
    <div class="col-sm-8">
      <label for="">Título de tu Evaluación</label>
      <input type="text" class="form-control" id="" v-model="" name="titulo" placeholder="" >
    </div>
  </div>

  <button type="submit" class="btn btn-primary">Empezar Evaluación</button>

</form>


@endsection
