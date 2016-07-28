@extends('layouts.layout')

@section('content')

<form method="post">
    <div class="wrapper">
        <div class="toclone">
            <select name="list">
                <option>selecione...</option>
                <option>opção 1</option>
                <option>opção 2</option>
                <option>opção 3</option>
                <option>opção 4</option>
            </select>
            <input  type="text" name="produtos[qtd][1]">
            <button type="button" class="add">+</button>
            <button type="button" class="remove">-</button>
        </div>
    </div>
    <input type="submit">
</form>

    <script>
        function adicionar(){
            var ElementoClonado = $(this.parentNode).clone(); //clona o elemento
            var str = $(ElementoClonado).children('input').eq(0).attr('name').split("["); //divide o name por "["
            console.log(str);
            var intQtd = parseInt(str[2].split("]")[0]); //resgata o numero entre "[" e "]"
            console.log(intQtd);
            var newName = "produtos[qtd]["+(intQtd+1)+"]"; //novo valor name somado +1 do original
            ElementoClonado.children('input').eq(0).attr('name', newName); //seta o novo name para o elemento clonado
            $('.wrapper').append(ElementoClonado);
            $('.add').on("click", adicionar);
            $('.remove').on("click", remover);
            $(this).unbind("click");
        }
        function remover(){
            $(this.parentNode).remove();
        }
        $('.add').on("click", adicionar);
        $('.remove').on("click", remover);
    </script>

@endsection