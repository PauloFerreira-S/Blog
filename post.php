<?php $pagina = "post";
$logado = "";
session_start();
if ((!isset($_SESSION['usuario']) == true) and (!isset($_SESSION['senha']) == true)) {
  unset($_SESSION['usuario']);
  unset($_SESSION['senha']);
} else {
  $logado = $_SESSION['usuario'];
}

include 'assets/includes/funcoes.php';
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
  <link href="assets/img/nav_icon.png" rel="icon">

  <!-- Bootstrap & FontAwesome CSS -->
  <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">

  <!-- Estilo Customizado -->
  <link href="assets/css/personalizados.css" rel="stylesheet">

</head>

<body>

  <!-- Barra de Navegação -->
  <?php
  include 'layout/navbar.php'
  ?>
  <!-- Fim da barra de Navegação -->

  <?php
  if (isset($_GET['post'])) {
    $titulo = ($_GET['post']);
    $titulo_novo = preg_replace('/[ _-]+/', ' ', $titulo);
    $con = selectPost($titulo_novo);
    if (mysqli_num_rows($con) > 0) {
      $dado = $con->fetch_array();
    } else {
      $dado['titulo'] = "Post não Encontrado";
      $dado['descricao'] = "";
      $dado['texto'] = "";
      $dado['criado_em'] = "";
      $dado['imagem'] = "";
    }
  } else {
    $dado['titulo'] = "Post não Encontrado";
    $dado['descricao'] = "";
    $dado['texto'] = "";
    $dado['criado_em'] = "";
    $dado['imagem'] = "";
  }
  ?>




  <!-- Conteúdo da Pagina -->
  <div class="container">

    <!-- Cabeçalho da Pagina  -->
    <h1 class="mt-4 mb-3 titulosh1"><?php echo $dado['titulo']; ?>
    </h1>

    <ol class="breadcrumb bg-breadTema texto-bread mt-4">
      <li class="breadcrumb-item">
        <a href="/">Blog</a>
      </li>
      <li class="breadcrumb-item">
        <a href="/">Categoria da postagem</a>
      </li>
      <li class="breadcrumb-item active"><?php echo $dado['titulo']; ?></li>
    </ol>

    <div class="row">

      <!-- Coluna da Postagem -->
      <div class="col-lg-8">

        <!-- Imagem -->
        <img class="card-img-top img-fluid rounded" alt="Card image cap" <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($dado['imagem']) . '"'; ?>>

        <hr>

        <!-- Data da Postagem-->
        <p><?php echo $dado['criado_em']; ?></p>

        <hr>

        <!-- Conteudo do post -->
        <p class="lead text-justify"><?php echo $dado['descricao']; ?></p>


        <p class="text-justify"><?php echo $dado['texto']; ?></p>

      </div>

      <!-- Barra Lateral -->
      <div class="col-md-4">

        <div class="card mb-4">
          <h5 class="card-header">Pesquisar</h5>
          <form id="pesquisar" method="post" action="pesquisa.php">
            <div class="card-body">
              <div class="input-group">
                <input type="text" name="pesquisa" class="form-control" placeholder="Pesquisar por..." required>
                <span class="input-group-append">
                  <button type="submit" class="btn btn-secondary" name="btnPesquisa" id="btnPesquisa">Pesquisar</button>
                </span>
              </div>
            </div>
          </form>
        </div>

        <!-- Categorias -->
        <div class="card">
          <h5 class="card-header">Categorias</h5>
          <div class="card-body">
            <ul class="ulCategorias">
              <?php $con = topicos();
              while ($dado = $con->fetch_array()) { ?>
                <li class="liCategorias">
                  <?php $topico = $dado['nome'];
                  $topico_novo = preg_replace('/[ -]+/', '_', $topico);
                  ?>
                  <a href="topico.php?topico=<?php echo $topico_novo; ?>"><?php echo $dado['nome']; ?></a>
                </li>
              <?php } ?>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <hr>

  </div>
  <!-- /. Fim do Conteúdo da Pagina -->

  <!-- Rodapé -->
  <?php
  include 'layout/Rodape.php';
  ?>
  <!-- FIM do Rodapé -->

  <!-- Scripts -->
  <script src="assets/jquery/jquery-3.5.1.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/subir_topo.js"></script>

</body>

</html>