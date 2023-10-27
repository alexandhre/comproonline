@extends('layouts.top')

@section('content')
    <!--------------------------------------CATEGORIAS--------------->
    <produtosearch v-bind:anuncio="{{$anuncio}}"></produtosearch>

@endsection