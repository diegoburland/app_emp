$(document).ready(function() {

  var URLactual = window.location;

  if(/empresa_editar/.test(URLactual)){
    var btn_actual = document.getElementById('btn_actual');
    var btn_practica = document.getElementById('btn_practica');
    var btn_pasado = document.getElementById('btn_pasado');
    var btn_empleado = document.getElementById('btn_empleado');
    var btn_directivo = document.getElementById('btn_directivo');
    var btn_SiRecomienda = document.getElementById('btn_SiRecomienda');
    var btn_NoRecomienda = document.getElementById('btn_NoRecomienda');
    var btn_SiOfrece = document.getElementById('btn_pra_si');
    var btn_NoOfrece = document.getElementById('btn_pra_no');
    var btn_SiAcepta = document.getElementById('btn_si_acepta');
    var btn_NoAcepta = document.getElementById('btn_no_acepta');

    
    if($('#tipoEvaluacion')[0].value == "Trabajo Pasado"){
      $('#btn_pasado').click();
      btn_actual.disabled = true;
      btn_practica.disabled = true;
    }

    else if($('#tipoEvaluacion')[0].value == "Trabajo Actual"){
      $('#btn_actual').click();
      btn_pasado.disabled = true;
      btn_practica.disabled = true;
    }
    else{
      $('#btn_practica').click();
      btn_pasado.disabled = true;
      btn_actual.disabled = true;
    }
    if($('#tipoCargo')[0].value == "Empleado"){
      $('#btn_empleado').click();
      btn_directivo.disabled = true;
    }
    else if($('#tipoCargo')[0].value == "Directivo"){
      $('#btn_directivo').click();
      btn_empleado.disabled = true;
    }
    else
      $('#btn_practicante').click();
    if($('#recomendacion')[0].value == "Si"){
      $('#btn_SiRecomienda').click();
      btn_NoRecomienda.disabled = true;
    }
    else{
      $('#btn_NoRecomienda').click();
      btn_SiRecomienda.disabled = true;
    }

    $("#departamento").val($('#depatarmentoEmp')[0].value);

    if($('#recomendacion')[0].value == "Si"){
      $('#btn_SiRecomienda').click();
      btn_NoRecomienda.disabled = true;
    }
    else{
      $('#btn_NoRecomienda').click();
      btn_SiRecomienda.disabled = true;
    }

    if($('#puestoempresa')[0].value == "Si"){
      $('#btn_pra_si').click();

      btn_NoOfrece.disabled = true;
    }
    else{
      $('#btn_pra_no').click();
      btn_SiOfrece.disabled = true;
    }

    if($('#aceptaoferta')[0].value == "Si"){
      $('#btn_si_acepta').click();
      btn_NoAcepta.disabled = true;
    }
    else{
      $('#btn_no_acepta').click();
      btn_SiAcepta.disabled = true;
    }
  }
  calificaciones = $.parseJSON($('#calificaciones').val());

});

var cambio = false;
var calificaciones;


function editar(opc){

  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  var id = $('#id_evaluacion').val();
  var departamento = $('#departamento').val();
  var titulo = $('#titulo').val();
  var salario = $('#salario').val();
  var horas = $('#trabajo_tiempo').val(); 
  var mejoras = $('#mejoras').val();
  var like = $('#like').val();
  var no_like = $('#no_like').val(); 
  var empresa = $('#empresa_id').val();
  var evalua = $('#tipoEvaluacion').val();
  var tipocargo = $('#tipoCargo').val(); 

  if(opc == 'true'){
    swal({
      title: "¿Seguro desea rechazar la evaluación?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
            url: 'editar_evaluacion',
            type: 'POST',
            
            data: {_method: 'POST',  _token: CSRF_TOKEN, id: id, departamento: departamento, titulo: titulo, salario: salario,
                    horas: horas, calificaciones: calificaciones, mejoras: mejoras, like: like, no_like: no_like, cambio: cambio, 
                    empresa_id: empresa, evalua: evalua, posicion: tipocargo, id_padre: id, rechazado: opc },
            dataType: 'JSON',
            
            success: function (data) { 
                alert("Edito");
            }
        });
        swal("Ud ha rechazado esta evaluación", {
          icon: "success",
        });
      }
     //  window.location.href = "/evaluacion_list";
    });
  }
  else{
    swal({
      title: "¡Evaluación verificada exitosamente!",
      icon: "success",
      button: "Cerrar",
    });

    $.ajax({
        url: 'editar_evaluacion',
        type: 'POST',
            
        data: {_method: 'POST',  _token: CSRF_TOKEN, id: id, departamento: departamento, titulo: titulo, salario: salario,
                horas: horas, calificaciones: calificaciones, mejoras: mejoras, like: like, no_like: no_like, cambio: cambio, 
                empresa_id: empresa, evalua: evalua, posicion: tipocargo, id_padre: id, rechazado: opc },
        dataType: 'JSON',
            
        success: function (data) { 
            alert("Edito");
        }
    })
 //   window.location.href = "/evaluacion_list";
  }
  setTimeout(function(){window.close()},4000); // 3000ms = 3s
} 

