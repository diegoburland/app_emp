@extends('layouts.master')

@section('title', 'VidAndWork.com')

@section('head')
  <script type="text/javascript" src="/js/empresa/home.js"></script>
@endsection

@section('content')


<div class="row justify-content-center mt-5">
	<div class="col-10">
	  <div class="alert alert-success" role="alert">
		  <h4 class="alert-heading">¡Tu evaluación ha sido guardada con éxito!</h4>
		 	<p>Gracias por tu aporte a un mercado laboral mas transparente, social y justo
      </p>
      
      <p>
        Estamos trabajando para que prontamente aparezca tu evaluación en el perfil de la empresa. Te informaremos mediante un correo cuando se haya publicado<br>
        ¡Te prometemos un 100% de anonimato y un manejo confiable de tus datos! <br>
        Muchas Gracias, Tu equipo de Vida and Work.
		  <hr>
		  <p class="mb-0">  	
			Si deseas editar o eliminar tu evaluación, nos puedes escribir al correo: <a href="mailto:evaluacion@vidaandwork.com">evaluacion@vidaandwork.com</a>.
		  </p>
		</div>
	</div>
</div>



@endsection