<?php $pagina = "editar_topico";
$logado = "";

session_start();
if ((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true)) {
  unset($_SESSION['login']);
  unset($_SESSION['senha']);
  header('location: ../index.php');
}

$logado = $_SESSION['login'];


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
    <h1 class="tituloPrincipalBlog mt-4 mb-3"> Editar Topico</h1>
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
      <li class="breadcrumb-item active">Editar Topico</li>
    </ol>

    <!-- Buscar Topico -->
    <?php if (isset($_GET['buscaTopico'])) {
      $nome = ($_GET['buscaTopico']);
      $nome_novo = preg_replace('/[ _-]+/', ' ', $nome);
      $con = selectTopico($nome_novo);
      $dado = $con->fetch_array();
    } else {

    ?>

      <h3>Editar Topico</h3>
      <form id="busca" method="post">
        <div class="control-group form-group">
          <div class="controls">
            <label for="titulo do post">Nome do Topico:</label>
            <input type="text" name="buscaTopico" class="form-control" id="buscaTopico" minlength="4" required required data-validation-required-message="Por favor, digite o Titulo da postagem para Deletar.">
          </div>
        </div>
        <button onclick="<?php $nome = ($_POST["buscaTopico"]);
                          $con = selectTopico($nome);
                          $dado = $con->fetch_array(); ?>" type="submit" name="selecionartopico" class="btn btn-tema" id="selecionartopico">Selecionar Topico</button>
      </form>
      <hr>
    <?php } ?>

    <!-- Informações do Post -->
    <form class="form_control mt-4" id="editar" method="post">
      <div class="control-group form-group">
        <div class="controls">
          <label for="id do topico">ID:</label>
          <input type="text" name="id" class="form-control" id="id" value="<?php echo $dado['id']; ?>" readonly>
        </div>
      </div>
      <div class="control-group form-group">
        <div class="controls">
          <label for="nome do topico">Topico:</label>
          <input type="text" name="nome" class="form-control" id="nome" minlength="10" value="<?php echo $dado['nome']; ?>" required required data-validation-required-message="Por favor, digite o Titulo.">
        </div>
      </div>
      <button onclick="
            <?php $resultado = editarTopico($id, $nome); ?>" type="submit" name="editartopico" class="btn btn-tema" id="editartopico">Editar Topico</button>
      <div class="retornoFunc"><?php echo ($resultado); ?></div>
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
  <script src="/assets/js/subir_topo.js"></script>

</body>

</html>