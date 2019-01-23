
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

    $('.content-area-six-box button').on('click', function(){
        $('.content-six-box-one button').removeClass('active');
        $(this).addClass('active');
        let selector = $(this).attr('index');
        $('.content-six-box-two .panel-ambiente-box').hide();

        $('.panel-ambiente-box-'+selector).css("display", "flex")
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


    $('.sidebar').stickySidebar({
        topSpacing: 10,
        bottomSpacing: 0,
        containerSelector: false,
        innerWrapperSelector: '.content-profile-hero',
        resizeSensor: true,
        stickyClass: 'is-affixed',
        minWidth: 0

    });

    function successMessage(id){

        $('#message' + id).empty().hide().append(
            `<div class="alert alert-dismissible alert-success alert-si">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Gracias!</strong> por tu valoracion.
            </div>`).fadeIn();

        setTimeout(function(){
            $('#message' + id).fadeOut('slow');
        }, 3000);
    }

    function successMessage2(id){

        $('#message' + id).empty().hide().append(
            `<div class="alert alert-dismissible alert-success alert-si">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Gracias!</strong> por tu valoracion.
            </div>`).fadeIn();

        setTimeout(function(){
            $('#message' + id).fadeOut('slow');
        }, 3000);
    }

    //AJAX PARA EL BOTON DE NO VALIOSA

    $('.option-yes').on('click', function(){
        let id = $(this).attr('index');
        let token = $('#token').val();

        $(this).css('background-color', '#66a960');
        $(this).parent().find('button').prop('disabled', 'disabled').css('cursor', 'no-drop');

        $.ajax({
            url: '/api/v1/recomienda',
            headers : {'X-CSRF-TOKEN': token},
            type : 'POST',
            dataType : 'json',
            data : {
                id: id
            },
            success: function(res){

                if(res.success == 200){
                    let selector = '#yes'+res.id;
                    $(selector).html(res.value);
                    successMessage(res.id);
                }else if(res.success == 400){
                    $('#message' + res.id).hide().append(
                        `<div class="alert alert-dismissible alert-danger alert-no">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Disculpa!</strong> Ha ocurrido un error.
                    </div>`).fadeIn();

                }else{
                    alert("hola");
                }
                
            }

        })
    })

    //AJAX PARA EL BOTON DE NO VALIOSA

    $('.option-no').on('click', function(){

        let id = $(this).attr('index');
        let token = $('#token').val();

        $(this).css('background-color', '#ff4444');
        $(this).parent().find('button').prop('disabled', 'disabled').css('cursor', 'no-drop');
        $.ajax({
            url: '/api/v1/norecomienda',
            headers : {'X-CSRF-TOKEN': token},
            type : 'POST',
            dataType : 'json',
            data : {
                id: id
            },
            success: function(res){
                console.log(res);
                if(res.success == 200){
                    let selector = '#no'+res.id;
                    $(selector).html(res.value);

                    successMessage2(res.id);
                }else if(res.success == 400){
                    $('#message' + res.id).hide().append(
                        `<div class="alert alert-dismissible alert-danger alert-no">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Disculpa!</strong> Ha ocurrido un error.
                    </div>`).fadeIn();

                }else{
                    alert("hola");
                }
                
            }

        })
    })

    $('.box-sticky-two i').on('click', function(){
       $('#selectCity').click()
    })


});

  