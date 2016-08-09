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

<div class="row">
    <div class='col-sm-6'>
        <div class="form-group">
            <div class='input-group date' id='datetimepicker2'>
                <input type='text' class="form-control" />
                <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            $('#datetimepicker2').datetimepicker({
                locale: 'pt-br'
            });
        });
    </script>
</div>


<div class="container">
    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker();
            });
        </script>
    </div>
</div>



























@endsection