@extends('layouts.layout_admin')
@section('title', 'Atividade')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>{{$atividade->tipoDeAtividade->nome}} "{{ $atividade->nome }}"</h2>
        </div>
        <div class="panel-body">
            <h3>Descrição</h3>
            <p class="text-capitalize">{{ $atividade->descricao }}</p>
            <h4>Vagas: </h4>
            <p class="text-capitalize">{{ $atividade->quantidadeVagas }}</p>
            <h4>Cursos: </h4>
            <p>{{ $atividade->cursos->lists('nome')->implode(', ') }}</p>
            <h4>{{$atividade->funcaoResponsavel}}(s):</h4>
            <div class="row">
                @foreach($atividade->atividadesResponsaveis as $atividadeResponsavel)
                    <div class="col-lg-3 col-md-6 col-xs-12">
                        <h4>Nome: </h4>
                        <p>{{$atividadeResponsavel->nome}}</p>
                        <h4>Titulação: </h4>
                        <p>{{$atividadeResponsavel->titulacao}}</p>
                        <h4>Instituição de Origem: </h4>
                        <p>{{$atividadeResponsavel->instituicaoOrigem}}</p>
                        <h4>Experiência Profissional: </h4>
                        <p>{{$atividadeResponsavel->experienciaProfissional}}</p>
                        <div class="btn-group">
                            {{link_to_route('atividades::editarResponsavel', 'Editar', ['id' => $atividadeResponsavel->id], ['class' => 'btn btn-primary'])}}
                            {{ Form::open(array('method' => 'POST', 'url' => route('atividades::excluirResponsavel', ['id' => $atividadeResponsavel->id]), 'style' => 'display:inline;')) }}
                            <button class='btn btn-danger' type='button' data-toggle="modal"
                                    data-target="#confirmDelete"
                                    data-title="Remover Responsável"
                                    data-message='Você tem certeza que deseja remover o responsável?'>
                                Deletar
                            </button>
                            {{Form::close()}}
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="espacos"></div>
            {{ link_to_route('atividades::adicionarResponsavel', 'Adicionar', ['idAtividade' => $atividade->id, 'quantidadeResponsaveis' => '1'], ['class' => 'btn btn-primary']) }}
            <hr/>
            <h4>Datas e Horários</h4>
            <div class="row">
                @foreach($atividade->atividadesDatasHoras->sortBy("data") as $atividadeDataHora)
                    <div class="col-lg-2 col-md-2 col-xs-4">
                        <h4>Data: </h4>
                        <p>{{$atividadeDataHora->data->format("d/m/Y")}}</p>
                        <h4>Horário: </h4>
                        <p>{{$atividadeDataHora->horarioInicio->format("H:i")}}h
                            até {{$atividadeDataHora->horarioTermino->format("H:i")}}h</p>
                        <div class="btn-group">
                            {{--TODO Lembrar de fazer o editar e remover de Datas e Horários--}}
                            {{link_to_route('atividades::editarDataHora', 'Editar', ['id' => $atividadeDataHora->id], ['class' => 'btn btn-primary'])}}
                            {{ Form::open(array('method' => 'POST', 'url' => route('atividades::excluirDataHora', ['id' => $atividadeDataHora->id]), 'style' => 'display:inline;')) }}
                            {{Form::button('Remover', ['class' => 'btn btn-danger', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete',
                                'data-title' => 'Remover Data e Horário', 'data-message' => 'Você tem certeza que deseja deletar essa data e horários?'])}}
                            {{Form::close()}}
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="espacos"></div>
            {{ link_to_route('atividades::adicionarDataHora', 'Adicionar', ['idAtividade' => $atividade->id], ['class' => 'btn btn-primary']) }}
            <hr/>
            <h4>Comentários</h4>
            <p class="text-capitalize">{!! $atividade->comentario !!} </p>
            <h4>Aprovação</h4>
            <h5>Status atual: {{$ultimoStatus->nome}}</h5>
            @if($atividade->evento->eventoCaracteristica->ePropostaAtividade && $ultimoStatus->nome == 'Proposta')
                {{ Form::open(array('url' => route('atividades::analisar', ['id' => $atividade->id]))) }}
                <label for="comentario">Comentário</label>
                {{ Form::textarea('comentario', null, array('class' => 'form-control')) }}
                <div class="btn-group">
                    {{Form::submit('Aprovar', ['class' => 'button button-blue', 'name' => 'status']) }}
                    {{Form::submit('Reprovar', ['class' => 'button button-blue', 'name' => 'status']) }}
                </div>
                {{ Form::close() }}
            @endif
            <hr/>
            <div class="btn-group">
                {{link_to_route('atividades::editar','Editar',['id'=>$atividade->id], ['class' => 'button button-blue'])}}
                {{link_to_route('atividades::index','Voltar', ['id' => $atividade->evento->id], ['class' => 'button button-green'])}}
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Delete Parmanently</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure about this ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="button button-blue" data-dismiss="modal">Cancel</button>
                    <button type="button" class="button button-red" id="confirm">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('#confirmDelete').on('show.bs.modal', function (e) {
            $message = $(e.relatedTarget).attr('data-message');
            $(this).find('.modal-body p').text($message);
            $title = $(e.relatedTarget).attr('data-title');
            $(this).find('.modal-title').text($title);

            // Pass form reference to modal for submission on yes/ok
            var form = $(e.relatedTarget).closest('form');
            $(this).find('.modal-footer #confirm').data('form', form);
        });

        <!-- Form confirm (yes/ok) handler, submits form -->
        $('#confirmDelete').find('.modal-footer #confirm').on('click', function () {
            $(this).data('form').submit();
        });
    </script>
@endsection