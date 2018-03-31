@extends('layouts.master')

@section('title', 'Page Title')


@section('content')
<h4>Empresas</h4>

<ul class="list-group">
  @foreach ($empresas as $empresa)

    <li class="list-group-item">{{$empresa->razon_social}}</li>
  @endforeach
</ul>

@endsection
