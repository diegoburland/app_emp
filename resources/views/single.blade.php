@extends('page.landing')

@section('title', 'VidaAndWork.com')

@section('navbar')
<nav class="hero-navbar single">
  <div class="hero-navbar-box">
    <div class="hero-navbar-box-one">
      <div class="hnbo-box ">
        <img class="img-fluid" src="/img/transparente1-k.png" alt="">
      </div>
    </div>
    <div class="hero-navbar-box-search">
      <div class="hsb-two-box-sticky sticky-single">
        <div class="box-sticky-one">
          <input type="search" placeholder="Busca una empresa" id="busqueda">
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
        <div class="hnbt-box-one-search">
        </div>
        <div class="hnbt-box-two">
          <a class="btn-vida btn-vida-primary" href="">Evaluar Anonimamente</a>
        </div>
      </div>
    </div>
  </div>
</nav>

@endsection
@section('content')
  <div class="hero-breadcrumb">
    <p></p>
  </div>
  <div id="content-single-area" class="content-single-area">
  <div class="content-profile-hero line-hero">
  <div class="profile-img-box line-hero">
    <img class="profile-img-box-img" src="/img/SinEvaluaciones-02.jpg" alt="Imagen de portada">
  </div>
  <div class="profile-content-box">
    <div class="profile-content-one">
      <p>Conoce como trabajar para</p>
    </div>
    <div class="profile-content-two title-single-box">
      <h1>{{$empresa->razon_social}}</h1>
    </div>
    <div class="profile-content-two">
      <small>{{$empresa->sector_economico}}</small>
    </div>
    <div class="profile-content-three">
      <p><span>5.226</span> visitas</p>
    </div>
    <div class="profile-content-four">
      <ul class="profile-list-details">
        <li><p>{{$empresa->ciudad->nombre}}</p></li>
        @if($empresa->web)
        <li><p>{{$empresa->web}}</p></li>
        @endif
        <li><p title="El tamaño de la empresa es {{$tamano_empresa}}">{{$tamano_empresa}}</p></li>
        @if($empresa->total_empleados)
        <li><p>{{$empresa->total_empleados}}</p></li>
        @endif
        <li><p>{{date('d-m-Y', strtotime($empresa->fecha_fun))}}</p></li>
      </ul>
    </div>
    
  </div>
