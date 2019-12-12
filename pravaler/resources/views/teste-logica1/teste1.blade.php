@extends('layout.principal')
@section('title', 'Teste 1')
@section('styles')
    @parent
@stop
    @section('conteudo')


    <div class="content">
        <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Teste de Lógica 1</li>
                </ol>
        </nav>
        <div class="title m-b-md">
            Desafio Pravaler: Teste 1
        </div>
        <form>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Produto</span>
                </div>
                <input type="text" class="form-control" placeholder="Nome do Produto" aria-label="Produto" id="Produto" aria-describedby="basic-addon1">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon2">Quantidade</span>
                </div>
                <input type="number" class="form-control" placeholder="Quantidade do Produto" aria-label="quantidade" id="quantidade" aria-describedby="basic-addon2">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Preço Unitário</span>
                </div>
                <input type="number" class="form-control" placeholder="Preço Unitário" aria-label="preco" id="preco" aria-describedby="basic-addon3">
            </div>

            <button type="button" class="btn btn-primary" onclick="calculaValorDesconto();">Calcular</button>

            <ul class="list-group" id="calculado">
                <li class="list-group-item">Total: <span id="total"> </span> </li>
                <li class="list-group-item">Desconto: <span id="desconto"></li>
                <li class="list-group-item">Total a pagar: <span id="total_pagar"></li>
            </ul>

        </form>

    </div>
@stop

@section('scripts')
    @parent
    <script src="{{ asset('js/teste-logica1.js')}}"></script>
@stop
