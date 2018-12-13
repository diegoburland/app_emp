$(document).ready(function() {

    $('#listEmpresa').DataTable({
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

    var table = $('#listEmpresa').DataTable();
     
     $('#listEmpresa tbody').on(function () {
        var data = table.row( this ).data();
        window.location.href = "/empresa_editar/"+data[0];
   } );

    var filter1 = createInput(table, [2], "empresa");
    var filter2 = createInput(table, [3], "nombre");
    var filter3 = createDropdowns(table, [8], "statusEmpresa");
    var filter4 = createDropdowns(table, [10], "clasificacion");
    var filter5 = createDropdowns(table, [11], "sector");
    var filter6 = createDropdowns(table, [9], "promedio");
    var filter7 = createDropdowns(table, [4], "totaleval");
    var filter8 = createDropdowns(table, [5], "totalemple");
    var filter9 = createDropdowns(table, [6], "totalexemple"); 
    var filter10 = createDropdowns(table, [6], "totalpracticas");

    filter1.appendTo(".empresa");
    filter2.appendTo(".nombre");
    filter3.appendTo(".statusEmpresa");
    filter4.appendTo(".clasificacion");
    filter5.appendTo(".sector");  
    filter6.appendTo(".promedio");
    filter7.appendTo(".totaleval");
    filter8.appendTo(".totalemple");
    filter9.appendTo(".totalexemple");
    filter10.appendTo(".totalpracticas");

getSectoresEconomicos();
getClasificacion();
   
});

    var empresa;
    var nombre;
    var statusEmpresa;
    var clasificacion;
    var sector_economico;
    var promedio;
    var totaleval;
    var totalemple;
    var totalexemple;
    var totalpracticas;

function createInput(table, columns, id) {
  var input = $('<input class="form-control" id="'+id+'" type="text"/ style="width: 120%;">').on("keypress", function() {
    table.draw();
    
  });

  return input;
}

function actionFilter(){
    empresa = document.getElementById('empresa').value;
    nombre = document.getElementById('nombre').value;
    statusEmpresa = document.getElementById('statusEmpresa').value;
    clasificacion = document.getElementById('clasificacion').value;
    sector_economico = document.getElementById('sector').value;
    promedio = document.getElementById('promedio').value;
    totaleval = document.getElementById('totaleval').value;
    totalemple = document.getElementById('totalemple').value; 
    totalexemple = document.getElementById('totalexemple').value; 
    totalpracticas = document.getElementById('totalpracticas').value; 

    filterEval(sector_economico, totalemple, statusEmpresa, promedio, clasificacion, empresa, nombre, totaleval, totalexemple, totalpracticas)
}

function filterEval(sector_economico, totalemple, statusEmpresa, promedio, clasificacion, empresa, nombre, totaleval, totalexemple, totalpracticas){
   
    var CSRF_TOKEN = $('meta[id="csrf-token"]').attr('content');
    $.ajax({
        url: 'filter_empresa',
        type: 'POST',
        data: {_method: 'POST', _token: CSRF_TOKEN, sector_economico:sector_economico, totalemple:totalemple, statusEmpresa: statusEmpresa, 
                promedio: promedio, clasificacion: clasificacion, empr: empresa, nombre: nombre, totaleval: totaleval, 
                totalexemple: totalexemple, totalpracticas: totalpracticas},
      
    })
    .done(function(response)    
    {
         $('#prueba').empty().append($(response)); 

            })
            .fail(function() {
                console.log("error");
            });
}

function getSectoresEconomicos(){
   $.ajax({
        url: 'sectores',
        success: function(respuesta) {
             listSectores = respuesta.data;
             addOptions("sector", listSectores);
             
        },
        error: function() {
            console.log("No se ha podido obtener la información");
        }
    });  
   
}

function getClasificacion(){
   $.ajax({
        url: 'clasificacion',
        success: function(respuesta) {
            listClasificacion = respuesta.data;
            addOptions("clasificacion", listClasificacion);
            
        },
        error: function() {
            console.log("No se ha podido obtener la información");
        }
    });
}

// Rutina para agregar opciones a un <select>
function addOptions(domElement, array) {
 var select = document.getElementById(domElement);
 for (value in array) {;
   var option = document.createElement("option");
   if(domElement == "sector")
        option.text = array[value].sector;
   else if(domElement == "clasificacion")
        option.text = array[value].clasificacion;
   select.add(option);
 }
}

function createDropdowns(table, columns, type) {
    var select
    if(type == "sector")
        select = $('<select class="form-control" id="sector" ><option value="">Seleccione una opcion</option></select>')
    else if(type == "promedio" || type == "totaleval" || type == "totalemple" || type == "totalexemple" || type == "totalpracticas")  
        select = $('<select class="form-control" id="'+type+'" ><option value="">Seleccione una opcion</option><option value="ASC">ASCENDENTE</option><option value="DESC">DESCENDENTE</option></select>')
    else if(type == "clasificacion")
        select = $('<select class="form-control" id="clasificacion" ><option value="">Seleccione una opcion</option></select>')
    else if(type == "statusEmpresa")
        select = $('<select class="form-control" id="statusEmpresa" ><option value="">Seleccione una opcion</option><option value="SI">VERIFICADA</option><option value="ESPERANDO">ESPERANDO</option><option value="POR VERIFICAR">POR VERIFICAR</option><option value="PENDIENTE">PENDIENTE</option><option value="SIN REVISION">SIN REVISION</option><option value="RECHAZADA">RECHAZADA</option></select>')

    return select;
         
  }