function actualiza(status){
  cambio = status;
}

function cambioComentario(id){  
   calificaciones[id-1].comentario = $('#text_'+id).val();
   actualiza('true');
}



function text_show(item) {
    $('.text_hide').hide();
    $('#text_'+item).show();
    $('#desc_'+item).show();
}

const BTN_PRACTICANTE = "<button type='button' id='btn_practicante' class='btn-pos btn btn-secondary'  onclick='elegir_pos(this)'>Prácticante</button>";
const BTN_OTROS = "<button type='button' id='btn_empleado' class='btn-pos btn btn-secondary' onclick='elegir_pos(this)'>Empleado</button><button type='button' id='btn_directivo' class='btn-pos btn btn-secondary'  onclick='elegir_pos(this)'>Directivo</button>";

function beneficio(self, id){
  
     if($(self).hasClass( "btn-secondary" )){
       
       $(self).removeClass('btn-secondary').addClass('btn-warning');
       $('#bene_' + id).val(id);
     }else{
       
       $(self).removeClass('btn-warning').addClass('btn-secondary');
       $('#bene_' + id).val(null);
     }   
}

function evaluo_mi(self){

    $('.btn-evaluo').removeClass('btn-dark').addClass('btn-secondary');

    $(self).removeClass('btn-secondary').addClass('btn-dark');

    $('#evalua').val($(self).text());

    if ($(self).attr('id') == "btn_actual" || $(self).attr('id') == "btn_pasado") {

        if (!$("#btn_empleado").is(":visible")) {
          
           $("#btn_practicante").before(BTN_OTROS);          
        }
       
        $("#btn_practicante").remove();

        $(".dim_practicante").hide();
        $(".dim_empleado").show();
      
        $(".bne_practica").hide();
        $(".bne_empleo").show();

    }else{

        if (!$("#btn_practicante").is(":visible")) {

          $('#btn_directivo').after(BTN_PRACTICANTE);    
          //elegir_pos($("#btn_practicante"));        
        }

        $("#btn_empleado").remove();
        $("#btn_directivo").remove();

        $(".dim_practicante").show();
        $(".bne_practica").show();
        $(".bne_empleo").hide();
        $(".dim_empleado").hide();
        
        
        elegir_pos($("#btn_practicante"));        
    }

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

    if ($(self).attr('id') == "btn_pra_no") {

        $("#pre_oferta").hide();
    }else{

        $("#pre_oferta").show();
    }

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

    if($('#empresa_id').val() == ""){

        $('#validar_empresa').css('display', 'block');
        $('#empresa').val('');
        validar = false;
    }else{

        $('#validar_empresa').css('display', 'none');
    }    

    var $starts = $('.rating-value');
    
    $starts.each(function() {
        console.log($(this).parent().is(":visible"));
        if ($(this).val() == "0" && $(this).parent().is(":visible")) {

            $("#mensaje_"+$(this).attr('id').split("_")[1]).css('display', 'block');
            validar = false;
        }        
    });

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

        /*    $('html, body').animate({                
            scrollTop: $(errorElements[0]).offset().top-50
            }, 2000);*/

	        form.classList.add('was-validated');
	    }, false);
    });



  $('.text_hide').hide();
  $('#cambiar_emp').hide();
  $("#cambiar_emp a").click(function() {
        $('#empresa').prop("readonly", false);
        $('#cambiar_emp').hide();
        $('#buscar_emp').show();
        $('#empresa').val(null);
        $('#empresa_id').val(null);
        $('#empresa').focus();
  });
  
  $("#empresa").focusout(function() {
    if($('#empresa_id').val() == "" || $('#empresa_id').val() == null){
        
      $('#empresa').val(null);
      $('#empresa').focus();
    }
  });
	
	$("#empresa").autocomplete({
      source: "/api/v1/encontrar_empresa",
      minLength: 2,
      select: function(event, ui) {
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
      select: function(event, ui) {
        $('#razon_social').val(ui.item.value);
        $('#razon_social_id').val(ui.item.id);
      }       
    });
  
  $("#empresa").focusout(function() {
    //console.log('ejecutar funciones');
    if($('#empresa_id').val() == "" || $('#empresa_id').val() == null){
      
      //$("#empresa").
          //border-color: #dc3545
    }
  })

   

});