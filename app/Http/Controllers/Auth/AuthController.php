<?php

namespace App\Http\Controllers\Auth;

use App\Models\Aluno;
use App\Models\Usuario;
use App\Models\UsuarioGrupo;
use App\Models\UsuarioTipo;
use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
    protected $redirectTo = '/eventos';
    protected $loginView = 'publico.login';
    protected $username = 'login';
    protected $maxLoginAttempts = 5;
    protected $lockoutTime = 300;

    protected function getCredentials(Request $request)
    {
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
        $this->middleware($this->guestMiddleware(), ['except' => ['logout', 'alterarSenha']]);
    }

    public function getCadastro()
    {
        return view('publico.cadastro');
    }

    public function getCadastroAluno(Request $request)
    {
        $this->validate($request, [
            'cpfAluno' => 'required|cpf',
            'matricula' => 'required'
        ], [
            'cpfAluno.required' => 'O CPF é obrigatório',
            'cpfAluno.cpf' => 'O CPF fornecido não é válido'
        ]);
        $tipoAluno = UsuarioTipo::where('nome', 'Aluno');
        if ($tipoAluno->conexaoExterna != null) {
            $tipoAluno->configurarConexao();
            Aluno::setTable($tipoAluno->conexaoExterna->view);
            $aluno = Aluno::checarCadastro($request->id, $request->cpf);
            if ($aluno) {
                $this->usuario = new Usuario();
                $this->usuario = [
                    'nome' => $aluno->nome,
                    'email' => $aluno->email,
                    'dataDeNascimento' => $aluno->dataDeNascimento,
                    'login' => $aluno->id,
                    'senha' => $aluno->dataDeNascimento->format('dmY'),
                    'idCursos' => $aluno->idCurso,
                    'idUsuariosTipo' => $tipoAluno->id
                ];
                if ($usuario = $this->usuario->create($this->usuario->attributesToArray())) {
                    $usuario->usuariosGrupos()->attach(UsuarioGrupo::where('nome', 'Usuário Comum')->pluck('id')->first());
                    \Auth::guard($this->getGuard())->login($usuario);
                    return redirect('/dashboard');
                }
            } else {
                \Session::flash('message', 'CPF e Matricula não reconhecidos');
                return redirect()->back();
            }
        } else {
            //Parte do Código para quando não houver conexão Externa para o Aluno
        }
        \Session::flash('message', 'Houve algum erro ao tentar cadastrar este usuário');
        return redirect()->back();
    }

//    public function getCadastroExterno(Request $request)
//    {
//        $this->validate($request, [
//            'cpfExterno' => 'required|cpf',
//            'nome' => 'required'
//        ], [
//            'cpfExterno.required' => 'O CPF é obrigatório',
//            'cpfExterno.cpf' => 'O CPF fornecido não é válido'
//        ]);
//        return view('publico.cadastroExterno')->with(array('nome' => $request->nome, 'cpf' => $request->cpfExterno));
//    }

    public function postSalvarExterno(Request $request)
    {
        if ($validator = $this->validate($request, [
            'nome' => 'required',
            'email' => 'required|email|unique:usuarios|same:confirmarEmail',
            'dataNascimento' => 'required|date_format:d/m/Y',
            'senha' => 'required|alpha_dash|between:8,20|same:confirmarSenha'
        ], [
            'dataNascimento.required' => 'O campo Data de Nascimento é obrigatório'
        ])
        ) {
            return view('publico.cadastro')->withErrors($validator)->withInput();
        }

        $this->usuario = new Usuario();
        $this->usuario->usuarioTipo()->associate(UsuarioTipo::where('nome', 'Externo')->first());
        $request->merge([
            'dataNascimento' => Carbon::createFromFormat('d/m/Y', $request->dataNascimento)
        ]);
        $this->usuario->fill($request->all());
        $this->usuario->senha = \Hash::make($this->usuario->senha);
        $this->usuario->login = $this->usuario->email;
        if ($usuario = $this->usuario->create($this->usuario->attributesToArray())) {
            $usuario->usuariosGrupos()->attach(UsuarioGrupo::where('nome', 'Usuário Comum')->pluck('id')->first());
            \Auth::guard($this->getGuard())->login($usuario);
            return redirect('/dashboard');
        }
        \Session::flash('message', 'Houve algum erro ao tentar cadastrar este usuário');
        return redirect()->back();
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function alterarSenha(Request $request)
    {
        $this->validateSenha($request);

        $senhaAtual = $request->password;

        if(Hash::check($senhaAtual, Auth::user()->senha)){
            $usuario = Auth::user();
            $usuario->senha = Hash::make($request->newPassword);
            $usuario->save();
            return redirect()->back()->with('status', 200);
        } else {
            return redirect()->back()->with('status', 400);
        }
    }

    /**
     * Validate the request of sending reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateSenha(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
            'newPassword' => 'required|alpha_dash|between:8,20|confirmed',
        ], [
            'password.required' => 'A Senha Atual é obrigatória',
            'newPassword.required' => 'A Nova Senha é obrigatória',
            'newPassword.alpha_dash' => 'A Nova Senha deverá ser alfanumérica',
            'newPassword.between' => 'A Nova Senha deverá ter de 8 a 20 caracteres',
            'newPassword.confirmed' => 'Por favor, verifique se as novas senhas digitadas são iguais',
        ]);
    }

    /**
     * Get the needed credentials for sending the reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function getAlterarSenhaCredentials(Request $request)
    {
        return $request->only('email');
    }

}
