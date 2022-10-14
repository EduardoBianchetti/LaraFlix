@extends('layouts.default')

@section('content')
    <h1>Nacionalidades</h1>
    <table class="table table-stripe table-bordered table-hover">
        <thead>
            <th>Descrição</th>
            <th>Ações</th>
        </thead>

        <tbody>
            @foreach($nacionalidades as $nacionalidade)
                <tr>
                    <td>{{ $nacionalidade->descricao }}</td>
                    <td>
                        <a href="{{ route('nacionalidades.edit', ['id'=>$nacionalidade->id]) }}" class="btn-sm btn-success">Editar</a>
                        <a href="#" onclick="return ConfirmaExclusao({{$nacionalidade->id}})" class="btn-sm btn-danger">Remover</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>    

    {{ $nacionalidades->links() }}

    <a href="{{ route('nacionalidades.create', []) }}" class="btn btn-info">Adicionar</a>
@stop

@section('table-delete')
"nacionalidades"
@endsection