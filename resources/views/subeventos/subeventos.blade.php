@forelse($subeventos as $subevento)
    <div class="row">
        <div class="col-md-5 col-md-offset-4">
            <div class="btn-group">
                {{ link_to_route('eventos::editar', 'Editar Subevento', array('id' => $subevento->id), array('class' => 'button button-blue')) }}
            </div>
        </div>
    </div>
@empty
    <p>Não há subeventos neste evento!</p>
@endforelse
{{ $subeventos->links() }}