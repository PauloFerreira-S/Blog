<?php $pagina = "all_post";
$logado = "";

session_start();
if ((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['login']);
    unset($_SESSION['senha']);
    header('location: ../index.php');
}

$logado = $_SESSION['login'];


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
        <h1 class="tituloPrincipalBlog mt-4 mb-3">Posts Criados</h1>
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
            <li class="breadcrumb-item active">Posts Criados</li>
        </ol>

        <!-- Criando o Post -->

        <h3>Posts Criados</h3>
        <div class="control-group form-group">
            <div class="controls">
                <div>
                    <label>Selecione um opção para pesquisa:</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="opcao" id="titulo" value="titulo">
                    <label class="form-check-label" for="titulo">Titulo</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="opcao" id="topico" value="topico">
                    <label class="form-check-label" for="topico">ID Topico</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="opcao" id="usuario" value="usuario">
                    <label class="form-check-label" for="usuario">ID Usuario</label>
                </div>
            </div>
        </div>
        <div class="control-group form-group">
            <div class="controls">
              <label for="pesquisar">Pesquisar:</label>
              <input type="text" class="form-control" id="pesquisar" onkeyup="pesquisar()">
            </div>
          </div>
        <div class="table-responsive text-center">
            <table id="tabela" class="table table-striped table-borderless table-light">
                <thead class="tabela-tema">
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Código do Topico</th>
                        <th scope="col">Data de Cadastro</th>
                        <th scope="col">Código do Usuario</th>
                        <th scope="col">Opção</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $con = posts();
                    while ($dado = $con->fetch_array()) { ?>
                        <tr>
                            <td><?php echo $dado['id']; ?></td>
                            <td><?php echo $dado['titulo']; ?></td>
                            <td><?php echo $dado['topico_id']; ?></td>
                            <td><?php echo $dado['criado_em']; ?></td>
                            <td><?php echo $dado['user_id']; ?></td>
                            <td>
                                <?php $titulo = $dado['titulo'];
                                $titulo_novo = preg_replace('/[ -]+/', '_', $titulo); ?>
                                <a class="btn btn-secund" href="/administracao/editar_post.php?buscaTitulo=<?php echo $titulo_novo; ?>">Editar</a>
                                <a class="btn btn-secund" href="/administracao/deletar_post.php?buscaTitulo=<?php echo $titulo_novo; ?>">Excluir</a>
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
    <script src="/assets/js/barraPesquisa.js"></script>

</body>

</html>