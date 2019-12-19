@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('curso.index')}}">Cursos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar Curso</li>
        </ol>
      </nav>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Editar Curso </div>

                <div class="card-body">
                    <form action="{{route('curso.update', $curso->id)}}" method="POST" >
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                          <label for="nome">Nome do Curso</label>
                          <input type="text" class="form-control" id="nome" name="nome" value="{{$curso->nome}}" aria-describedby="Nome" placeholder="Nome">
                        </div>

                        <div class="form-group">
                            <label for="duracao">Duração em semestres</label>
                            <input type="number" class="form-control cnpj" id="duracao" name="duracao" value="{{$curso->duracao_semestres}}" aria-describedby="duracao" placeholder="Duração em semestres" >
                        </div>

                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
