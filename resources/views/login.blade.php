@extends('layouts.master')

@section('title', 'VidAndWork.com')

@section('head')
  <script type="text/javascript" src="/js/empresa/profile.js"></script>
@endsection

@section('content')


<div class="card bg-light m-3" style="max-width: 18rem;">
  <div class="card-header"><h5>Ingresar</h5></div>
  <div class="card-body">    
    <form id="login" method="POST" action="/login_usuario" novalidate class="needs-validation">
      @method('POST')
			@csrf
      <div class="form-group">
        <label for="exampleInputEmail1">Correo electrónico</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" required aria-describedby="emailHelp" placeholder="Ingresa tu correo">        
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Contraseña</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña" required>
        <small id="emailHelp" class="form-text text-muted">Tu contraseña se envian a tu correo luego de realizar la primera evaluación.</small>
      </div>
      <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Mantenerme conectado</label>
      </div>
      <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
  </div>
</div>
    


@endsection
