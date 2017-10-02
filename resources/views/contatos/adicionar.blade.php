@extends('layouts.layout_admin')
@section('title', 'Contatos')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Adicionar Novo</h3>
        </div>
        <div class="panel-body">
            {{Form::open(array('url'=>route('contatos::salvar')))}}
            @include('contatos.campos')
            {{Form::submit('Salvar', array('class' => 'button button-blue'))}}
            <button class="button button-green">
                {{link_to_route('contatos::index','Voltar', null, ['style' => 'color:#fff;'])}}
            </button>
            {{Form::close()}}
        </div>
    </div>
    <script>
        $(function () {
            $('#telefone').mask('(##) ####-####');
            $('#celular').mask('(##) ###-###-###');
        });
    </script>
@endsection