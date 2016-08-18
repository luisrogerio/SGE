@foreach($subeventos as $subevento)
    <div class="col-md-4 col-md-offset-2">
        <h4>{{ $subevento->nome }}</h4>
    </div>
    <div class="col-md-5 col-md-offset-1">
        <div class="btn-group">
            {{ link_to_action('EventosController@getEditar', 'Editar Subevento', array('id' => $subevento->id), array('class' => 'btn btn-default')) }}
            {{ link_to_action('AtividadesController@getAdicionar', 'Adicionar Atividade', null, array('class' => 'btn btn-success')) }}
        </div>
    </div>
@endforeach
