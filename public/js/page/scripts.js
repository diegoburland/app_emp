
$(document).ready(function() {
    src = '/searchajax';
     $("#search_text").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: src,
                dataType: "json",
                data: {
                    term : request.term
                },
                success: function(data) {
                    response(data);
                    console.log(data);
                }
            });
        },
        minLength: 1,
       
    });
});