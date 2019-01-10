
$(document).ready(function() {
    // AJAX PARA FORMULARIO DE BUSQUEDA
    $("#texto_busqueda").autocomplete({
        source: "/api/v1/encontrar_empresa_principal",
        minLength: 1,
        success: function(data) {
            response(data);
            console.log(data);
        },
        select: function (event, ui) {
            $('#texto_busqueda').val(ui.item.value);
            // $('#texto_busqueda').prop("readonly", true);
            $('.box-sticky-one #formulario_busqueda').attr('action', document.location.origin +'/busqueda/'+ ui.item.id);

        }
    });


    
    $('.content-five-box-one button').on('click', function(){
        $('.content-five-box-one button').removeClass('active');
        $(this).addClass('active');
        let selector = $(this).attr('index');
        $('.ambiente-box-one').hide();

        $('.'+selector).css("display", "flex")
        .hide().fadeIn();


    
      })

    
    // CONTROLADOR CARRUSEL DE IMAGENES SINGLE PAGE
    
    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:2
            }
        }
    })

    $('.owl-carousel').find('.owl-nav').removeClass('disabled');
    $('.owl-carousel').on('changed.owl.carousel', function(event) {
        $(this).find('.owl-nav').removeClass('disabled');
    });
    

    // COLAPSE EVALUACIONES SINGLE PAGE
    
    $('#myCollapsible').collapse({
      toggle: false
    })


    // CAMBIAR ESTADO DEL BOTON EVALUACIONES DE MAS A MENOS Y DE MENOS A MAS
    $('.button-more').on('click', function(){
      $(this).parent().parent().parent().parent().toggleClass('showing');
      $(this).children('.fa-minus, .fa-plus').toggleClass('fa-minus fa-plus');

    })
    
    // INICIALIZAR TOOLTIPS BOOTSTRAP POPPER
    $('[data-toggle="tooltip"]').tooltip()
    

    //ACTUALIZA EL NUMERO DE EMPLEADOS EN EL EL BOTON SINGLE PAGE
    let valueEmpleado = $('.hiddenEmpleados').text();
    let valuePracticante = $('.hiddenPracticantes').text();
    $('#empleados').text(valueEmpleado + ' Empleados');

    $('#practicantes').text(valuePracticante + ' Practicantes');


});

  