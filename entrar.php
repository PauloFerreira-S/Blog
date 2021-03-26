<?php $pagina = "entrar";
$logado = "";

session_start();
if ((!isset($_SESSION['usuario']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['usuario']);
    unset($_SESSION['senha']);
} else {
    header('location:index.php');
    $logado = $_SESSION['usuario'];
}

header('content-type: text/html; charset=utf-8'); ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta http-equiv="content-language" content="pt-br" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#0375b4" />

    <title>Entrar</title>
    <link href="assets/img/nav_icon.png" rel="icon">
    <!-- Bootstrap & FontAwesome CSS -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Estilo Customizado -->
    <link href="assets/css/login.css" rel="stylesheet">

</head>

<body>
    <div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" method="post" action="assets/includes/acesso.php">
                            <div class="text-center text-white pt-5">
                                <img alt="logo blog" class="logo-entrar" src="/assets/img/logo_entrar.png">
                            </div>
                            <div class="">
                                <label for="usuario" class="text-info"> Usuario </label>
                                <input type="text" name="usuario" id="usuario" class="form-control">
                            </div>
                            <div class="">
                                <label for="senha" class="text-info"> Senha </label>
                                <input type="password" name="senha" id="senha" class="form-control">
                            </div>
                            <div>
                                <button type="submit" id="btnEntrar" class="btn btn-tema btn-block bg-tema mt-4">Entrar no blog</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="assets/jquery/jquery-3.5.1.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>