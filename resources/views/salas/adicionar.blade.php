@extends('layouts.layout_admin')
@section('title', 'Salas')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>
                <ol class="breadcrumb">
                    <li>{{ link_to_route("unidades::index", "Unidade ".$local->unidade->nome) }}</li>
                    <li>{{ link_to_route("locais::index", "Local ".$local->nome, ['id' => $local->unidade->id]) }}</li>
                    <li>Adicionar
                        @if($numeroDeSalas != 1) Novas Salas
                        @else Nova Sala
                        @endif</li>
                </ol>
            </h3>
        </div>
        <div class="panel-body">
            {{Form::open(array('url'=> route('salas::salvar')))}}
            @if($numeroDeSalas != 0)
                <div class="row">
                    @for($i = 0; $i < $numeroDeSalas; $i++)
                        <div class="form-inline col-md-6 col-sm-12">
                            <fieldset class="form-group">
                                {{Form::label('prefixo[]', 'Espaço ', ['class' => 'hack-espaco'])}}
                                {{ Form::select('prefixo[]', array(
                                    'Sala' => 'Sala',
                                    'Laboratório' => 'Laboratório',
                                    'Anfiteatro' => 'Anfiteatro',
                                    'Galpão' => 'Galpão',
                                    'Quadra' => 'Quadra',
                                    'Salão' => 'Salão'
                                    ), null, array('class' => 'form-control hack-espaco')) }}
                                @if ($errors->has('prefixo[]')) <p
                                        class="help-block">{{ $errors->first('prefixo[]') }}</p>
                                @endif
                            </fieldset>
                            <fieldset class="form-group">
                                {{Form::text('sufixo[]', null, array('class' => 'form-control col-xs-2 hack-espaco'))}}
                                @if ($errors->has('sufixo[]')) <p
                                        class="help-block">{{ $errors->first('sufixo[]') }}</p> @endif
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
            <br/>
            {{Form::hidden('idLocais', $local->id)}}
            {{Form::hidden('numeroDeSalas', $numeroDeSalas)}}
            @if ($errors->has('idLocais')) <p class="help-block">{{ $errors->first('idLocais') }}</p> @endif
            {{Form::submit('Salvar', array('class' => 'button button-blue'))}}
            <button class="button button-green">
                {{link_to_route('salas::index','Voltar', ['idLocais' => $local->id], ['style' => 'color:#fff;'])}}
            </button>
            {{Form::close()}}
        </div>
    </div>
    <div class="espacos"></div>
    <div class="espacos"></div>
    <div class="espacos"></div>
@endsection