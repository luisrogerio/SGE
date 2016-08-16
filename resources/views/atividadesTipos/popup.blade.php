<div class="modal fade" id="modalPopup" role="dialog" aria-labelledby="modalPopupLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">TITULO DO MODAL</h4>
            </div>
            <div class="modal-body">
                <fieldset class="form-group">
                    {{Form::label('atividadesTipos.nome', 'Nome')}}
                    {{Form::text('atividadesTipos.nome', null, array('class' => 'form-control'))}}
                    @if ($errors->has('atividadesTipos.nome')) <p
                            class="help-block">{{ $errors->first('atividadesTipos.nome') }}</p> @endif
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                {{Form::button('Salvar', array('class' => 'btn btn-success', 'id'=>'confirm', 'onClick'=> 'popup();'))}}
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#modalPopup').on('show.bs.modal', function (e) {
        $message = $(e.relatedTarget).attr('data-message');
        $(this).find('.modal-body p').text($message);
        $title = $(e.relatedTarget).attr('data-title');
        $(this).find('.modal-title').text($title);
        var form = $(e.relatedTarget).closest('form');
        $(this).find('.modal-footer #confirm').data('form', form);
    });

    $('#modalPopup').find('.modal-footer #confirm').on('click', function(e){
        $('#modalPopup').modal('hide');
    });



    function popup(){
        $.ajax({
            type:'get',
            url:'/atividadesTipos/popup/'+document.getElementById('atividadesTipos.nome').value,
            //data:'_token = {!! csrf_token() !!}',
            success:function(data){
                var combo = $('#atividadesTipos');
                combo.empty();
                //combo.prop("disabled", false);
                $.each(data, function (index, element) {
                    var opcao = "<option value='"+element.id + "'>" +element.nome + "</option>";
                    combo.append(opcao);
                });
            }
        });
    }

</script>