@extends('layouts.main') {{-- busca o layout padrão --}}

@section('title', 'Meus Projetos')  {{-- Muda o título da página --}}


{{-- Início seção conteúdo --}}
@section('content')

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Meus Projetos</h1>
</div>

<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($events) > 0)
    <p>ola</p>
    @else
    <p>Você ainda não tem projetos, <a href="/events/create">criar evento</a></p>
    @endif
</div>

@endsection
{{-- Fim seção conteúdo --}}
