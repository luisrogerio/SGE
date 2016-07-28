<fieldset class="form-group">
    {{Form::label('nome', 'Nome do Contato')}}
    {{Form::text('nome', null, array('class' => 'form-control', 'placeholder' => 'Diretoria de Extensão e Relações Comunitárias'))}}
    @if ($errors->has('nome')) <p class="help-block">{{ $errors->first('nome') }}</p> @endif
</fieldset>

<fieldset class="form-group">
    {{Form::label('telefone', 'Telefone') }}
    {{Form::text('telefone', null, array('class' => 'form-control', 'maxlength' => 14, 'placeholder' => '(xx) xxxx-xxxx'))}}
    @if ($errors->has('telefone')) <p class="help-block">{{$errors->first('telefone')}}</p> @endif
</fieldset>

<fieldset class="form-group">
    {{Form::label('celular', 'Celular') }}
    {{Form::text('celular', null, array('class' => 'form-control', 'maxlength' => 16, 'placeholder' => '(xx) xxx-xxx-xxx'))}}
    @if ($errors->has('celular')) <p class="help-block">{{$errors->first('celular')}}</p> @endif
</fieldset>

<fieldset class="form-group">
    {{Form::label('email', 'Email') }}
    {{Form::email('email', null, array('class' => 'form-control', 'placeholder' => 'exemplo@gmail.com'))}}
    @if ($errors->has('email')) <p class="help-block">{{$errors->first('email')}}</p> @endif
</fieldset>

{{ Form::label('redesSociais[]', 'Redes Sociais') }}

<fieldset class="form-group">
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-facebook fa-fw"></i></span>
        {!! Form::url('redesSociais[0]', null, array(
            'class' => 'form-control',
            'placeholder' => 'https://www.facebook.com/profile.php?id=')) !!}
        @if ($errors->has('redesSociais')) <p class="help-block">{{$errors->first('redesSociais')}}</p> @endif
    </div>
</fieldset>

<fieldset class="form-group">
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-twitter fa-fw"></i></span>
        {!! Form::text('redesSociais[1]', null, array('class' => 'form-control', 'placeholder' => '@MeuTwitter')) !!}
        @if ($errors->has('redesSociais[]')) <p class="help-block">{{$errors->first('redesSociais[]')}}</p> @endif
    </div>
</fieldset>
