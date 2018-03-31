<html>
    <head>
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="/js/app.js"></script>
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
                <a class="nav-link disabled" href="#">Crear Categoria</a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" href="#">Lista Categorias</a>
              </li>
            </ul>
        @show

        <div class="container">
            @yield('content')
        </div>
    </body>
</html>