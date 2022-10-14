@extends('layouts.default')

@section('content')
    <h1>Atores</h1>

    {!! Form::open(['name'=>'form_name', 'route'=>'atores']) !!}
        <div class="sidebar-form">
            <div class="input-group">
                <input type="text" name="desc_filtro" class="form-control" style="width:80% !important;" placeholder="Pesquisa...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-default"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </div>
    {!! Form::close() !!}
    <br>
    <table class="table table-stripe table-bordered table-hover">
        <thead>
            <th>Nome</th>
            <th>Nacionalidade</th>
            <th>Data de Nascimento</th>
            <th>Data Início de Atividade</th>
            <th>Ações</th>
        </thead>

        <tbody>
            @foreach($atores as $ator)
                <tr>
                    <td>{{ $ator->nome }}</td>
                    <td>{{ $ator->nacionalidade->descricao }}</td>
                    <td>{{ \Carbon\Carbon::parse($ator->dt_nascimento)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($ator->inicio_atividades)->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('atores.edit', ['id'=>\Crypt::encrypt($ator->id)]) }}" class="btn-sm btn-success">Editar</a>
                        <a href="#" onclick="return ConfirmaExclusao({{$ator->id}})" class="btn-sm btn-danger">Remover</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>    

    {{ $atores->links() }}

    <a href="{{ route('atores.create', []) }}" class="btn btn-info">Adicionar</a>
@stop

@section('table-delete')
"atores"
@endsection