</div>
<div class="content-area-hero">
  <div class="content-area-hero-box">
    <div class="content-area-one">
      <div class="content-area-one-box">
        <img src="/img/SinEvaluaciones-01.jpg" alt="">
      </div>
    </div>
    <div class="content-area-two">
      <div class="content-area-two-box">
        <span class="item-tag">
          Empresa transparente
        </span>
        <span class="item-tag">
          Empresa abierta
        </span>
      </div>
    </div>
    <div class="content-area-three">
      <div class="content-area-three-box">
        <div class="content-area-three-box-one hero-average line-hero">
          <div class="hero-average-box flex">
            <h4>Promedio de esta empresa</h4>
            <span class="number-average empresa-average">{{$total_puntaje}}</span>
            <div class="rating-box">
              <div class="rating-stars-one">
                {{get_rating_main($total_puntaje)}}
              </div>
              <div class="rating-stars-two">Basado en {{$cantidad_evaluaciones}} evaluaciones</div>
            </div>
            <div class="rating-indicator">
            @if($total_puntaje >= $total_promedio)
              <img src="/img/Barras-01.png" alt="" title="Por arriba del promedio">
            @elseif($total_puntaje < $total_promedio)
              <img src="/img/Barras-02.png" alt="" title="Por debajo del promedio">
            @endif
            </div>
            <h5>Promedio del sector</h5>
            <span class="number-average sector-average">{{$total_promedio}}</span>
            <div class="rating-box">
              <div class="rating-stars-one">
                {{get_rating_main($total_promedio)}}
              </div>
              <div class="rating-stars-two">Basado en {{$total_evaluaciones}} evaluaciones</div>
            </div>
          </div>
        </div>
        <div class="content-area-three-box-two hero-recommend line-hero">
          <div class="percentage-rating">
            <h4>{{$recomendacion}}%</h4>
            <p>Recomiendan trabajar aquí</p>
          </div>
          <div class="percentage-rating-bar">
            <div class="title-bar">
              <h5>Distribución de la evalucion</h5>
            </div>
            <div class="content-bar">
              <div class="item-bar">
                <div class="item-bar-star">
                  <span class="count">5</span>
                  <i class="fas fa-star stars-hero-s"></i>
                </div>
                <div class="item-bar-bar">
                  <div class="progress">
                    <div class="progress-bar bg-green" role="progressbar" style="width: {{$total_puntaje_fraccionado['cinco']}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
                <div class="item-bar-per">{{$total_puntaje_fraccionado['cinco']}}%</div>
              </div>
              <div class="item-bar">
                <div class="item-bar-star">
                  <span class="count">4</span>
                  <i class="fas fa-star stars-hero-s"></i>
                </div>
                <div class="item-bar-bar">
                  <div class="progress">
                    <div class="progress-bar bg-green-light" role="progressbar" style="width: {{$total_puntaje_fraccionado['cuatro']}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
                <div class="item-bar-per">{{$total_puntaje_fraccionado['cuatro']}}%</div>
              </div>
              <div class="item-bar">
                <div class="item-bar-star">
                  <span class="count">3</span>
                  <i class="fas fa-star stars-hero-s"></i>
                </div>
                <div class="item-bar-bar">
                  <div class="progress">
                    <div class="progress-bar bg-yellow" role="progressbar" style="width: {{$total_puntaje_fraccionado['tres']}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
                <div class="item-bar-per">{{$total_puntaje_fraccionado['tres']}}%</div>
              </div>
              <div class="item-bar">
                <div class="item-bar-star">
                  <span class="count">2</span>
                  <i class="fas fa-star stars-hero-s"></i>
                </div>
                <div class="item-bar-bar">
                  <div class="progress">
                    <div class="progress-bar bg-orange" role="progressbar" style="width: {{$total_puntaje_fraccionado['dos']}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
                <div class="item-bar-per">{{$total_puntaje_fraccionado['dos']}}%</div>
              </div>
              <div class="item-bar">
                <div class="item-bar-star">
                  <span class="count one-span">1</span>
                  <i class="fas fa-star stars-hero-s"></i>
                </div>
                <div class="item-bar-bar">
                  <div class="progress">
                    <div class="progress-bar bg-red" role="progressbar" style="width: {{$total_puntaje_fraccionado['uno']}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
                <div class="item-bar-per">{{$total_puntaje_fraccionado['uno']}}%</div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    <div class="content-area-four">
      <div class="content-area-four-box line-hero" height="300">
          <h4>Beneficios más comunes</h4>
          <div class="icons-commun">
            @foreach($benes as $key => $bene)
          <div class="icon-commun-box" data-toggle="tooltip" data-placement="top" title="{{$bene->nombre}}">
            <img src="/img/icons/{{$bene->url_img}}"  alt="">
            </div>
            @endforeach
          </div>
      </div>
    </div>
    <div class="content-area-five">
      <div class="content-area-five-box">
        <div class="content-five-box-one">
          <button class="empleados eone active" index="datos-empleados" id="empleados">Empleados</button>
          <button class="empleados etwo"  index="datos-practicantes" id="practicantes">Practicantes</button>
        </div>
        <div class="content-five-box-two" id="employees">
          <div class="panel-ambiente line-hero">
              <div class="panel-ambiente-box flex column">
                <div class="ambiente-box-one datos-empleados">
                  @foreach ($categorias as $categoria)
                    @if($categoria->dimension == "empleado")
                    <div class="box-one-one">
                      <div class="title">
                        <h4>{{$categoria->nombre}}</h4>
                      </div>
                      <div class="content">
                        @foreach ($evaluacion_empleados as $key => $item)
                          @if($item->categoria_id == $categoria->id)
                            <div class="laboral-item">
                              @if($key == 0)
                                <p class="hiddenEmpleados" style="display: none">{{$item->cantidad}}</p>
                              @endif
                              <p class="name-item" title="{{$item->descripcion}}">{{$item->nombre}}</p>
                              <p class="stars-item">
                                {{get_rating($item->promedio)}}
                              </p>
                              <p class="number-item">
                              {{$item->promedio}}
                              </p>
                            </div>
                          @endif
                        @endforeach
                      </div>
                    </div>
                    @endif
                  @endforeach
                </div>
                <div class="ambiente-box-one datos-practicantes">
                  @foreach ($categorias as $categoria)
                    @if($categoria->dimension == "practicante")
                    <div class="box-one-one">
                      <div class="title diego">
                        <h4>{{$categoria->nombre}}</h4>
                      </div>
                      <div class="content">
                        @foreach ($evaluacion_practicantes as $keys => $item)
                          @if($item->categoria_id == $categoria->id)
                          <div class="laboral-item">
                            @if($keys == 18)

                            <p class="hiddenPracticantes" style="display: none">{{$item->cantidad}}</p>
                            @endif
                            <p class="name-item" title="{{$item->descripcion}}">{{$item->nombre}}</p>
                            <p class="stars-item">
                              {{get_rating($item->promedio)}}
                            </p>
                            <p class="number-item">
                            {{$item->promedio}}
                            </p>
                          </div>
                          @endif
                        @endforeach
                      </div>
                    </div>
                    @endif
                  @endforeach
                </div>
              </div>
          </div>
        </div>
        <div class="content-five-box-two" id="participants">
          <div class="panel-ambiente line-hero">
              <div class="panel-ambiente-box flex">
                <div class="ambiente-box-one">
                  <div class="box-one-one">
                    <div class="title">
                      <h4>Ambiente laboral experimento</h4>
                    </div>
                    <div class="content">
                      <div class="laboral-item">
                        <p class="name-item">Cultura organizacional</p>
                        <p class="stars-item">
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                        </p>
                        <p class="number-item">
                          4.2
                        </p>
                      </div>
                      <div class="laboral-item">
                        <p class="name-item">Cultura organizacional</p>
                        <p class="stars-item">
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                        </p>
                        <p class="number-item">
                          4.2
                        </p>
                      </div>
                      <div class="laboral-item">
                        <p class="name-item">Sentido de pertenencia</p>
                        <p class="stars-item">
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                        </p>
                        <p class="number-item">
                          4.2
                        </p>
                      </div>
                      <div class="laboral-item">
                        <p class="name-item">Reconocimiento</p>
                        <p class="stars-item">
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                        </p>
                        <p class="number-item">
                          4.2
                        </p>
                      </div>
                      <div class="laboral-item">
                        <p class="name-item">Relación entre compañeros</p>
                        <p class="stars-item">
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                        </p>
                        <p class="number-item">
                          4.2
                        </p>
                      </div>
                      <div class="laboral-item">
                        <p class="name-item">Liderazgo</p>
                        <p class="stars-item">
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                        </p>
                        <p class="number-item">
                          4.2
                        </p>
                      </div>
                      <div class="laboral-item">
                        <p class="name-item">Comunicación</p>
                        <p class="stars-item">
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                        </p>
                        <p class="number-item">
                          4.2
                        </p>
                      </div>
                      <div class="laboral-item">
                        <p class="name-item">Confianza</p>
                        <p class="stars-item">
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                        </p>
                        <p class="number-item">
                          4.2
                        </p>
                      </div>
                      <div class="laboral-item">
                        <p class="name-item">Trato equitativo</p>
                        <p class="stars-item">
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                        </p>
                        <p class="number-item">
                          4.2
                        </p>
                      </div>
                      <div class="laboral-item">
                        <p class="name-item">Responsabilidad social y ambiental</p>
                        <p class="stars-item">
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                        </p>
                        <p class="number-item">
                          4.2
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="box-one-two">
                    <div class="title">
                      <h4>Carrera profesional</h4>
                    </div>
                    <div class="content">
                      <div class="laboral-item">
                        <p class="name-item">Inducción al trabajo</p>
                        <p class="stars-item">
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                        </p>
                        <p class="number-item">
                          4.2
                        </p>
                      </div>
                      <div class="laboral-item">
                        <p class="name-item">Estabilidad laboral</p>
                        <p class="stars-item">
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                        </p>
                        <p class="number-item">
                          4.2
                        </p>
                      </div>
                      <div class="laboral-item">
                        <p class="name-item">Oportunidad de ascenso</p>
                        <p class="stars-item">
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                        </p>
                        <p class="number-item">
                          4.2
                        </p>
                      </div>
                      <div class="laboral-item">
                        <p class="name-item">Crecimiento profesional</p>
                        <p class="stars-item">
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                        </p>
                        <p class="number-item">
                          4.2
                        </p>
                      </div>
                      <div class="laboral-item">
                        <p class="name-item">Remuneración</p>
                        <p class="stars-item">
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                        </p>
                        <p class="number-item">
                          4.2
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="ambiente-box-two">
                  <div class="box-two-one">
                    <div class="title">
                      <h4>Ambiente laboral</h4>
                    </div>
                    <div class="content">
                      <div class="laboral-item">
                        <p class="name-item">Carga laboral</p>
                        <p class="stars-item">
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                        </p>
                        <p class="number-item">
                          4.2
                        </p>
                      </div>
                      <div class="laboral-item">
                        <p class="name-item">Tareas</p>
                        <p class="stars-item">
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                        </p>
                        <p class="number-item">
                          4.2
                        </p>
                      </div>
                      <div class="laboral-item">
                        <p class="name-item">Equilibrio trabajo - vida</p>
                        <p class="stars-item">
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                        </p>
                        <p class="number-item">
                          4.2
                        </p>
                      </div>
                      <div class="laboral-item">
                        <p class="name-item">Cond. del lugar de trabajo</p>
                        <p class="stars-item">
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                        </p>
                        <p class="number-item">
                          4.2
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="box-two-two">
                    <h4>Promedio de empleados</h4>
                    <div><span>3,9</span></div>
                    <div class="rating">
                      <i class="fas fa-star stars-hero-s"></i>
                      <i class="fas fa-star stars-hero-s"></i>
                      <i class="fas fa-star stars-hero-s"></i>
                      <i class="fas fa-star stars-hero-s"></i>
                      <i class="fas fa-star stars-hero-s"></i>
                      <i class="fas fa-star stars-hero-s"></i>
                    </div>
                    <div class="result-rating">
                      <p>
                        Basado en 896 evaluaciones
                      </p>
                    </div>

                    <div class="percentage"><span>50%</span></div>
                    <h4>Recomiendan trabajar aquí </h4>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>

    </div>
    <div class="content-area-six">
      <div class="content-area-six-box">
        <div class="content-six-box-one">
          <button class="empleados eone active" index="employees">42 Empleados</button>
          <button class="empleados etwo"  index="employees">12 Participantes</button>
        </div>
        <div class="content-six-box-two" id="employees">
          <div class="panel-ambiente line-hero">
              <div class="panel-ambiente-box flex">
                <div class="main-title">
                  <h4>Conoce los beneficios que brinda esta empresa</h4>
                  <div class="legend">
                    <p><span class="mr-1 AAA">A</span><strong>Aprobado por los empleados</strong></p>
                    <p><span class="mr-1"><img width="20" src="iconos/icons8-hoy-96.png" alt=""></span><strong>Aprobado por la empresa</strong></p>
                  </div>
                </div>
                <div class="main-content-box">
                  <div class="main-content-box-one">
                    <div class="main-content-box-one-one">
                      <div class="title">
                        <h4>Otros</h4>
                      </div>
                      <div class="content">
                        <ul>
                          <li><img class="mr-1" src="https://cdn181.picsart.com/229913690016202.png?r1024x1024" width="15" alt=""><img class="mr-1" src="https://img.icons8.com/metro/1600/idea.png" width="20" alt="">Accesibilidad víal y geográfica</li>
                          <li><img class="mr-1" src="https://cdn181.picsart.com/229913690016202.png?r1024x1024" width="15" alt=""><img class="mr-1" src="https://img.icons8.com/metro/1600/idea.png" width="20" alt="">Guardería</li>
                          <li><img class="mr-1" src="https://cdn181.picsart.com/229913690016202.png?r1024x1024" width="15" alt=""><img class="mr-1" src="https://img.icons8.com/metro/1600/idea.png" width="20" alt="">Parqueadero</li>
                          <li><img class="mr-1" src="https://cdn181.picsart.com/229913690016202.png?r1024x1024" width="15" alt=""><img class="mr-1" src="https://img.icons8.com/metro/1600/idea.png" width="20" alt="">Restaurante empresarial</li>
                          <li><img class="mr-1" src="https://cdn181.picsart.com/229913690016202.png?r1024x1024" width="15" alt=""><img class="mr-1" src="https://img.icons8.com/metro/1600/idea.png" width="20" alt="">Se permite mascotas</li>
                          <li><img class="mr-1" src="https://cdn181.picsart.com/229913690016202.png?r1024x1024" width="15" alt=""><img class="mr-1" src="https://img.icons8.com/metro/1600/idea.png" width="20" alt="">Transporte empresarial</li>
                        </ul>
                      </div>
                    </div>
                    <div class="main-content-box-one-two">
                      <div class="title">
                        <h4>Financieros & Descuentos</h4>
                      </div>
                      <div class="content">
                        <ul>
                          <li><img class="mr-1" src="https://cdn181.picsart.com/229913690016202.png?r1024x1024" width="15" alt=""><img class="mr-1" src="https://img.icons8.com/metro/1600/idea.png" width="20" alt="">Descuentos para empleados</li>
                          <li><img class="mr-1" src="https://cdn181.picsart.com/229913690016202.png?r1024x1024" width="15" alt=""><img class="mr-1" src="https://img.icons8.com/metro/1600/idea.png" width="20" alt="">Bonos</li>
                          <li><img class="mr-1" src="https://cdn181.picsart.com/229913690016202.png?r1024x1024" width="15" alt=""><img class="mr-1" src="https://img.icons8.com/metro/1600/idea.png" width="20" alt="">Descansos remunerados</li>
                          <li><img class="mr-1" src="https://cdn181.picsart.com/229913690016202.png?r1024x1024" width="15" alt=""><img class="mr-1" src="https://img.icons8.com/metro/1600/idea.png" width="20" alt="">Primas extralegales</li>
                          <li><img class="mr-1" src="https://cdn181.picsart.com/229913690016202.png?r1024x1024" width="15" alt=""><img class="mr-1" src="https://img.icons8.com/metro/1600/idea.png" width="20" alt="">Subsidio de alimentos</li>
                          <li><img class="mr-1" src="https://cdn181.picsart.com/229913690016202.png?r1024x1024" width="15" alt=""><img class="mr-1" src="https://img.icons8.com/metro/1600/idea.png" width="20" alt="">Prima de antiguedad</li>
                          <li><img class="mr-1" src="https://cdn181.picsart.com/229913690016202.png?r1024x1024" width="15" alt=""><img class="mr-1" src="https://img.icons8.com/metro/1600/idea.png" width="20" alt="">Participación de ganancias</li>
                          <li><img class="mr-1" src="https://cdn181.picsart.com/229913690016202.png?r1024x1024" width="15" alt=""><img class="mr-1" src="https://img.icons8.com/metro/1600/idea.png" width="20" alt="">Fondo de empleados</li>
                          <li><img class="mr-1" src="https://cdn181.picsart.com/229913690016202.png?r1024x1024" width="15" alt=""><img class="mr-1" src="https://img.icons8.com/metro/1600/idea.png" width="20" alt="">Fondo de ahorro para pensión voluntario</li>
                          <li><img class="mr-1" src="https://cdn181.picsart.com/229913690016202.png?r1024x1024" width="15" alt=""><img class="mr-1" src="https://img.icons8.com/metro/1600/idea.png" width="20" alt="">Crédito empresarial a tasas blandas</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="main-content-box-two">
                    <div class="main-content-box-two-one">
                      <div class="title">
                        <h4>Seguros & Bienestar</h4>
                      </div>
                      <div class="content">
                        <ul>
                          <li><img class="mr-1" src="https://cdn181.picsart.com/229913690016202.png?r1024x1024" width="15" alt=""><img class="mr-1" src="https://img.icons8.com/metro/1600/idea.png" width="20" alt="">Seguro de vida, accidentes o invalidez</li>
                          <li><img class="mr-1" src="https://cdn181.picsart.com/229913690016202.png?r1024x1024" width="15" alt=""><img class="mr-1" src="https://img.icons8.com/metro/1600/idea.png" width="20" alt="">Medicina prepagadas</li>
                          <li><img class="mr-1" src="https://cdn181.picsart.com/229913690016202.png?r1024x1024" width="15" alt=""><img class="mr-1" src="https://img.icons8.com/metro/1600/idea.png" width="20" alt="">Auxilio por salud (Lentes, Odontología y Otros)</li>
                          <li><img class="mr-1" src="https://cdn181.picsart.com/229913690016202.png?r1024x1024" width="15" alt=""><img class="mr-1" src="https://img.icons8.com/metro/1600/idea.png" width="20" alt="">Actividades deportivas y recreativas</li>
                          <li><img class="mr-1" src="https://cdn181.picsart.com/229913690016202.png?r1024x1024" width="15" alt=""><img class="mr-1" src="https://img.icons8.com/metro/1600/idea.png" width="20" alt="">Eventos para empleados y familia</li>
                        </ul>
                      </div>
                    </div>
                    <div class="main-content-box-two-two">
                      <div class="title">
                        <h4>Apoyo profesional</h4>
                      </div>
                      <div class="content">
                        <ul>
                          <li><img class="mr-1" src="https://cdn181.picsart.com/229913690016202.png?r1024x1024" width="15" alt=""><img class="mr-1" src="https://img.icons8.com/metro/1600/idea.png" width="20" alt="">Plan de carrera profesional</li>
                          <li><img class="mr-1" src="https://cdn181.picsart.com/229913690016202.png?r1024x1024" width="15" alt=""><img class="mr-1" src="https://img.icons8.com/metro/1600/idea.png" width="20" alt="">Seminario y talleres pagados</li>
                          <li><img class="mr-1" src="https://cdn181.picsart.com/229913690016202.png?r1024x1024" width="15" alt=""><img class="mr-1" src="https://img.icons8.com/metro/1600/idea.png" width="20" alt="">Auxilio de educación</li>
                          <li><img class="mr-1" src="https://cdn181.picsart.com/229913690016202.png?r1024x1024" width="15" alt=""><img class="mr-1" src="https://img.icons8.com/metro/1600/idea.png" width="20" alt="">Horario flexible</li>
                          <li><img class="mr-1" src="https://cdn181.picsart.com/229913690016202.png?r1024x1024" width="15" alt=""><img class="mr-1" src="https://img.icons8.com/metro/1600/idea.png" width="20" alt="">Teletrabajo</li>
                          <li><img class="mr-1" src="https://cdn181.picsart.com/229913690016202.png?r1024x1024" width="15" alt=""><img class="mr-1" src="https://img.icons8.com/metro/1600/idea.png" width="20" alt="">Posibilidad de traslados</li>
                          <li><img class="mr-1" src="https://cdn181.picsart.com/229913690016202.png?r1024x1024" width="15" alt=""><img class="mr-1" src="https://img.icons8.com/metro/1600/idea.png" width="20" alt="">Bono de telefonía móvil</li>
                          <li><img class="mr-1" src="https://cdn181.picsart.com/229913690016202.png?r1024x1024" width="15" alt=""><img class="mr-1" src="https://img.icons8.com/metro/1600/idea.png" width="20" alt="">Celular empresarial</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>

    </div>
    <div class="content-area-seven">
      <div class="content-area-seven-box line-hero">
        <div class="title">
          <h4>¿Porque trabajar con nosotros?</h4>
        </div>
        <div class="form">
          <textarea class="textarea-seven" name="name"></textarea>
        </div>
      </div>
    </div>
    <div class="content-area-eight">
      <div class="content-area-eight-hero line-hero">
        <div class="title">
          <h4>Conócenos</h4>
        </div>
        <div class="owl-carousel owl-theme">
          <div class="item">
            <img class="img-fluid" src="https://static05.ofertia.com.co/catalogos/c561b8c5-4410-4f67-9c49-940e8e1f944d/0/large.v1.jpg" alt="">
          </div>
          <div class="item">
            <img class="img-fluid" src="https://static05.ofertia.com.co/catalogos/c561b8c5-4410-4f67-9c49-940e8e1f944d/0/large.v1.jpg" alt="">
          </div>
      </div>
      </div>
    </div>
    <div class="title">
      <h4>Conoce los que dicen los empleados</h4>
    </div>
    <div class="content-area-nine">
      <div id="accordion">
        <div class="card showing">
          <div class="card-header" id="headingOne">
            <div class="card-header-box">
              <div class="card-header-box-one">
                <div class="box-one">
                  <div class="rating">
                    <i class="fas fa-star stars-hero-s"></i>
                    <i class="fas fa-star stars-hero-s"></i>
                    <i class="fas fa-star stars-hero-s"></i>
                    <i class="fas fa-star stars-hero-s"></i>
                    <i class="fas fa-star stars-hero-s"></i>
                    <i class="fas fa-star stars-hero-s"></i>
                  </div>
                </div>
                <div class="box-two">
                  <div class="number"><p>4.2</p></div>
                </div>
                <div class="box-three">
                  <div class="content"><p>Empleado | Investigacion / Desarrollo / Innovación</p></div>
                </div>
                <div class="box-four">
                  <div class="date"><p>27/10/2018</p></div>
                </div>
              </div>
              <div class="card-header-box-two">
                <div class="card-header-excerpt">
                  <p>Trabajo desde hace 5 años feliz en esta empresa</p>
                </div>
                <button class="btn btn-link button-more" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  <i class="fas fa-plus"></i>
                </button>
              </div>
            </div>
          </div>
          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
              <div class="card-body-box">
                <div class="box-one">
                  <div class="box-one-one">
                    <div class="title og">
                      <h4>Ambiente laboral</h4>
                    </div>
                    <div class="content">
                      <div class="item-ambiente">
                        <div class="title"><p>Cultura organizacional</p></div>
                        <div class="stars">
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                        </div>
                        <div class="number"><p>4.2</p></div>
                      </div>
                      <div class="item-ambiente">
                        <div class="title"><p>Sentido de pertenencia</p></div>
                        <div class="stars">
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                        </div>
                        <div class="number"><p>4.2</p></div>
                      </div>
                      <div class="item-ambiente">
                        <div class="title"><p>Reconocimiento</p></div>
                        <div class="stars">
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                        </div>
                        <div class="number"><p>4.2</p></div>
                      </div>
                      <div class="item-ambiente">
                        <div class="title"><p>Relación entre compañeros</p></div>
                        <div class="stars">
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                        </div>
                        <div class="number"><p>4.2</p></div>
                      </div>
                    </div>
                  </div>
                  <div class="box-one-one">
                    <div class="title og">
                      <h4>Condiciones laborales</h4>
                    </div>
                    <div class="content">
                      <div class="item-ambiente">
                        <div class="title"><p>Cultura organizacional</p></div>
                        <div class="stars">
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                        </div>
                        <div class="number"><p>4.2</p></div>
                      </div>
                      <div class="item-ambiente">
                        <div class="title"><p>Sentido de pertenencia</p></div>
                        <div class="stars">
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                        </div>
                        <div class="number"><p>4.2</p></div>
                      </div>
                      <div class="item-ambiente">
                        <div class="title"><p>Reconocimiento</p></div>
                        <div class="stars">
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                        </div>
                        <div class="number"><p>4.2</p></div>
                      </div>
                      <div class="item-ambiente">
                        <div class="title"><p>Relación entre compañeros</p></div>
                        <div class="stars">
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                          <i class="fas fa-star stars-hero-s"></i>
                        </div>
                        <div class="number"><p>4.2</p></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="box-two">
                  <div class="box-two-one">
                    <div class="title">
                      <h4>Comentarios</h4>
                    </div>
                    <div class="content">
                      <div class="input-group">
                        <span>Comunicación</span>
                        <input type="text" placeholder="Insertar comentario de comunicación">
                      </div>
                      <div class="input-group">
                        <span>Trato equitativo</span>
                        <input type="text" placeholder="Insertar comentario de equitativo">
                      </div>
                      <div class="input-group">
                        <span>Reconocimiento</span>
                        <input type="text" placeholder="Insertar comentario de reconocimiento">
                      </div>
                      <div class="input-group">
                        <span>Remuneración</span>
                        <input type="text" placeholder="Insertar comentario de remuneración">
                      </div>
                      <div class="input-group">
                        <span>Opciones de mejorar</span>
                        <input type="text" placeholder="Insertar opciones de mejorar">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="box-three">
                  <div class="box-three-box">
                    <div class="pros">
                      <span>Pro</span>
                      <textarea name="" id="" cols="30" rows="10">Donec quam felis, ultricies nec, pellen tesque eu, pretium quis, sem. Nulla consequat massa quis enim Donec.</textarea>
                    </div>
                    <div class="contra">
                      <span>Contra</span>
                      <textarea name="" id="" cols="30" rows="10">Donec quam felis, ultricies nec, pellen tesque eu, pretium quis, sem. Nulla consequat massa quis enim Donec.</textarea>
                    </div>
                  </div>
                </div>
                <div class="box-four">
                  <div class="box-four-box">
                    <div class="title"><h4>Beneficios</h4></div>
                    <div class="content">
                      <div class="box-icons">
                        <div class="icons-commun">
                          <div class="icon-commun-box" data-toggle="tooltip" data-placement="top" title="Ejemplo">

                          </div>
                          <div class="icon-commun-box" data-toggle="tooltip" data-placement="top" title="Ejemplo">

                          </div>
                          <div class="icon-commun-box" data-toggle="tooltip" data-placement="top" title="Ejemplo">

                          </div>
                          <div class="icon-commun-box" data-toggle="tooltip" data-placement="top" title="Ejemplo">

                          </div>
                          <div class="icon-commun-box" data-toggle="tooltip" data-placement="top" title="Ejemplo">

                          </div>
                          <div class="icon-commun-box" data-toggle="tooltip" data-placement="top" title="Ejemplo">

                          </div>
                          <div class="icon-commun-box" data-toggle="tooltip" data-placement="top" title="Ejemplo">

                          </div>
                          <div class="icon-commun-box" data-toggle="tooltip" data-placement="top" title="Ejemplo">

                          </div>
                        </div>
                      </div>
                      <div class="box-result">
                        <p>Recomienda esta empresa <i class="fas fa-thumbs-up"></i></p>
                      </div>
                      <div class="box-options">
                        <p>Te pareció valiosa esta evaluación</p>
                        <div class="pane-options">
                          <div class="result-yes"><p>26</p></div>
                          <div class="si-or-no">
                            <button type="button" class="option-yes">Si</button><button type="button" class="option-no">No</button>
                          </div>
                          <div class="result-no"><p>02</p></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</div>

  </div>







@endsection