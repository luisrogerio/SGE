@foreach($subeventos as $subevento)
    <div class="col-md-4 col-md-offset-2">
        <h4>{{ $subevento->nome }}</h4>
    </div>
    <div class="col-md-5 col-md-offset-1">
        <div class="btn-group">
            {{ link_to_route('eventos::editar', 'Editar Subevento', array('id' => $subevento->id), array('class' => 'button button-blue')) }}
            {{ link_to_route('atividades::adicionar', 'Adicionar Atividade', null, array('class' => 'btn btn-success')) }}
        </div>
    </div>
@endforeach
