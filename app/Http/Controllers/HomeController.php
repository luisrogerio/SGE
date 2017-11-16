<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function perfil()
    {
        return view('publico.perfil');
    }

    public function indexAdmin()
    {
        return view('admin.index');
    }

    public function getEditarPerfil()
    {
        return view('publico.editarPerfil');
    }

    /**
     * Save the requested user's data.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function patchAtualizarPerfil(Request $request)
    {
        $this->validatePerfil($request);
        $usuario = auth()->user();
        $usuario->dataNascimento = Carbon::createFromFormat('d/m/Y', $request->dataNascimento);
        $usuario->eNecessidadesEspeciais = $request->eNecessidadesEspeciais;
        $usuario->necessidadeEspecial = $request->necessidadeEspecial;
        $usuario->atendimentoEspecializado = $request->atendimentoEspecializado;
        $usuario->save();
        return redirect()->route('perfil');
    }

    /**
     * Validate the request of changing account data.
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    protected function validatePerfil(Request $request)
    {
        $this->validate($request, [
            'dataNascimento' => 'required|date_format:"d/m/Y"'
        ], [
            'dataNascimento.required' => 'A Data de Nascimento é obrigatória',
            'dataNascimento.date' => 'A data de nascimento deve ser uma data',
        ]);
    }


}
