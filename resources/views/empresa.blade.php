@extends('layouts.master')

@section('title', 'Page Title')

@section('head')
  <script type="text/javascript" src="/js/empresa/profile.js"></script>
@endsection

@section('content')


<div class="card">
  <div class="card-header">
  	<h2>{{$empresa->razon_social}}</h2>
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home">Resumen</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab">Calificaciones</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab">Preguntas</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
	
	<div class="tab-content" id="myTabContent">
	  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
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

	  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">	  	
	  	
	  	<div class="row">

				@foreach ($categorias as $categoria)
				  		
					<div class="col-lg-4 m-1">
						
					
			  			<div class="list-group">
			  				<a class="list-group-item list-group-item-action text-light bg-dark">
								<h5>{{$categoria->nombre}}</h5>    	
							</a>	
			    	
				    	@foreach ($items as $item)

				    		@if($item->categoria_id == $categoria->id)
				    				  
								  <a class="list-group-item list-group-item-action">{{$item->nombre}}			  	
								      <div class="star-rating star-rating-{{$item->id}}">
								        <span class="fa fa-star-o fa-lg" data-rating="1"></span>
								        <span class="fa fa-star-o fa-lg" data-rating="2"></span>
								        <span class="fa fa-star-o fa-lg" data-rating="3"></span>
								        <span class="fa fa-star-o fa-lg" data-rating="4"></span>
								        <span class="fa fa-star-o fa-lg" data-rating="5"></span>
								        <input type="hidden" name="item_{{$item->id}}" class="rating-value" value="{{$item->promedio}}">
								        <span class="badge badge-primary badge-pill">{{$item->promedio}}</span>
								      </div>
								  </a>

							   
					    	@endif
					  	
					  	@endforeach

					  	</div>	
					</div>  	 
				  	
				@endforeach
			</div>
	  </div>
	  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">3...</div>
	</div>

  </div>
</div>

    


@endsection
