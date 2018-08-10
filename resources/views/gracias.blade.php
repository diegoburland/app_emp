@extends('layouts.master')

@section('title', 'OcuPasion')

@section('head')
  <script type="text/javascript" src="/js/empresa/home.js"></script>
@endsection

@section('content')


<div class="row justify-content-center mt-5">
	<div class="col-10">
	  <div class="alert alert-success" role="alert">
		  <h4 class="alert-heading">¡Tú evaluación se ha guardado con éxito!</h4>
		 	<p>¡Muchas gracias por tu evaluación anónima sobre {{ $empresa }}!</p>

			<p>Estás a solo unos pasos de publicar tu evaluación:<br>
			Recibirás un enlace de nosotros para verificar tu correo electrónico a {{ $email }}.
			Por favor, también revisa tu carpeta de spam.</p>

			<p>¿No recibiste un correo electrónico de nosotros? - <a>¡haga clic aquí!</a></p>
		  <hr>
		  <p class="mb-0">  	
			Muchas Gracias, Tu equipo de Ocupasión
		  </p>
		</div>
	</div>
</div>



@endsection