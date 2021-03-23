<?php $pagina = "deletar_post";
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
    <h1 class="tituloPrincipalBlog mt-4 mb-3"> Deletar Post</h1>
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
      <li class="breadcrumb-item active">Deletar Post</li>
    </ol>

    <!-- Buscar post -->
    <?php if (isset($_GET['buscaTitulo'])) {
      $titulo = ($_GET['buscaTitulo']);
      $titulo_novo = preg_replace('/[ _-]+/', ' ', $titulo);
      $con = selectPost($titulo_novo);
      $dado = $con->fetch_array();
    } else {

    ?>


      <h3>Deletar Postagem</h3>
      <form id="busca" method="post">
        <div class="control-group form-group">
          <div class="controls">
            <label for="titulo do post">Titulo do Post:</label>
            <input type="text" name="buscaTitulo" class="form-control" id="buscaTitulo" minlength="4" required required data-validation-required-message="Por favor, digite o Titulo da postagem para Deletar.">
          </div>
        </div>
        <button onclick="<?php $titulo = ($_POST["buscaTitulo"]);
                          $con = selectPost($titulo);
                          $dado = $con->fetch_array(); ?>" type="submit" name="selecionarpost" class="btn btn-tema" id="selecionarpost">Selecionar Post</button>
      </form>
      <hr>
    <?php } ?>

    <!-- Informações do Post -->
    <form class="form_control mt-4" id="deletar" method="post">
      <div class="control-group form-group">
        <div class="controls">
          <label for="titulo do post">ID:</label>
          <input type="text" name="id" class="form-control" id="id" value="<?php echo $dado['id']; ?>" readonly required>
        </div>
      </div>
      <div class="control-group form-group">
        <div class="controls">
          <label for="titulo do post">Titulo:</label>
          <input type="text" name="titulo" class="form-control" id="titulo" minlength="10" value="<?php echo $dado['titulo']; ?>" readonly>
        </div>
      </div>
      <div class="control-group form-group">
        <div class="controls">
          <label for="descricao do post">Descrição:</label>
          <small class="caracteres"></small>
          <textarea class="form-control" rows="4" cols="100" name="descricao" id="descricao" minlength="20" maxlength="150" style="resize:none" readonly><?php echo $dado['descricao']; ?></textarea>
        </div>
      </div>
      <div class="control-group form-group">
        <div class="controls">
          <label for="texto do post">Texto:</label>
          <small class="texto"></small>
          <textarea class="form-control" rows="10" cols="100" name="texto" id="texto" minlength="150" style="resize:none" readonly><?php echo $dado['texto']; ?></textarea>
        </div>
      </div>
      <button onclick="
            <?php $resultado = deletarPost($id); ?>" type="submit" name="deletarpost" class="btn btn-atencao" id="deletarpost">Deletar Post</button>
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