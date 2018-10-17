$(document).ready(function() {

    $('#listEvaluacion').DataTable({
        "searching": false,
        "paging": false,
        "info": false,
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
        ]/*,
          initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        } */
        
    });

    var table = $('#listEvaluacion').DataTable();
     
     $('#listEvaluacion tbody').on(function () {
        var data = table.row( this ).data();
        window.location.href = "/empresa_editar/"+data[0];
   } );

    var filter1 = createInput(table, [2], "empresa");
    var filter2 = createInput(table, [3], "correo");
    var filter3 = createInput(table, [6], "trabajo");
    var filter4 = createInput(table, [7], "institucion");
    var filter5 = createDropdowns(table, [8], "evaluacion");
    var filter6 = createDropdowns(table, [9], "statusCorreo");
    var filter7 = createDropdowns(table, [10], "statusEmpresa");
    var filter8 = createDropdowns(table, [11], "contenido");
    var filter9 = createDropdowns(table, [12], "publicacion");

    filter1.appendTo(".empresa");
    filter2.appendTo(".correo");
    filter3.appendTo(".trabajo");
    filter4.appendTo(".institucion");
    filter5.appendTo(".statusevaluacion");
    filter6.appendTo(".statuscorreo");
    filter7.appendTo(".statusempresa");
    filter8.appendTo(".statuscontenido");
    filter9.appendTo(".statuspublicacion");  
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


function ShowSelected() {
    publicada = document.getElementById('public').value;
    contenido = document.getElementById('contenido').value;
    statusEmpresa = document.getElementById('statusEmpresa').value;
    statusCorreo = document.getElementById('statusCorreo').value;
    evaluacion = document.getElementById('evaluac').value;
    empresa = document.getElementById('empresa').value;
    correo = document.getElementById('correo').value;
    trabajo = document.getElementById('trabajo').value;
    institucion = document.getElementById('institucion').value;
    filterEval(publicada, contenido, statusEmpresa, statusCorreo, evaluacion, empresa, correo, trabajo, institucion)
};

function createInput(table, columns, id) {
  var input = $('<input class="form-control" id="'+id+'" type="text"/ style="width: 120%;">').on("keypress", function() {
    table.draw();
    empresa = document.getElementById('empresa').value;
    correo = document.getElementById('correo').value;
    trabajo = document.getElementById('trabajo').value;
    institucion = document.getElementById('institucion').value;
    publicada = document.getElementById('public').value;
    contenido = document.getElementById('contenido').value;
    statusEmpresa = document.getElementById('statusEmpresa').value;
    statusCorreo = document.getElementById('statusCorreo').value;
    evaluacion = document.getElementById('evaluac').value;

    filterEval(publicada, contenido, statusEmpresa, statusCorreo, evaluacion, empresa, correo, trabajo, institucion)
  });

  return input;
}

function filterEval(publicada, contenido, statusEmpresa, statusCorreo, evaluacion, empresa, correo, trabajo, institucion){
   
    var CSRF_TOKEN = $('meta[id="csrf-token"]').attr('content');
    $.ajax({
        url: 'filter_evaluacion',
        type: 'POST',
        data: {_method: 'POST', _token: CSRF_TOKEN, publicada:publicada, contenido:contenido, statusEmpresa: statusEmpresa, 
                statusCorreo: statusCorreo, evaluacion: evaluacion, empresa: empresa, correo: correo, trabajo: trabajo, 
                institucion: institucion},
        dataType: 'JSON',
    })
    .done(function(response)
    {console.log(response[0]);
        var prueba = response[0];

        $('#prueba listEvaluacion tbody').html(prueba);


        
   //     response.evaluacion = response[0].data;
     //    $('#listEvaluacion tbody').html(response);
      //  $('#listEvaluacion').html(response[0]);

        
    //    console.log(evaluacion);
     //   var result= $.parseJSON(response);
       // console.log(result);

     /*   table_students.rows().remove();
        for (var i = result.length - 1; i >= 0; i--) 
        {
            var rowNode = table_students
            .row.add([
                                result[i].id_group,
                                result[i].stu_nombre,
                                result[i].stu_apellido,
                                result[i].stu_identificacion,
                                result[i].stu_calificacion,
                                '<center><button type="button" name="viewdata" id="viewdata" class="btn btn-warning"><span class="glyphicon glyphicon-file"></span></center></button>',
                            ])                     
                        .draw()
                    .node();
                }*/
            })
            .fail(function() {
                console.log("error");
            });
}




function createDropdowns(table, columns, type) {
    var select
    if(type == "publicacion")
        select = $('<select class="form-control" id="public" onchange="ShowSelected();"><option value="">Seleccione una opcion</option><option value="SI">SI</option><option value="NO">NO</option></select>')
    else if(type == "contenido")
        select = $('<select class="form-control" id="contenido" onchange="ShowSelected();"><option value="">Seleccione una opcion</option><option value="RECHAZADO">RECHAZADO</option><option value="ESPERANDO">ESPERANDO</option><option value="POR VERIFICAR">POR VERIFICAR</option><option value="SIN REVISION">SIN REVISION</option><option value="ACEPTADO">ACEPTADO</option></select>')
    else if(type == "statusEmpresa")
        select = $('<select class="form-control" id="statusEmpresa" onchange="ShowSelected();"><option value="">Seleccione una opcion</option><option value="SI">SI</option><option value="ESPERANDO">ESPERANDO</option><option value="POR VERIFICAR">POR VERIFICAR</option><option value="PENDIENTE">PENDIENTE</option><option value="SIN REVISION">SIN REVISION</option><option value="NO VERIFICADA">NO VERIFICADA</option></select>')
    else if(type == "statusCorreo")
        select = $('<select class="form-control" id="statusCorreo" onchange="ShowSelected();"><option value="">Seleccione una opcion</option><option value="SI">SI</option><option value="NO">NO</option><option value="PENDIENTE">PENDIENTE</option></select>')
    else if(type == "evaluacion")
        select = $('<select class="form-control" id="evaluac" onchange="ShowSelected();"><option value="">Seleccione una opcion</option><option value="NORMAL">NORMAL</option><option value="POR CONTROLAR">POR CONTROLAR</option><option value="INVALIDA">INVALIDA</option></select>')

    return select;
         
  }

