@extends('layouts.layout')
@section('title', 'Salas')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Unidade {{ $local->unidade->nome }} - Local {{ $local->nome }} - Adicionar
                @if($numeroDeSalas != 1) Novas Salas
                @else Nova Sala
                @endif
            </h3>
        </div>
        <div class="panel-body">
            {{Form::open(array('url'=>'salas/salvar'))}}
            @if($numeroDeSalas != 0)
                <div class="row">
                    @for($i = 0; $i < $numeroDeSalas; $i++)
                        <div class="form-inline col-md-6 col-sm-12">
                            <fieldset class="form-group">
                                {{Form::label('prefixo[]', 'Nome')}}
                                {{ Form::select('prefixo[]', array(
                                    'Sala' => 'Sala',
                                    'Laboratório' => 'Laboratório',
                                    'Anfiteatro' => 'Anfiteatro',
                                    'Galpão' => 'Galpão',
                                    'Quadra' => 'Quadra',
                                    'Salão' => 'Salão'
                                    ), null, array('class' => 'form-control')) }}
                                @if ($errors->has('prefixo[]')) <p class="help-block">{{ $errors->first('prefixo[]') }}</p> @endif
                            </fieldset>
                            <fieldset class="form-group">
                                {{Form::text('sufixo[]', null, array('class' => 'form-control col-xs-2'))}}
                                @if ($errors->has('sufixo[]')) <p class="help-block">{{ $errors->first('sufixo[]') }}</p> @endif
                            </fieldset>
                        </div>
                    @endfor
                </div>
            @else
                <fieldset class="form-group">
                    {{Form::label('prefixo[]', 'Prefixo')}}
                    {{ Form::select('prefixo[]', array(
                        'Sala' => 'Sala',
                        'Laboratório' => 'Laboratório',
                        'Anfiteatro' => 'Anfiteatro',
                        'Galpão' => 'Galpão',
                        'Quadra' => 'Quadra',
                        'Salão' => 'Salão'
                        ), null, array('class' => 'form-control')) }}
                    @if ($errors->has('prefixo[]')) <p class="help-block">{{ $errors->first('prefixo[]') }}</p> @endif
                </fieldset>
                <fieldset class="form-group">
                    {{Form::label('sufixo[]', 'Nome')}}
                    {{Form::text('sufixo[]', null, array('class' => 'form-control'))}}
                    @if ($errors->has('sufixo[]')) <p class="help-block">{{ $errors->first('sufixo[]') }}</p> @endif
                </fieldset>
            @endif
            <br />
            {{Form::hidden('idLocais', $local->id)}}
            {{Form::hidden('numeroDeSalas', $numeroDeSalas)}}
            @if ($errors->has('idLocais')) <p class="help-block">{{ $errors->first('idLocais') }}</p> @endif
            {{Form::submit('Salvar', array('class' => 'btn btn-primary'))}}
            {{Form::close()}}
        </div>
    </div>
@endsection