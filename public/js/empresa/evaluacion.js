
function evaluar(self, item){

    
	//console.log($(self).siblings('input.rating-value').val())
	$(self).siblings('input.rating-value').val($(self).data('rating'));
	//console.log($(self).siblings('input.rating-value').val())}
    $("#mensaje_"+item).css('display', 'none');

	var $star_rating = $('.star-rating-' + item + ' .fa');
	$star_rating.each(function() {
		if (parseInt($($star_rating).siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
	      return $(this).removeClass('fa-star-o').addClass('fa-star');
	    } else {
	      return $(this).removeClass('fa-star').addClass('fa-star-o');
	    }
    });
}

function text_show(item) {
    $('.text_hide').hide();
    $('#text_'+item).show();
}

function evaluo_mi(self){

    $('.btn-evaluo').removeClass('btn-dark').addClass('btn-secondary');

    $(self).removeClass('btn-secondary').addClass('btn-dark');

    $('#evalua').val($(self).text());

    //validar_botones();
}

function elegir_pos(self){

    $('.btn-pos').removeClass('btn-dark').addClass('btn-secondary');

    $(self).removeClass('btn-secondary').addClass('btn-dark');

    $('#posicion').val($(self).text());

    //validar_botones();
}

function save_empresa(){

    $('#modal_empresa').submit();
    
}


function elegir_ofre(self){

    $('.btn-ofre').removeClass('btn-dark').addClass('btn-secondary');

    $(self).removeClass('btn-secondary').addClass('btn-dark');

    $('#ofrecer').val($(self).text());

}

function elegir_oferta(self){

    $('.btn-oferta').removeClass('btn-dark').addClass('btn-secondary');

    $(self).removeClass('btn-secondary').addClass('btn-dark');

    $('#oferta').val($(self).text());
}

function elegir_recomienda(self){

    $('.btn-recomienda').removeClass('btn-dark').addClass('btn-secondary');

    $(self).removeClass('btn-secondary').addClass('btn-dark');

    $('#recomienda').val($(self).text());
}

function validar_botones(){    

    var validar = true;

    if($('#evalua').val() == ""){

        $('#validar_evalua').css('display', 'block');
        validar = false;
    }else{

        $('#validar_evalua').css('display', 'none');
    }

    if($('#posicion').val() == ""){

        $('#validar_posicion').css('display', 'block');
        validar = false;
    }else{

        $('#validar_posicion').css('display', 'none');
    }

    var $starts = $('.rating-value');
    
    $starts.each(function() {
        if ($(this).val() == "0") {

            $("#mensaje_"+$(this).attr('id').split("_")[1]).css('display', 'block');
            validar = false;
        }        
    });

    return validar;
}

function validar_modal(){

    var validar = true;

    if($('#ciudad_id').val() == ""){

        $('#validar_ciudad').css('display', 'block');
        $('#ciudad').removeClass('form-control:valid').addClass('form-control:invalid');
        validar = false;
    }else{

        $('#validar_ciudad').css('display', 'none');
    }
    return validar;
}

$(function() {

	var forms = document.getElementsByClassName('needs-validation');
	    // Loop over them and prevent submission

        
	    var validation = Array.prototype.filter.call(forms, function(form) {
	      form.addEventListener('submit', function(event) {            

            //event.preventDefault();
            //event.stopPropagation();

	        if (validar_botones() == false || form.checkValidity() === false) {
	          event.preventDefault();
	          event.stopPropagation();
              
              var errorElements = $(
                "input:invalid, select:invalid, .invalid-feedback[style*='display: block']")
              .toArray();
              //document.querySelectorAll(
                //"input:invalid, .invalid-feedback[style='display:block']");              

	        }

            $('html, body').animate({                
            scrollTop: $(errorElements[0]).offset().top-50
            }, 2000);

	        form.classList.add('was-validated');
	    }, false);
    });


    $( "#modal_empresa" ).submit(function( event ) {
      
      event.preventDefault();

      if( validar_modal() && $('#modal_empresa')[0].checkValidity()){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var form = $('#modal_empresa');

        
        $.ajax({
            
            url: '/api/v1/crear_empresa',
            type: 'POST',
            
            data: {_method: 'POST', _token: CSRF_TOKEN, razon_social:$('#razon_social').val(),
             ciudad_id:$('#ciudad_id').val(), direccion:$('#direccion').val(), sector_economico:$('#sector_economico').val()},
            dataType: 'JSON',
            
            success: function (data) { 
                $("#empresa").val($('#razon_social').val());
                $('#empresa_id').val(data);
                $('#exampleModal').modal('hide');
            }
        }); 
      }
      $('#modal_empresa').addClass('was-validated');
      validar_modal();
      
    });



    $('.text_hide').hide();
	/*$('#a_anterior').hide();
    

	$('.carousel').carousel({
    	interval: false
	});*/		

	//$('#categoria_1').addClass('active');
	
	$("#empresa").autocomplete({
      source: "/api/v1/encontrar_empresa",
      minLength: 2,
      select: function(event, ui) {
	  	$('#empresa').val(ui.item.value);
	  	$('#empresa_id').val(ui.item.id);
	  }	      
    });

    $("#razon_social").autocomplete({
      source: "/api/v1/encontrar_empresa",
      minLength: 2,
      select: function(event, ui) {
        $('#razon_social').val(ui.item.value);
        $('#razon_social_id').val(ui.item.id);
      }       
    });

    /*$('#a_siguiente_solo').click(function(){
    	con = 0;

    	
    	if($('#form_evaluar_empresa')[0].checkValidity()){

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
		});

    	con = con + 1;

    	//console.log(con)
    	if(con == 6){

    		console.log('guardar datos');
    		$('#form_evaluar_empresa').submit();

    	}else if(con == 5){

    		$('#a_sig').text('Terminar');
    	}
    })*/

});