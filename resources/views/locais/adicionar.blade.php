{{Form::open(array('url'=>'locais/salvar'))}}
    {{Form::label('Nome')}}
    {{Form::text('nome')}}
    {{Form::submit('Salvar')}}
{{Form::close()}}