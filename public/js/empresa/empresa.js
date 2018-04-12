$(function() {

  $("#ciudad").autocomplete({
      source: "/api/v1/buscar_ubicacion",
      minLength: 2,
      select: function(event, ui) {
      $('#ciudad').val(ui.item.value);
      $('#ciudad_id').val(ui.item.id);
    }       
  });

});