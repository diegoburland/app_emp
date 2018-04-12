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

.paginador_none{
	width: 100%; visibility: hidden; display: none;
}

.paginador{
	width: 100%;
}

</style>


@section('head')
	<script type="text/javascript" src="/js/empresa/evaluacion.js"></script>
@endsection





<form id="form_evaluar_empresa" method="POST" action="/crear_evaluacion" novalidate class="needs-validation">
	
	

	@method('POST')
	@csrf
	
	<h4>Evaluar Empresa</h4>

	<div class="col col-sm-8">

	  <!--button type="submit" class="btn btn-primary">Empezar Evaluación</button-->


		<div id="demo" class="carousel slide" data-ride="carousel">

	  		<div class="carousel-inner">


	  			<div id="categoria_0" class="carousel-item active">
		  			<div class="list-group">
			  			<a href="#" class="list-group-item list-group-item-action text-light bg-dark">
							<h5>Datos Generales</h5>    								
						</a>
						<a class="list-group-item list-group-item-action">
							<div class="form-group row">
						    	<div class="col-sm-8">
						      		<label for="">Empresa</label>
						    	  	<input type="text" class="form-control" id="empresa" v-model="" name="titulo" placeholder="Empresa" required>
						    	  	<input type="hidden" name="empresa_id" id="empresa_id" value="">  
						    	  	<div class="invalid-feedback">
							          Por favor ingresa una empresa
							        </div>
						  	    </div>
						  	</div>
						</a>
						<a class="list-group-item list-group-item-action">
						 	<div class="form-group row">
								<div class="col-sm-4">
								  <label for="">Evalúo mi</label>
								  <select name="evalua" class="form-control" required>
								  	<option value=""></option>
								  	<option value="Trabajo Actual">Trabajo Actual</option>
								  	<option value="Trabajo Pasado">Trabajo Pasado</option>
								  	<option value="Práctica">Práctica</option>
								  	<option value="Otro">Otro</option>
								  </select>
								  <div class="invalid-feedback">
							          Por favor selecciona que evaluas
							      </div>
								</div>
							</div>
						</a>

						<a class="list-group-item list-group-item-action">
							<div class="form-group row">
								<div class="col-sm-8">
								  <label for="">Elegir Posición</label>
								  <select name="posicion" class="form-control" required>
								  	<option value=""></option>
								  	<option value="Empleado/Obrero">Empleado/Obrero</option>
								  	<option value="Gerente/Directivo">Gerente/Directivo</option>
								  	<option value="Contrato a tiempo parcial">Contrato a tiempo parcial</option>
								  	<option value="Estudiante">Estudiante</option>
								  	<option value="Otro">Otro</option>
								  </select>
								  <div class="invalid-feedback">
							          Por favor selecciona la posición
							      </div>
								</div>
							</div>
						</a>
						<a class="list-group-item list-group-item-action">
							<div class="form-group row">
								<div class="col-sm-8">
								  <label for="">Departamento de la Empresa</label>
								  <select name="departamento" class="form-control" required>
								  	<option value=""></option>
								  	<option value="(Administración/Organización">Administración/Organización</option>
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
								  <div class="invalid-feedback">
							          Por favor selecciona el departamento
							      </div>
								</div>
							</div>
						</a>
						<a class="list-group-item list-group-item-action">
							<div class="form-group row">
								<div class="col-sm-8">
								  <label for="">Título de tu Evaluación</label>
								  <input type="text" class="form-control" id="" v-model="" name="titulo" placeholder="" >
								</div>
							</div>
						</a>
						
					</div>  
				</div>

	  	
		  	@foreach ($categorias as $categoria)
		  		
				<div id="categoria_{{$categoria->id}}" class="carousel-item ">
		  			<div class="list-group">
		  				<a class="list-group-item list-group-item-action text-light bg-dark">
							<h5>{{$categoria->nombre}}</h5>    	
						</a>	
		    	
			    	@foreach ($items as $item)

			    		@if($item->categoria_id == $categoria->id)
			    				  
							  <a class="list-group-item list-group-item-action">{{$item->nombre}}			  	
							      <div class="star-rating star-rating-{{$item->id}}">
							        <span class="fa fa-star-o fa-lg" data-rating="1" onclick="evaluar(this, {{$item->id}})"></span>
							        <span class="fa fa-star-o fa-lg" data-rating="2" onclick="evaluar(this, {{$item->id}})"></span>
							        <span class="fa fa-star-o fa-lg" data-rating="3" onclick="evaluar(this, {{$item->id}})"></span>
							        <span class="fa fa-star-o fa-lg" data-rating="4" onclick="evaluar(this, {{$item->id}})"></span>
							        <span class="fa fa-star-o fa-lg" data-rating="5" onclick="evaluar(this, {{$item->id}})"></span>
							        <input type="hidden" name="item_{{$item->id}}" class="rating-value" value="0">
							      </div>
							  </a>

						   
				    	@endif
				  	
				  	@endforeach

				  		</div>	  	 
			  	</div>	  	 

			@endforeach

		  		<div class="carousel-item">
		  			<div class="list-group">
			  			<a href="#" class="list-group-item list-group-item-action text-light bg-dark">
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

					</div>  
				</div>
			</div>
		</div>

		<div class="form-group row">
		    <div class="col-sm-12">
		    	<div class="btn-group paginador_none" id="paginador">
				  	<a class="btn btn-lg btn-warning" id="a_pre" href="#demo" data-slide="prev" style="width: 50%">
					    Anterior
					</a>
					<a class="btn btn-lg btn-warning" id="a_sig" href="#demo" data-slide="next" style="width: 50%">
					    Siguiente
					</a>
				</div>

				<a class="btn btn-lg btn-warning" id="a_siguiente_solo" style="width: 100%">
					Siguiente
				</a>
		    </div>
		</div>    
	
	</div>

</form>


@endsection
