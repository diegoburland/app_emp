<html>
    <head>
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="/css/app.css" rel="stylesheet" type="text/css"/>        
    </head>
    <body>
        @section('sidebar')
            <ul class="nav">
              <li class="nav-item">
                <a class="nav-link active" href="/empresa_new">Crear Empresa</a>
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
        @show

        <div class="container">
            @yield('content')
        </div>
    </body>
    
    <script type="text/javascript" src="/js/app.js"></script>
        @section('head')
        @show
</html>