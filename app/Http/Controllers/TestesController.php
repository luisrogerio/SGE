<?php

namespace SGE\Http\Controllers;

use Illuminate\Http\Request;

use SGE\Http\Requests;

class TestesController extends Controller
{
    public function getIndex()
    {
        JasperPHP::compile('/vendor/cossou/jasperphp/examples/hello_world.jrxml')->execute();
        return view('testes.teste');
    }
}
