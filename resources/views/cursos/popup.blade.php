<div class="modal fade" id="modalPopupCursos" role="dialog" aria-labelledby="modalPopupLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">TITULO DO MODAL</h4>
            </div>
            <div class="modal-body">
                <fieldset class="form-group">
                    {{Form::label('nome', 'Nome')}}
                    {{Form::text('nome', null, array('class' => 'form-control'))}}
                    @if ($errors->has('nome')) <p class="help-block">{{ $errors->first('nome') }}</p> @endif
                </fieldset>
                <fieldset class="form-group">
                    {{Form::label('sigla', 'Sigla') }}
                    {{Form::text('sigla', null, array('class' => 'form-control', 'maxlength' => 10))}}
                    @if ($errors->has('sigla')) <p class="help-block">{{$errors->first('sigla')}}</p> @endif
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
            url:'/cursos/popup/',//+document.getElementById('atividadesTipos.nome').value,
            //data:'_token = {!! csrf_token() !!}',
            success:function(data){
                var combo = $('#cursos');
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