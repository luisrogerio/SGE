<h1>Locais</h1>

<table border>
    <tr><td>Nome</td><td colspan="2">Opções</td></tr>
@foreach($locais as $local)
    <tr><td>{{$local->nome}}</td><td>{{link_to_action('LocaisController@getEditar','Editar',['id'=>$local->id])}}</td><td>{{link_to_action('LocaisController@getExcluir','Excluir',['id'=>$local->id])}}</td></tr>
@endforeach
    <tr><td colspan="3">{{link_to_action('LocaisController@getAdicionar','Adicionar Novo')}}</td></tr>
    <tr><td colspan="3">{{$locais->links()}}</td></tr>
</table>