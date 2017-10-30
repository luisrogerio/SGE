@extends('layouts.layout_admin')
@section('title', 'Notícias do Evento')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Adicionar Nova</h3>
        </div>
        <div class="panel-body">
            {{Form::open(array('url'=>route('eventosNoticias::salvar', ['idEventos' => $idEventos])))}}
            <fieldset class="form-group">
                {{Form::label('titulo', 'Título')}}
                {{Form::text('titulo', null, array('class' => 'form-control'))}}
                @if ($errors->has('titulo')) <p class="help-block">{{ $errors->first('titulo') }}</p> @endif
            </fieldset>
            <fieldset class="form-group">
                {{Form::label('noticia', 'Notícia') }}
                {{Form::textarea('noticia', null, array('class' => 'form-control'))}}
                @if ($errors->has('noticia')) <p class="help-block">{{$errors->first('noticia')}}</p> @endif
            </fieldset>
            <div class="row">
                <div class='col-sm-12'>
                    <fieldset class="form-group">
                        {{Form::label('dataHoraPublicacao', 'Data e Hora de Publicação da Notícia')}}
                        {{Form::text('dataHoraPublicacao', null, array('class' => 'form-control', 'id'=> 'dataHoraPublicacao'))}}
                        @if ($errors->has('dataHoraPublicacao')) <p
                                class="help-block">{{ $errors->first('dataHoraPublicacao') }}</p> @endif
                    </fieldset>
                </div>
            </div>
            {{Form::submit('Salvar', array('class' => 'button button-blue'))}}
            <a href="{{route('eventosNoticias::index', ['id' => $idEventos])}}">
                <button type="button" class="button button-green">Voltar</button>
            </a>
            {{Form::close()}}
        </div>
    </div>
    <script type="application/javascript">
        $(function () {
            $('#dataHoraPublicacao').datetimepicker({
                locale: 'pt-br',
                minDate: moment()
            });
            if ($('#dataHoraPublicacao').attr('value')) {
                $dataHora = $('#dataHoraPublicacao').data("DateTimePicker");
                $dataHora.date(moment($('#dataHoraPublicacao').attr('value'), ['DD/MM/YYYY HH:mm', 'YYYY-MM-DD HH:mm:ss']));
            }
        });
    </script>
@endsection