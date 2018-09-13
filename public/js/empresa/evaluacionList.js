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
});
