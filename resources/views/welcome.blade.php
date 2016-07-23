@extends('layouts.layout')

@section('content')

    <table class="table">
        <tr><th>Data</th><th>Horários</th><th>Locais</th></tr>
        <tr>
            <td>Data</td>
            <td>Horário 1<br> Horário 2</td>
            <td><select multiple size="3">
                    <option>local 1</option>
                    <option>local 2</option>
                    <option>local 3</option>
                    <option>local 4</option>
                    <option>local 54</option>
                    <option>local 6</option>
                    <option>local 7</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Data 2</td>
            <td>Horário 1</td>
            <td><select multiple size="3">
                    <option>local 1</option>
                    <option>local 2</option>
                    <option>local 3</option>
                    <option>local 4</option>
                    <option>local 54</option>
                    <option>local 6</option>
                    <option>local 7</option>
                </select>
            </td>
        </tr>
    </table>

@endsection