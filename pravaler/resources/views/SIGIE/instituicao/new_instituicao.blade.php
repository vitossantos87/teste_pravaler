@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('instituicao.index')}}">Instituições</a></li>
            <li class="breadcrumb-item active" aria-current="page">Nova Instituição</li>
        </ol>
      </nav>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Cadastrar Instituição </div>

                <div class="card-body">
                    <form action="{{route('instituicao.store')}}" method="POST" >
                        @csrf

                        <div class="form-group">
                          <label for="nome">Nome da Instituição</label>
                          <input type="text" class="form-control" id="nome" name="nome" value="{{old('nome')}}" aria-describedby="Nome" placeholder="Nome">
                        </div>

                        <div class="form-group">
                            <label for="cnpj">CNPJ</label>
                            <input type="text" class="form-control cnpj" id="cnpj" name="cnpj" value="{{old('cnpj')}}" aria-describedby="cnpj" placeholder="CNPJ" data-inputmask="'mask': '99.999.999/9999-99'">
                        </div>

                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    @parent
    <script type="text/javascript" src="{{ asset('js/instituicao.js')}}"></script>
@stop
