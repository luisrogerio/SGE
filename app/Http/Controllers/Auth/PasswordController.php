<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    protected $subject = 'Recuperação de Senha';

    protected $redirectTo = '/eventos';

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function getResetValidationRules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|alpha_dash|between:8,20',
        ];
    }

    protected function getResetValidationMessages() {
        return [
            'token' => 'É obrigatório que exista um token',
            'email.required' => 'E-mail é obrigatório',
            'email.email' => 'E-mail inválido',
            'password.required' => 'Por favor, digite a nova senha',
            'password.confirmed' => 'Senha não confirmada',
            'password.alpha_dash' => 'A senha só pode conter caracteres alfanuméricos, traços e sublinhado',
            'password.between' => 'A senha deve conter de 8 até 20 caracteres'
        ];
    }

    protected function resetPassword($user, $password)
    {
        $user->forceFill([
            'senha' => bcrypt($password),
            'remember_token' => Str::random(60),
        ])->save();

        Auth::guard($this->getGuard())->login($user);
    }


}
