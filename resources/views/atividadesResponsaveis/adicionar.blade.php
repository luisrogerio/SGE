@extends('layouts.layout_admin')
@section('title', 'Atividades Responsáveis')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Adicionar Responsáveis</h3>
        </div>
        <div class="panel-body">
            {{ Form::open(array('url' => route('atividades::salvarResponsavel'))) }}
            @for($i = 0; $i < $quantidadeResponsaveis; $i++)
                <div class="well">
                    <fieldset class="form-group">
                        <label for="salvar[{{$i}}]">
                            {{ Form::checkbox('salvar['.$i.']', true, true) }} Salvar
                        </label>
                    </fieldset>
                    <fieldset class="form-group">
                        {{Form::label('nome['.$i.']', 'Nome do Responsável '.($i+1))}}
                        {{Form::text('nome['.$i.']', null, array('class' => 'form-control'))}}
                        @if ($errors->has('nome.'.$i)) <p
                                class="help-block">{{ $errors->first('nome.'.$i) }}</p> @endif
                    </fieldset>
                    <fieldset class="form-group">
                        {{Form::label('titulacao['.$i.']', 'Titulação do Responsável '.($i+1))}}
                        {{Form::text('titulacao['.$i.']', null, array('class' => 'form-control'))}}
                        @if ($errors->has('titulacao.'.$i)) <p
                                class="help-block">{{ $errors->first('titulacao.'.$i) }}</p> @endif
                    </fieldset>
                    <fieldset class="form-group">
                        {{Form::label('instituicaoOrigem['.$i.']', 'Instituição de Origem do Responsável '.($i+1))}}
                        {{Form::text('instituicaoOrigem['.$i.']', null, array('class' => 'form-control'))}}
                        @if ($errors->has('instituicaoOrigem.'.$i)) <p
                                class="help-block">{{ $errors->first('instituicaoOrigem.'.$i) }}</p> @endif
                    </fieldset>
                    <fieldset class="form-group">
                        {{Form::label('experienciaProfissional['.$i.']', 'Experiência Profissional do Responsável '.($i+1))}}
                        {{Form::textarea('experienciaProfissional['.$i.']', null, array('class' => 'form-control'))}}
                        @if ($errors->has('experienciaProfissional.'.$i)) <p
                                class="help-block">{{ $errors->first('experienciaProfissional.'.$i) }}</p> @endif
                    </fieldset>
                </div>
            @endfor

            {{Form::hidden('idAtividade', $idAtividade)}}
            {{Form::submit('Salvar', array('class' => 'button button-blue'))}}
            <button class="button button-green">
                    {{link_to_route('atividades::view','Voltar', ['id' => $idAtividade], ['style' => 'color:#fff;'])}}
                </button>
            {{Form::close()}}
        </div>
    </div>
@endsection