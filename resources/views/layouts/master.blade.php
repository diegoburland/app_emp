<html>
    <head>
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--link href="/css/app.css" rel="stylesheet" type="text/css"/-->    
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>   
        @section('head')

        @show
        
    </head>
    <body>
        @section('sidebar')

          <nav class="navbar navbar-expand-lg bg-dark navbar-dark">

            <a href="/" class="navbar-brand">
              <b><span  class="text-light"><span class="fa fa-eercast"></span>cu</span><span class="text-warning">Pasion</span></b>                
            </a>

              <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="collapsibleNavbar">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="/empresa_new">Crear Empresa</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/empresa_list">Lista de Empresas</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled" href="#">Crear Sector</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled" href="#">Crear Categoria</a>
                </li>
              </ul>    
                      
            </div>

            <form class="form-inline my-2 my-lg-0">
              <a href="/buscar_empresa" class="text-light mr-sm-2"><span class="fa fa-search"></span> Buscar</a>
              <button class="btn btn-outline-warning" type="button" onclick="window.location.href='/empresa_evaluar'">Evaluar Empresa</button>                   
            </form>     

          </nav>  
        @show

        <div class="container">
            @yield('content')
        </div>
    </body>        
</html>