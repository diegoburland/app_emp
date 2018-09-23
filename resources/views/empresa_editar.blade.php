@extends('layouts.master')

@section('title', ' Verificación de evaluación')


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

ul.ui-autocomplete {
    z-index: 1100;
}

</style>


@section('head')
	<script type="text/javascript" src="/js/empresa/evaluacion.js"></script>
	<script type="text/javascript" src="/js/empresa/empresa.js"></script>
@endsection


<div class="row justify-content-md-center">

	<form id="form_evaluacion" method="POST" action="/editar_evaluacion" novalidate class="needs-validation">

	<div class="col-sm-11" style="margin-left: 4%;">

		
			
			

			@method('POST')
			@csrf
			
			<h4>Verificar evaluación</h4>

			

			  <button type="submit" btn btn-secondary style="margin-left: 95%;">Atrás</button>


					
			<a class="list-group-item list-group-item-action text-light bg-dark">
				<h5>Datos Generales</h5>    								
			</a>

			


			<div class="list-group-item list-group-item-action">
				<div class="form-group row required ">
			    	<div class="col-sm-6">
              <label class="control-label" ><b>Empresa</b></label>
			    	  	<input type="text" class="form-control" id="empresa" name="empresa_nombre" placeholder="Busca y selecciona la empresa" disabled="true" value="{{$empresa->razon_social}}" required>
			    	  	<input type="hidden" name="empresa_id" id="empresa_id" value="">  
			    	  	<small id="buscar_emp" class="form-text text-muted">
			    	  	<a href="#" data-toggle="modal" data-target="#exampleModal">¿Asignar una empresa no registrada?</a>
			    	  	</small>
              
                <small id="cambiar_emp" class="form-text text-muted">
			    	  	<a href="#" id="cambiar_action">Cambiar Empresa!</a>
			    	  	</small>
			    	  	

			    	  	<div id="validar_empresa" class="invalid-feedback">
				          Por favor selecciona una empresa, o crea una nueva.
				        </div>

			  	    </div>
          
			  	</div>
			</div>
    
      <div class="list-group-item list-group-item-action">
				<div class="form-group row required ">
				    <div class="col-sm-6">
				      <label for="">Ciudad</label>
				      <input type="text" disabled="true" class="form-control" id="ciudad" name="ciudad" placeholder="Ciudad" autocomplete="off" value="{{$empresa->ciudad}}" required>
				      <input type="hidden" name="ciudad_id" id="ciudad_id" value="">  
				      <div id="validar_ciudad" class="invalid-feedback">
				          Por favor selecciona una ciudad del listado
				      </div>
				    </div>
				</div>
      </div>

			<a class="list-group-item list-group-item-action">
			 	<div class="form-group row required" >
			 		<input type="hidden" name="tipoEvaluacion" id="tipoEvaluacion" value="{{$evaluacion->evalua}}"> 
					<div class="col-sm-5">
						<div class="row ml-1">
					  		<label for="">Evalúo mi</label>
					  	</div>
					  	<div class="btn-group flex-wrap" role="group" aria-label="Basic example">
						  <button type="button" id="btn_actual" class="btn-evaluo btn btn-secondary" onclick="evaluo_mi(this)">Trabajo Actual</button>
						  <button type="button" id="btn_pasado" class="btn-evaluo btn btn-secondary" onclick="evaluo_mi(this)">Trabajo Pasado</button>
						  <button type="button" id="btn_practica" class="btn-evaluo btn btn-secondary" onclick="evaluo_mi(this)">Práctica</button>
						</div>
					
						<input type="hidden" data-validate="true" name="evalua" id="evalua" value="" required>
					  <div id="validar_evalua" class="invalid-feedback">
				          Por favor seleccione una opción
				      </div>
					</div>
				</div>
			</a>

			<a class="list-group-item list-group-item-action">
				<div class="form-group row">
					<div class="col-sm-5">
						<div class="row ml-1">
							<label for="">Elegir Posición</label>		
						</div>
					  
						<input type="hidden" name="tipoCargo" id="tipoCargo" value="{{$evaluacion->posicion}}"> 
					  	<div class="btn-group flex-wrap" role="group" aria-label="Basic example">
						  <button type="button" id="btn_empleado" class="btn-pos btn btn-secondary" onclick="elegir_pos(this)">Empleado</button>
						  <button type="button" id="btn_directivo" class="btn-pos btn btn-secondary" onclick="elegir_pos(this)">Directivo</button>
						  <button type="button" id="btn_practicante" class="btn-pos btn btn-secondary" onclick="elegir_pos(this)">Practicante</button>
						</div>
						
						<input type="hidden" name="posicion" id="posicion" value="">
					  <div id="validar_posicion" class="invalid-feedback">
				          Por favor selecciona la posición
				      </div>
					</div>
				</div>
			</a>
			<a class="list-group-item list-group-item-action">
				<div class="form-group row">
					<div class="col-sm-6">
					  <input type="hidden" name="depatarmentoEmp" id="depatarmentoEmp" value="{{$evaluacion->departamento}}">
					  <label for="">Departamento de la Empresa</label>
					  <select name="departamento" id="departamento" class="form-control" required>
					  	<option value="">Selecciona una opción</option>
					  	<option value="Administración / Organización">Administración / Organización</option>
					  	<option value="Compras / Proveedores">Compras / Proveedores</option>
					  	<option value="Control de Gestión">Control de Gestión</option>
					  	<option value="Finanzas / Contabilidad">Finanzas / Contabilidad</option>
					  	<option value="Investigación / Desarrollo">Investigación / Desarrollo</option>
					  	<option value="Gerencia / Dirección">Gerencia / Dirección</option>
					  	<option value="Sistemas de información / TI">Sistemas de información / TI</option>
					  	<option value="Logística / Almacén / Inventario">Logística / Almacén / Inventario</option>
					  	<option value="Mercadeo / Gerencia de Productos">Mercadeo / Gerencia de Productos</option>
					  	<option value="Comunicación / Relaciones públicas">Comunicación / Relaciones públicas</option>
					  	<option value="Talento humano">Talento humano</option>
					  	<option value="Producción">Producción</option>
					  	<option value="Legal / Fiscal">Legal / Fiscal</option>
					  	<option value="Ventas / Comercial">Ventas / Comercial</option>
					  	<option value="Gestión de Calidad">Gestión de Calidad</option>
					  	<option value="Otro">Otro</option>
					  </select>
					  <div class="invalid-feedback">
				          Por favor selecciona el departamento
				      </div>
					</div>
				</div>
			</a>

		</div>

		<div class="col-sm-11" style="margin-left: 4%;">
		
			<div class="alert alert-secondary" role="alert">
		  	
			  	<p>Todos juntos aspiramos a hacer más transparente el mercado laboral. 
				Por favor, evalúa cada dimensión laboral lo más honesto posible. </p>

				<p><b>Recuerda:</b> Somos una plataforma neutral y justa. Por lo tanto, te pedimos tomar en cuenta los siguientes aspectos: </p>

				<ul>
					<dl>
						• No mencionar personas específicas ni nombres.	
					</dl>
					<dl>
						• Se prohíbe publicar información interna, secreta o sensible de la organización. 		
					</dl>
					<dl>
						• Se prohíbe el uso de lenguaje discriminatorio, desacreditante, racista o vulgar. 		
					</dl>
				</ul>	

				En Ocupasión utilizamos un modo amigable de calificar. Sin embargo, ten presente el siguiente rubro de calificación de estrellas:		

				<div class="row">
							  		
			  		<div class="col-sm-3 h5 mt-2">
				  		Muy insatisfecho
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
								  		
			  		<div class="col-sm-3 h5 mt-2">
				  		Insatisfecho
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
								  		
			  		<div class="col-sm-3 h5 mt-2">
				  		Neutral
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
								  		
			  		<div class="col-sm-3 h5 mt-2">
				  		Satisfecho
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
								  		
			  		<div class="col-sm-3 h5 mt-2">
				  		Muy satisfecho
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
		

		<div class="col-sm-11" style="margin-left: 4%;">

			

			<a class="list-group-item list-group-item-action">
				<div class="form-group row">
					<div class="col-sm-8">
					  <label for="">Título de tu evaluación</label>
					  <input type="text" class="form-control" id="" value='{{$evaluacion->titulo}}' name="titulo" placeholder="Ponle un título a tu experencia en la empresa/organización" >
					</div>
				</div>
			</a>			
										
			
		  	@foreach ($categorias as $categoria)
		  		
				
		  		
		  				<a class="list-group-item list-group-item-action text-light bg-dark dim_{{$categoria->dimension}}" >
							<h5>{{$categoria->nombre}}</h5>    	
						</a>	
		    	
			    	@foreach ($items as $item)

			    		@if($item->categoria_id == $categoria->id)
			    				  
							  <a class="list-group-item list-group-item-action dim_{{$categoria->dimension}}">

							  	<div class="row">
							  		
							  		<div class="col-sm-4 h5 mt-2">
								  		{{$item->nombre}}		
								  	</div>
								  	@foreach ($calificaciones as $calificacion)
								  	@if($item->id == $calificacion->id)
								  	@if($calificacion->puntaje == "1")
								  	<div class="col-sm-4 ">
								  		<div class="d-inline-flex star-rating star-rating-{{$item->id}}">
									        <span class="p-1 fa fa-star fa-2x" data-rating="1"></span>
									        <span class="p-1 fa fa-star-o fa-2x" data-rating="2"></span>
									        <span class="p-1 fa fa-star-o fa-2x" data-rating="3"></span>
									        <span class="p-1 fa fa-star-o fa-2x" data-rating="4"></span>
									        <span class="p-1 fa fa-star-o fa-2x" data-rating="5"></span>								        
									    </div>
								  	</div>
								  	<div class="col-sm-4 mb-2 text_hide " id="desc_{{$item->id}}">
								  		<small id="emailHelp" class="form-text text-muted font-italic">{{$item->descripcion}}</small>
								  									  		
								  	</div>
								  	@endif
								  	@if($calificacion->puntaje == "2")
								  	<div class="col-sm-4 ">
								  		<div class="d-inline-flex star-rating star-rating-{{$item->id}}">
									        <span class="p-1 fa fa-star fa-2x" data-rating="1"></span>
									        <span class="p-1 fa fa-star fa-2x" data-rating="2"></span>
									        <span class="p-1 fa fa-star-o fa-2x" data-rating="3"></span>
									        <span class="p-1 fa fa-star-o fa-2x" data-rating="4"></span>
									        <span class="p-1 fa fa-star-o fa-2x" data-rating="5"></span>								        
									    </div>
								  	</div>
								  	<div class="col-sm-4 mb-2 text_hide " id="desc_{{$item->id}}">
								  		<small id="emailHelp" class="form-text text-muted font-italic">{{$item->descripcion}}</small>
								  									  		
								  	</div>
								  	@endif
								  	@if($calificacion->puntaje == "3")
								  	<div class="col-sm-4 ">
								  		<div class="d-inline-flex star-rating star-rating-{{$item->id}}">
									        <span class="p-1 fa fa-star fa-2x" data-rating="1"></span>
									        <span class="p-1 fa fa-star fa-2x" data-rating="2"></span>
									        <span class="p-1 fa fa-star fa-2x" data-rating="3"></span>
									        <span class="p-1 fa fa-star-o fa-2x" data-rating="4"></span>
									        <span class="p-1 fa fa-star-o fa-2x" data-rating="5"></span>								        
									    </div>
								  	</div>
								  	<div class="col-sm-4 mb-2 text_hide " id="desc_{{$item->id}}">
								  		<small id="emailHelp" class="form-text text-muted font-italic">{{$item->descripcion}}</small>
								  									  		
								  	</div>
								  	@endif
								  	@if($calificacion->puntaje == "4")
								  	<div class="col-sm-4 ">
								  		<div class="d-inline-flex star-rating star-rating-{{$item->id}}">
									        <span class="p-1 fa fa-star fa-2x" data-rating="1"></span>
									        <span class="p-1 fa fa-star fa-2x" data-rating="2"></span>
									        <span class="p-1 fa fa-star fa-2x" data-rating="3"></span>
									        <span class="p-1 fa fa-star fa-2x" data-rating="4"></span>
									        <span class="p-1 fa fa-star-o fa-2x" data-rating="5"></span>								        
									    </div>
								  	</div>
								  	<div class="col-sm-4 mb-2 text_hide " id="desc_{{$item->id}}">
								  		<small id="emailHelp" class="form-text text-muted font-italic">{{$item->descripcion}}</small>
								  									  		
								  	</div>
								  	@endif
								  	@if($calificacion->puntaje == "5")
								  	<div class="col-sm-4 ">
								  		<div class="d-inline-flex star-rating star-rating-{{$item->id}}">
									        <span class="p-1 fa fa-star fa-2x" data-rating="1"></span>
									        <span class="p-1 fa fa-star fa-2x" data-rating="2"></span>
									        <span class="p-1 fa fa-star fa-2x" data-rating="3"></span>
									        <span class="p-1 fa fa-star fa-2x" data-rating="4"></span>
									        <span class="p-1 fa fa-star fa-2x" data-rating="5"></span>								        
									    </div>
								  	</div>
								  	<div class="col-sm-4 mb-2 text_hide " id="desc_{{$item->id}}">
								  		<small id="emailHelp" class="form-text text-muted font-italic">{{$item->descripcion}}</small>
								  									  		
								  	</div>
								  	@endif
								  	
							  	</div>						  	
							  	  @if($calificacion->comentario != "")					      
							      	<textarea name="comentario_{{$item->id}}" id="text_{{$item->id}}" class="form-control" placeholder="Agrega un comentario">{{$calificacion->comentario}}</textarea>
							      @endif
							      <div id="mensaje_{{$item->id}}" class="invalid-feedback">
							          Debes asignar una estrella
							      </div>
							      <input type="hidden" name="puntaje_{{$item->id}}" id="puntaje_{{$item->id}}" class="rating-value" value="0">

							      @endif
							      @endforeach
							 </a>

						   
				    	@endif
				  	
				  	@endforeach

				
			@endforeach		

      <a  class="list-group-item list-group-item-action text-light bg-dark">
				<h5>Beneficios</h5>    	
			</a>
      <a  class="list-group-item list-group-item-action bne_empleo">
				<div class="col-sm-12">
          @foreach ($benes as $bene)
            @if($bene->tipo == 1)
              <button type="button" style="white-space: normal;width: 200px;" class="btn btn-sm btn-secondary m-1" onclick="beneficio(this, {{$bene->id}})">{{$bene->nombre}}</button>
              <input type="hidden" name="bene_{{$bene->id}}" id="bene_{{$bene->id}}" value="">
            @endif
          @endforeach          
			  </div>
			</a>
      
      <a  class="list-group-item list-group-item-action bne_practica">
				<div class="col-sm-12">
           @foreach ($benes as $bene)
            @if($bene->tipo == 2)
              <button type="button" style="white-space: normal;width: 200px;" class="btn btn-sm btn-secondary m-1" onclick="beneficio(this, {{$bene->id}})">{{$bene->nombre}}</button>
              <input type="hidden" name="bene_{{$bene->id}}" id="bene_{{$bene->id}}" value="">
            @endif
          @endforeach          
			  </div>
			</a>
      
			<a  class="list-group-item list-group-item-action text-light bg-dark">
				<h5>Información adicional</h5>    	
			</a>

			<a  class="list-group-item list-group-item-action">
				<div class="form-group row">
			    	<div class="col-sm-4">
			      		<label for="">Salario</label>
			    	  	<input type="number" class="form-control" id="" name="salario" value="{{$evaluacion->salario}}" placeholder="$COP Pesos Colombianos" >
			  	    </div>
			  	</div>
			</a>

			<a  class="list-group-item list-group-item-action">
			 	<div class="form-group row">
			    	<div class="col-sm-4">
			      		<label for="">Horas trabajadas por semana</label>
			    	  	<input type="number" class="form-control" id="" name="trabajo_tiempo" value="{{$evaluacion->trabajo_tiempo}}" placeholder="Horas por semana" >
			  	    </div>
			  	</div>
			</a>

			<a  class="list-group-item list-group-item-action dim_practicante">
			 	<div class="form-group row">
			    	<div class="col-sm-4">
			      		<label for="">¿Le ofrecieron un puesto en la empresa después de la practica?</label>
			    	  	<div class="btn-group" role="group" aria-label="Basic example">
						  <button type="button" id="btn_pra_si" class="btn-ofre btn btn-secondary" onclick="elegir_ofre(this)">Si</button>
						  <button type="button" id="btn_pra_no" class="btn-ofre btn btn-secondary" onclick="elegir_ofre(this)">No</button>
						</div>
						<input type="hidden" name="ofrecer" id="ofrecer" value="">

			  	    </div>
			  	</div>
			</a>

			<a id="pre_oferta"  class="list-group-item list-group-item-action">
			 	<div class="form-group row">
			    	<div class="col-sm-3">
			      		<label for="">¿Decidió aceptar la oferta de trabajo?</label>
			    	  	<div class="btn-group" role="group" aria-label="Basic example">
						  <button type="button" class="btn-oferta btn btn-secondary" onclick="elegir_oferta(this)">Si</button>
						  <button type="button" class="btn-oferta btn btn-secondary"  onclick="elegir_oferta(this)">No</button>
						</div>
						<input type="hidden" name="oferta" id="oferta" value="">
			  	    </div>
			  	</div>
			</a>

			

			<a  class="list-group-item list-group-item-action text-light bg-dark">
				<h5>Cuéntanos algo sobre tu empleador</h5>    	
			</a>
			<a  class="list-group-item list-group-item-action">
			 	<div class="form-group row">
			    	<div class="col-sm-8">
			      		<label for="">¿En qué puede mejorar tu empleador?</label>
			    	  	<textarea class="form-control" name="mejoras">{{$evaluacion->mejoras}}</textarea>
			  	    </div>
			  	</div>
			</a>

			<a  class="list-group-item list-group-item-action">
				<div class="form-group row">
			    	<div class="col-sm-8">
			      		<label for="">¿Qué te gustó de tu empleador?</label>
			    	  	<textarea class="form-control" name="like">{{$evaluacion->like}}</textarea>
			  	    </div>
			  	</div>
			</a>

			<a  class="list-group-item list-group-item-action">
				<div class="form-group row">
			    	<div class="col-sm-8">
			      		<label for="">¿Qué no te gustó de tu empleador?</label>
			    	  	<textarea class="form-control" name="no_like">{{$evaluacion->no_like}}</textarea>
			  	    </div>
			  	</div>
			</a>

			<a  class="list-group-item list-group-item-action">
				<div class="form-group row">
			    	<div class="col-sm-4">
			      		<label for="">¿Recomendarías tu empleador a un amigo?</label>				
			      		<div class="btn-group" role="group" aria-label="Basic example">
						  <button type="button" class="btn-recomienda btn btn-secondary" onclick="elegir_recomienda(this)">Si</button>
						  <button type="button" class="btn-recomienda btn btn-secondary"  onclick="elegir_recomienda(this)">No</button>
						</div>
						<input type="hidden" name="recomienda" id="recomienda" value="">		    	  	
			  	    </div>
			  	</div>
			</a>

			<!--a  class="list-group-item list-group-item-action">
				<div class="form-group row">
			    	<div class="col-sm-8">
			      		<label for="">¿Cuáles beneficios se te ofrecen en la empresa?</label>						    	  	
			  	    </div>
			  	</div>
			</a-->

			<div class="list-group-item list-group-item-action">
				<div class="form-group row required">
			    	<div class="col-sm-8">
			      		<label for="">Correo electrónico del evaluador</label>		
			      		<input type="email" class="form-control" id="" disabled="true" name="email" placeholder="Correo electrónico" value="{{$evaluacion->email}}" required>
			    	  	<div class="invalid-feedback">
				          Por favor ingresa tu correo
				        </div>		    	  	
			  	    </div>
			  	</div>
			</div>	
								

			<div class="pt-2 mb-2"> 		
				<button class="btn btn-warning  btn-lg btn-block" type="submit">
					Finalizar
				</button>
			</div>
						  				

	</div>

	</form>


	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Crear empresa</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        
	        <meta name="csrf-token" content="{{ csrf_token() }}" />
	        <form id="modal_empresa" novalidate class="needs-validation2" method="POST">
	        	
	        
		      	<div class="form-group row">
			        <div class="col-sm-12">
				      <label for="">Nombre de la Empresa</label>
				      <input type="text" class="form-control" id="razon_social" name="razon_social" placeholder="Nombre de la Empresa" required>
				      <input type="hidden" name="razon_social_id" id="razon_social_id" value="">

				      <div class="invalid-feedback">
				          Por favor ingresa el nombre de la empresa
				      </div>
				    </div>
			    </div>

			    <div class="form-group row">
				    <div class="col-sm-12">
				    	<label for="">Sector económico</label>
				      <select class="form-control" id="sector_economico" name="sector_economico" required>
				        <option></option>
				        <option value="Administrativa y Financiera">
				          Administrativa y Financiera
				        </option>
				        <option value="Archivo y Documentación">
				          Archivo y Documentación
				        </option>
				        <option value="Auditoría, Contraloría e Interventoría">
				          Auditoría, Contraloría e Interventoría
				        </option>
				        <option value="Calidad (aseguramiento, gestión y afines)">
				          Calidad (aseguramiento, gestión y afines)
				        </option>
				        <option value="Comercial, Ventas y Telemercadeo">
				          Comercial, Ventas y Telemercadeo
				        </option>
				        <option value="Comercio Exterior">
				          Comercio Exterior
				        </option>
				        <option value="Compras e Inventarios">
				          Compras e Inventarios
				        </option>
				        <option value="Construcción y Obra">
				          Construcción y Obra
				        </option>
				        <option value="Docencia">
				          Docencia
				        </option>        
				      </select>   
				      <div class="invalid-feedback">
				          Por favor selecciona un sector
				      </div>   
				    </div>
				</div>

			    <div class="form-group row">
				    <div class="col-sm-12">
				      <label for="">Ciudad</label>
				      <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="Ciudad" autocomplete="off" required>
				      <input type="hidden" name="ciudad_id" id="ciudad_id" value="">  
				      <div id="validar_ciudad" class="invalid-feedback">
				          Por favor selecciona una ciudad del listado
				      </div>
				    </div>
				</div>
				<div class="form-group row">
				    <div class="col-sm-12">
				    	<label for="">Dirección</label>
				      <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección">
				    </div>
				</div>

			</form>

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
	        <button type="button" class="btn btn-primary" onclick="save_empresa()" >Guardar</button>
	      </div>
	    </div>
	  </div>
	</div>

</div>

@endsection