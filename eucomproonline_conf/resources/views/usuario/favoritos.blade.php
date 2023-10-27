@extends('layouts.top')

@section('content')
    <favoritos v-bind:anuncio="{{$listaUsers}}"></favoritos>

@endsection