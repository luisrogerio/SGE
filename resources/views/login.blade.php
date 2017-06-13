<!DOCTYPE html>
<html >
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login do Usuário</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
  <!-- Styles -->
  <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="/css/font-awesome.css" />
  <script src="/js/npm.js"></script>
  <script src="/js/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="/css/main.css" />
  <!-- Scripts -->
  <script src="/js/bootstrap.min.js"></script>
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600|Raleway:400,500,600" rel="stylesheet">
  <link rel="stylesheet" href="/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/login.css">
</head>
<body><br />

<header>
  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <div class="navbar-header">
          <a class="navbar-brand" href="#">
            <i class="fa fa-calendar"></i>
            SGE
          </a>
        </div>
      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="" class=""><i class="fa fa-home" aria-hidden="true"></i> Inicial</a></li>
          <li><a href="" class=""><i class="fa fa-plus" aria-hidden="true"></i> Cadastro</a></li>
          <li><a href="" class=""><i class="fa fa-question" aria-hidden="true"></i> Esqueci minha Senha</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
</header>

<div class="container">
  <div class="card"></div>
  <div class="card">
    <h1 class="title">Sistema de Gestão de Eventos- Login</h1>
    <form>
      <div class="input-container">
        <input type="#{type}" id="#{label}" required="required"/>
        <label for="#{label}">Usuário</label>
        <div class="bar"></div>
      </div>

      <div class="input-container">
        <input type="#{type}" id="#{label}" required="required"/>
        <label for="#{label}">Senha</label>
        <div class="bar"></div>
      </div>

      <div class="row text-center">
          <label>
            <input type="checkbox" value="manter"/>
            Manter Logado?
          </label>
      </div>

      <div class="button-container">
        <button><span>Entrar</span></button>
      </div>

      <div class="footer">
        <a href="#">Esqueceu sua senha <i class="fa fa-question" aria-hidden="true"></i></a>
      </div>
    </form>
  </div>
</div>
<footer>
  <h1>© Luis é o Root e o sistema desenvolverá</h1>
</footer>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="/js/login.js"></script>
</body>
</html>
