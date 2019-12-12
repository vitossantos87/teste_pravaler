@extends('layout.principal')
@section('title', 'Home')
@section('styles')
    @parent
@stop
    @section('conteudo')
            <div class="content">
                <div class="title m-b-md">
                    Desafio Pravaler
                </div>

                <div class="links">
                    <a href="{{route('teste1')}}">Teste de Lógica 1</a>
                    <a href="{{route('teste2')}}">Teste de Lógica 2</a>
                    <a href="https://laravel-news.com">Sistema SGIE</a>
                </div>
            </div>
@stop

@section('scripts')
    @parent
@stop
