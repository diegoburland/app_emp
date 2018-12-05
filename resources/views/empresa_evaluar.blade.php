@extends('layouts.master_eval')

@section('title', 'Evaluar Empresa - Vida and Work')


@section('content')


@section('head')
<script type="text/javascript" src="/js/jquery.numeric-min.js?v={{ time() }}"></script>
<script type="text/javascript" src="/js/empresa/evaluacion.js?v={{ time() }}"></script>
<script type="text/javascript" src="/js/empresa/empresa.js?v={{ time() }}"></script>

@endsection

<div id="public_div" class="loader_div">
    <div id="public_label"  class="loader"><b>Guardando...</b><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>
</div>

<div class="row justify-content-md-center">

    <form id="form_evaluar_empresa" method="POST" action="/crear_evaluacion" novalidate class="needs-validation">

        <div class="col-sm-11 centrar_div">





            @method('POST')
            @csrf



            <h4>Evalúa a tu empleador</h4>
            <div class="alert alert-secondary" role="alert">                
                <p>Gracias por aportar tu experiencia laboral. Así otros pueden tener una
                    mejor idea de como es realmente trabajar para una empresa como la tuya.
                    Por supuesto, la evaluación es <b> 100% gratuita y anónima.</b>
                </p>			
            </div>


            <!--button type="submit" btn btn-secondary>Empezar Evaluación</button-->



            <a class="list-group-item list-group-item-action text-light bg-dark">
                <h5>Datos Generales</h5>    								
            </a>




            <div class="list-group-item list-group-item-action">
                <div class="form-group row required ">
                    <div class="col-sm-6">
                        <label class="control-label" ><b>Busca y selecciona la empresa</b></label>
                        <input type="text" class="form-control" id="empresa" autocomplete="nope" name="empresa_nombre" placeholder="Busca y selecciona la empresa" required>
                        <input type="hidden" name="empresa_id" id="empresa_id" value="">  

                        <small id="buscar_emp" class="form-text text-muted">
                            <a href="#" data-toggle="modal" data-target="#exampleModal">¿No aparece tu empresa?</a>
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
                        <label class="control-label" for="">Ciudad</label>
                        <input type="text" class="form-control" id="ciudad_eval" name="ciudad_eval" placeholder="Busca y selecciona la ciudad" autocomplete="nope" required>
                        <input type="hidden" name="ciudad_eval_id" id="ciudad_eval_id" value="">  
                        <div id="validar_ciudad_eval" class="invalid-feedback">
                            Por favor selecciona una ciudad del listado
                        </div>
                    </div>
                </div>
            </div>

            <a class="list-group-item list-group-item-action">
                <div class="form-group row required" >
                    <div class="col-sm-5">
                        <div class="row ml-1">
                            <label class="control-label" for="">Evalúo mi</label>
                        </div>

                        <button type="button" id="btn_actual" class="btn-evaluo btn btn-dark" onclick="evaluo_mi(this)">Trabajo Actual</button>
                        <button type="button" id="btn_pasado" class="btn-evaluo btn btn-dark"  onclick="evaluo_mi(this)">Trabajo Pasado</button>
                        <button type="button" id="btn_practica" class="btn-evaluo btn btn-dark"  onclick="evaluo_mi(this)">Práctica</button>


                        <input type="hidden" data-validate="true" name="evalua" id="evalua" value="" required>

                        <!--select name="evalua" class="form-control" required>
                              <option value="">Selecciona una opción</option>
                              <option value="Trabajo Actual">Trabajo Actual</option>
                              <option value="Trabajo Pasado">Trabajo Pasado</option>
                              <option value="Práctica">Práctica</option>						  	
                        </select-->
                        <div id="validar_evalua" class="invalid-feedback">
                            Por favor selecciona que evaluas
                        </div>
                    </div>
                </div>
            </a>

            <div class="list-group-item list-group-item-action" id="pre_ies">
                <div class="form-group row required ">
                    <div class="col-sm-6">
                        <label class="control-label" for="">Institución Educativa</label>
                        <input type="text" class="form-control" id="ies_campo" name="ies_campo" placeholder="Institución Educativa" autocomplete="nope">
                        <input type="hidden" name="ies" id="ies" value="">  
                        <div class="invalid-feedback">
                            Por favor selecciona una institución educativa del listado
                        </div>
                    </div>
                </div>
            </div>

            <a class="list-group-item list-group-item-action" id="pre_cargo">
                <div class="form-group row required">
                    <div class="col-sm-6">                           
                        <label class="control-label" for="">Elegir Cargo</label>
                        <input type="text" class="form-control" id="posicion_campo" name="posicion_campo" placeholder="Busca y selecciona un cargo" autocomplete="nope">
                        <input type="hidden" name="posicion" id="posicion" value="">
                        <div id="validar_posicion" class="invalid-feedback">
                            Por favor selecciona la posición
                        </div>
                        <small id="emailHelp" class="form-text text-muted text-justify">
                            Nunca se publica
                        </small>


                    </div>
                </div>
            </a>
            <a class="list-group-item list-group-item-action">
                <div class="form-group row required">
                    <div class="col-sm-6">
                        <label class="control-label" for="">Departamento de la Empresa</label>
                        <select name="departamento" class="form-control" required>
                            <option value="">Selecciona una opción</option>
                            <option value="Administración / Organización">Administración / Organización</option>
                            <option value="Compras / Proveedores">Compras / Proveedores</option>
                            <option value="Control de Gestión">Control de Gestión</option>
                            <option value="Finanzas / Contabilidad">Finanzas / Contabilidad</option>
                            <option value="Investigación / Desarrollo/ Innovación">Investigación / Desarrollo/ Innovación</option>
                            <option value="Gerencia / Dirección">Gerencia / Dirección</option>
                            <option value="Sistemas de información / TI">Sistemas de información / TI</option>
                            <option value="Logística y Abastecimiento">Logística y Abastecimiento</option>
                            <option value="Mercadeo / Gerencia de Productos">Mercadeo / Gerencia de Productos</option>
                            <option value="Comunicación / Relaciones públicas">Comunicación / Relaciones públicas</option>
                            <option value="Talento humano">Talento humano</option>
                            <option value="Producción">Producción</option>
                            <option value="Legal / Fiscal">Legal / Fiscal</option>
                            <option value="Ventas / Comercial">Ventas / Comercial</option>
                            <option value="Gestión de Calidad">Gestión de Calidad</option>
                            <option value="Salud">Salud</option>
                            <option value="Educación">Educación</option>
                            <option value="Otro">Otro</option>
                        </select>
                        <div class="invalid-feedback">
                            Por favor selecciona el departamento
                        </div>
                    </div>
                </div>
            </a>

        </div>

        <div class="col-sm-11 mt-3 centrar_div">

            <div class="alert alert-secondary" role="alert">

                <p><b>Recuerda:</b> Somos una plataforma neutral y justa. Por lo tanto, te pedimos ser respetuoso en tus comentarios, no mencionar personas específicas ni información sensible de la organización. 

            </div>	


        </div>


        <div class="col-sm-11 centrar_div">



            <a class="list-group-item list-group-item-action">
                <div class="form-group row">
                    <div class="col-sm-8">
                        <label class="control-label" for="">Título de tu evaluación</label>
                        <input type="text" class="form-control" id=""  name="titulo" maxlength="100" placeholder="Breve resume tu experiencia en la empresa" >
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
                    <div class="col-sm-4 ">
                        @if ($item == $items[0])
                        <div style="display: inline-flex;">   

                            <div class="d-inline">
                                <i class="far fa-frown-open fa-2x" style="color: #ff3100;"></i> 
                            </div>
                            <div class="d-inline" style="padding-left: 195px"></div>
                            <div class="d-inline">
                                <i class="far fa-grin-alt fa-2x" aria-hidden="true" style="color: green"></i> 
                            </div>

                        </div>
                        @endif

                        <div class="d-inline-flex star-rating star-rating-{{$item->id}}" 
                             onclick="text_show({{$item -> id}})">
                            <!--i class="far fa-star"></i-->
                            <span class="p-1 far fa-star fa-2x" data-rating="1" 
                                  onclick="evaluar(this, {{$item -> id}})"></span>
                            <span class="p-1 far fa-star fa-2x" data-rating="2" 
                                  onclick="evaluar(this, {{$item -> id}})"></span>
                            <span class="p-1 far fa-star fa-2x" data-rating="3" 
                                  onclick="evaluar(this, {{$item -> id}})"></span>
                            <span class="p-1 far fa-star fa-2x" data-rating="4" 
                                  onclick="evaluar(this, {{$item -> id}})"></span>
                            <span class="p-1 far fa-star fa-2x" data-rating="5" 
                                  onclick="evaluar(this, {{$item -> id}})"></span>								        
                        </div>                        

                    </div>
                    <div class="col-sm-4 mb-2 text_hide " id="desc_{{$item->id}}">
                        <small id="emailHelp" class="form-text text-muted font-italic">{{$item->descripcion}}</small>

                    </div>
                </div>							  	

                <textarea name="comentario_{{$item->id}}" id="text_{{$item->id}}" maxlength="255" class="text_hide form-control" placeholder="Agrega un comentario"></textarea>

                <div id="mensaje_{{$item->id}}" class="invalid-feedback">
                    Debes asignar una estrella
                </div>
                <input type="hidden" name="puntaje_{{$item->id}}" id="puntaje_{{$item->id}}" class="rating-value" value="0">
            </a>


            @endif

            @endforeach


            @endforeach		

            <a  class="list-group-item list-group-item-action text-light bg-dark">
                <h5>Beneficios</h5>    	
            </a>
            <a  class="list-group-item list-group-item-action bne_empleo bonus_extra">
                <div class="alert alert-secondary" role="alert">
                    <p id="label_bene">Selecciona los beneficios que te ofrece tu empleador</p>			
                </div>

                <div class="col-sm-12 col_auto">
                    @foreach ($benes as $bene)
                    @if($bene->tipo == 1)
                    <button type="button" class="btn btn-sm btn-outline-secondary mb-1 bunus" onclick="beneficio(this, {{$bene -> id}})">{{$bene->nombre}}</button>
                    <input type="hidden" name="bene_{{$bene->id}}" id="bene_{{$bene->id}}" value="">
                    @endif
                    @endforeach          
                </div>
            </a>

            <a  class="list-group-item list-group-item-action bne_practica">

                <div class="alert alert-secondary" role="alert">
                    <p>Selecciona los beneficios que te ofrece tu empleador</p>			
                </div>

                <div class="col-sm-12">
                    @foreach ($benes as $bene) 
                    @if($bene->tipo == 2)
                    <button type="button" class="btn btn-sm btn-outline-secondary m-1 bunus" onclick="beneficio(this, {{$bene -> id}})">{{$bene->nombre}}</button>
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
                    <div class="col-sm-5">
                        <label id="label_salario" for="">Salario</label>
                        <input type="text" class="form-control" id="salario" name="salario" placeholder="$COP Pesos Colombianos" >
                        <small id="emailHelp" class="form-text text-muted text-justify">
                            Nunca se publica
                        </small>
                    </div>

                </div>
            </a>

            <a  class="list-group-item list-group-item-action">
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="">Horas trabajadas por semana</label>
                        <input type="text" class="form-control" id="trabajo_tiempo" name="trabajo_tiempo" placeholder="Horas por semana" >
                    </div>
                </div>
            </a>

            <a  class="list-group-item list-group-item-action dim_practicante">
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="">¿Le ofrecieron un puesto en la empresa después de la practica?</label>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" id="btn_pra_si" class="btn-ofre btn btn-dark" onclick="elegir_ofre(this)">Si</button>
                            <button type="button" id="btn_pra_no" class="btn-ofre btn btn-dark" onclick="elegir_ofre(this)">No</button>
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
                            <button type="button" class="btn-oferta btn btn-dark" onclick="elegir_oferta(this)">Si</button>
                            <button type="button" class="btn-oferta btn btn-dark"  onclick="elegir_oferta(this)">No</button>
                        </div>
                        <input type="hidden" name="oferta" id="oferta" value="">
                    </div>
                </div>
            </a>

            <a  id="pre_porque" class="list-group-item list-group-item-action">
                <div class="form-group row">
                    <div class="col-sm-8">
                        <label for="">¿Qué lo motivó a no aceptar la oferta?</label>
                        <textarea class="form-control" name="porque"></textarea>
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
                        <textarea class="form-control" name="mejoras"></textarea>
                    </div>
                </div>
            </a>

            <a  class="list-group-item list-group-item-action">
                <div class="form-group row">
                    <div class="col-sm-8">
                        <label id="label_gusto" for="">¿Qué te gustó de tu empleador?</label>
                        <textarea class="form-control" name="like"></textarea>
                    </div>
                </div>
            </a>

            <a  class="list-group-item list-group-item-action">
                <div class="form-group row">
                    <div class="col-sm-8">
                        <label id="label_nogusto" for="">¿Qué no te gustó de tu empleador?</label>
                        <textarea class="form-control" name="no_like"></textarea>
                    </div>
                </div>
            </a>

            <a  class="list-group-item list-group-item-action" id="pre_motivo">
                <div class="form-group row">
                    <div class="col-sm-8">
                        <label for="">¿Cuál fue el motivo de tu retiro?</label>
                        <textarea class="form-control" name="motivo"></textarea>
                    </div>
                </div>
            </a>      

            <a  class="list-group-item list-group-item-action">
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label  for="">¿Recomendarías tu empleador a un amigo? <span class="asteris">*</span></label>				
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn-recomienda btn btn-dark" onclick="elegir_recomienda(this)">Si</button>
                            <button type="button" class="btn-recomienda btn btn-dark"  onclick="elegir_recomienda(this)">No</button>
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
                        <label class="control-label" for="">Correo electrónico</label>		
                        <input type="email" class="form-control" id="" name="email" placeholder="Correo electrónico" required>	
                        <small id="emailHelp" class="form-text text-muted text-justify">
                            Nunca se publicará tu correo. Necesitamos tu correo para verificar la autenticidad de tu evaluación. Te enviamos un correo para confirmar tu evaluación. 
                            Al dar click en el botón Finalizar aceptas nuestros <a href="http://vidaandwork.com/terminos-y-condiciones/" target="_blank">Términos y Condiciones.</a>
                        </small>

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

                        <div class="form-group required row">
                            <div class="col-sm-12">
                                <label class="control-label" for="">Nombre de la Empresa (Razón Social)</label>
                                <input type="text" class="form-control text-uppercase" id="razon_social" name="razon_social" placeholder="Nombre de la empresa (Razón Social)" required>
                                <input type="hidden" name="razon_social_id" id="razon_social_id" value="">

                                <div class="invalid-feedback">
                                    Por favor ingresa el nombre de la empresa
                                </div>
                            </div>
                        </div>

                        <div class="form-group required row">
                            <div class="col-sm-12">
                                <label class="control-label" for="">Sector económico</label>
                                <select class="form-control" id="sector_economico" name="sector_economico" required>
                                    <option></option>				        
                                </select>   
                                <div class="invalid-feedback">
                                    Por favor selecciona un sector
                                </div>   
                            </div>
                        </div>

                        <div class="form-group required row">
                            <div class="col-sm-12">
                                <label class="control-label" for="">Ciudad</label>
                                <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="Busca y selecciona la ciudad" autocomplete="nope" required>
                                <input type="hidden" name="ciudad_id" id="ciudad_id" value="">  
                                <div id="validar_ciudad" class="invalid-feedback">
                                    Por favor selecciona una ciudad del listado
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="">Página web</label>
                                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Página web">
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
