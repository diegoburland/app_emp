$(document).ready(function() {
    $('#listEvaluacion').DataTable({
    	"processing": true,
    	"searching": true,
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
     
    $('#listEvaluacion tbody').on('click', 'tr', function () {
        var data = table.row( this ).data();
        window.location.href = "/empresa_editar/"+data[0];
    } );


    var filter1 = createFilter(table, [1]);
    var filter2 = createFilter(table, [2]);
    var filter3 = createFilter(table, [5]);
    var filter4 = createFilter(table, [6]);
    var filter5 = createFilter(table, [7]);
    var filter6 = createFilter(table, [8]);
    var filter7 = createFilter(table, [9]);
    var filter8 = createFilter(table, [10]);
    var filter9 = createFilter(table, [11]);

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

function createFilter(table, columns) {
  var input = $('<input type="text"/ style="width: 120%;">').on("keyup", function() {
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
