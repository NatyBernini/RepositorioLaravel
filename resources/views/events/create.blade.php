@extends('layouts.main') {{-- busca o layout padrão --}}

@section('title', 'Criar Projeto')  {{-- Muda o título da página --}}


{{-- Início seção conteúdo --}}
@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Criar novo projeto</h1>
    <form action="/events" method="POST" enctype="multipart/form-data">
        @csrf  
        <div class="form-group">
            <label for="image">Imagem:</label>
            <input type="file" id="image" name="image" class="from-control-file">
        </div>
        <div class="form-group">
            <label for="title">Projeto:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Nome do Projeto">
        </div>
        <div class="form-group">
            <label for="data_criacao">Data de Criação:</label>
            <input type="date" class="form-control" id="data_criacao" name="data_criacao" placeholder="Data de criação">
        </div>
        <div class="form-group">
            <label for="link">Link para acesso:</label>
            <input type="text" class="form-control" id="link" name="link" placeholder="Link de acesso">
        </div>
        <div class="form-group">
            <label for="gitlink">Link GitHub:</label>
            <input type="text" class="form-control" id="gitlink" name="gitlink" placeholder="Link GitHub">
        </div>
        <div class="form-group">
            <label for="description">Descrição:</label>
            <textarea name="description" id="description" class="form-control" placeholder="Descrição do evento"></textarea>
        </div>
        <div class="form-group">
            <label for="items">Adicione as linguagens utilizadas:</label>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="HTML"> HTML
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="CSS"> CSS
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="JS"> JS
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Python"> Python
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Java"> Java
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="C"> C
            </div>
        </div>
        <input type="submit" class="btn btn-primary" value="Criar Projeto">
    </form>
</div>

@endsection
{{-- Fim seção conteúdo --}}