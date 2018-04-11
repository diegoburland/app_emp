@extends('layouts.master')

@section('title', 'Page Title')

@section('content')
<h2>{{$empresa->razon_social}}</h2>
    ubicacion: 
    {{$empresa->ubicacion}}
@endsection
