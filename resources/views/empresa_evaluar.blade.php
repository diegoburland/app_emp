@extends('layouts.master')

@section('title', 'Evaluar Empresa')


@section('content')
<style type="text/css">
.star-rating {
	line-height:32px;
	font-size:1.25em;
}

.star-rating .fa-star{color: yellow;}

.evalua {
	width: 200px;
}

</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
	

	function evaluar(self, item){
		console.log($(self).siblings('input.rating-value').val())
		$(self).siblings('input.rating-value').val($(self).data('rating'));
		console.log($(self).siblings('input.rating-value').val())

		var $star_rating = $('.star-rating-' + item + ' .fa');
		$star_rating.each(function() {
			if (parseInt($($star_rating).siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
		      return $(this).removeClass('fa-star-o').addClass('fa-star');
		    } else {
		      return $(this).removeClass('fa-star').addClass('fa-star-o');
		    }
	    });
	}	

</script>

<form id="form_evaluar_empresa" method="POST" >
	
	@if(isset($empresa_id))
	<input type="hidden" name="empresa_id" value="{{$empresa_id}}">
	@endif

	
	@method('POST')
	@csrf

  @if(isset($evaluacion_id))
  <input type="hidden" name="empresa_id" value="{{$evaluacion_id}}">
  <h4>Continuar Evaluación</h4>
  

  	<div class="col col-sm-8">
  	@foreach ($categorias as $categoria)
  		<br>
  		<div class="list-group">
  			<a class="list-group-item list-group-item-action active">
				<h5>{{$categoria->nombre}}</h5>    	
			</a>	
    	
    	@foreach ($items as $item)

    		@if($item->categoria_id == $categoria->id)
    				  
			  <a class="list-group-item list-group-item-action">{{$item->nombre}}			  	
			      <div class="star-rating star-rating-{{$item->id}}">
			        <span class="fa fa-star-o" data-rating="1" onclick="evaluar(this, {{$item->id}})"></span>
			        <span class="fa fa-star-o" data-rating="2" onclick="evaluar(this, {{$item->id}})"></span>
			        <span class="fa fa-star-o" data-rating="3" onclick="evaluar(this, {{$item->id}})"></span>
			        <span class="fa fa-star-o" data-rating="4" onclick="evaluar(this, {{$item->id}})"></span>
			        <span class="fa fa-star-o" data-rating="5" onclick="evaluar(this, {{$item->id}})"></span>
			        <input type="hidden" name="whatever1" class="rating-value" value="2.56">
			      </div>
			  </a>

			   
	    	@endif
	  	
	  	@endforeach

	  	</div>
  	@endforeach

  	<br>
	  	<div class="list-group">
  			<a href="#" class="list-group-item list-group-item-action active">
				<h5>Tiempo laboral</h5>    	
			</a>
			<a href="#" class="list-group-item list-group-item-action">
			 	<div class="form-group row">
			    	<div class="col-sm-8">
			      		<label for="">Horas trabajadas por mes/semana</label>
			    	  	<input type="text" class="form-control" id="" v-model="" name="titulo" placeholder="" >
			  	    </div>
			  	</div>
			</a>

			<a href="#" class="list-group-item list-group-item-action">
				<div class="form-group row">
			    	<div class="col-sm-8">
			      		<label for="">Cantidad de asuetos al año</label>
			    	  	<input type="text" class="form-control" id="" v-model="" name="titulo" placeholder="" >
			  	    </div>
			  	</div>
			</a>
			<br>
	  		<button type="submit" class="btn btn-primary">Guardar Evaluación</button>

		</div>  	

  	</div>
  	
  @else
  	<h4>Evaluar Empresa</h4>
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
  @endif





</form>


@endsection
