<ol class="breadcrumb">
    @foreach($eventosPai as $eventoPai)
    <li>{{ link_to_action('EventosController@getVisualizar', $eventoPai->nome, array('id' => $eventoPai->id)) }}</li>
    @endforeach
    <li class="active">{{ $evento->nome }}</li>
</ol>