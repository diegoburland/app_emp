@extends('layouts.master')

@section('title', 'OcuPasion')

@section('head')
  <script type="text/javascript" src="/js/empresa/home.js"></script>
@endsection

@section('content')

<div class="div_img_home">
	
	<div > 

		<form>

			<div class="input-group mb-3 col-sm-8">
			  <input type="text" name="empresa" id="empresa" class="form-control form-control-lg" placeholder="Buscar una empresa">
			  <input type="hidden" name="empresa_id" id="empresa_id" value="">  
			  <div class="input-group-append">
			    <button style="background-color: darkgrey" class="btn btn-outline-secondary" type="button"><span class="fa fa-search"></span>&nbsp;</button>
			  </div>
			</div>
			
		</form>		

	</div>

	<div class="div_sloga">

		<b>Califica tu <span style="color: yellow;">pasión</span>. Que tu opinión cuente!</b>
	</div>

</div>

<div class="container">
	<h2>Nuestra Misión</h2>
	<p class="text-justify">
	En Ocupasión.com trabajamos para el derecho de cada ciudadano de la República de Colombia por un trabajo con condiciones laborales justas, remuneración justa y trato interpersonal justo.
	</p>

	<p class="text-justify">
	Por lo tanto, queremos pedirte francamente que evalúes tu empleador con mayor sinceridad y equidad posible para que buenas empresas tengan la valoración que se merezcan y las malas tengan incentivo a constantemente mejorar.	
	</p>

	<p class="text-justify">
	Para que los resultados de las evaluaciones reflejen la realidad queremos pedirte que uses la oportunidad de evaluar a tu empleador de manera anónima y gratuita. Así no solo ayuda a hacer el mercado laboral colombiano más transparente y justo,sino también, aporta un valor agregado para los buscadores actuales y futuros de empleo.	
	</p>

	<button class="btn btn-outline-warning btn-sm" type="button" onclick="window.location.href='/empresa_evaluar'"><b>EVALUACIÓN ANÓNIMA</b></button>    
	
</div>
<br>
<br>







@endsection
