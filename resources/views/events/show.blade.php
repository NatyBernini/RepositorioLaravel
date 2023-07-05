@extends('layouts.main') {{-- busca o layout padrão --}}

@section('title', $event->title)  {{-- Muda o título da página --}}


{{-- Início seção conteúdo --}}
@section('content')
    <div class="col-md-10 offset-md-1">
        <div class="detalhes_projeto row">
            <div id="image-container" class="col-md-6">
                <img src="/img/events/{{ $event->image }}" class="img-fluid" alt="Imagem do Evento {{ $event->title }}">
            </div>
            <div class="info-container col-md-6">
                <h1>{{ $event->title}}</h1>
                <p> {{ $eventOwner['name'] }} &copy; {{  date('d/m/Y', strtotime($event->data_criacao))}}</p>
                <p class="project-desc">
                    <ion-icon name="star-outline"></ion-icon>
                    <a href="{{ $event ->gitlink}}" target="_blank">Link GitHub</a>
                </p>
                <h3>Linguagens utilizadas:</h3>
                <ul id="items-list">
                    @foreach($event->items as $item)
                        <li><ion-icon name="play-outline"></ion-icon> {{ $item }}</li>
                    @endforeach
                </ul>
                @if(($event->link) != 0)
                    <a href="{{ $event->link }}" target="_blank" class="btn btn-primary">Acessar</a>
                @endif
                <div class="like">
                    <p class="events-participants"><span>{{ count($event->users) }}</span><ion-icon class="icon_like" name="heart-outline"></ion-icon></p>
                    @if(!$hasUserJoined)
                    <form action="/events/join/{{ $event->id }}" method="POST">
                        @csrf
                        <a href="/events/join/{{ $event->id }}" target="_blank" class="btn btn-primary" id="event-submit" onclick="event.preventDefault(); this.closest('form').submit();"><ion-icon name="heart-outline"></ion-icon>Adicionar aos favoritos</a>
                    </form>
                    @else
                        <form action="/events/leave/{{ $event->id }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-danger delete-btn">
                                <ion-icon name="trash-outline"></ion-icon>Remover dos Favoritos
                            </button>
                        </form>
                    @endif
                </div>
            </div>
            <div class="col-md-12" id="description-container">
                <h3>Sobre o evento: </h3>
                <p class="event-description">{{ $event->description }}</p>
            </div>
        </div>
    </div>
@endsection
{{-- Fim seção conteúdo --}}