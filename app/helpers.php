<?php 
// FUNCION PARA IMPRIMIR LA CANTIDAD DE ESTRELLAS PEQUEÑAS SEGUN EL PROMEDIO
function get_rating($rating){
    if($rating <= 0.5){
        $stars = 
        '<i class="fas fa-star-half-alt stars-hero-s" data-rating="1"></i>'.
        '<i class="far fa-star stars-hero-s" data-rating="2"></i>'.
        '<i class="far fa-star stars-hero-s" data-rating="3"></i>'.
        '<i class="far fa-star stars-hero-s" data-rating="4"></i>'.
        '<i class="far fa-star stars-hero-s" data-rating="5"></i>';

        echo $stars;
    }else if($rating <= 1){
        $stars = 
        '<i class="fas fa-star stars-hero-s" data-rating="1"></i>'.
        '<i class="far fa-star stars-hero-s" data-rating="2"></i>'.
        '<i class="far fa-star stars-hero-s" data-rating="3"></i>'.
        '<i class="far fa-star stars-hero-s" data-rating="4"></i>'.
        '<i class="far fa-star stars-hero-s" data-rating="5"></i>';

        echo $stars;
    }else if($rating <= 1.5){
        $stars = 
        '<i class="fas fa-star stars-hero-s" data-rating="1"></i>'.
        '<i class="fas fa-star-half-alt stars-hero-s" data-rating="2"></i>'.
        '<i class="far fa-star stars-hero-s" data-rating="3"></i>'.
        '<i class="far fa-star stars-hero-s" data-rating="4"></i>'.
        '<i class="far fa-star stars-hero-s" data-rating="5"></i>';

        echo $stars;
    }else if($rating <= 2){
        $stars = 
        '<i class="fas fa-star stars-hero-s" data-rating="1"></i>'.
        '<i class="fas fa-star stars-hero-s" data-rating="2"></i>'.
        '<i class="far fa-star stars-hero-s" data-rating="3"></i>'.
        '<i class="far fa-star stars-hero-s" data-rating="4"></i>'.
        '<i class="far fa-star stars-hero-s" data-rating="5"></i>';

        echo $stars;
    }else if($rating <= 2.5){
        $stars = 
        '<i class="fas fa-star stars-hero-s" data-rating="1"></i>'.
        '<i class="fas fa-star stars-hero-s" data-rating="2"></i>'.
        '<i class="fas fa-star-half-alt stars-hero-s" data-rating="3"></i>'.
        '<i class="far fa-star stars-hero-s" data-rating="4"></i>'.
        '<i class="far fa-star stars-hero-s" data-rating="5"></i>';

        echo $stars;
    }else if($rating <= 3){
        $stars = 
        '<i class="fas fa-star stars-hero-s" data-rating="1"></i>'.
        '<i class="fas fa-star stars-hero-s" data-rating="2"></i>'.
        '<i class="fas fa-star stars-hero-s" data-rating="3"></i>'.
        '<i class="far fa-star stars-hero-s" data-rating="4"></i>'.
        '<i class="far fa-star stars-hero-s" data-rating="5"></i>';

        echo $stars;
    }else if($rating <= 3.5){
        $stars = 
        '<i class="fas fa-star stars-hero-s" data-rating="1"></i>'.
        '<i class="fas fa-star stars-hero-s" data-rating="2"></i>'.
        '<i class="fas fa-star stars-hero-s" data-rating="3"></i>'.
        '<i class="fas fa-star-half-alt stars-hero-s" data-rating="4"></i>'.
        '<i class="far fa-star stars-hero-s" data-rating="5"></i>';

        echo $stars;
    }else if($rating <= 4){
        $stars = 
        '<i class="fas fa-star stars-hero-s" data-rating="1"></i>'.
        '<i class="fas fa-star stars-hero-s" data-rating="2"></i>'.
        '<i class="fas fa-star stars-hero-s" data-rating="3"></i>'.
        '<i class="fas fa-star stars-hero-s" data-rating="4"></i>'.
        '<i class="far fa-star stars-hero-s" data-rating="5"></i>';

        echo $stars;
    }else if($rating <= 4.5){
        $stars = 
        '<i class="fas fa-star stars-hero-s" data-rating="1"></i>'.
        '<i class="fas fa-star stars-hero-s" data-rating="2"></i>'.
        '<i class="fas fa-star stars-hero-s" data-rating="3"></i>'.
        '<i class="fas fa-star stars-hero-s" data-rating="4"></i>'.
        '<i class="fas fa-star-half-alt stars-hero-s" data-rating="5"></i>';

        echo $stars;
    }else if($rating <= 5){
        $stars = 
        '<i class="fas fa-star stars-hero-s" data-rating="1"></i>'.
        '<i class="fas fa-star stars-hero-s" data-rating="2"></i>'.
        '<i class="fas fa-star stars-hero-s" data-rating="3"></i>'.
        '<i class="fas fa-star stars-hero-s" data-rating="4"></i>'.
        '<i class="fas fa-star stars-hero-s" data-rating="5"></i>';

        echo $stars;
    }

}


