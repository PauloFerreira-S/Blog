<?php $pagina = "editar_usuario";
$logado = "";

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
    <h1 class="tituloPrincipalBlog mt-4 mb-3"> Editar Usuário</h1>
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
      <li class="breadcrumb-item active">Editar Usuário</li>
    </ol>

    <!-- Buscar Usuário -->
    <?php if (isset($_GET['buscaNome'])) {
      $nome = ($_GET['buscaNome']);
      $nome_novo = preg_replace('/[ _-]+/', ' ', $nome);
      $con = selectUser($nome_novo);
      $dado = $con->fetch_array();
    ?>

      <!-- Informações do Post -->
      <h3>Editar Usuário</h3>

      <form method="post" action="../assets/includes/funcoes.php">
        <div class="control-group form-group">
          <div class="controls">
            <label for="titulo do post">ID:</label>
            <input type="text" name="id" class="form-control" id="id" value="<?php echo $dado['id']; ?>" readonly>
          </div>
        </div>
        <div class="control-group form-group">
          <div class="controls">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" class="form-control" id="nome" minlength="3" required value="<?php echo $dado['nome']; ?>">
          </div>
        </div>
        <div class="control-group form-group">
          <div class="controls">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" id="email" required value="<?php echo $dado['email']; ?>">
          </div>
        </div>
        <div class="control-group form-group">
          <div class="controls">
            <label for="senha">Senha:</label>
            <input class="form-control" type="password" name="senhaUser" id="senhaUser" minlength="5" required value="<?php echo $dado['senha']; ?>">
          </div>
        </div>
        <button type="submit" name="editaruser" class="btn btn-tema" id="editaruser">Editar Usuário</button>
      </form>
      <hr>

    <?php
    } else {
    ?>

      <h3>Selecionar Usuário</h3>
      <form method="post" action="../assets/includes/funcoes.php">
        <div class="control-group form-group">
          <div class="controls">
            <label for="nome do usuario">Nome do Usuário:</label>
            <input type="text" name="buscaNome" class="form-control" id="buscaNome" required>
          </div>
        </div>
        <button type="submit" name="edituser" class="btn btn-tema">Selecionar Usuário</button>
      </form>
      <hr>
    <?php } ?>


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
  <script src="/assets/js/subir_topo.js"></script>

</body>

</html>