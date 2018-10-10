$(document).ready(function() {
    $('#listEvaluacion').DataTable({
        "searching": true,
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
        ],
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
        }
        
    });

    var table = $('#listEvaluacion').DataTable();
     
     $('#listEvaluacion tbody').on(function () {
        var data = table.row( this ).data();
        window.location.href = "/empresa_editar/"+data[0];
   } );

    var filter1 = createInput(table, [2]);
    var filter2 = createInput(table, [3]);
    var filter3 = createInput(table, [6]);
    var filter4 = createInput(table, [7]);
    var filter5 = createDropdowns(table, [8], "evaluacion");
    var filter6 = createDropdowns(table, [9], "correo");
    var filter7 = createDropdowns(table, [10], "empresa");
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

function createInput(table, columns) {
  var input = $('<input class="form-control" type="text"/ style="width: 120%;">').on("keyup", function() {
    table.draw();
  });


  $.fn.dataTable.ext.search.push(function(
    settings,
    searchData,
    index,
    rowData,
    counter
  ) {
    var val = input.val().toLowerCase();

    for (var i = 0, ien = columns.length; i < ien; i++) {
      if (searchData[columns[i]].toLowerCase().indexOf(val) !== -1) {
        return true;
      }
    }

    return false;
  });

  return input;
}

function createDropdowns(table, columns, type) {
    var select
    if(type == "publicacion")
        select = $('<select class="form-control" id="public"><option value="">Seleccione una opcion</option><option value="SI">SI</option><option value="NO">NO</option></select>')
    else if(type == "contenido")
        select = $('<select class="form-control" id="contenido"><option value="">Seleccione una opcion</option><option value="RECHAZADO">RECHAZADO</option><option value="ESPERANDO">ESPERANDO</option><option value="POR VERIFICAR">POR VERIFICAR</option><option value="SIN REVISION">SIN REVISION</option><option value="ACEPTADO">ACEPTADO</option></select>')
    else if(type == "empresa")
        select = $('<select class="form-control" id="empresa"><option value="">Seleccione una opcion</option><option value="SI">SI</option><option value="ESPERANDO">ESPERANDO</option><option value="POR VERIFICAR">POR VERIFICAR</option><option value="PENDIENTE">PENDIENTE</option><option value="SIN REVISION">SIN REVISION</option><option value="NO VERIFICADA">NO VERIFICADA</option></select>')
    else if(type == "correo")
        select = $('<select class="form-control" id="correo"><option value="">Seleccione una opcion</option><option value="SI">SI</option><option value="NO">NO</option><option value="PENDIENTE">PENDIENTE</option></select>')
    else if(type == "evaluacion")
        select = $('<select class="form-control" id="evaluac"><option value="">Seleccione una opcion</option><option value="NORMAL">NORMAL</option><option value="POR CONTROLAR">POR CONTROLAR</option><option value="INVALIDA">INVALIDA</option></select>')

        select.on( 'change', function () {
            var val = select[0].value;
            table.draw();   
        });


    $.fn.dataTable.ext.search.push(function(
    settings,
    searchData,
    index,
    rowData,
    counter
  ) {
   var val = select[0].value;

    for (var i = 0, ien = columns.length; i < ien; i++) {
      if (searchData[columns[i]].indexOf(val) !== -1) {
        return true;
      }
    }

    return false;
  });

    return select;
 
         
  }

