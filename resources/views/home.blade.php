@extends('layouts.master')

@section('title', 'OcuPasion')

@section('head')
  <script type="text/javascript" src="/js/empresa/home.js"></script>
@endsection

@section('content')

<div style="margin-top: 100px;"> 

<form>

	<div class="input-group mb-3 col-sm-8">
	  <input type="text" name="empresa" id="empresa" class="form-control form-control-lg" placeholder="Buscar una empresa">
	  <input type="hidden" name="empresa_id" id="empresa_id" value="">  
	  <div class="input-group-append">
	    <button class="btn btn-outline-secondary" type="button"><span class="fa fa-search"></span>&nbsp;</button>
	  </div>
	</div>
	
</form>

</div>

@endsection
