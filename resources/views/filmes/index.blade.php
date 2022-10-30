@extends('layouts.default')

@section('content')
    <h1>Filmes</h1>
    <br>
    <table class="table table-stripe table-bordered table-hover">
        <thead>
            <tr>
                <th>Filme</th>
                <th>Categoria</th>
                <th>Atores</th>
            </tr>
        </thead>

        <tbody>
            @foreach($filmes as $filme)
                <tr>
                    <td>{{ $filme->nome }}</td>
                    <td>{{ $filme->categoria }}</td>
                    <td>
                        @foreach($filme->atores as $a)
                            <li>{{ $a->ator->nome }}</li>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>    
    <a href="{{ route('filmes.create', []) }}" class="btn btn-info">Adicionar</a>
@stop