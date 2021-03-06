var accentMap = {
  'á': 'a',
  'é': 'e',
  'í': 'i',
  'ó': 'o',
  'ú': 'u'
};

function accent_fold(s) {
  if (!s) {
    return '';
  }
  var ret = '';
  for (var i = 0; i < s.length; i++) {
    ret += accentMap[s.charAt(i)] || s.charAt(i);
  }
  return ret;
};

function evaluar(self, item) {


    //console.log($(self).siblings('input.rating-value').val())
    ///$(self).siblings('input.rating-value').val($(self).data('rating'));
    //console.log($(self).siblings('input.rating-value').val())}
    $('#puntaje_' + item).val($(self).data('rating'));

    $("#mensaje_" + item).css('display', 'none');

    var $star_rating;

    console.log($(self).attr("class"));
    if ($(self).hasClass("far")) {
        $star_rating = $('.star-rating-' + item + ' .far');
    } else {
        $star_rating = $('.star-rating-' + item + ' .fas');
    }

    $star_rating.each(function () {
        if (parseInt($('#puntaje_' + item).val()) >= parseInt($(this).data('rating'))) {
            return $(this).removeClass('far').addClass('fas');
        } else {
            return $(this).removeClass('fas').addClass('far');
        }
    });
}

function text_show(item) {
    $('.text_hide').hide();
    $('#text_' + item).show();
    $('#desc_' + item).show();
}

//const BTN_PRACTICANTE = "<button type='button' id='btn_practicante' class='btn-pos btn btn-dark'  onclick='elegir_pos(this)'>Prácticante</button>";
//const BTN_OTROS = "<button type='button' id='btn_empleado' class='btn-pos btn btn-dark' onclick='elegir_pos(this)'>Empleado</button><button type='button' id='btn_directivo' class='btn-pos btn btn-dark'  onclick='elegir_pos(this)'>Directivo</button>";

function beneficio(self, id) {

    if ($(self).hasClass("btn-outline-secondary")) {

        $(self).removeClass('btn-outline-secondary').addClass('btn-warning');
        $('#bene_' + id).val(id);
    } else {

        $(self).removeClass('btn-warning').addClass('btn-outline-secondary');
        $('#bene_' + id).val(null);
    }
}

function evaluo_mi(self) {

    $('.btn-evaluo').removeClass('btn-warning').addClass('btn-dark');

    $(self).removeClass('btn-dark').addClass('btn-warning');

    $('#evalua').val($(self).text());

    //console.log($(self).attr('id'));
    if ($(self).attr('id') == "btn_actual" || $(self).attr('id') == "btn_pasado") {

        /*if (!$("#btn_empleado").is(":visible")) {
         
         $("#btn_practicante").before(BTN_OTROS);
         }
         
         $("#btn_practicante").remove();*/
        $("#pre_cargo").show();
        $(".dim_practicante").hide();
        $(".dim_empleado").show();

        $(".bne_practica").hide();
        $(".bne_empleo").show();
        $("#pre_ies").hide();
        $("#pre_porque").hide();
        $("#pre_oferta").hide();


        if ($(self).attr('id') == "btn_pasado") {
            $("#pre_motivo").show();
            $("#label_gusto").text("¿Qué te gustó de tu empleador?");
            $("#label_nogusto").text("¿Qué no te gustó de tu empleador?");
            $("#label_bene").text("Selecciona los beneficios que te ofreció tu empleador");

        } else {
            $("#pre_motivo").hide();
            $("#label_gusto").text("¿Qué te gusta de tu empleador?");
            $("#label_nogusto").text("¿Qué no te gusta de tu empleador?");
            $("#label_bene").text("Selecciona los beneficios que te ofrece tu empleador");

        }

        $("#label_salario").text('Salario mensual');

    } else {

        $("#label_salario").text('Apoyo de sostenimiento mensual');

        /*if (!$("#btn_practicante").is(":visible")) {
         
         $('#btn_directivo').after(BTN_PRACTICANTE);
         //elegir_pos($("#btn_practicante"));        
         }*/

        $("#btn_empleado").remove();
        $("#btn_directivo").remove();

        $(".dim_practicante").show();
        $("#pre_ies").show();
        $("#pre_cargo").hide();
        $(".bne_practica").show();
        $(".bne_empleo").hide();
        $(".dim_empleado").hide();
        $("#pre_motivo").hide();

    }

    //validar_botones();
}

/*function elegir_pos(self) {
 
 $('.btn-pos').removeClass('btn-warning').addClass('btn-dark');
 
 $(self).removeClass('btn-dark').addClass('btn-warning');
 
 $('#posicion').val($(self).text());
 
 //validar_botones();
 }*/

function save_empresa() {

    $('#modal_empresa').submit();

}


