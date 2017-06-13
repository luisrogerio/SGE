<div class="row">
    <div class="conteiner">
        <div class="col-xs-12 col-sm-12 col-md-offset-1 col-md-10 col-lg-offset-1 col-lg-10">
            <h2>Lista de Atividades do evento: $evento</h2>
            <form action="#" class="form-group">
                <select name="pesquisa" class="form-control">
                    <option value="subevento">SubEvento</option>
                    <option value="curso">Curso</option>
                </select><br/>
                <button type="submit" class="btn btn-info"><i class="fa fa-search" aria-hidden="true"></i> Pesquisar
                </button>
            </form>
            <hr/>
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Atividade 1</a></li>
                <li><a data-toggle="tab" href="#menu1">Atividade 2</a></li>
                <li><a data-toggle="tab" href="#menu2">Atividade 3</a></li>
            </ul>
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <h3>
                        Atividade 0
                        <small class="pull-right">Data da Atividade: dd/mm/YYYY</small>
                    </h3>
                    @include('eventos.components.tabela')
                </div>
                <div id="menu1" class="tab-pane fade">
                    <h3>
                        Atividade 1
                        <small class="pull-right">Data da Atividade: dd/mm/YYYY</small>
                    </h3>
                    <p>Some content in menu 1.</p>
                </div>
                <div id="menu2" class="tab-pane fade">
                    <h3>
                        Atividade 2
                        <small class="pull-right">Data da Atividade: dd/mm/YYYY</small>
                    </h3>
                    <p>Some content in menu 2.</p>
                </div>
            </div>
        </div>
    </div>
</div>
