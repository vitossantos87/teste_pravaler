@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <button type="button" class="btn btn-primary" onclick="window.location.href = '{{route('instituicao.index')}}';">Instituicões</button>
                    <button type="button" class="btn btn-primary" onclick="window.location.href = '{{route('curso.index')}}';">Cursos</button>
                    <button type="button" class="btn btn-primary" onclick="window.location.href = '{{route('aluno.index')}}';">Alunos</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
