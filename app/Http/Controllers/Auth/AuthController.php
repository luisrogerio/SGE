<?php

namespace App\Http\Controllers\Auth;

use App\Models\Usuario;
use App\Models\UsuarioTipo;
use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';
    protected $loginView = 'publico.login';
    protected $username = 'login';
    protected $maxLoginAttempts = 3;

    protected function getCredentials(Request $request){
        return [
            $this->loginUsername() => $request->get($this->loginUsername()),
            'password' => $request->get('senha')
        ];
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->loginUsername() => 'required', 'senha' => 'required',
        ]);
    }
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    public function getCadastro(){
        return view('publico.cadastro');
    }

    public function postCadastroExterno(Request $request){
        $this->validate($request, [
            'cpfExterno' => 'required|cpf',
            'nome' => 'required'
        ], [
            'cpfExterno.required' => 'O CPF é obrigatório',
            'cpfExterno.cpf' => 'O CPF fornecido não é válido'
        ]);
        return view('publico.cadastroExterno')->with(array('nome' => $request->nome, 'cpf' => $request->cpfExterno));
    }

    public function postSalvarExterno(Request $request){
        $this->validate($request, [
            'nome' => 'required',
            'email' => 'required|email|unique:usuarios',
            'dataNascimento' => 'required|date_format:d/m/Y',
            'cpf' => 'required|cpf',
            'senha' => 'required|alpha_dash|between:8,20|same:confirmarSenha'
        ], [
            'dataNascimento.required' => 'O campo Data de Nascimento é obrigatório'
        ]);
        $this->usuario = new Usuario();
        $this->usuario->usuarioTipo()->associate(UsuarioTipo::where('nome', 'Externo')->first());
        $this->usuario->fill($request->all());
        $this->usuario->senha = \Hash::make($this->usuario->senha);
        $this->usuario->login = $this->usuario->email;
        if ($usuario = $this->usuario->create($this->usuario->attributesToArray())){
            \Auth::guard($this->getGuard()->login($usuario));
            return redirect('/home');
        }
        return back();
    }

}
