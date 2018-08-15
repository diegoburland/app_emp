@extends('layouts.master')

@section('title', 'Empresas')


@section('content')
<h4>Empresas</h4>
<!--href="/empresa/{{$empresa->id}}"-->
<div class="list-group">
  @foreach ($empresas as $empresa)

    <a class="list-group-item list-group-item-action"  >{{$empresa->razon_social}}</a>
  @endforeach
</div>

@endsection
