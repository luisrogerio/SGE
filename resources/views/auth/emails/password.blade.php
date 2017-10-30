<h1>Link para Recuperação da Senha</h1>
<p>Alguém solicitou um pedido para redefinir a senha do Sistema de Gestão de Eventos utilizando seu e-mail.</p>
Clique aqui para resetar sua senha: <a
        href="{{ $link = route('resetToken', ['token' => $token]).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>

<p>Caso não tenha sido você, entre em contato respondendo a este e-mail.</p>
<p>Atenciosamente, Equipe de Tecnologia do Sistema de Gestão de Eventos.</p>
