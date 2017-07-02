@extends('layouts.layout')
@section('title', 'Atividades Responsáveis')
@section('content')
    <div class="well">
        <fieldset class="form-group">
            {{Form::label('atividades_responsaveis.nome', 'Nome do Responsável')}}
            {{Form::text('atividades_responsaveis.nome', null, array('class' => 'form-control'))}}
            @if ($errors->has('atividades_responsaveis.nome')) <p
                    class="help-block">{{ $errors->first('atividades_responsaveis.nome') }}</p> @endif
        </fieldset>
        <fieldset class="form-group">
            {{Form::label('atividades_responsaveis.titulacao', 'Titulação do Responsável')}}
            {{Form::text('atividades_responsaveis.titulacao', null, array('class' => 'form-control'))}}
            @if ($errors->has('atividades_responsaveis.titulacao')) <p
                    class="help-block">{{ $errors->first('atividades_responsaveis.titulacao') }}</p> @endif
        </fieldset>
        <fieldset class="form-group">
            {{Form::label('atividades_responsaveis.instituicaoOrigem', 'Instituição de Origem do Responsável')}}
            {{Form::text('atividades_responsaveis.instituicaoOrigem', null, array('class' => 'form-control'))}}
            @if ($errors->has('atividades_responsaveis.instituicaoOrigem')) <p
                    class="help-block">{{ $errors->first('atividades_responsaveis.instituicaoOrigem') }}</p> @endif
        </fieldset>
        <fieldset class="form-group">
            {{Form::label('atividades_responsaveis.experienciaProfissional', 'Instituição de Origem do Responsável')}}
            {{Form::textarea('atividades_responsaveis.experienciaProfissional', null, array('class' => 'form-control'))}}
            @if ($errors->has('atividades_responsaveis.experienciaProfissional')) <p
                    class="help-block">{{ $errors->first('atividades_responsaveis.experienciaProfissional') }}</p> @endif
        </fieldset>
        <fieldset class="form-group">
            {{Form::label('atividades_responsaveis.instituicaoOrigem', 'Instituição de Origem do Responsável')}}
            {{Form::text('atividades_responsaveis.instituicaoOrigem', null, array('class' => 'form-control'))}}
            @if ($errors->has('atividades_responsaveis.instituicaoOrigem')) <p
                    class="help-block">{{ $errors->first('atividades_responsaveis.instituicaoOrigem') }}</p> @endif
        </fieldset>
    </div>
@endsection