
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

function text_show(item) {
    $('.text_hide').hide();
    $('#text_'+item).show();
}

function evaluo_mi(self){

    $('.btn-evaluo').removeClass('btn-dark').addClass('btn-secondary');

    $(self).removeClass('btn-secondary').addClass('btn-dark');

    $('#evalua').val($(self).text());
}

function elegir_pos(self){

    $('.btn-pos').removeClass('btn-dark').addClass('btn-secondary');

    $(self).removeClass('btn-secondary').addClass('btn-dark');

    $('#posicion').val($(self).text());
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

$(function() {

	var forms = document.getElementsByClassName('needs-validation');
	    // Loop over them and prevent submission
	    var validation = Array.prototype.filter.call(forms, function(form) {
	      form.addEventListener('submit', function(event) {
	        if (form.checkValidity() === false) {
	          event.preventDefault();
	          event.stopPropagation();
              
              var errorElements = document.querySelectorAll(
                "input.form-control:invalid");
              errorElements.forEach(function(element) {
                element.parentNode.childNodes.forEach(function(node) {
                  if (node.className == 'valid-feedback') {
                    node.className = 'invalid-feedback';
                    node.innerText =
                      'Please choose a Gender';
                  }
                });
              });

	        }
            
            $('html, body').animate({
            scrollTop: $(errorElements[0]).offset().top
            }, 2000);

	        form.classList.add('was-validated');
	    }, false);
    });


	$('#a_anterior').hide();
    $('.text_hide').hide();

	$('.carousel').carousel({
    	interval: false
	});		

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

    $('#a_siguiente_solo').click(function(){
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
		});*/

    	con = con + 1;

    	//console.log(con)
    	if(con == 6){

    		console.log('guardar datos');
    		$('#form_evaluar_empresa').submit();

    	}else if(con == 5){

    		$('#a_sig').text('Terminar');
    	}
    })

});