// FUNCION PARA IMPRIMIR LA CANTIDAD DE ESTRELLAS GRANDES SEGUN EL PROMEDIO
function get_rating_main($rating){
    if($rating <= 0.5){
        $stars = 
        '<i class="fas fa-star-half-alt stars-hero-s" data-rating="1"></i>'.
        '<i class="far fa-star stars-hero" data-rating="2"></i>'.
        '<i class="far fa-star stars-hero" data-rating="3"></i>'.
        '<i class="far fa-star stars-hero" data-rating="4"></i>'.
        '<i class="far fa-star stars-hero" data-rating="5"></i>';

        echo $stars;
    }else if($rating <= 1){
        $stars = 
        '<i class="fas fa-star stars-hero" data-rating="1"></i>'.
        '<i class="far fa-star stars-hero" data-rating="2"></i>'.
        '<i class="far fa-star stars-hero" data-rating="3"></i>'.
        '<i class="far fa-star stars-hero" data-rating="4"></i>'.
        '<i class="far fa-star stars-hero" data-rating="5"></i>';

        echo $stars;
    }else if($rating <= 1.5){
        $stars = 
        '<i class="fas fa-star stars-hero" data-rating="1"></i>'.
        '<i class="fas fa-star-half-alt stars-hero" data-rating="2"></i>'.
        '<i class="far fa-star stars-hero" data-rating="3"></i>'.
        '<i class="far fa-star stars-hero" data-rating="4"></i>'.
        '<i class="far fa-star stars-hero" data-rating="5"></i>';

        echo $stars;
    }else if($rating <= 2){
        $stars = 
        '<i class="fas fa-star stars-hero" data-rating="1"></i>'.
        '<i class="fas fa-star stars-hero" data-rating="2"></i>'.
        '<i class="far fa-star stars-hero" data-rating="3"></i>'.
        '<i class="far fa-star stars-hero" data-rating="4"></i>'.
        '<i class="far fa-star stars-hero" data-rating="5"></i>';

        echo $stars;
    }else if($rating <= 2.5){
        $stars = 
        '<i class="fas fa-star stars-hero" data-rating="1"></i>'.
        '<i class="fas fa-star stars-hero" data-rating="2"></i>'.
        '<i class="fas fa-star-half-alt stars-hero" data-rating="3"></i>'.
        '<i class="far fa-star stars-hero" data-rating="4"></i>'.
        '<i class="far fa-star stars-hero" data-rating="5"></i>';

        echo $stars;
    }else if($rating <= 3){
        $stars = 
        '<i class="fas fa-star stars-hero" data-rating="1"></i>'.
        '<i class="fas fa-star stars-hero" data-rating="2"></i>'.
        '<i class="fas fa-star stars-hero" data-rating="3"></i>'.
        '<i class="far fa-star stars-hero" data-rating="4"></i>'.
        '<i class="far fa-star stars-hero" data-rating="5"></i>';

        echo $stars;
    }else if($rating <= 3.5){
        $stars = 
        '<i class="fas fa-star stars-hero" data-rating="1"></i>'.
        '<i class="fas fa-star stars-hero" data-rating="2"></i>'.
        '<i class="fas fa-star stars-hero" data-rating="3"></i>'.
        '<i class="fas fa-star-half-alt stars-hero" data-rating="4"></i>'.
        '<i class="far fa-star stars-hero" data-rating="5"></i>';

        echo $stars;
    }else if($rating <= 4){
        $stars = 
        '<i class="fas fa-star stars-hero" data-rating="1"></i>'.
        '<i class="fas fa-star stars-hero" data-rating="2"></i>'.
        '<i class="fas fa-star stars-hero" data-rating="3"></i>'.
        '<i class="fas fa-star stars-hero" data-rating="4"></i>'.
        '<i class="far fa-star stars-hero" data-rating="5"></i>';

        echo $stars;
    }else if($rating <= 4.5){
        $stars = 
        '<i class="fas fa-star stars-hero" data-rating="1"></i>'.
        '<i class="fas fa-star stars-hero" data-rating="2"></i>'.
        '<i class="fas fa-star stars-hero" data-rating="3"></i>'.
        '<i class="fas fa-star stars-hero" data-rating="4"></i>'.
        '<i class="fas fa-star-half-alt stars-hero" data-rating="5"></i>';

        echo $stars;
    }else if($rating <= 5){
        $stars = 
        '<i class="fas fa-star stars-hero" data-rating="1"></i>'.
        '<i class="fas fa-star stars-hero" data-rating="2"></i>'.
        '<i class="fas fa-star stars-hero" data-rating="3"></i>'.
        '<i class="fas fa-star stars-hero" data-rating="4"></i>'.
        '<i class="fas fa-star stars-hero" data-rating="5"></i>';

        echo $stars;
    }

}
