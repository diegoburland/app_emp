@extends('layouts.master')

@section('title', 'Buscar Empresa')


@section('content')
<h4>Buscar Empresa</h4>
<form class="form-inline">
  <label class="sr-only" for="empresa">Name</label>  
  <input type="text" class="form-control mb-2 mr-sm-2" id="empresa" placeholder="Empresa">

  <label class="sr-only" for="industria">Industria</label>
  <input type="text" class="form-control mb-2 mr-sm-2" id="industria" placeholder="Industria">

  <label class="sr-only" for="dep">Departamento</label>
  <input type="text" class="form-control mb-2 mr-sm-2" id="dep" placeholder="Departamento">

  <label class="sr-only" for="ciudad">Ciudad</label>
  <input type="text" class="form-control mb-2 mr-sm-2" id="ciudad" placeholder="Ciudad">

  <button type="submit" class="btn btn-primary mb-2">Buscar</button>
</form>

@endsection