@extends('layouts.master_eval')

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

.form-group.required .control-label:after { 
    color: #d00;
    content: "*";
    position: absolute;
    margin-left: 8px;
    top:3px;
}

</style>


@section('head')
	<script type="text/javascript" src="/js/empresa/evaluacion.js"></script>
@endsection

<div class="row justify-content-md-center">

	<div class="col-sm-11">

		<form id="form_evaluar_empresa" method="POST" action="/crear_evaluacion" novalidate class="needs-validation">
			
			

			@method('POST')
			@csrf
			
			<h4>Evaluar Empresa</h4>

			

			  <!--button type="submit" class="btn btn-primary">Empezar Evaluación</button-->


					
			<a class="list-group-item list-group-item-action text-light bg-dark">
				<h5>Datos Generales</h5>    								
			</a>

			<div class="list-group-item list-group-item-action">
				<div class="form-group row required ">
			    	<div class="col-sm-6">
			      		<label class="control-label" >Empresa</label>
			    	  	<input type="text" class="form-control" id="empresa" v-model="" name="titulo" placeholder="    Busca tu empleador / organización" required>
			    	  	<input type="hidden" name="empresa_id" id="empresa_id" value="">  
			    	  	
			    	  	<small id="emailHelp" class="form-text text-muted">
			    	  	<a href="#">	Tu empresa aún no se registado? Sé el primero compartiendo tu experiencia laboral</a>
			    	  	</small>
			    	  	

			    	  	<div class="invalid-feedback">
				          Por favor ingresa una empresa
				        </div>

			  	    </div>
			  	</div>
			</div>
			<a class="list-group-item list-group-item-action">
			 	<div class="form-group row">
					<div class="col-sm-4">
					  <label for="">Evalúo mi</label>
					  <select name="evalua" class="form-control" required>
					  	<option value="">Selecciona una opción</option>
					  	<option value="Trabajo Actual">Trabajo Actual</option>
					  	<option value="Trabajo Pasado">Trabajo Pasado</option>
					  	<option value="Práctica">Práctica</option>						  	
					  </select>
					  <div class="invalid-feedback">
				          Por favor selecciona que evaluas
				      </div>
					</div>
				</div>
			</a>

			<a class="list-group-item list-group-item-action">
				<div class="form-group row">
					<div class="col-sm-4">
					  <label for="">Elegir Posición</label>
					  <select name="posicion" class="form-control" required>
					  	<option value="">Selecciona una opción</option>
					  	<option value="Empleado/Obrero">Empleado/Colaborador</option>
					  	<option value="Gerente/Directivo">Gerente/Directivo</option>
					  	<option value="Contrato a tiempo parcial">Prácticante</option>						  	
					  </select>
					  <div class="invalid-feedback">
				          Por favor selecciona la posición
				      </div>
					</div>
				</div>
			</a>
			<a class="list-group-item list-group-item-action">
				<div class="form-group row">
					<div class="col-sm-6">
					  <label for="">Departamento de la Empresa</label>
					  <select name="departamento" class="form-control" required>
					  	<option value="">Selecciona una opción</option>
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

		</div>

		<div class="col-sm-11">
		
			<div class="alert alert-secondary" role="alert">
		  	
			  	<p>Todos juntos aspiramos a hacer más transparente el mercado laboral. 
				Por favor, evalúe cada dimensión laboral lo más honesto posible. </p>

				<p><b>Recuerda:</b> Somos una plataforma neutral y justa 
				Por lo tanto te pedimos tomar en cuenta los siguientes aspectos: </p>

				<ul>
					<dl>
						• No mencionar personas específicas ni nombres.	
					</dl>
					<dl>
						• Se prohíbe publicar información interna, secreta o sensible de la organización. 		
					</dl>
					<dl>
						• Se prohíbe el uso de lenguage discriminatorio, desacreditante, racista o vulgar. 		
					</dl>
				</ul>	

				En ocupasion utilizamos un modo amigable de calificar, sin embargo ten presente el siguiete valor equivalente para las estrellas:		

				<div class="row">
							  		
			  		<div class="col-sm-2 h5 mt-2">
				  		Malo
				  	</div>
				  	<div class="col-sm-5 ">
				  		<div class="d-inline-flex star-rating" >
				        <span class="p-1 fa fa-star fa-2x" data-rating="1" ></span>
				        <span class="p-1 fa fa-star-o fa-2x" data-rating="2" ></span>
				        <span class="p-1 fa fa-star-o fa-2x" data-rating="3" ></span>
				        <span class="p-1 fa fa-star-o fa-2x" data-rating="4" ></span>
				        <span class="p-1 fa fa-star-o fa-2x" data-rating="5" ></span>				        
				      </div>
				  	</div>
			  	</div>

			  	<div class="row">
								  		
			  		<div class="col-sm-2 h5 mt-2">
				  		Regular
				  	</div>
				  	<div class="col-sm-5 ">
				  		<div class="d-inline-flex star-rating" >
				        <span class="p-1 fa fa-star fa-2x" data-rating="1" ></span>
				        <span class="p-1 fa fa-star fa-2x" data-rating="2" ></span>
				        <span class="p-1 fa fa-star-o fa-2x" data-rating="3" ></span>
				        <span class="p-1 fa fa-star-o fa-2x" data-rating="4" ></span>
				        <span class="p-1 fa fa-star-o fa-2x" data-rating="5" ></span>				        
				      </div>
				  	</div>
			  	</div>

			  	<div class="row">
								  		
			  		<div class="col-sm-2 h5 mt-2">
				  		Bueno
				  	</div>
				  	<div class="col-sm-5 ">
				  		<div class="d-inline-flex star-rating" >
				        <span class="p-1 fa fa-star fa-2x" data-rating="1" ></span>
				        <span class="p-1 fa fa-star fa-2x" data-rating="2" ></span>
				        <span class="p-1 fa fa-star fa-2x" data-rating="3" ></span>
				        <span class="p-1 fa fa-star-o fa-2x" data-rating="4" ></span>
				        <span class="p-1 fa fa-star-o fa-2x" data-rating="5" ></span>				        
				      </div>
				  	</div>
			  	</div>

			  	<div class="row">
								  		
			  		<div class="col-sm-2 h5 mt-2">
				  		Muy bueno
				  	</div>
				  	<div class="col-sm-5 ">
				  		<div class="d-inline-flex star-rating" >
				        <span class="p-1 fa fa-star fa-2x" data-rating="1" ></span>
				        <span class="p-1 fa fa-star fa-2x" data-rating="2" ></span>
				        <span class="p-1 fa fa-star fa-2x" data-rating="3" ></span>
				        <span class="p-1 fa fa-star fa-2x" data-rating="4" ></span>
				        <span class="p-1 fa fa-star-o fa-2x" data-rating="5" ></span>				        
				      </div>
				  	</div>
			  	</div>

			  	<div class="row">
								  		
			  		<div class="col-sm-2 h5 mt-2">
				  		Excelente
				  	</div>
				  	<div class="col-sm-5 ">
				  		<div class="d-inline-flex star-rating" >
				        <span class="p-1 fa fa-star fa-2x" data-rating="1" ></span>
				        <span class="p-1 fa fa-star fa-2x" data-rating="2" ></span>
				        <span class="p-1 fa fa-star fa-2x" data-rating="3" ></span>
				        <span class="p-1 fa fa-star fa-2x" data-rating="4" ></span>
				        <span class="p-1 fa fa-star fa-2x" data-rating="5" ></span>				        
				      </div>
				  	</div>
			  	</div>
			</div>	

			
		</div>
		

		<div class="col-sm-11">

			

			<a class="list-group-item list-group-item-action">
				<div class="form-group row">
					<div class="col-sm-8">
					  <label for="">Título de tu evaluación</label>
					  <input type="text" class="form-control" id="" v-model="" name="titulo" placeholder="Ponle un título a tu experencia en la empresa/organización" >
					</div>
				</div>
			</a>			
										
			
		  	@foreach ($categorias as $categoria)
		  		
				
		  		
		  				<a class="list-group-item list-group-item-action text-light bg-dark" >
							<h5>{{$categoria->nombre}}</h5>    	
						</a>	
		    	
			    	@foreach ($items as $item)

			    		@if($item->categoria_id == $categoria->id)
			    				  
							  <a class="list-group-item list-group-item-action">

							  	<div class="row">
							  		
							  		<div class="col-sm-4 h5 mt-2">
								  		{{$item->nombre}}		
								  	</div>
								  	<div class="col-sm-5 ">
								  		<div class="d-inline-flex star-rating star-rating-{{$item->id}}" 
								      	onclick="text_show({{$item->id}})">
								        <span class="p-1 fa fa-star-o fa-2x" data-rating="1" 
								        onclick="evaluar(this, {{$item->id}})"></span>
								        <span class="p-1 fa fa-star-o fa-2x" data-rating="2" 
								        onclick="evaluar(this, {{$item->id}})"></span>
								        <span class="p-1 fa fa-star-o fa-2x" data-rating="3" 
								        onclick="evaluar(this, {{$item->id}})"></span>
								        <span class="p-1 fa fa-star-o fa-2x" data-rating="4" 
								        onclick="evaluar(this, {{$item->id}})"></span>
								        <span class="p-1 fa fa-star-o fa-2x" data-rating="5" 
								        onclick="evaluar(this, {{$item->id}})"></span>
								        <input type="hidden" name="puntaje_{{$item->id}}" class="rating-value" value="0">
								      </div>
								  	</div>
							  	</div>							  	
							  			  	
							      

							      

							      <textarea name="comentario_{{$item->id}}" id="text_{{$item->id}}" class="text_hide form-control" placeholder="Agrega un comentario"></textarea>
							 </a>

						   
				    	@endif
				  	
				  	@endforeach

				
			@endforeach

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

				<a href="#" class="list-group-item list-group-item-action text-light bg-dark">
				<h5>Cuéntanos algo sobre tu empleador</h5>    	
			</a>
			<a href="#" class="list-group-item list-group-item-action">
			 	<div class="form-group row">
			    	<div class="col-sm-8">
			      		<label for="">Propuesta de mejoras (que puede mejorar la empresa)</label>
			    	  	<textarea class="form-control" name="mejoras"></textarea>
			  	    </div>
			  	</div>
			</a>

			<a href="#" class="list-group-item list-group-item-action">
				<div class="form-group row">
			    	<div class="col-sm-8">
			      		<label for="">Del empleador me gusta:</label>
			    	  	<textarea class="form-control" name="like"></textarea>
			  	    </div>
			  	</div>
			</a>

			<a href="#" class="list-group-item list-group-item-action">
				<div class="form-group row">
			    	<div class="col-sm-8">
			      		<label for="">Del empleador no me gusta:</label>
			    	  	<textarea class="form-control" name="no_like"></textarea>
			  	    </div>
			  	</div>
			</a>

			<a href="#" class="list-group-item list-group-item-action">
				<div class="form-group row">
			    	<div class="col-sm-8">
			      		<label for="">¿Recomendarías tu empleador a un amigo? (Si/No)</label>						    	  	
			  	    </div>
			  	</div>
			</a>

			<a href="#" class="list-group-item list-group-item-action">
				<div class="form-group row">
			    	<div class="col-sm-8">
			      		<label for="">¿Cuáles beneficios se te ofrecen en la empresa?</label>						    	  	
			  	    </div>
			  	</div>
			</a>

			<a href="#" class="list-group-item list-group-item-action">
				<div class="form-group row">
			    	<div class="col-sm-8">
			      		<label for="">Correo electrónico (No se publica → Verificación de autenticidad)</label>		
			      		<input type="text" class="form-control" id="" v-model="" name="titulo" placeholder="" >				    	  	
			  	    </div>
			  	</div>
			</a>

			  			

		</form>

	</div>
</div>

@endsection
