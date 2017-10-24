Clique aqui para resetar sua senha: <a
        href="{{ $link = route('resetToken', ['token' => $token]).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
