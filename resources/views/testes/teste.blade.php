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



@endsection