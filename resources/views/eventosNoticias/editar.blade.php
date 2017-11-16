@extends('layouts.layout_admin')
@section('title', 'EventosNoticias')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Atualizar Notícia</h3>
        </div>
        <div class="panel-body">
            {{Form::model($eventoNoticia, array('url'=>route('eventosNoticias::atualizar', ['id' => $eventoNoticia->id])))}}
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
            <button class="button button-green">
                {{link_to_route('eventosNoticias::index','Voltar', ['id' => $eventoNoticia->evento->id], ['style' => 'color:#fff'])}}
            </button>
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