<?php

$usuario = ($_POST['usuario']);
$senha = ($_POST['senha']);

// Conexao com Banco de Dados.
session_start();
// as variáveis login e senha recebem os dados digitados na página entrar.php

include 'conexao.php';

$consulta = "SELECT * FROM `usuario` WHERE nome = '$usuario' AND senha = '$senha'";
$con = $link->query($consulta) or die($link->error);

// Se encontrou algum registro idêntico o seu valor será igual a 1//
if (mysqli_num_rows($con) > 0) {
  $_SESSION['usuario'] = $usuario;
  $_SESSION['senha'] = $senha;
  header('location: ../../adm.php');
} else {
  echo "<script language='javascript' type='text/javascript'>
        alert('Login e/ou senha incorretos');window.location
        .href='../../entrar.php';</script>";
  die();
}
