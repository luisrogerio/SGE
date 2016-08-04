<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TestesController extends Controller
{
    public function getIndex()
    {
        JasperPHP::compile('/vendor/cossou/jasperphp/examples/hello_world.jrxml')->execute();
        return view('testes.teste');
    }
}
