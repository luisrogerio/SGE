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
                                {{Form::label('tipoDeEspaco[]', 'Espaço/Vagas de Ocupação', ['class' => 'hack-espaco'])}}
                                {{ Form::select('tipoDeEspaco[]', $tiposDeEspaco, null, array('class' => 'form-control hack-espaco')) }}
                                @if ($errors->has('tipoDeEspaco[]')) <p
                                        class="help-block">{{ $errors->first('tipoDeEspaco[]') }}</p>
                                @endif
                            </fieldset>
                            <fieldset class="form-group">
                                {{Form::text('nome[]', null, array('class' => 'form-control hack-espaco', 'placeholder' => 'Sala'))}}
                                @if ($errors->has('nome[]')) <p
                                        class="help-block">{{ $errors->first('nome[]') }}</p> @endif
                            </fieldset>
                            <fieldset class="form-group">
                                {{Form::number('quantidade_ocupacao[]', null, array('class' => 'form-control hack-espaco', 'placeholder' => '20'))}}
                                @if ($errors->has('quantidade_ocupacao[]')) <p
                                        class="help-block">{{ $errors->first('quantidade_ocupacao[]') }}</p> @endif
                            </fieldset>
                        </div>
                    @endfor
                </div>
            @else
                <fieldset class="form-group">
                    {{Form::label('tipoDeEspaco[]', 'Tipo de Espaço')}}
                    {{ Form::select('tipoDeEspaco[]', $tiposDeEspaco, null, array('class' => 'form-control')) }}
                    @if ($errors->has('tipoDeEspaco[]')) <p
                            class="help-block">{{ $errors->first('tipoDeEspaco[]') }}</p> @endif
                </fieldset>
                <fieldset class="form-group">
                    {{Form::label('nome[]', 'Nome')}}
                    {{Form::text('nome[]', null, array('class' => 'form-control'))}}
                    @if ($errors->has('nome[]')) <p class="help-block">{{ $errors->first('nome[]') }}</p> @endif
                </fieldset>
                <fieldset class="form-group">
                    {{Form::label('quantidade_ocupacao[]', 'Vagas de Ocupação')}}
                    {{Form::number('quantidade_ocupacao[]', null, array('class' => 'form-control'))}}
                    @if ($errors->has('nome[]')) <p
                            class="help-block">{{ $errors->first('quantidade_ocupacao[]') }}</p> @endif
                </fieldset>
            @endif
            <br/>
            {{Form::hidden('idLocais', $local->id)}}
            {{Form::hidden('numeroDeSalas', $numeroDeSalas)}}
            @if ($errors->has('idLocais')) <p class="help-block">{{ $errors->first('idLocais') }}</p> @endif
            {{Form::submit('Salvar', array('class' => 'button button-blue'))}}
            {{link_to_route('salas::index','Voltar', ['idLocais' => $local->id], ['class' => 'button button-green'])}}
            {{Form::close()}}
        </div>
    </div>
    <div class="espacos"></div>
    <div class="espacos"></div>
    <div class="espacos"></div>
@endsection