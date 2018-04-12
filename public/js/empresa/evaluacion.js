
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

$(function() {

	/*var forms = document.getElementsByClassName('needs-validation');
	    // Loop over them and prevent submission
	    var validation = Array.prototype.filter.call(forms, function(form) {
	      form.addEventListener('submit', function(event) {
	        if (form.checkValidity() === false) {
	          event.preventDefault();
	          event.stopPropagation();
	        }
	        form.classList.add('was-validated');
	    }, false);
    });*/


	$('#a_anterior').hide();

	$('.carousel').carousel({
    	interval: false
	});		

	//$('#categoria_1').addClass('active');
	
	$("#empresa").autocomplete({
      source: "/api/v1/buscar_empresa",
      minLength: 2,
      select: function(event, ui) {
	  	$('#empresa').val(ui.item.value);
	  	$('#empresa_id').val(ui.item.id);
	  }	      
    });

    $('#a_siguiente_solo').click(function(){
    	con = 0;

    	//$('#form_evaluar_empresa')[0].checkValidity()
    	if(true){

    		//botones
    		$('#paginador').removeClass('paginador_none');
    		$('#paginador').addClass('paginador');
    		$('#a_siguiente_solo').hide();

    		//next carusel

    		$($('.carousel .carousel-inner').children()[0]).removeClass('active');
    		$($('.carousel .carousel-inner').children()[0]).next().addClass('active');
    		//$('#categoria_0').removeClass('active');

    		if($('#form_evaluar_empresa').hasClass('was-validated')){
    			$('#form_evaluar_empresa').removeClass('was-validated')
    		}

    	}else{

    		$('#form_evaluar_empresa').addClass('was-validated');
    	}
    	

    	//$('#form_evaluar_empresa').checkValidity();

    });

    var con = 0;
    $('#a_pre').click(function(){

    	//console.log($('.carousel .carousel-inner #categoria_0').hasClass('active'))
    	con = con - 1;
    	if(con < 0){

    		$('#paginador').removeClass('paginador');
    		$('#paginador').addClass('paginador_none');
    		$('#a_siguiente_solo').show();
    	}
    	$('#a_sig').text('Siguiente');
    })

    $('#a_sig').click(function(){

    	//console.log($('.carousel .carousel-inner #categoria_0').hasClass('active'))

    	/*$('.carousel .carousel-inner').children().each(function() {

    		console.log($( this ));
		  //$( this ).addClass( "foo" );
		});*/

    	con = con + 1;

    	//console.log(con)
    	if(con == 5){

    		console.log('guardar datos');
    		$('#form_evaluar_empresa').submit();

    	}else if(con == 4){

    		$('#a_sig').text('Terminar');
    	}
    })

});