@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('aluno.index')}}">Alunos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar Aluno</li>
        </ol>
      </nav>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Editar Aluno </div>

                <div class="card-body">
                    <form action="{{route('aluno.update', $aluno->id)}}" method="POST" >
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                          <label for="nome">Nome do Aluno</label>
                          <input type="text" class="form-control" id="nome" name="nome" value="{{$aluno->nome}}" aria-describedby="Nome" placeholder="Nome">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="cpf">CPF</label>
                                <input type="text" class="form-control" id="cpf" name="cpf" value="{{$aluno->cpf}}" aria-describedby="cpf" placeholder="CPF" data-inputmask="'mask': '999.999.999-99'">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="data_nascimento">Data de Nascimento</label>
                                <input type="text" class="form-control" id="data_nascimento" name="data_nascimento" value="{{$aluno->data_nascimento}}" aria-describedby="data_nascimento" placeholder="dd/mm/aaaa" data-inputmask="'mask': '99/99/9999'">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="email">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{$aluno->email}}" aria-describedby="email" placeholder="exemplo@exemplo.com">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="celular">Celular</label>
                                <input type="text" class="form-control" id="celular" name="celular" value="{{$aluno->celular}}" aria-describedby="celular" placeholder="(11)91111-1111" data-inputmask="'mask': '(99) 99999 - 9999'">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="endereco">Endereço</label>
                                <input type="text" class="form-control" id="endereco" name="endereco" value="{{$aluno->endereco}}" aria-describedby="endereco" placeholder="Rua exemplo">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="numero">Número</label>
                                <input type="text" class="form-control" id="numero" name="numero" value="{{$aluno->numero}}" aria-describedby="numero" placeholder="xxx" >
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="bairro">bairro</label>
                                <input type="text" class="form-control" id="bairro" name="bairro" value="{{$aluno->bairro}}" aria-describedby="bairro" placeholder="bairro">
                            </div>
                            <div class="form-group col-md-5">
                                <label for="cidade">Cidade</label>
                                <input type="text" class="form-control" id="cidade" name="cidade" value="{{$aluno->cidade}}" aria-describedby="cidade" placeholder="cidade" >
                            </div>
                            <div class="form-group col-md-2">
                                <label for="uf">UF</label>
                                <input type="text" class="form-control" id="uf" name="uf" value="{{$aluno->uf}}" aria-describedby="uf" placeholder="SP" data-inputmask="'mask': 'AA'">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="instituicao">Instituição</label>
                            <select class="form-control" id="instituicao" name="instituicao">
                                <option value="">Selecione a instituicao</option>
                                @foreach ($instituicoes as $instituicao)
                                    <option value="{{$instituicao->id}}" {{$aluno->instituicao == $instituicao->id ? 'selected' : ''}}>
                                        {{$instituicao->nome}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" id="temp_curso" value="{{$aluno->curso}}">
                        <input type="hidden" name="url_ajax" id="url_ajax" value="{{route('curso.filtroAjax',0)}}">


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
