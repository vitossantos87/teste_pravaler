@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Alunos</li>
        </ol>
      </nav>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="col-md-4">Alunos</div>
                    <div class="col-md-4 offset-md-8">
                    <a class="btn btn-primary" href="{{route('aluno.create')}}" role="button">Novo Aluno</a>
                    </div>
                </div>
                <div class="card-header">
                    <form action="{{route('aluno.index')}}" method="GET" id="form_filtro_aluno">
                    <div class="form-group">
                            <label for="filtro_instituicao">Filtrar Por instituição</label>
                            <select class="form-control" id="filtro_instituicao" name="filtro_instituicao">
                                <option value="">Selecione a instituicao</option>
                                @foreach ($instituicoes as $instituicao)
                                    <option value="{{$instituicao->id}}" {{$filtro_instituicao == $instituicao->id ? 'selected' : ''}}>
                                        {{$instituicao->nome}}
                                    </option>
                                @endforeach

                            </select>

                    </div>

                    <div class="form-group">

                            <label for="filtro_curso">Filtrar Por Curso</label>
                            <select class="form-control" id="filtro_curso" name="filtro_curso">
                                <option value="">Selecione a instituicao</option>

                            </select>

                    </div>
                    </form>
                </div>

                <div class="card-body">
                    @if(count($cursos) > 0)
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Instituição</th>
                            <th scope="col">Curso</th>
                            <th scope="col">Duração</th>
                            <th scope="col">Ações</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($cursos as $curso)
                            <tr>
                                <td>{{$curso->instituicao}}</td>
                                <td>{{$curso->nome}}</td>
                                <td>{{$curso->duracao_semestres}} Semestres</td>
                                <td>
                                <a  class="btn btn-outline-primary" href="{{route('curso.edit', $curso->id)}}" > Editar </a>
                                <button type="button"  class="btn btn-outline-danger"  onclick='excluirCurso("form{{$curso->id}}");'> Excluir </button>
                                <form action="{{route('curso.destroy', $curso->id)}}" id="form{{$curso->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="instituicao_id" id="instituicao_id" value="{{$curso->instituicao_id}}" >
                                </form>
                                </td>
                              </tr>

                            @endforeach

                        </tbody>
                      </table>
                        @if(isset($filtro_instituicao))
                            {{$cursos->appends(['filtro_instituicao' => $filtro_instituicao])->links()}}
                        @else
                            {{$cursos->links()}}
                        @endif

                    @else
                        <div class="alert alert-info" role="alert">
                         Nenhum curso foi encontrado!
                        </div>
                    @endif
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
