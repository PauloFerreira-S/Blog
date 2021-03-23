<?php $pagina = "topico";
$logado = "";
session_start();
if ((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['login']);
    unset($_SESSION['senha']);
} else {
    $logado = $_SESSION['login'];
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
    $topico = ($_GET['topico']);
    $topico_novo = preg_replace('/[ _-]+/', ' ', $topico);
    $con = getTopico($topico_novo);
    ?>



    <!-- Conteúdo da Pagina -->
    <div class="container">

        <!-- Cabeçalho da Pagina  -->
        <h1 class="mt-4 mb-3 titulosh1"><?php echo $topico_novo; ?>
        </h1>

        <ol class="breadcrumb bg-breadTema texto-bread mt-4">
            <li class="breadcrumb-item">
                <a href="/">Blog</a>
            </li>
            <li class="breadcrumb-item active"><?php echo $topico_novo; ?></li>
        </ol>

        <div class="row">

            <!-- Coluna onde ficara as Postagens -->
            <div class="col-md-8">
                <h2 class="blogh2">Topico '<?php echo $topico_novo; ?>'</h2>

                <!-- Postagens -->
                <?php
                while ($dado = $con->fetch_array()) {
                ?>

                    <div class="card mb-4">
                        <img class="card-img-top" alt="Card image cap" <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($dado['imagem']) . '"'; ?>>
                        <div class="card-body">
                            <h2 class="card-title"><?php echo $dado['titulo']; ?></h2>
                            <p class="card-text text-justify"><?php echo $dado['descricao']; ?></p>
                            <?php $titulo = $dado['titulo'];
                            $titulo_novo = preg_replace('/[ -]+/', '_', $titulo);
                            ?>
                            <a href="post.php?post=<?php echo $titulo_novo; ?>" class="btn btn-secund">Leia Mais &rarr;</a>
                        </div>
                        <div class="card-footer text-muted">
                            Postado em <?php echo $dado['criado_em']; ?>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <!-- Barra Lateral -->
            <div class="col-md-4">

                <!-- Categorias -->
                <div class="card">
                    <h5 class="card-header">Categorias</h5>
                    <div class="card-body">
                        <ul class="ulCategorias">
                            <?php $con = topicos();
                            while ($dado = $con->fetch_array()) { ?>
                                <li class="liCategorias">
                                    <a href="#"><?php echo $dado['nome']; ?></a>
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