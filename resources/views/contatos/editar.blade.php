@extends('layouts.layout_admin')
@section('title', 'Contatos')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Atualizar Contato</h3>
        </div>
        <div class="panel-body">
            {{Form::model($eventoContato, array('url'=>route('contatos::atualizar', ['id'=>$eventoContato->id])))}}
            @include('contatos.campos')
            {{Form::submit('Salvar', array('class' => 'button button-blue'))}}
            {{link_to_route('contatos::index','Voltar', null, ['class' => 'button button-green'])}}
            {{Form::close()}}
        </div>
    </div>
@endsection