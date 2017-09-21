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
            {{Form::close()}}
        </div>
    </div>
@endsection