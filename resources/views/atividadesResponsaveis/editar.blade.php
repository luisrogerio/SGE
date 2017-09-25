@extends('layouts.layout_admin')
@section('title', 'Responsável da Atividade')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Editar Responsável</h3>
        </div>
        {{ Form::model($atividadeResponsavel, array('url' => route('atividades::atualizarResponsavel', ['id' => $atividadeResponsavel->id]))) }}
        {{ method_field('PATCH') }}
        <div class="well">
            </fieldset>
            <fieldset class="form-group">
                {{Form::label('nome', 'Nome do Responsável')}}
                {{Form::text('nome', null, array('class' => 'form-control'))}}
                @if ($errors->has('nome.')) <p
                        class="help-block">{{ $errors->first('nome') }}</p> @endif
            </fieldset>
            <fieldset class="form-group">
                {{Form::label('titulacao', 'Titulação do Responsável')}}
                {{Form::text('titulacao', null, array('class' => 'form-control'))}}
                @if ($errors->has('titulacao.')) <p
                        class="help-block">{{ $errors->first('titulacao') }}</p> @endif
            </fieldset>
            <fieldset class="form-group">
                {{Form::label('instituicaoOrigem', 'Instituição de Origem do Responsável')}}
                {{Form::text('instituicaoOrigem', null, array('class' => 'form-control'))}}
                @if ($errors->has('instituicaoOrigem.')) <p
                        class="help-block">{{ $errors->first('instituicaoOrigem') }}</p> @endif
            </fieldset>
            <fieldset class="form-group">
                {{Form::label('experienciaProfissional', 'Experiência Profissional do Responsável')}}
                {{Form::textarea('experienciaProfissional', null, array('class' => 'form-control'))}}
                @if ($errors->has('experienciaProfissional.')) <p
                        class="help-block">{{ $errors->first('experienciaProfissional') }}</p> @endif
            </fieldset>
        </div>
        {{Form::submit('Editar', array('class' => 'button button-blue'))}}
        {{link_to_route('atividades::view','Voltar', ['id' => $atividadeResponsavel->atividade->id], ['class' => 'button button-green'])}}
        {{Form::close()}}
    </div>
@endsection