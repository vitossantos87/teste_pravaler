@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('aluno.index')}}">Alunos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Novo Aluno</li>
        </ol>
      </nav>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Cadastrar Aluno </div>

                <div class="card-body">
                    <form action="{{route('aluno.store')}}" method="POST" >
                        @csrf

                        <div class="form-group">
                          <label for="nome">Nome do Aluno</label>
                          <input type="text" class="form-control" id="nome" name="nome" value="{{old('nome')}}" aria-describedby="Nome" placeholder="Nome">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="cpf">CPF</label>
                                <input type="text" class="form-control" id="cpf" name="cpf" value="{{old('cpf')}}" aria-describedby="cpf" placeholder="CPF" data-inputmask="'mask': '999.999.999-99'">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="data_nascimento">Data de Nascimento</label>
                                <input type="text" class="form-control" id="data_nascimento" name="data_nascimento" value="{{old('data_nascimento')}}" aria-describedby="data_nascimento" placeholder="dd/mm/aaaa" data-inputmask="'mask': '99/99/9999'">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="email">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" aria-describedby="email" placeholder="exemplo@exemplo.com">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="celular">Celular</label>
                                <input type="text" class="form-control" id="celular" name="celular" value="{{old('celular')}}" aria-describedby="celular" placeholder="(11)91111-1111" data-inputmask="'mask': '(99) 99999 - 9999'">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="endereco">Endereço</label>
                                <input type="text" class="form-control" id="endereco" name="endereco" value="{{old('endereco')}}" aria-describedby="endereco" placeholder="Rua exemplo">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="numero">Número</label>
                                <input type="text" class="form-control" id="numero" name="numero" value="{{old('numero')}}" aria-describedby="numero" placeholder="xxx" >
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="bairro">bairro</label>
                                <input type="text" class="form-control" id="bairro" name="bairro" value="{{old('bairro')}}" aria-describedby="bairro" placeholder="bairro">
                            </div>
                            <div class="form-group col-md-5">
                                <label for="cidade">Cidade</label>
                                <input type="text" class="form-control" id="cidade" name="cidade" value="{{old('cidade')}}" aria-describedby="cidade" placeholder="cidade" >
                            </div>
                            <div class="form-group col-md-2">
                                <label for="uf">UF</label>
                                <input type="text" class="form-control" id="uf" name="uf" value="{{old('uf')}}" aria-describedby="uf" placeholder="SP" data-inputmask="'mask': 'AA'">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="instituicao">Instituição</label>
                            <select class="form-control" id="instituicao" name="instituicao">
                                <option value="">Selecione a instituicao</option>
                                @foreach ($instituicoes as $instituicao)
                                    <option value="{{$instituicao->id}}" {{old('instituicao') == $instituicao->id ? 'selected' : ''}}>
                                        {{$instituicao->nome}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" id="temp_curso" value="{{old('curso')}}">
                        <input type="hidden" id="url_ajax" value="{{route('curso.filtroAjax',0)}}">


                        <div class="form-group">
                            <label for="curso">Curso</label>
                            <select class="form-control" id="curso" name="curso">
                                <option value="">Selecione a instituicao</option>
                            </select>
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
    <script src="{{ asset('js/aluno.js')}}"></script>
@stop
