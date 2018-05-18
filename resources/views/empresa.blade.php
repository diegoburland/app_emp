@extends('layouts.master')

@section('title', 'Ocupacion')

@section('head')
  <script type="text/javascript" src="/js/empresa/profile.js"></script>
@endsection

@section('content')

<div class="m-1">
  <div class="row">
    <div class="col-sm-3">
    	<h2>{{$empresa->razon_social}}</h2>
      	<p>
	  		<b>Ubicación:</b> {{$empresa->ciudad->nombre}}<br>
	  		<b>Sector económico:</b> {{$empresa->sector_economico}}<br>
	  	</p>
	  	
	  	<b>Puntaje promedio:</b>
	    <div class="star-rating star-rating-0">
	      <span class="fa fa-star-o fa-lg" data-rating="1"></span>
	      <span class="fa fa-star-o fa-lg" data-rating="2"></span>
	      <span class="fa fa-star-o fa-lg" data-rating="3"></span>
	      <span class="fa fa-star-o fa-lg" data-rating="4"></span>
	      <span class="fa fa-star-o fa-lg" data-rating="5"></span>
	      <input type="hidden" name="item_0" class="rating-value" value="{{$total_puntaje}}">
	 		<span class="badge badge-primary badge-pill">{{$total_puntaje}}</span>
	  	</div>
		<br>
	    <p class="card-text">Algun texto descriptivo de la empresa</p>
	    <p class="card-text">Imagenes</p>
	    <p class="card-text">Videos</p>
    </div>
    <div class="col-sm-9">
      <div class="card m-1">
  <div class="card-header">
  	
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home">Total</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab">Empleados</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab">Practicantes</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
	
	<div class="tab-content" id="myTabContent">
	  	<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
	  	

			@foreach ($categorias as $categoria)
			  		
		  	<div class="m-1">
		  		
				<div class="row mt-3 pb-1">		  	
					<h4>{{$categoria->nombre}}</h4>
				</div>

				<div class="row">
					
				
	    	
		    	@foreach ($items as $item)

		    		@if($item->categoria_id == $categoria->id)
		    			
		    			<div class="col-sm-6">

		    				<div class="float-left">
		    					{{$item->nombre}}			  		
		    				</div>

					      	<div class="float-right d-inline star-rating star-rating-{{$item->id}}">
					        	<span class="fa fa-star-o fa-lg" data-rating="1"></span>
					        	<span class="fa fa-star-o fa-lg" data-rating="2"></span>
					        	<span class="fa fa-star-o fa-lg" data-rating="3"></span>
					        	<span class="fa fa-star-o fa-lg" data-rating="4"></span>
					        	<span class="fa fa-star-o fa-lg" data-rating="5"></span>
					        	<input type="hidden" name="item_{{$item->id}}" class="rating-value" value="{{$item->promedio}}">
					        	<span class="badge badge-primary badge-pill">{{$item->promedio}}</span>
					      	</div>
		    			</div>	  
						  

					   
			    	@endif
			  	
			  	@endforeach

			  	</div>
			</div>			

			@endforeach
		</div>
	  

	  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">	  	
	  	
	  	
	  </div>
	  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">3...</div>
	</div>

  </div>
</div>
    </div>
  </div>
</div>



    


@endsection
