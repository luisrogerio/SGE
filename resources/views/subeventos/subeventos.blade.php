@forelse($subeventos as $subevento)
    <div class="row">
        <div class="col-md-3">
            <p>{{ link_to_route('eventos::visualizar', $subevento->nome, array('id' => $subevento->id)) }}</p>
        </div>
        <div class="col-md-5 col-md-offset-4">
            <div class="btn-group">
                {{ link_to_route('eventos::editar', 'Editar Subevento', array('id' => $subevento->id), array('class' => 'btn btn-default')) }}
                {{ link_to_route('atividades::adicionar', 'Adicionar Atividade', null, array('class' => 'btn btn-success')) }}
            </div>
        </div>
    </div>
@empty
    <p>Não há subeventos neste evento!</p>
@endforelse
{{ $subeventos->links() }}