@extends('layouts.top')

@section('content')
    <!--------------------------------------CATEGORIAS--------------->
    <div class="container has-text-left" style="margin-top: 5%;margin-bottom: -3%;">
        <h2 class="title">CATEGORIAS</h2>

        <h2 class="subtitle ">Aqui você encontrará as categorias que te ajudarão a encontrar os<br>
            produtos ideais para o seu comercio com as ultimas novidades!</h2>
    </div>

    <carouselcategoria v-bind:categorias="{{$categorias}}"></carouselcategoria>


    <!--------------------------------------DEMANDAS--------------->
    <demanda></demanda>

@endsection
