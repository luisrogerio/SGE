{{Form::model($local,array('url'=>'locais/atualizar/'.$local->id))}}
    {{Form::label('Nome')}}
    {{Form::text('nome')}}
    {{Form::submit('Salvar')}}
{{Form::close()}}