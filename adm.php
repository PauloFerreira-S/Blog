<?php $pagina = "administracao";
$logado = "";

session_start();
if ((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true)) {
  unset($_SESSION['login']);
  unset($_SESSION['senha']);
  header('location: ../index.php');
}

$logado = $_SESSION['login'];
header('content-type: text/html; charset=utf-8');
?>

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
  include 'layout/navbar.php'
  ?>
  <!-- Fim da barra de Navegação -->

  <div class="p-5 bg-tema">
    <h1 class="tituloPrincipalBlog mt-4 mb-3"> Adminstração</h1>
  </div>

  <!-- Conteúdo da Pagina -->
  <div class="container">

    <!-- Cabeçalho da Pagina  -->
    <ol class="breadcrumb bg-breadTema texto-bread mt-5">
      <li class="breadcrumb-item">
        <a href="/">Blog</a>
      </li>
      <li class="breadcrumb-item active">Adminstração</li>
    </ol>

    <div class="card">
      <div class="card-body">
        <ul class="ulCategorias">
          <li class="liCategorias">
            <a href="/administracao/criar_post.php">CRIAR POST</a>
          </li>
          <li class="liCategorias">
            <a href="/administracao/editar_post.php">EDITAR POST</a>
          </li>
          <li class="liCategorias">
            <a href="/administracao/deletar_post.php">DELETAR POST</a>
          </li>
          <li class="liCategorias">
            <a href="/administracao/all_posts.php">TODOS OS POST</a>
          </li>
          <li class="liCategorias mt-5">
            <a href="/administracao/criar_usuario.php">CRIAR USUARIO</a>
          </li>
          <li class="liCategorias">
            <a href="/administracao/editar_usuario.php">EDITAR USUARIO</a>
          </li>
          <li class="liCategorias">
            <a href="/administracao/deletar_usuario.php">DELETAR USUARIO</a>
          </li>
          <li class="liCategorias">
            <a href="/administracao/all_usuarios.php">TODOS OS USUARIOS</a>
          </li>
          <li class="liCategorias mt-5">
            <a href="/administracao/criar_topico.php">CRIAR TÓPICO</a>
          </li>
          <li class="liCategorias">
            <a href="/administracao/editar_topico.php">EDITAR TÓPICO</a>
          </li>
          <li class="liCategorias">
            <a href="/administracao/deletar_topico.php">DELETAR TÓPICO</a>
          </li>
          <li class="liCategorias">
            <a href="/administracao/all_topicos.php">TODOS OS TÓPICOS</a>
          </li>
        </ul>
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