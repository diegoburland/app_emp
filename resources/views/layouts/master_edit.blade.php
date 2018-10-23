<html>
    <head>
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="/css/estilos_app.css?v={{ time() }}" rel="stylesheet" type="text/css"> 
        <link href="/css/edit_evaluacion.css" rel="stylesheet" type="text/css"> 


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-127067149-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
          gtag('config', 'UA-127067149-1');
        </script>
        
        <script type="text/javascript">
            window.smartlook||(function(d) {
            var o=smartlook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];
            var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
            c.charset='utf-8';c.src='https://rec.smartlook.com/recorder.js';h.appendChild(c);
            })(document);
            smartlook('init', 'f2519ee6854e705a7666bcb2d045b22e207ed679');
        </script>
               

        @section('head')

        @show
        
    </head>
    <body>

        <nav class="navbar navbar-expand-lg">

          <a href="https://www.vidaandwork.com" class="navbar-brand">
            <img src="/img/transparente1-k.png" width="180px">
            <!--h1 class="font-italic"><b><span  class="text-light"><span class="fa fa-eercast"></span>cu</span><span class="text-warning">Pasión</span></b></h1>-->
          </a>

            <!-- Toggler/collapsibe Button -->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
         
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
              <ul class="navbar-nav">
                 @if(session('tipo') == 'admin')
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Administración
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/empresa_new">Crear Empresa</a>
                    <a class="dropdown-item" href="/empresa_list">Lista de Empresas</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Crear Sector</a>
                    <a class="dropdown-item" href="#">Crear Categoria</a>
                    <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="/evaluacion_list">Lista de Evaluaciones</a>
                  </div>
                </li>
                 @endif
              </ul> 
            
                    
          </div>

          <form class="form-inline my-2 my-lg-0">
             <button type="button" class="btn btn-link text-warning" onclick="window.location.href='/login'"><b>MI CUENTA</b></button>
            <!--button type="button" class="btn btn-link btn-sm text-light" onclick="window.location.href='/buscar_empresa'"><span class="fa fa-search"></span> <b>BUSCAR</b></button-->
            <button class="btn btn-warning " type="button" onclick="window.location.href='/empresa_evaluar'"><b>EVALUACIÓN ANÓNIMA</b></button>                   
          </form>     

        </nav>  

        <div class="container-fluid">
            @yield('content')
        </div>

        <div class="footer">

          <div class="p-1 text-center">
              <a  href="javascript:void(0)" class="navbar-brand retornar">
            <img src="/img/transparente1-k.png" width="180px">
            <!--h1 class="font-italic"><b><span  class="text-light"><span class="fa fa-eercast"></span>cu</span><span class="text-warning">Pasión</span></b></h1-->
            </a>
          </div>                  

          <!--div class="text-center"> 
            <div style="display: inline-flex;">
              <div class="mr-3"><h5  class="font-italic">¿Quienes somos?</h4></div>
              <div class="mr-3"><h5  class="font-italic">Preguntas frecuentes</h4></div>
              <div class="mr-3"><h5  class="font-italic">Contacto</h4></div>
            </div>
          </div>
          
          
            <div class="text-left font-italic m-1">Hecho en <a href="https://es.wikipedia.org/wiki/Colombia"><img src="/img/co.png" alt="Colombia"></a></div-->  
          
        </div>
    </body>        
</html>
