@extends('layouts.layout')
@section('title', 'Contatos')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Atualizar Contato</h3>
        </div>
        <div class="panel-body">
            {{Form::model($eventoContato, array('url'=>'contatos/atualizar/'.$eventoContato->id))}}
            @include('eventosContatos.campos')
            {{Form::submit('Salvar', array('class' => 'btn btn-primary'))}}
            {{Form::close()}}
        </div>
    </div>
@endsection