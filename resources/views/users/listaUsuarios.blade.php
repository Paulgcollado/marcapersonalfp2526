<!-- COGER COMO PLANTILLA BASE ESTE ARCHIVO. -->
@extends('dopetrope.master')


<!-- SECCIÓN DEL MENÚ PRINCIPAL -->
@section('menu')
    @parent
    <li>Opción adicional</li>
@endsection


<!-- CONTENIDO DE LA PÁGINA -->
@section('content')
    <ul>
    @foreach ($users as $user)
        <li>Usuario {{ $user['name'] }} con identificador: {{ $user['id'] }}</li>
    @endforeach
    </ul>
@endsection


