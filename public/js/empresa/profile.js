$(function() {
	

	var $star_rating = $('.star-rating');
	$star_rating.each(function() {
		//console.log($(this).attr('class').split(' ')[1]);
		evaluar($(this).attr('class').split(' ')[1]);
	});
	
});


function evaluar(item){


	var $star_rating = $('.' + item + ' .fa');
	$star_rating.each(function() {
		if (parseInt($($star_rating).siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
	      return $(this).removeClass('fa-star-o').addClass('fa-star');
	    } else {
	      return $(this).removeClass('fa-star').addClass('fa-star-o');
	    }
    });
}