@extends('layouts.principal')
@section('title', 'Teste 1')
@section('styles')
    @parent
@stop
    @section('conteudo')


    <div class="content">
        <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Teste de Lógica 2</li>
                </ol>
        </nav>
        <div class="title m-b-md">
            Desafio Pravaler: Teste 2
        </div>
        <form>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon2">Massa</span>
                </div>
                <input type="number" class="form-control" placeholder="Informe a Massa" aria-label="massa" id="massa" aria-describedby="basic-addon2">
            </div>

            <button type="button" class="btn btn-primary" onclick="calculaValorDesconto();">Calcular</button>

            <ul class="list-group" id="calculado">
                <li class="list-group-item">Tempo para reduzir a massa a 0.10: <span id="total"> </span> </li>
            </ul>

        </form>

    </div>
@stop

@section('scripts')
    @parent
    <script src="{{ asset('js/teste-logica2.js')}}"></script>
@stop
