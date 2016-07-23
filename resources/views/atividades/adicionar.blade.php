@extends('layouts.layout')
@section('title', 'Atividades')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Adicionar Novo</h3>
        </div>
        <div class="panel-body">
            {{Form::open(array('url'=>'atividades/salvar'))}}
                <ul class="nav nav-tabs nav-justified" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#atividade" aria-controls="atividade" role="tab" data-toggle="tab">Atividade</a>
                    </li>
                    <li role="presentation">
                        <a href="#responsavel" aria-controls="responsavel" role="tab" data-toggle="tab">Responsável</a>
                    </li>
                    <li role="presentation">
                        <a href="#horario" aria-controls="horario" role="tab" data-toggle="tab">Data/Horário e Local</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel1" class="tab-pane fade in active" id="atividade">
                        <div class="well">
                            <fieldset class="form-group">
                                {{Form::label('atividades.nome', 'Nome')}}
                                {{Form::text('atividades.nome', null, array('class' => 'form-control'))}}
                                @if ($errors->has('atividades.nome')) <p class="help-block">{{ $errors->first('atividades.nome') }}</p> @endif
                            </fieldset>
                            <fieldset class="form-group">
                                {{Form::label('atividades.quantidadeVagas', 'Quantidade de Vagas')}}
                                {{Form::number('atividades.quantidadeVagas', null, array('class' => 'form-control'))}}
                                @if ($errors->has('atividades.quantidadeVagas')) <p class="help-block">{{ $errors->first('atividades.quantidadeVagas') }}</p> @endif
                            </fieldset>
                            <fieldset class="form-group">
                                {{Form::label('atividades.descricao', 'Descrição')}}
                                {{Form::textarea('atividades.descricao', null, array('class' => 'form-control'))}}
                                @if ($errors->has('atividades.descricao')) <p class="help-block">{{ $errors->first('descricao') }}</p> @endif
                            </fieldset>
                            <fieldset class="form-group">
                                {{Form::label('', 'Cursos') }}
                                <?php $i=0; ?>
                                @foreach($cursos as $curso)
                                    {{Form::checkbox('atividades.idCursos['.$i.']', $curso->id, false,
                                        ['id' => 'atividades.idCursos['.$i.']'])}} {{Form::label('atividades.idCursos['.$i.']', $curso->sigla)}}<br>
                                    <?php $i++; ?>
                                @endforeach
                                @if ($errors->has('atividades.idCursos['.$i.']')) <p class="help-block">{{$errors->first('atividades.idCursos['.$i.']')}}</p> @endif
                            </fieldset>
                        </div>
                    </div>
                    <div role="tabpanel1" class="tab-pane fade" id="responsavel">
                        <div class="well">
                            <fieldset class="form-group">
                                {{Form::label('atividades_responsaveis.nome', 'Nome do Responsável')}}
                                {{Form::text('atividades_responsaveis.nome', null, array('class' => 'form-control'))}}
                                @if ($errors->has('atividades_responsaveis.nome')) <p class="help-block">{{ $errors->first('atividades_responsaveis.nome') }}</p> @endif
                            </fieldset>
                            <fieldset class="form-group">
                                {{Form::label('atividades_responsaveis.titulacao', 'Titulação do Responsável')}}
                                {{Form::text('atividades_responsaveis.titulacao', null, array('class' => 'form-control'))}}
                                @if ($errors->has('atividades_responsaveis.titulacao')) <p class="help-block">{{ $errors->first('atividades_responsaveis.titulacao') }}</p> @endif
                            </fieldset>
                            <fieldset class="form-group">
                                {{Form::label('atividades_responsaveis.instituicaoOrigem', 'Instituição de Origem do Responsável')}}
                                {{Form::text('atividades_responsaveis.instituicaoOrigem', null, array('class' => 'form-control'))}}
                                @if ($errors->has('atividades_responsaveis.instituicaoOrigem')) <p class="help-block">{{ $errors->first('atividades_responsaveis.instituicaoOrigem') }}</p> @endif
                            </fieldset>
                            <fieldset class="form-group">
                                {{Form::label('atividades_responsaveis.experienciaProfissional', 'Instituição de Origem do Responsável')}}
                                {{Form::textarea('atividades_responsaveis.experienciaProfissional', null, array('class' => 'form-control'))}}
                                @if ($errors->has('atividades_responsaveis.experienciaProfissional')) <p class="help-block">{{ $errors->first('atividades_responsaveis.experienciaProfissional') }}</p> @endif
                            </fieldset>
                            <fieldset class="form-group">
                                {{Form::label('atividades_responsaveis.instituicaoOrigem', 'Instituição de Origem do Responsável')}}
                                {{Form::text('atividades_responsaveis.instituicaoOrigem', null, array('class' => 'form-control'))}}
                                @if ($errors->has('atividades_responsaveis.instituicaoOrigem')) <p class="help-block">{{ $errors->first('atividades_responsaveis.instituicaoOrigem') }}</p> @endif
                            </fieldset>
                        </div>
                    </div>
                    <div role="tabpanel1" class="tab-pane fade" id="horario">
                        <div class="well">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>Horário</th>
                                        <th>Local</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{Form::date('atividades_datas.data[0]', \Carbon\Carbon::now(), array('class' => 'form-control')) }}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    {{Form::time('horarios.inicio[0]', '12:00', array('class' => 'form-control'))}}
                                                </div>
                                                <div class="col-xs-4">
                                                    {{Form::time('horarios.termino[0]', '13:00', array('class' => 'form-control col-xs-2'))}}
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{Form::select('locais.id', array('1' => 'B-204', '2' => 'B-104'), null, array('class' => 'form-control'))}}</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-plus"></span></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            {{Form::submit('Salvar', array('class' => 'btn btn-primary'))}}
            {{Form::close()}}
        </div>
    </div>
@endsection