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
                                {{Form::label('atividades.idAtividadesTipos', 'Tipo de Atividade')}}
                                {{Form::select('atividades.idAtividadesTipos', $atividadesTipos, null, array('class' => 'form-control'))}}
                                @if ($errors->has('atividades.idAtividadesTipos')) <p class="help-block">{{ $errors->first('atividades.idAtividadesTipos') }}</p> @endif
                            </fieldset>
                            <fieldset class="form-group">
                                {{Form::label('atividades.descricao', 'Descrição')}}
                                {{Form::textarea('atividades.descricao', null, array('class' => 'form-control'))}}
                                @if ($errors->has('atividades.descricao')) <p class="help-block">{{ $errors->first('descricao') }}</p> @endif
                            </fieldset>
                            <fieldset class="form-group">
                                {{Form::label('', 'Cursos') }}
                                <p class="help-block">Marque nenhum para deixar aberto para qualquer público.</p>
                                <?php $i=0; ?>
                                <div class="row">
                                @foreach($cursos as $curso)

                                        <div class="col-sm-3">
                                    {{Form::checkbox('atividades.idCursos['.$i.']', $curso->id, false,
                                        ['id' => 'atividades.idCursos['.$i.']'])}} {{Form::label('atividades.idCursos['.$i.']', $curso->sigla)}}
                                    <?php $i++; ?>
                                        </div>
                                @endforeach
                                </div>
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
                                    <tr class="linhaDeConteudo">
                                        <td>{{Form::date('atividades_datas.data[]', \Carbon\Carbon::now(), array('class' => 'form-control')) }}</td>
                                        <td class="horarios">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    {{Form::time('horarios.inicio[][0]', '12:00', array('class' => 'form-control'))}}
                                                </div>
                                                <div class="col-xs-4">
                                                    {{Form::time('horarios.termino[][0]', '13:00', array('class' => 'form-control'))}}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                                {{Form::select('locais.id[][0]', $locais, null, array('class' => 'form-control'))}}
                                        </td>
                                    </tr>
                                    <tr class="linhaDeConteudo" hidden>
                                        <td>{{Form::date('atividades_datas.data[]', \Carbon\Carbon::now(), array('class' => 'form-control')) }}</td>
                                        <td class="horarios">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    {{Form::time('horarios.inicio[][]', '12:00', array('class' => 'form-control'))}}
                                                </div>
                                                <div class="col-xs-4">
                                                    {{Form::time('horarios.termino[][]', '13:00', array('class' => 'form-control'))}}
                                                </div>
                                                <div class="col-xs-4">
                                                    <a class="btn btn-default" id="adicionarHorario"><span class="glyphicon glyphicon-plus"></span></a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{Form::select('locais.id[][]', $locais, null, array('class' => 'form-control'))}}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a class="btn btn-default btn-lg" id="adicionarLinha" role="button"><span class="glyphicon glyphicon-plus"></span></a>
                                            <a class="btn btn-default btn-lg" id="removerLinha" role="button"><span class="glyphicon glyphicon-minus"></span></a>
                                        </td>
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

    <script type="application/javascript">
        var contadorData = 0;
        var contadorHorario = 0;
        var contadorLocal = 0;

        $('#adicionarLinha').on("click", function(){
            var ultimaLinha     = $(".linhaDeConteudo:last");
            var primeiraColuna  = ultimaLinha.children(":first");
            var segundaColuna   = primeiraColuna.next();
            var terceiraColuna  = segundaColuna.next();

            var novaLinha       = $("<tr/>").attr('class', 'linhaDeConteudo');
            contadorData++;

            var novaPrimeiraColuna  = primeiraColuna.clone();
            var primeiroInput       = $(novaPrimeiraColuna).find("input:first");
            primeiroInput.attr('name', 'atividades_datas.data[]');//+contadorData+']');

            var novaSegundaColuna       = segundaColuna.clone();
            var primeiroInputHorario    = $(novaSegundaColuna).find("input:first");
            primeiroInputHorario.attr('name', 'horarios.inicio['+contadorData+'][0]');
            var segundoInputHorario     = $(novaSegundaColuna).find("input:last");
            segundoInputHorario.attr('name', 'horarios.termino['+contadorData+'][0]');

            var novaTerceiraColuna  = terceiraColuna.clone();
            var terceiroInput       = $(novaTerceiraColuna).find("select:first");
            terceiroInput.attr('name', 'locais.id['+contadorData+']['+contadorHorario+']');

            novaLinha.append(novaPrimeiraColuna, novaSegundaColuna, novaTerceiraColuna);
            ultimaLinha.before(novaLinha);
        });

        $('#adicionarHorario').on('click', function () {
            var linhaAtual  = $(this).closest('.horarios');
            var colunaAtual = $(this).closest('.row');


        });

        $('#removerLinha').on("click", function() {
            $(".linhaDeConteudo:visible:last").remove();
        });

    </script>

@endsection