function elegir_ofre(self) {

    $('.btn-ofre').removeClass('btn-warning').addClass('btn-dark');

    $(self).removeClass('btn-dark').addClass('btn-warning');

    $('#ofrecer').val($(self).text());

    if ($(self).attr('id') == "btn_pra_no") {

        $("#pre_oferta").hide();
        $("#pre_porque").hide();
    } else {

        $("#pre_oferta").show();
    }

}

function abandonar() {
    var res = confirm("¿Realmente quieres abandonar la evaluación?");
    if (res) {
        window.location.href = "http://vidaandwork.com/";
    }
}

function elegir_oferta(self) {

    $('.btn-oferta').removeClass('btn-warning').addClass('btn-dark');

    $(self).removeClass('btn-dark').addClass('btn-warning');

    var text = $(self).text().toUpperCase();
    $('#oferta').val(text);

    if (text == "NO") {
        $("#pre_porque").show();
    } else {
        $("#pre_porque").hide();
    }

}

function elegir_recomienda(self) {

    $('.btn-recomienda').removeClass('btn-warning').addClass('btn-dark');

    $(self).removeClass('btn-dark').addClass('btn-warning');

    $('#recomienda').val($(self).text());
}

function validar_botones() {

    var validar = true;
    
    $("#salary").val($("#salario").val().replace('.',''));

    if ($('#evalua').val() == "") {

        $('#validar_evalua').css('display', 'block');
        validar = false;
    } else {

        $('#validar_evalua').css('display', 'none');
    }

    if ($('#evalua').val() != "Práctica") {

        if ($('#posicion_campo').val() == "") {

            $('#validar_posicion').css('display', 'block');
            validar = false;
        } else {

            $('#validar_posicion').css('display', 'none');
        }
    } else {
        $('#posicion').val("Prácticante");
    }


    if ($('#empresa_id').val() == "") {

        $('#validar_empresa').css('display', 'block');
        $('#empresa').val('');
        validar = false;
    } else {

        $('#validar_empresa').css('display', 'none');
    }

    if ($('#ciudad_eval_id').val() == "") {

        $('#validar_ciudad_eval').css('display', 'block');
        $('#ciudad_eval').removeClass('form-control:valid').addClass('form-control:invalid');
        validar = false;
    } else {

        $('#validar_ciudad_eval').css('display', 'none');
    }

    var $starts = $('.rating-value');

    $starts.each(function () {
        //console.log($(this).parent().is(":visible"));
        if ($(this).val() == "0" && $(this).parent().is(":visible")) {

            $("#mensaje_" + $(this).attr('id').split("_")[1]).css('display', 'block');
            validar = false;
        }
    });

    return validar;
}

function validar_modal() {

    var validar = true;

    if ($('#ciudad_id').val() == "") {

        $('#validar_ciudad').css('display', 'block');
        $('#ciudad').removeClass('form-control:valid').addClass('form-control:invalid');
        validar = false;
    } else {

        $('#validar_ciudad').css('display', 'none');
    }
    return validar;
}

