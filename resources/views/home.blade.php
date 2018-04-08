@extends('layouts.master')

@section('title', 'OcuPasion')

@section('content')

<div style="margin-top: 100px;"> 

<form>

	<div class="input-group mb-3 col-sm-8">
	  <input type="text" name="" class="form-control form-control-lg" placeholder="Buscar una empresa">
	  <div class="input-group-append">
	    <button class="btn btn-outline-secondary" type="button"><span class="fa fa-search"></span>&nbsp;</button>
	  </div>
	</div>
	
</form>

</div>

@endsection
