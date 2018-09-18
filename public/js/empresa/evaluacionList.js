function createFilter(table, columns) {
  var input = $('<input type="text"/>').on("keyup", function() {
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


$(document).ready(function() {
    $('#listEvaluacion').DataTable({
    	"processing": true,
    	"searching": false,
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


    var filter1 = createFilter(table, [0, 1]);
    var filter2 = createFilter(table, [2]);

    filter1.appendTo(".prueba");
    filter2.appendTo(".prueba");
});
