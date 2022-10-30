@extends('adminlte::page')
@section('plugins.Sweetalert2', true)
@section('content')

@if(Session::has('message'))
<p class="alert alert-danger">{{ Session::get('message') }}</p>
@endif
    <div class="card">
        <div class="card-header" style="background: lightgrey">
            <h3>Novo Filme:</h3>
        </div>

        <div class="card-body">
        {!! Form::open(['route'=>'filmes.store']) !!}

            <div class="form-group">
                {!! Form::label('nome', 'Nome:') !!}
                {!! Form::text('nome', null, ['class'=>'form-control', 'required']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('categoria', 'Categoria:') !!}
                {!! Form::text('categoria', null, ['class'=>'form-control', 'required']) !!}
            </div>
            <hr />

            <h4>Atores</h4>
            <div class="input_fields_wrap"></div>
            <br>

            <button style="float:right" class="add_field_button btn btn-default">Adicionar Ator</button>

            <br>
            <hr />

            <div class="form-group">
                {!! Form::submit('Criar Filme', ['class'=>'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}

        </div>
    </div>
@stop

@section("js")
  <script>
    $(document).ready(function () {
      var wrapper = $(".input_fields_wrap");
      var add_button = $(".add_field_button");
      var x = 0;  // Contador de linhas adicionadas pelo usuário
      // Array que guarda os itens adicionados
      // a cada interação com campos select
      var myarray = [];
      // Variáveis para guardar dados de restauração
      var previousValue = 0;
      var previousIndex = 0;

      $(add_button).click(function(e) {
        x++;  // Atualiza contador de nova linha
        var newField = '<div><div style="width:94%; float:left" id="ator">{!! Form::select("atores[]", \App\Ator::orderBy("nome")->pluck("nome","id")->toArray(), null, ["class"=>"form-control", "required", "placeholder"=>"Selecione um ator"]) !!}</div><button type="button" class="remove_field btn btn-danger btn-circle"><i class="fa fa-times"></button></div>';
        $(wrapper).append(newField);
      });

      $(wrapper).on("click", ".remove_field", function(e) {
        e.preventDefault();

        // Trecho para retirar do array auxiliar o valor que foi
        // removido pelo autor, antes de submeter ao banco
        selectedValue = $(this).parent('div').find(":selected").val();
        var myIndex = myarray.indexOf(selectedValue);
        if (myIndex !== -1)
          myarray.splice(myIndex, 1);
        ///////////////////////////////////////////////////////////

        $(this).parent('div').remove();  // Remove a div (elemento que contém um select)
        x--;  // Atualiza contador (linha suprimida)
      });

      $(wrapper).on("focus", "select", function(e) {
        e.preventDefault();
        // Pega valor e índice anteriores à mudança para restaurar
        // em caso de seleção de ator que já está na lista
        previousValue = $(this).find(":selected").val();
        previousIndex = $(this).find(":selected").index();
      });

      $(wrapper).on("change", "select", function(e) {
        e.preventDefault();

        selectedValue = $(this).find(":selected").val();  // Pega o valor que foi alterado

        // Caso esse valor já esteja no array de controle, avisa que é preciso
        // escolher um ator que ainda não está na lista do filme
        if(myarray.find(element => element == selectedValue)) {
          Swal.fire('Ator já se encontra na lista de atores do filme!',
                    'Por favor, selecione outro ator.',
                    'warning');
          $(this).prop('selectedIndex', previousIndex);
        }
        else {
          // Caso o ator ainda não esteja na lista, adiciona-o
          // Primeiro, verifica se o tamanho do array de controle é menor
          // que o número de linhas já existente (significa que o usuário
          // não está alterando um campo que já existia no form previamente)
          if(myarray.length < x)  {
            myarray.push(selectedValue);
          }
          else {
            // Aqui ele vai entrar se ele está trocando um ator que já havia
            // sido previamente selecionado e adicionado à lista.
            // Aí, ao invés de remover, sobrescreve o valor novo na mesma
            // posição do anterior
            var index = myarray.indexOf(previousValue);
            if (index !== -1)
              myarray[index] = selectedValue;
          }
        }
      });
    });
  </script>
@stop