@extends('page.landing')

@section('title', 'VidAndWork.com')

@section('navbar')
<nav class="hero-navbar">
  <div class="hero-navbar-box">
    <div class="hero-navbar-box-one">
      <div class="hnbo-box ">
        <img class="img-fluid" src="img/transparente1-k.png" alt="">
      </div>
    </div>
    <div class="hero-navbar-box-two">
      <div class="hnbt-box">

        <div class="hnbt-box-one">
          <a href="" class="dots-3">
            <i class="fas fa-circle"></i><i class="fas fa-circle"></i><i class="fas fa-circle"></i>
          </a>
          <button class="hamburger hamburger--spin" type="button">
            <span class="hamburger-box">
              <span class="hamburger-inner"></span>
            </span>
          </button>
        </div>
        <div class="hnbt-box-two">
          <a class="btn-vida btn-vida-primary" href="">Evaluar Anonimamente</a>
        </div>
      </div>
    </div>
  </div>
</nav>
<div class="main-container">
  <div class="hero-search">
    <div class="hero-search-box">
      <div class="hsb-one">
        <h1>Conoce las empresas por dentro</h1>
      </div>
      <div class="hsb-two">
        <div class="hsb-two-box">
          <div class="hsb-two-box-sticky">
          <div class="box-sticky-one">
            <form action="http://localhost:8000/autocomplete" method="post" id="aa">
              <input type="search" placeholder="Busca una empresa" id="search_text" name="search_text">
                <!-- {{ csrf_field() }} -->
              </div>
              <div class="box-sticky-two">
                <i class="fas fa-angle-down"></i>
                <select name="" id="">
                  <option value="" disabled selected>Ubicación <img src="http://www.clker.com/cliparts/y/m/X/o/s/R/down-arrow-circle-md.png" width="20" height="20" alt=""></option>
                  <option value="">Medellín</option>
                </select>
              </div>
              <div class="box-sticky-three">
                <button class="btn-buscar btn-vida-primary">Buscar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="hsb-three">
        <div class="hsb-three-box">
          <h3>En Vida and Work aspiramos a ayudarte a encontrar la mejor empresa u organización para ti.
              En el futuro podrás conocer aquí lo que los mismos empleados dicen sobre su empresa y las condiciones laborales.</h3>
        </div>
      </div>
    </div>
  </div>
  <footer class="footer-main">
    <div class="footer-box">
      <div class="footer-box-one">
        <div class="fbo-icon facebook">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
        </div>
        <div class="fbo-icon instagram">
          <a href="#"><i class="fab fa-twitter"></i></a>
        </div>
        <div class="fbo-icon pinterest">
          <a href="#"><i class="fab fa-pinterest-p"></i></a>
        </div>
      </div>
      <div class="footer-box-two">
        <span class="span-mobile">Copyright 2017 © Vida and Work Todos los Derechos Reservados.</span>
        <span class="span-desktop">Copyright 2017 © Vida and Work | Todos los Derechos Reservados</span>
      </div>
    </div>
  </footer>
</div>
<script>
  
</script>

@endsection

@section('content')


@endsection