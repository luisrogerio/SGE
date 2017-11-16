@extends('layouts.eventoPublico')
@section('title', 'Perfil - Editar')
@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Editar Perfil</h3>
        </div>
        {{ Form::model(Auth::user(), array('url' => route('atualizarPerfil'))) }}
        {{ method_field('PATCH') }}
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group">
                        <label for="dataNascimento">Data de Nascimento</label>
                        {{Form::text('dataNascimento', \Carbon\Carbon::today()->format('d/m/Y'), array('class' => 'form-control', 'id' => 'dataNascimento')) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="input-group">
                        <label for="eNecessidadesEspeciais">
                        {{Form::checkbox('eNecessidadesEspeciais') }} Possui alguma necessidade específica?</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="input-group">
                        <label for="necessidadeEspecial">Se possui, qual a sua necessidade específica?</label>
                        {{Form::text('necessidadeEspecial', null, array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="input-group">
                        <label for="atendimentoEspecializado">Solicita algum atendimento especializado?</label>
                        {{Form::textarea('atendimentoEspecializado', null, array('class' => 'form-control')) }}
                    </div>
                </div>
            </div>
            <div class="espacos"></div>
            {{Form::submit('Editar', array('class' => 'button button-blue'))}}
            <a style="color: #fff" href="{{ route('perfil') }}">
                <button type="button" class="button button-green">
                    <i class="fa fa-edit"></i> Voltar
                </button>
            </a>
        </div>
        {{Form::close()}}
    </div>
    <script>
        $(function () {
            $('#dataNascimento').datetimepicker({
                format: 'DD/MM/YYYY',
                locale: 'pt-br',
                useCurrent: true
            });
        });
    </script>
@endsection