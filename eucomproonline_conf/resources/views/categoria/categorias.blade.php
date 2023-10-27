@extends('layouts.top')

@section('content')
    <!--------------------------------------CATEGORIAS--------------->
    <categorias v-bind:categorias="{{$AllCategorias}}"></categorias>

@endsection