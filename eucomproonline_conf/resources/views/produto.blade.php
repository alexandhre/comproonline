@extends('layouts.app')

@section('content')

<produto v-bind:list="{{$showProdutos}}"></produto>

@endsection