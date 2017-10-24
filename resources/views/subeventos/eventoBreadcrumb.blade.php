<ol class="breadcrumb">
    @foreach($eventosPai as $eventoPai)
        <li>{{ link_to_route('eventos::visualizar', $eventoPai->nome, array('id' => $eventoPai->id)) }}</li>
    @endforeach
    <li class="active">{{ $evento->titulo }}</li>
</ol>