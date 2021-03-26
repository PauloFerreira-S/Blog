<?php $pagina = "all_topicos";
$logado = "";

session_start();
if ((!isset($_SESSION['usuario']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['usuario']);
    unset($_SESSION['senha']);
    header('location: ../index.php');
}

$logado = $_SESSION['usuario'];


include '../assets/includes/funcoes.php';
header('content-type: text/html; charset=utf-8mb4'); ?>


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
    include '../layout/navbar.php';
    ?>
    <!-- Fim da barra de Navegação -->

    <div class="p-5 bg-tema">
        <h1 class="tituloPrincipalBlog mt-4 mb-3">Tópicos Criados</h1>
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
            <li class="breadcrumb-item active">Tópicos Criados</li>
        </ol>

        <!-- Criando o Post -->

        <h3>Tópicos Criados</h3>

        <div class="table-responsive text-center">
            <table class="table table-striped table-borderless table-light">
                <thead class="tabela-tema">
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Opção</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $con = topicos();
                    while ($dado = $con->fetch_array()) { ?>
                        <tr>
                            <td><?php echo $dado['id']; ?></td>
                            <td><?php echo $dado['nome']; ?></td>
                            <td>
                                <?php $nome = $dado['nome'];
                                $nome_novo = preg_replace('/[ -]+/', '_', $nome); ?>
                                <a class="btn btn-secund" href="/administracao/editar_topico.php?buscaTopico=<?php echo $nome_novo; ?>">Editar</a>
                                <a class="btn btn-secund" href="/administracao/deletar_topico.php?buscaTopico=<?php echo $nome_novo; ?>">Excluir</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <hr>
        </div>
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
    <script src="/assets/js/textCont.js"></script>

</body>

</html>