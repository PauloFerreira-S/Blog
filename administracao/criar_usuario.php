<?php $pagina = "criar_usuario"; $logado = "";

session_start();
if ((!isset($_SESSION['usuario']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['usuario']);
    unset($_SESSION['senha']);
    header('location: ../index.php');
}

$logado = $_SESSION['usuario'];

include '../assets/includes/funcoes.php';
header('content-type: text/html; charset=utf-8'); ?>


<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <meta http-equiv="content-language" content="pt-br" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="theme-color" content="#0375b4" />
  <meta name="description" content="Descrição">

  <title>Blog</title>
  <link href="/assets/img/nav_icon.png" rel="icon">
  <!-- Bootstrap & FontAwesome CSS -->
  <link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">

  <!-- Estilo Customizado -->
  <link href="/assets/css/personalizados.css" rel="stylesheet">

</head>

<body>

  <!-- Barra de Navegação -->
  <?php
  include '../layout/navbar.php'
  ?>
  <!-- Fim da barra de Navegação -->

  <div class="p-5 bg-tema">
    <h1 class="tituloPrincipalBlog mt-4 mb-3"> Criar Usuario</h1>
  </div>

  <!-- Conteúdo da Pagina -->
  <div class="container">

    <!-- Cabeçalho da Pagina  -->
    <ol class="breadcrumb bg-breadTema texto-bread mt-5">
      <li class="breadcrumb-item">
        <a href="/">Blog</a>
      </li>
      <li class="breadcrumb-item">
        <a href="/adm.php">Administração</a>
      </li>
      <li class="breadcrumb-item active">Criar Usuario</li>
    </ol>

    <!-- Criando o Post -->
        <h3>Criar Usuario</h3>
        <form method="post" action="../assets/includes/funcoes.php">
          <div class="control-group form-group">
            <div class="controls">
              <label for="titulo do post">Nome:</label>
              <input type="text" name="nome" class="form-control" id="nome" minlength="3" required>
            </div>
          </div>
          <div class="control-group form-group">
            <div class="controls">
              <label for="titulo do post">Email:</label>
              <input type="email" name="email" class="form-control" id="email" required>
            </div>
          </div>
          <div class="control-group form-group">
            <div class="controls">
              <label for="descricao do post">Senha:</label>
              <input class="form-control" type="password" name="senhaUser" id="senhaUser" minlength="5" required></input>
            </div>
          </div>
          <button type="submit" name="criaruser" class="btn btn-tema" id="criaruser">Criar Usuario</button>
        </form>
        <hr>
      </div>
  <!-- /. Fim do Conteúdo da Pagina -->

  <!-- Rodapé -->
  <?php
  include '../layout/Rodape.php';
  ?>
  <!-- FIM do Rodapé --> 

  <!-- Scripts -->
  <script src="/assets/jquery/jquery-3.5.1.min.js"></script>
  <script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src='/assets/js/jqBootstrapValidation.js'></script>
  <script src="/assets/js/subir_topo.js"></script>

</body>

</html>