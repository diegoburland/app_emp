@extends('layouts.master')

@section('title', 'OcuPasion')

@section('head')
  <script type="text/javascript" src="/js/empresa/home.js"></script>
@endsection

@section('content')


<div class="row justify-content-center mt-5">
	<div class="col-10">
	  <div class="alert alert-success" role="alert">
		  <h4 class="alert-heading">¡Verificamos tu correo electrónico con éxito!</h4>
		 	<p>
        Tu evaluación se publicará en breve. Recibirás una notificación después de que nosotros publiquemos tu evaluación.
        El proceso se puede demorar unos pocos días. 
      </p>
      
      <p>
        Mientras tanto, te invitamos a explorar el mundo de ocupasion.com. Ten una mirada cualitativa y aprende más sobre las condiciones laborales internas de miles de empresas.<br>
        ¡Te prometemos un 100% de anonimato y un manejo confiable de tus datos en todo momento!
		  <hr>
		  <p class="mb-0">  	
			Muchas Gracias, Tu equipo de Ocupasión
		  </p>
		</div>
	</div>
</div>



@endsection