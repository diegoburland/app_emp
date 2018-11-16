$(document).ready(function() {

    $('#listEvaluacion').DataTable({
        "searching": false,
        "paging": false,
        "info": false,
        "scrollX": false,
        "ordering": false,
       "lengthMenu": [[50,70,80,100], [50,70,80,100]],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json",
            "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
            }
        },
        "columnDefs": [
        {"className": "dt-center", "targets": "_all"}
        ]
        
    });

    var table = $('#listEvaluacion').DataTable();
     
     $('#listEvaluacion tbody').on(function () {
        var data = table.row( this ).data();
        window.location.href = "/empresa_editar/"+data[0];
   } );

    var filter1 = createInput(table, [2], "empresa");
    var filter2 = createInput(table, [3], "correo");
    var filter3 = createDropdowns(table, [6], "trabajo");
    var filter4 = createInput(table, [7], "institucion");
    var filter5 = createDropdowns(table, [8], "evaluacion");
    var filter6 = createDropdowns(table, [9], "statusCorreo");
    var filter7 = createDropdowns(table, [10], "statusEmpresa");
    var filter8 = createDropdowns(table, [11], "contenido");
    var filter9 = createDropdowns(table, [12], "publicacion");
    var filter10 = createInput(table, [5], "ip");

    filter1.appendTo(".empresa");
    filter2.appendTo(".correo");
    filter3.appendTo(".trabajo");
    filter4.appendTo(".institucion");
    filter5.appendTo(".statusevaluacion");
    filter6.appendTo(".statuscorreo");
    filter7.appendTo(".statusempresa");
    filter8.appendTo(".statuscontenido");
    filter9.appendTo(".statuspublicacion");  
    filter10.appendTo(".ip");
});
    var empresa;
    var correo;
    var trabajo;
    var institucion;
    var publicada;
    var contenido;
    var statusEmpresa;
    var statusCorreo;
    var evaluacion;
    var ip;

function createInput(table, columns, id) {
  var input = $('<input class="form-control" id="'+id+'" type="text"/ style="width: 120%;">').on("keypress", function() {
    table.draw();
    
  });

  return input;
}

function actionFilter(){
    empresa = document.getElementById('empresa').value;
    correo = document.getElementById('correo').value;
    trabajo = document.getElementById('trabajo').value;
    institucion = document.getElementById('institucion').value;
    publicada = document.getElementById('public').value;
    contenido = document.getElementById('contenido').value;
    statusEmpresa = document.getElementById('statusEmpresa').value;
    statusCorreo = document.getElementById('statusCorreo').value;
    evaluacion = document.getElementById('evaluac').value;
    ip = document.getElementById('ip').value;

    filterEval(publicada, contenido, statusEmpresa, statusCorreo, evaluacion, empresa, correo, trabajo, institucion, ip)
}

function filterEval(publicada, contenido, statusEmpresa, statusCorreo, evaluacion, empresa, correo, trabajo, institucion, ip){
   
    var CSRF_TOKEN = $('meta[id="csrf-token"]').attr('content');
    $.ajax({
        url: 'filter_evaluacion',
        type: 'POST',
        data: {_method: 'POST', _token: CSRF_TOKEN, publicada:publicada, contenido:contenido, statusEmpresa: statusEmpresa, 
                statusCorreo: statusCorreo, evaluacion: evaluacion, empresa: empresa, correo: correo, trabajo: trabajo, 
                institucion: institucion, ip: ip},
      
    })
    .done(function(response)    
    {
     //   var answer = $.parseJSON(response[0].data);
    //    console.log(response);
     //   $("#listEvaluacion").dataTable().fnDestroy();
        
      //  var prueba = response[0];
         $('#prueba').empty().append($(response)); 

            })
            .fail(function() {
                console.log("error");
            });
}




function createDropdowns(table, columns, type) {
    var select
    if(type == "publicacion")
        select = $('<select class="form-control" id="public" ><option value="">Seleccione una opcion</option><option value="SI">SI</option><option value="NO">NO</option></select>')
    else if(type == "contenido")
        select = $('<select class="form-control" id="contenido" ><option value="">Seleccione una opcion</option><option value="RECHAZADO">RECHAZADO</option><option value="ESPERANDO">ESPERANDO</option><option value="POR VERIFICAR">POR VERIFICAR</option><option value="SIN REVISION">SIN REVISION</option><option value="ACEPTADO">ACEPTADO</option><option value="EDITADO">EDITADO</option></select>')
    else if(type == "statusEmpresa")
        select = $('<select class="form-control" id="statusEmpresa"><option value="">Seleccione una opcion</option><option value="SI">SI</option><option value="ESPERANDO">ESPERANDO</option><option value="POR VERIFICAR">POR VERIFICAR</option><option value="PENDIENTE">PENDIENTE</option><option value="SIN REVISION">SIN REVISION</option><option value="NO VERIFICADA">NO VERIFICADA</option></select>')
    else if(type == "statusCorreo")
        select = $('<select class="form-control" id="statusCorreo" ><option value="">Seleccione una opcion</option><option value="SI">SI</option><option value="NO">NO</option><option value="PENDIENTE">PENDIENTE</option></select>')
    else if(type == "evaluacion")
        select = $('<select class="form-control" id="evaluac" ><option value="">Seleccione una opcion</option><option value="NORMAL">NORMAL</option><option value="POR CONTROLAR">POR CONTROLAR</option><option value="INVALIDA">INVALIDA</option></select>')
    else if(type == "trabajo")
        select = $('<select class="form-control" id="trabajo" ><option value="">Seleccione una opcion</option><option value="TRABAJO ACTUAL">TRABAJO ACTUAL</option><option value="TRABAJO PASADO">TRABAJO PASADO</option><option value="PRÁCTICA">PRÁCTICA</option></select>')

    return select;
         
  }

