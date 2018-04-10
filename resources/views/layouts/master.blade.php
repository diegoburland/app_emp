<html>
    <head>
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="/css/app.css" rel="stylesheet" type="text/css"/>    
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">   

        
    </head>
    <body>
        @section('sidebar')

          <nav class="navbar navbar-expand-lg bg-dark navbar-dark">

            <a href="." class="navbar-brand">
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
    
    
    
        @section('head')

        @show
</html>