$.fn.digits = function () {
    return this.each(function () {
        $(this).val($(this).val().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
        
    })
}

$(function () {

    $(".retornar").on('click', function () {
        abandonar();
    });

    /*$("#form_evaluar_empresa").on('submit', (function (e) {}
     ));*/

    $("#public_div").hide();
    $("#pre_oferta").hide();

    $("#pre_porque").hide();

    $(".dim_practicante").hide();
    $(".bne_practica").hide();
    $("#pre_motivo").hide();
    $("#pre_ies").hide();

    $('#salario').numeric({negative: false, decimal: true});
    $("#salario").keyup(function () {
        $("#salario").digits();
        
    });
    
    $("#salario").focusout(function () {
        $("#salary").val($("#salario").val().replace('.',''));
    });
    
    

    $('#trabajo_tiempo').numeric({negative: true, decimal: false});


    //sector_economico

    const url_sector = '/json/sectores_economicos.json';

    // Populate dropdown with list of provinces
    let dropdown = $('#sector_economico');
    //console.log('esta entrando');
    $.getJSON(url_sector, function (data) {

        $.each(data, function (key, entry) {

            dropdown.append($('<option></option>').attr('value', entry.value).text(entry.text));
        })
    });


    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission


    var validation = Array.prototype.filter.call(forms, function (form) {
        form.addEventListener('submit', function (event) {

            //event.preventDefault();
            //event.stopPropagation();
            //
            if (validar_botones() == false || form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();

                var errorElements = $(
                        "input:invalid, select:invalid, .invalid-feedback[style*='display: block']")
                        .toArray();

                $('html, body').animate({
                    scrollTop: $(errorElements[0]).offset().top - 50
                }, 2000);

            } else {
                $("#public_div").show();
            }



            form.classList.add('was-validated');
        }, false);
    });


    $("#modal_empresa").submit(function (event) {

        event.preventDefault();

        if (validar_modal() && $('#modal_empresa')[0].checkValidity()) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var form = $('#modal_empresa');


            $.ajax({

                url: '/api/v1/crear_empresa',
                type: 'POST',

                data: {_method: 'POST', _token: CSRF_TOKEN, razon_social: $('#razon_social').val().toUpperCase(), verificada: 'PENDIENTE',
                    ciudad_id: $('#ciudad_id').val(), direccion: $('#direccion').val(), sector_economico: $('#sector_economico').val()},
                dataType: 'JSON',

                success: function (data) {

                    if (parseInt(data) > 0) {
                        $("#empresa").val($('#razon_social').val().toUpperCase());
                        $('#empresa_id').val(data);
                        $('#exampleModal').modal('hide');
                        $('#ciudad_eval_id').val($('#ciudad_id').val());
                        $('#ciudad_eval').val($('#ciudad').val());
                    } else {
                        alert('Error al crear la nueva empresa. Por favor vuelva a intentar.');
                    }
                },
                error: function (request, status, error) {
                    console.log(error);
                    console.log(status);
                    console.log(request);
                    alert('Error al crear la nueva empresa. Por favor vuelva a intentar.');
                }
            });
        }
        $('#modal_empresa').addClass('was-validated');
        validar_modal();

    });



    $('.text_hide').hide();
    $('#cambiar_emp').hide();
    $("#cambiar_emp a").click(function () {
        $('#empresa').prop("readonly", false);
        $('#cambiar_emp').hide();
        $('#buscar_emp').show();
        $('#empresa').val(null);
        $('#empresa_id').val(null);
        $('#empresa').focus();
    });

    $("#empresa").focusout(function () {
        if ($('#empresa_id').val() == "" || $('#empresa_id').val() == null) {

            $('#empresa').val(null);
            $('#empresa').focus();
        }
    });

    $("#empresa").autocomplete({
        source: "/api/v1/encontrar_empresa",
        minLength: 2,
        select: function (event, ui) {
            $('#empresa').val(ui.item.value);
            $('#empresa').prop("readonly", true);
            $('#empresa_id').val(ui.item.id);
            $('#cambiar_emp').show();
            $('#buscar_emp').hide();

        }
    });

    $("#razon_social").autocomplete({
        source: "/api/v1/encontrar_empresa",
        minLength: 2,
        select: function (event, ui) {
            $('#razon_social').val(ui.item.value);
            $('#razon_social_id').val(ui.item.id);
        }
    });

    $("#empresa").focusout(function () {
        //console.log('ejecutar funciones');
        if ($('#empresa_id').val() == "" || $('#empresa_id').val() == null) {

            //$("#empresa").
            //border-color: #dc3545
        }
    })


    var cache_ies = [];
    const url_ies = '/json/ies.json';
    $.getJSON(url_ies, function (data, status, xhr) {

        $.each(data, function (key, entry) {

            cache_ies.push(entry.value);
        });
        //console.log(cache_ies);
    });

    /*var cache_cargos = [];
    const url_cargos = '/json/cargos.json';
    $.getJSON(url_cargos, function (data, status, xhr) {

        $.each(data, function (key, entry) {

            cache_cargos.push(entry.value);
        });
        //console.log(cache_ies);
    });*/

    $("#ciudad_eval").autocomplete({
        source: "/api/v1/encontrar_ubicacion",
        minLength: 2,
        select: function (event, ui) {
            $('#ciudad_eval').val(ui.item.value);
            $('#ciudad_eval_id').val(ui.item.id);
        }
    });
    
    $("#posicion_campo").autocomplete({
        source: "/api/v1/search_job",
        minLength: 2,
        select: function (event, ui) {
            $('#posicion_campo').val(ui.item.value);            
            $('#job_id').val(ui.item.id);
        }
    });

    /*$("#posicion_campo").keyup(function () {
        $('#posicion').val($("#posicion_campo").val());
    });*/

    $("#ciudad_eval").focusout(function () {

        if ($('#ciudad_eval_id').val() == "" && $('#ciudad_eval').val() != "") {

            $.ajax({

                url: '/api/v1/encontrar_ubicacion',
                type: 'GET',
                data: {term: $('#ciudad_eval').val()},
                dataType: 'JSON',
                success: function (data) {
                    console.log(data);
                    $('#ciudad_eval').val(data[0].value);
                    $('#ciudad_eval_id').val(data[0].id);
                },
                error: function (request, status, error) {
                    console.log(error);
                    console.log(status);
                    console.log(request);
                    alert('Error de conexión. Por favor vuelva a intentar.');
                }
            });
        }

    });

    

    $("#ies_campo").autocomplete({
        minLength: 3,
        source: function (request, response) {
            var results = $.ui.autocomplete.filter(cache_ies, accent_fold(request.term));

            response(results.slice(0, 10));
        },
        select: function (event, ui) {
            $('#ies').val(ui.item.value);

        }
    });

    

});

