@extends('layouts.main') {{-- busca o layout padrão --}}

@section('title', 'Repositório')  {{-- Muda o título da página --}}


{{-- Início seção conteúdo --}}
@section('content')

    <div id="search-container" class="col-md-12">
        <h1>Busque um projeto</h1>
        <form action="/" method="GET" class="search-box">
            <input type="text" id="search" name="search" placeholder="Pesquisar por um projeto">
            <button type="reset"></button>
        </form>
    </div>  {{-- Fim search-container --}}

    <div id="events-container" class="col-md-12">
        @if($search)
        <h2 class="titleMain">Resultados da Busca por: <span>{{ $search }}</span></h2>
        @else
        <h2 class="titleMain">Repositório</h2>
        <p class="pMain" >Veja meus projetos criados até o momento...</p>
        @endif
        <div id="cards-container" class="row">
            @foreach($events as $event)
            <div class="card col-md-3">
                <img src="/img/events/{{ $event->image }}" alt="Imagem do Projeto {{ $event->title }}">
                <div class="card-body">
                    <p class="card-date">{{ date('d/m/Y', strtotime($event->data_criacao))}} </p>
                    <h5 class="card-title">{{ $event->title }}</h5>
                    <p class="card-desc">{{ $event->description}}</p>
                </div>
                <div class="like_welcome">
                        <p class="events-participants"><span>{{ count($event->users) }}</span><ion-icon class="icon_like" name="heart-outline"></ion-icon></p>
                        <a href="/events/{{ $event->id }}" class="btn btn-primary acessar">Acessar</a>
                    </div>
            </div>
            @endforeach
            @if(count($events) == 0 && $search)
                <p>Não foi possível encontrar nenhum evento com o nome de <span>{{ $search }}</span> ! <a href="/" class="btn btn-primary">Ver todos</a> </p>
            @elseif(count($events) == 0)
                <p>Não há eventos disponíveis<p></p>
            @endif
        </div>
    </div> {{-- Fim events-container --}}

@endsection
{{-- Fim seção conteúdo --}}