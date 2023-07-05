@extends('layouts.main') {{-- busca o layout padrão --}}

@section('title', 'Meus Projetos')  {{-- Muda o título da página --}}


{{-- Início seção conteúdo --}}
@section('content')

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Meus Projetos</h1>


<div class="container-table">
    @if(count($events) > 0)
    <table >
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Data de Criação</th>
                <th scope="col">Likes</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
    
        <tbody>
            @foreach($events as $event)
                <tr>
                    <td scropt="row">{{ $loop->index + 1 }}</td>
                    <td><a href="/events/{{ $event->id }}">{{ $event->title }}</a></td>
                    <td>{{ date('d/m/Y', strtotime($event->data_criacao))}}</td>
                    <td>{{ count($event->users) }}</td>
                    <td>
                        <a href="/events/edit/{{ $event->id }}" class="btn btn-info edit-btn"><ion-icon name="create-outline"></ion-icon> Editar</a>
                        <form action="/events/{{ $event->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger delete-btn"><ion-icon name="trash-outline"></ion-icon>Deletar</button>
                        </form>
                </tr>
            @endforeach
        </tbody>

    </table>
    @else
    <p class="pProjetos">Você ainda não tem projetos, <a href="/events/create">criar evento</a></p>
    @endif
</div>
</div>

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Favoritos</h1>


<div class="container-table">
    @if(count($eventsasparticipant) > 0)
    <table >
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Data de Criação</th>
                <th scope="col">Likes</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
    
        <tbody>
            @foreach($eventsasparticipant as $event)
                <tr>
                    <td scropt="row">{{ $loop->index + 1 }}</td>
                    <td><a href="/events/{{ $event->id }}">{{ $event->title }}</a></td>
                    <td>{{ date('d/m/Y', strtotime($event->data_criacao))}}</td>
                    <td>{{ count($event->users) }}</td>
                    <td>
                        <form action="/events/leave/{{ $event->id }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-danger delete-btn">
                                <ion-icon name="trash-outline"></ion-icon>Remover dos Favoritos
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
    @else
    <p class="pProjetos">Você ainda não favoritou nenhum evento <a href="/">ver eventos</a></p>
    @endif
</div>
</div>

@endsection
{{-- Fim seção conteúdo --}}
