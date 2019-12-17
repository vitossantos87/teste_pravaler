@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Instituições</li>
        </ol>
      </nav>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">

                    <div class="col-md-4">Instituições</div>
                    <div class="col-md-4 offset-md-8">
                    <a class="btn btn-primary" href="{{route('instituicao.create')}}" role="button">Nova Intituição</a>
                    </div>
                </div>


                <div class="card-body">
                    @if(count($instituicoes) > 0)
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Instituição</th>
                            <th scope="col">CNPJ</th>
                            <th scope="col">Ações</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($instituicoes as $instituicao)
                            <tr>
                                <td>{{$instituicao->nome}}</td>
                                <td>{{$instituicao->cnpj}}</td>
                                <td>
                                <a  class="btn btn-outline-primary" href="{{route('instituicao.edit', $instituicao->id)}}" > Editar </a>
                                <a  class="btn btn-outline-danger" href="{{route('instituicao.destroy', $instituicao->id)}}" > Excluir </a>
                                </td>
                              </tr>

                            @endforeach

                        </tbody>
                      </table>
                      {{ $instituicoes->links() }}
                    @else
                        <div class="alert alert-info" role="alert">
                         Nenhuma Instituição foi encontrada!
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
