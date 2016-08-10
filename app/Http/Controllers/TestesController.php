<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TestesController extends Controller
{
    public function getIndex()
    {
        return view('testes.teste');
    }
}
